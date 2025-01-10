<?php
namespace Services;

use Models\SEO\{
    KeywordDensityAnalyzer,
    CompetitorAnalyzer,
    TrendAnalyzer
};
use Utils\{
    TextAnalysisHelper,
    MarketplaceHelper
};

class ListingOptimizer {
    private $keywordAnalyzer;
    private $competitorAnalyzer;
    private $trendAnalyzer;

    public function __construct() {
        $this->keywordAnalyzer = new KeywordDensityAnalyzer();
        $this->competitorAnalyzer = new CompetitorAnalyzer();
        $this->trendAnalyzer = new TrendAnalyzer();
    }

    public function optimizeListing(array $listing): array {
        $readability = TextAnalysisHelper::calculateReadability($listing['description']);
        $categoryReqs = MarketplaceHelper::getCategoryRequirements($listing['category']);
        $attributes = MarketplaceHelper::validateAttributes($listing['attributes'], $categoryReqs);
        
        $keywords = $this->extractKeywords($listing['title'], $listing['description']);
        $keywordDensity = $this->keywordAnalyzer->analyzeKeywordDensity(
            $listing['description'], 
            $keywords
        );
        
        $trends = $this->trendAnalyzer->analyzeTrends($keywords);

        return [
            'readability' => $readability,
            'attributes' => $attributes,
            'keywords' => [
                'extracted' => $keywords,
                'density' => $keywordDensity,
                'trends' => $trends
            ],
            'suggestions' => $this->compileSuggestions($readability, $attributes, $trends)
        ];
    }

    private function extractKeywords(string $title, string $description): array {
        // Simple keyword extraction
        $text = strtolower($title . ' ' . $description);
        $words = str_word_count($text, 1);
        return array_unique(array_filter($words, fn($word) => strlen($word) > 3));
    }

    private function compileSuggestions(array $readability, array $attributes, array $trends): array {
        $suggestions = [];
        
        if (!$readability['isOptimal']) {
            $suggestions[] = "Improve text readability (current level: {$readability['level']})";
        }
        
        if (!empty($attributes['missing'])) {
            $suggestions[] = "Add required attributes: " . implode(', ', $attributes['missing']);
        }
        
        return array_merge($suggestions, $trends['suggestions']);
    }
}