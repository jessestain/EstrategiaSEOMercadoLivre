<?php
namespace Models\SEO;

class TrendAnalyzer {
    public function analyzeTrends(array $keywords): array {
        $trends = [];
        foreach ($keywords as $keyword) {
            $trends[$keyword] = $this->getKeywordTrend($keyword);
        }
        
        return [
            'trends' => $trends,
            'suggestions' => $this->generateTrendSuggestions($trends)
        ];
    }

    private function getKeywordTrend(string $keyword): array {
        // Simplified trend analysis
        return [
            'popularity' => 'high',
            'growth' => 'stable',
            'competition' => 'medium'
        ];
    }

    private function generateTrendSuggestions(array $trends): array {
        $suggestions = [];
        foreach ($trends as $keyword => $trend) {
            if ($trend['popularity'] === 'high' && $trend['competition'] === 'low') {
                $suggestions[] = "Keyword '$keyword' has high potential - consider featuring it prominently";
            }
        }
        return $suggestions;
    }
}