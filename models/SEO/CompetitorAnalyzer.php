<?php
namespace Models\SEO;

class CompetitorAnalyzer {
    public function analyzeCompetition(array $competitorData): array {
        $suggestions = [];
        $metrics = [
            'pricePosition' => $this->analyzePricePosition($competitorData['prices']),
            'imageCount' => $this->compareImageCount($competitorData['imageCounts']),
            'titleLength' => $this->compareTitleLength($competitorData['titleLengths'])
        ];

        foreach ($metrics as $metric => $data) {
            if (!$data['isCompetitive']) {
                $suggestions[] = $data['suggestion'];
            }
        }

        return [
            'metrics' => $metrics,
            'suggestions' => $suggestions,
            'isCompetitive' => count($suggestions) === 0
        ];
    }

    private function analyzePricePosition(array $prices): array {
        $avgPrice = array_sum($prices) / count($prices);
        return [
            'averagePrice' => $avgPrice,
            'isCompetitive' => true,
            'suggestion' => ''
        ];
    }

    private function compareImageCount(array $counts): array {
        $avgCount = array_sum($counts) / count($counts);
        return [
            'averageCount' => $avgCount,
            'isCompetitive' => true,
            'suggestion' => ''
        ];
    }

    private function compareTitleLength(array $lengths): array {
        $avgLength = array_sum($lengths) / count($lengths);
        return [
            'averageLength' => $avgLength,
            'isCompetitive' => true,
            'suggestion' => ''
        ];
    }
}