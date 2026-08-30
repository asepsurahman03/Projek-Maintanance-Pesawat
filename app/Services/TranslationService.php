<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    /**
     * Translate text from source language (default: 'en') to target language (default: 'id')
     */
    public function translate(string $text, string $target = 'id', string $source = 'en'): string
    {
        $text = trim($text);
        if (empty($text)) {
            return '';
        }

        if ($target === $source) {
            return $text;
        }

        $cacheKey = 'tr_' . $source . '_' . $target . '_' . md5($text);

        // Return from cache if already translated
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $translated = null;

        // Provider 1: MyMemory Translation API
        try {
            $response = Http::timeout(8)->get('https://api.mymemory.translated.net/get', [
                'q'        => $text,
                'langpair' => "{$source}|{$target}",
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $transText = $data['responseData']['translatedText'] ?? null;
                if (!empty($transText) && stripos($transText, 'MYMEMORY WARNING') === false) {
                    $translated = html_entity_decode($transText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }
            }
        } catch (\Exception $e) {
            Log::info('MyMemory Translation API error: ' . $e->getMessage());
        }

        // Provider 2: Lingva Translation API (Google Translate Proxy)
        if (!$translated) {
            try {
                $encodedText = rawurlencode($text);
                $response = Http::timeout(8)->get("https://lingva.ml/api/v1/{$source}/{$target}/{$encodedText}");
                if ($response->successful()) {
                    $data = $response->json();
                    if (!empty($data['translation'])) {
                        $translated = $data['translation'];
                    }
                }
            } catch (\Exception $e) {
                Log::info('Lingva Translation API error: ' . $e->getMessage());
            }
        }

        // Provider 3: Direct Google GTX
        if (!$translated) {
            try {
                $response = Http::timeout(8)
                    ->withHeaders(['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36'])
                    ->get('https://translate.googleapis.com/translate_a/single', [
                        'client' => 'gtx',
                        'sl'     => $source,
                        'tl'     => $target,
                        'dt'     => 't',
                        'q'      => $text,
                    ]);

                if ($response->successful()) {
                    $result = $response->json();
                    if (is_array($result) && isset($result[0]) && is_array($result[0])) {
                        $str = '';
                        foreach ($result[0] as $part) {
                            if (is_array($part) && isset($part[0])) {
                                $str .= $part[0];
                            }
                        }
                        if (!empty(trim($str))) {
                            $translated = $str;
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::info('Google GTX Translation error: ' . $e->getMessage());
            }
        }

        if ($translated && $translated !== $text) {
            Cache::forever($cacheKey, $translated);
            return $translated;
        }

        return $text;
    }
}
