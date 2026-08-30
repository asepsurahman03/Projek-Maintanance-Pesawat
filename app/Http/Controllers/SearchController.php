<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Subsection;
use App\Models\Specification;
use App\Models\Figure;
use App\Models\AircraftModel;
use App\Models\InspectionItem;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query  = $request->get('q', '');
        $filter = $request->get('filter', 'all');
        $results = collect();
        $counts  = [];

        if (strlen(trim($query)) >= 2) {
            $q = trim($query);

            if (in_array($filter, ['all', 'sections'])) {
                $sections = Section::where('title', 'LIKE', "%{$q}%")
                    ->orWhere('description', 'LIKE', "%{$q}%")
                    ->get()
                    ->map(fn($s) => [
                        'type'    => 'section',
                        'label'   => 'Section ' . $s->section_number,
                        'title'   => $s->title,
                        'excerpt' => \Str::limit($s->description, 180),
                        'page'    => $s->page_start,
                        'url'     => route('manual.section', $s->section_number),
                        'badge'   => 'Section',
                        'badge_color' => 'blue',
                    ]);
                $counts['sections'] = $sections->count();
                if ($filter === 'sections') { $results = $sections; }
                else { $results = $results->merge($sections); }
            }

            if (in_array($filter, ['all', 'paragraphs'])) {
                $subs = Subsection::where('title', 'LIKE', "%{$q}%")
                    ->orWhere('content', 'LIKE', "%{$q}%")
                    ->with('section')
                    ->limit(30)
                    ->get()
                    ->map(fn($s) => [
                        'type'    => 'paragraph',
                        'label'   => 'Section ' . $s->section?->section_number . ' — ¶' . $s->paragraph_number,
                        'title'   => $s->title ?? $s->section?->title,
                        'excerpt' => $this->highlight($this->excerpt($s->content, $q), $q),
                        'page'    => $s->page,
                        'url'     => route('manual.section', $s->section?->section_number ?? '#'),
                        'badge'   => 'Paragraph',
                        'badge_color' => 'slate',
                    ]);
                $counts['paragraphs'] = $subs->count();
                if ($filter === 'paragraphs') { $results = $subs; }
                else { $results = $results->merge($subs); }
            }

            if (in_array($filter, ['all', 'specifications'])) {
                $specs = Specification::where('name', 'LIKE', "%{$q}%")
                    ->orWhere('value', 'LIKE', "%{$q}%")
                    ->orWhere('category', 'LIKE', "%{$q}%")
                    ->with('section')
                    ->limit(20)
                    ->get()
                    ->map(fn($s) => [
                        'type'    => 'specification',
                        'label'   => $s->category,
                        'title'   => $s->name,
                        'excerpt' => "{$s->value} {$s->unit}" . ($s->model ? " — {$s->model}" : ''),
                        'page'    => $s->source_page,
                        'url'     => route('specifications') . '#' . \Str::slug($s->category),
                        'badge'   => 'Specification',
                        'badge_color' => 'green',
                    ]);
                $counts['specifications'] = $specs->count();
                if ($filter === 'specifications') { $results = $specs; }
                else { $results = $results->merge($specs); }
            }

            if (in_array($filter, ['all', 'figures'])) {
                $figs = Figure::where('title', 'LIKE', "%{$q}%")
                    ->orWhere('figure_number', 'LIKE', "%{$q}%")
                    ->orWhere('caption', 'LIKE', "%{$q}%")
                    ->with('section')
                    ->limit(20)
                    ->get()
                    ->map(fn($f) => [
                        'type'    => 'figure',
                        'label'   => 'Figure ' . $f->figure_number,
                        'title'   => $f->title,
                        'excerpt' => \Str::limit($f->caption, 180),
                        'page'    => $f->page,
                        'url'     => route('figures.show', $f->id),
                        'badge'   => 'Figure',
                        'badge_color' => 'amber',
                    ]);
                $counts['figures'] = $figs->count();
                if ($filter === 'figures') { $results = $figs; }
                else { $results = $results->merge($figs); }
            }

            if (in_array($filter, ['all', 'models'])) {
                $models = AircraftModel::where('model', 'LIKE', "%{$q}%")
                    ->orWhere('popular_name', 'LIKE', "%{$q}%")
                    ->orWhere('year', 'LIKE', "%{$q}%")
                    ->limit(10)
                    ->get()
                    ->map(fn($m) => [
                        'type'    => 'model',
                        'label'   => $m->year,
                        'title'   => "{$m->popular_name} — {$m->model}",
                        'excerpt' => "Serial: {$m->serial_beginning} – {$m->serial_ending}",
                        'page'    => $m->source_page,
                        'url'     => route('models.show', $m->id),
                        'badge'   => 'Model',
                        'badge_color' => 'sky',
                    ]);
                $counts['models'] = $models->count();
                if ($filter === 'models') { $results = $models; }
                else { $results = $results->merge($models); }
            }

            if (in_array($filter, ['all', 'inspection'])) {
                $items = InspectionItem::where('item', 'LIKE', "%{$q}%")
                    ->orWhere('description', 'LIKE', "%{$q}%")
                    ->limit(20)
                    ->get()
                    ->map(fn($i) => [
                        'type'    => 'inspection',
                        'label'   => $i->interval,
                        'title'   => $i->item,
                        'excerpt' => \Str::limit($i->description, 180),
                        'page'    => $i->source_page,
                        'url'     => route('inspection') . '#interval-' . \Str::slug($i->interval),
                        'badge'   => 'Inspection',
                        'badge_color' => 'red',
                    ]);
                $counts['inspection'] = $items->count();
                if ($filter === 'inspection') { $results = $items; }
                else { $results = $results->merge($items); }
            }
        }

        $counts['all'] = $results->count();

        return view('search.index', compact('query', 'filter', 'results', 'counts'));
    }

    private function excerpt(?string $text, string $query, int $length = 200): string
    {
        if (!$text) return '';
        $pos = stripos($text, $query);
        if ($pos === false) return \Str::limit($text, $length);
        $start = max(0, $pos - 60);
        return ($start > 0 ? '...' : '') . \Str::limit(substr($text, $start), $length) ;
    }

    private function highlight(string $text, string $query): string
    {
        return preg_replace('/(' . preg_quote($query, '/') . ')/i',
            '<mark class="search-highlight">$1</mark>', $text);
    }
}
