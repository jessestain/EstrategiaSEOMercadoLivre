<?php
namespace Models\SEO;

class TitleOptimizer {
    private const MAX_LENGTH = 60;
    private const MIN_LENGTH = 30;

    public function optimizeTitle(string $title): array {
        $length = strlen($title);
        $suggestions = [];

        if ($length > self::MAX_LENGTH) {
            $suggestions[] = 'Title is too long. Reduce to ' . self::MAX_LENGTH . ' characters.';
        } elseif ($length < self::MIN_LENGTH) {
            $suggestions[] = 'Title is too short. Increase to at least ' . self::MIN_LENGTH . ' characters.';
        }

        return [
            'title' => $title,
            'length' => $length,
            'isOptimal' => $length >= self::MIN_LENGTH && $length <= self::MAX_LENGTH,
            'suggestions' => $suggestions
        ];
    }
}