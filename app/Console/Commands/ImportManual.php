<?php

namespace App\Console\Commands;

use App\Models\Manual;
use App\Models\Section;
use App\Models\Subsection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportManual extends Command
{
    protected $signature = 'manual:import
                            {--section= : Only import a specific section number}
                            {--dry-run  : Preview what would be imported without saving}
                            {--force    : Overwrite existing content}';

    protected $description = 'Import content from the Cessna 172-Series Service Manual PDF';

    public function handle(): int
    {
        if (!class_exists(\Smalot\PdfParser\Parser::class)) {
            $this->error('smalot/pdfparser is not installed. Run: composer require smalot/pdfparser');
            return Command::FAILURE;
        }

        $pdfPath = storage_path('app/public/manual/cessna_172_1969-76_smv1975.pdf');

        if (!file_exists($pdfPath)) {
            $this->error("PDF not found at: {$pdfPath}");
            $this->warn('Please copy the PDF to: storage/app/public/manual/');
            $this->warn('Then run: php artisan storage:link');
            return Command::FAILURE;
        }

        $manual = Manual::where('title', 'Cessna 172-Series Service Manual')->first();
        if (!$manual) {
            $this->error('Manual record not found. Run: php artisan db:seed --class=ManualSeeder');
            return Command::FAILURE;
        }

        $this->info('Parsing PDF... (this may take a few minutes)');
        $this->info('File: ' . basename($pdfPath));

        try {
            $parser = new \Smalot\PdfParser\Parser();
            $pdf    = $parser->parseFile($pdfPath);
            $pages  = $pdf->getPages();
            $totalPages = count($pages);
            $this->info("Total pages: {$totalPages}");
        } catch (\Exception $e) {
            $this->error('PDF parsing failed: ' . $e->getMessage());
            $this->warn('Tip: Some PDF files have restrictions that prevent text extraction.');
            return Command::FAILURE;
        }

        $sections = Section::where('manual_id', $manual->id)->get()->keyBy('section_number');
        if ($sections->isEmpty()) {
            $this->warn('No sections found. Run: php artisan db:seed --class=SectionSeeder');
            return Command::FAILURE;
        }

        $targetSection = $this->option('section');
        $dryRun        = $this->option('dry-run');
        $force         = $this->option('force');

        if ($dryRun) {
            $this->warn('[DRY RUN] No data will be saved.');
        }

        $imported    = 0;
        $skipped     = 0;
        $currentSection = null;
        $buffer      = [];
        $paraNum     = 1;

        $bar = $this->output->createProgressBar($totalPages);
        $bar->start();

        foreach ($pages as $pageNum => $page) {
            $bar->advance();
            $pageIndex = $pageNum + 1; // 1-indexed

            try {
                $text = $page->getText();
            } catch (\Exception $e) {
                continue;
            }

            if (empty(trim($text))) continue;

            $lines = explode("\n", $text);

            foreach ($lines as $line) {
                $line = trim($line);
                if (strlen($line) < 3) continue;

                // Detect section headers (e.g. "SECTION 11 ENGINE" or just numbered paragraphs)
                if (preg_match('/^(SECTION|CHAPTER)\s+([\dA-Z]+)\s*[-—]?\s*(.+)?$/i', $line, $m)) {
                    $num = strtoupper(trim($m[2]));
                    if ($sections->has($num)) {
                        if ($buffer && $currentSection && !$dryRun) {
                            $this->saveBuffer($buffer, $currentSection, $pageIndex, $force);
                        }
                        $currentSection = $sections[$num];
                        $buffer         = [];
                        $paraNum        = 1;
                    }
                    continue;
                }

                // Detect paragraph numbers (e.g. "1.", "2.a.", "A.")
                if ($currentSection && preg_match('/^(\d+[\.\d]*\.?[a-z]?\.?)\s{1,4}(.+)$/', $line, $m)) {
                    if ($buffer) {
                        $this->saveBuffer($buffer, $currentSection, $pageIndex, $force, $dryRun);
                        $imported++;
                    }
                    $buffer = [
                        'paragraph_number' => $m[1],
                        'title'            => null,
                        'content'          => $m[2],
                        'page'             => $pageIndex,
                    ];
                    $paraNum++;
                } elseif ($buffer) {
                    $buffer['content'] .= "\n" . $line;
                }
            }
        }

        // Save last buffer
        if ($buffer && $currentSection && !$dryRun) {
            $this->saveBuffer($buffer, $currentSection, $totalPages, $force);
            $imported++;
        }

        $bar->finish();
        $this->newLine(2);

        if ($dryRun) {
            $this->info("[DRY RUN] Would have imported approximately {$imported} paragraphs.");
        } else {
            $this->info("✓ Import complete! Imported {$imported} paragraphs.");
        }

        $this->newLine();
        $this->warn('IMPORTANT: Verify all imported content against the original PDF.');
        $this->warn('PDF text extraction may have formatting artifacts that require manual correction.');

        return Command::SUCCESS;
    }

    private function saveBuffer(array $buffer, Section $section, int $page, bool $force, bool $dryRun = false): void
    {
        if (empty(trim($buffer['content'] ?? ''))) return;

        if ($dryRun) {
            $this->line("  [DRY] §{$section->section_number} ¶{$buffer['paragraph_number']}: " . \Str::limit($buffer['content'], 60));
            return;
        }

        $existing = Subsection::where('section_id', $section->id)
            ->where('paragraph_number', $buffer['paragraph_number'])
            ->first();

        if ($existing && !$force) return;

        $data = [
            'section_id'       => $section->id,
            'paragraph_number' => $buffer['paragraph_number'] ?? null,
            'title'            => $buffer['title'] ?? null,
            'content'          => trim($buffer['content']),
            'page'             => $page,
            'sort_order'       => (int) filter_var($buffer['paragraph_number'], FILTER_SANITIZE_NUMBER_INT),
        ];

        if ($existing) {
            $existing->update($data);
        } else {
            Subsection::create($data);
        }
    }
}
