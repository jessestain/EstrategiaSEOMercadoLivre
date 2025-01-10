<?php
namespace Utils;

class StringHelper {
    public static function cleanText(string $text): string {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    public static function extractWords(string $text): array {
        $text = self::cleanText($text);
        return str_word_count(strtolower($text), 1);
    }

    public static function calculateWordFrequency(array $words): array {
        return array_count_values($words);
    }
}