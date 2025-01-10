<?php
namespace Utils;

class TextAnalysisHelper {
    public static function calculateReadability(string $text): array {
        $sentences = self::countSentences($text);
        $words = str_word_count($text);
        $syllables = self::countSyllables($text);
        
        $fleschScore = 206.835 - 1.015 * ($words / $sentences) - 84.6 * ($syllables / $words);
        
        return [
            'score' => round($fleschScore, 2),
            'level' => self::getReadabilityLevel($fleschScore),
            'isOptimal' => $fleschScore >= 60 && $fleschScore <= 80
        ];
    }

    private static function countSentences(string $text): int {
        return preg_match_all('/[.!?]+/', $text, $matches);
    }

    private static function countSyllables(string $text): int {
        // Simplified syllable counting
        return str_word_count($text);
    }

    private static function getReadabilityLevel(float $score): string {
        if ($score >= 90) return 'Very Easy';
        if ($score >= 80) return 'Easy';
        if ($score >= 70) return 'Fairly Easy';
        if ($score >= 60) return 'Standard';
        if ($score >= 50) return 'Fairly Difficult';
        if ($score >= 30) return 'Difficult';
        return 'Very Difficult';
    }
}