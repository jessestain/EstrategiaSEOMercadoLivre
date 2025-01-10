<?php
namespace Models\SEO;

class CategoryAnalyzer {
    public function analyzeCategory(string $category, array $attributes): array {
        $requirements = $this->getCategoryRequirements($category);
        $analysis = [
            'category' => $category,
            'required' => $this->validateRequiredAttributes($attributes, $requirements['required']),
            'recommended' => $this->validateRecommendedAttributes($attributes, $requirements['recommended']),
            'suggestions' => []
        ];

        $this->generateSuggestions($analysis);
        return $analysis;
    }

    private function getCategoryRequirements(string $category): array {
        // This would typically fetch from a database or API
        return [
            'required' => ['brand', 'model', 'condition'],
            'recommended' => ['color', 'size', 'material']
        ];
    }

    private function validateRequiredAttributes(array $attributes, array $required): array {
        $missing = array_diff($required, array_keys($attributes));
        return [
            'complete' => empty($missing),
            'missing' => $missing
        ];
    }

    private function validateRecommendedAttributes(array $attributes, array $recommended): array {
        $missing = array_diff($recommended, array_keys($attributes));
        return [
            'complete' => empty($missing),
            'missing' => $missing
        ];
    }

    private function generateSuggestions(array &$analysis): void {
        if (!empty($analysis['required']['missing'])) {
            $analysis['suggestions'][] = "Add required attributes: " . 
                implode(', ', $analysis['required']['missing']);
        }

        if (!empty($analysis['recommended']['missing'])) {
            $analysis['suggestions'][] = "Consider adding recommended attributes: " . 
                implode(', ', $analysis['recommended']['missing']);
        }
    }
}