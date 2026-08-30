<?php

namespace App\Http\Controllers;

use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TranslationController extends Controller
{
    public function __construct(
        protected TranslationService $translator
    ) {}

    /**
     * Translate text or paragraph
     * POST /api/translate
     */
    public function translate(Request $request): JsonResponse
    {
        $request->validate([
            'text'   => 'required|string',
            'target' => 'nullable|string|max:5',
            'source' => 'nullable|string|max:5',
        ]);

        $text   = $request->input('text');
        $target = $request->input('target', 'id');
        $source = $request->input('source', 'en');

        $translated = $this->translator->translate($text, $target, $source);

        return response()->json([
            'success'    => true,
            'original'   => $text,
            'translated' => $translated,
            'source'     => $source,
            'target'     => $target,
        ]);
    }
}
