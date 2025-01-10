<?php
namespace Models\SEO;

class ImageOptimizer {
    private const MIN_IMAGES = 3;
    private const MAX_IMAGES = 10;
    private const MIN_RESOLUTION = 500;
    private const MAX_FILE_SIZE = 2097152; // 2MB

    public function analyzeImages(array $images): array {
        $suggestions = [];
        $imageCount = count($images);

        if ($imageCount < self::MIN_IMAGES) {
            $suggestions[] = "Add at least " . self::MIN_IMAGES . " images for better visibility";
        }
        if ($imageCount > self::MAX_IMAGES) {
            $suggestions[] = "Reduce number of images to maximum " . self::MAX_IMAGES;
        }

        return [
            'imageCount' => $imageCount,
            'isOptimal' => $imageCount >= self::MIN_IMAGES && $imageCount <= self::MAX_IMAGES,
            'suggestions' => $suggestions
        ];
    }
}