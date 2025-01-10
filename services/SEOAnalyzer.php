<?php
namespace Services;

use Models\SEO\{
    ImageAnalyzer,
    CategoryAnalyzer,
    KeywordDensityAnalyzer,
    TrendAnalyzer
};
use Utils\{
    StringHelper,
    ValidationHelper
};

class SEOAnalyzer {
    private $imageAnalyzer;
    private $categoryAnalyzer;
    private $keywordAnalyzer;
    private $trendAnalyzer;

    public function __construct() {
        $this->imageAnalyzer = new ImageAnalyzer();
        $this->categoryAnalyzer = new CategoryAnalyzer();
        $this->keywordAnalyzer = new KeywordDensityAnalyzer();
        $this->trendAnalyzer = new TrendAnalyzer();
    }

    public function analyzeListing(array $listing): array {
        $titleValidation = ValidationHelper::validateTitle($listing['title']);
        $descriptionValidation = ValidationHelper::validateDescription($listing['description']);
        $priceValidation = ValidationHelper::validatePrice($listing['price'], $listing['marketAverage'] ?? null);

        $analysis = [
            'title' => $titleValidation,
            'description' => $descriptionValidation,
            'price' => $priceValidation,
            'images' => $this->imageAnalyzer->analyzeImages($listing['images']),
            'category' => $this->categoryAnalyzer->analyzeCategory($listing['category'], $listing['attributes']),
            'keywords' => $this->analyzeKeywords($listing['title'], $listing['description']),
            'score' => 0,
            'suggestions' => []
        ];

        $this->calculateScore($analysis);
        $this->compileSuggestions($analysis);

        return $analysis;
    }

    private function analyzeKeywords(string $title, string $description): array {
        $words = StringHelper::extractWords($title . ' ' . $description);
        $frequency = StringHelper::calculateWordFrequency($words);
        $keywords = array_slice($frequency, 0, 10, true);

        return [
            'main' => array_keys($keywords),
            'frequency' => $frequency,
            'density' => $this->keywordAnalyzer->analyzeKeywordDensity($description, array_keys($keywords)),
            'trends' => $this->trendAnalyzer->analyzeTrends(array_keys($keywords))
        ];
    }

    private function calculateScore(array &$analysis): void {
        $scores = [
            'title' => $analysis['title']['isValid'] ? 20 : 0,
            'description' => $analysis['description']['isValid'] ? 20 : 0,
            'images' => count($analysis['images']['suggestions']) === 0 ? 20 : 10,
            'category' => $analysis['category']['required']['complete'] ? 20 : 0,
            'price' => $analysis['price']['isValid'] ? 20 : 0
        ];

        $analysis['score'] = array_sum($scores);
    }

    private function compileSuggestions(array &$analysis): void {
        $suggestions = [];

        if (!$analysis['title']['isValid']) {
            $suggestions[] = $analysis['title']['message'];
        }

        if (!$analysis['description']['isValid']) {
            $suggestions[] = $analysis['description']['message'];
        }

        if (!empty($analysis['images']['suggestions'])) {
            $suggestions = array_merge($suggestions, $analysis['images']['suggestions']);
        }

        if (!empty($analysis['category']['suggestions'])) {
            $suggestions = array_merge($suggestions, $analysis['category']['suggestions']);
        }

        if (!empty($analysis['price']['message'])) {
            $suggestions[] = $analysis['price']['message'];
        }

        $analysis['suggestions'] = $suggestions;
    }
}