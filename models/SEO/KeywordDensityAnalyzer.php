<?php
namespace Models\SEO;

class KeywordDensityAnalyzer {
    private const OPTIMAL_DENSITY_MIN = 1;
    private const OPTIMAL_DENSITY_MAX = 3;

    public function analyzeKeywordDensity(string $text, array $keywords): array {
        $wordCount = str_word_count(strtolower($text));
        $densities = [];
        
        foreach ($keywords as $keyword) {
            $count = substr_count(strtolower($text), strtolower($keyword));
            $density = ($wordCount > 0) ? ($count / $wordCount) * 100 : 0;
            $densities[$keyword] = [
                'count' => $count,
                'density' => round($density, 2),
                'isOptimal' => $density >= self::OPTIMAL_DENSITY_MIN && $density <= self::OPTIMAL_DENSITY_MAX
            ];
        }

        return $densities;
    }
}