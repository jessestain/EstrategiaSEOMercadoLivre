<?php
namespace Models\SEO;

class ImageAnalyzer {
    private const MIN_IMAGES = 3;
    private const MAX_IMAGES = 10;
    private const MIN_WIDTH = 800;
    private const MIN_HEIGHT = 800;
    private const MAX_FILE_SIZE = 2097152; // 2MB

    public function analyzeImages(array $images): array {
        $results = [
            'count' => count($images),
            'quality' => [],
            'suggestions' => []
        ];

        foreach ($images as $index => $image) {
            $imageAnalysis = $this->analyzeSingleImage($image, $index + 1);
            $results['quality'][] = $imageAnalysis;
            if (!empty($imageAnalysis['issues'])) {
                $results['suggestions'] = array_merge($results['suggestions'], $imageAnalysis['issues']);
            }
        }

        $this->validateImageCount($results);
        return $results;
    }

    private function analyzeSingleImage(array $image, int $position): array {
        $issues = [];
        
        if ($image['width'] < self::MIN_WIDTH || $image['height'] < self::MIN_HEIGHT) {
            $issues[] = "Image #$position: Resolution too low (minimum {self::MIN_WIDTH}x{self::MIN_HEIGHT})";
        }

        if ($image['size'] > self::MAX_FILE_SIZE) {
            $issues[] = "Image #$position: File size too large (maximum 2MB)";
        }

        return [
            'position' => $position,
            'dimensions' => "{$image['width']}x{$image['height']}",
            'size' => $image['size'],
            'isValid' => empty($issues),
            'issues' => $issues
        ];
    }

    private function validateImageCount(array &$results): void {
        if ($results['count'] < self::MIN_IMAGES) {
            $results['suggestions'][] = "Add at least " . self::MIN_IMAGES . " images";
        } elseif ($results['count'] > self::MAX_IMAGES) {
            $results['suggestions'][] = "Reduce to maximum " . self::MAX_IMAGES . " images";
        }
    }
}