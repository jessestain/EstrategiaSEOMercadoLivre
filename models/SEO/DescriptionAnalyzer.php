<?php
namespace Models\SEO;

class DescriptionAnalyzer {
    private const MAX_LENGTH = 4000;
    private const MIN_LENGTH = 200;

    public function analyzeDescription(string $description): array {
        $length = strlen($description);
        $suggestions = [];

        if ($length > self::MAX_LENGTH) {
            $suggestions[] = 'Description is too long. Reduce to ' . self::MAX_LENGTH . ' characters.';
        } elseif ($length < self::MIN_LENGTH) {
            $suggestions[] = 'Description is too short. Increase to at least ' . self::MIN_LENGTH . ' characters.';
        }

        return [
            'description' => $description,
            'length' => $length,
            'isOptimal' => $length >= self::MIN_LENGTH && $length <= self::MAX_LENGTH,
            'suggestions' => $suggestions
        ];
    }
}