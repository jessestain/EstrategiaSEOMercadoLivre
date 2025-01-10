<?php
namespace Models\SEO;

class PriceAnalyzer {
    public function analyzePricing(float $price, ?float $comparePrice = null): array {
        $suggestions = [];

        if ($comparePrice && $price >= $comparePrice) {
            $suggestions[] = "Consider setting a competitive price below market average";
        }

        if ($price <= 0) {
            $suggestions[] = "Invalid price. Must be greater than zero";
        }

        return [
            'price' => $price,
            'comparePrice' => $comparePrice,
            'isCompetitive' => $comparePrice ? $price < $comparePrice : true,
            'suggestions' => $suggestions
        ];
    }
}