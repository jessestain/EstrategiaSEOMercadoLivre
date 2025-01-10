<?php
namespace Utils;

class ValidationHelper {
    public static function validateTitle(string $title): array {
        $length = strlen($title);
        $isValid = $length >= 30 && $length <= 60;
        
        return [
            'isValid' => $isValid,
            'length' => $length,
            'message' => $isValid ? '' : "Title should be between 30 and 60 characters (current: $length)"
        ];
    }

    public static function validateDescription(string $description): array {
        $length = strlen($description);
        $isValid = $length >= 200 && $length <= 4000;
        
        return [
            'isValid' => $isValid,
            'length' => $length,
            'message' => $isValid ? '' : "Description should be between 200 and 4000 characters (current: $length)"
        ];
    }

    public static function validatePrice(float $price, ?float $marketAverage = null): array {
        $isValid = $price > 0;
        $message = '';

        if (!$isValid) {
            $message = 'Price must be greater than zero';
        } elseif ($marketAverage && $price > $marketAverage * 1.5) {
            $message = 'Price is significantly higher than market average';
        }

        return [
            'isValid' => $isValid,
            'message' => $message
        ];
    }
}