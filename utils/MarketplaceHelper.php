<?php
namespace Utils;

class MarketplaceHelper {
    public static function getCategoryRequirements(string $category): array {
        // Simplified category requirements
        return [
            'required_attributes' => [
                'brand',
                'model',
                'condition'
            ],
            'recommended_attributes' => [
                'color',
                'size',
                'material'
            ],
            'min_images' => 3,
            'max_images' => 10
        ];
    }

    public static function validateAttributes(array $attributes, array $requirements): array {
        $missing = array_diff($requirements['required_attributes'], array_keys($attributes));
        $recommended = array_diff($requirements['recommended_attributes'], array_keys($attributes));
        
        return [
            'isValid' => empty($missing),
            'missing' => $missing,
            'recommended' => $recommended
        ];
    }
}