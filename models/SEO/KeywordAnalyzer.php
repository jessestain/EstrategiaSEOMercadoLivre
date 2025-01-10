<?php
namespace Models\SEO;

class KeywordAnalyzer {
    public function analyzeKeywords(string $title, string $description): array {
        $keywords = $this->extractKeywords($title . ' ' . $description);
        return $this->rankKeywords($keywords);
    }

    private function extractKeywords(string $text): array {
        $text = strtolower($text);
        $words = str_word_count($text, 1);
        return array_filter($words, function($word) {
            return strlen($word) > 3;
        });
    }

    private function rankKeywords(array $keywords): array {
        $frequency = array_count_values($keywords);
        arsort($frequency);
        return array_slice($frequency, 0, 10, true);
    }
}