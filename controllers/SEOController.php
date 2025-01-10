<?php
namespace Controllers;

use Services\SEOAnalyzer;

class SEOController {
    private $seoAnalyzer;

    public function __construct() {
        $this->seoAnalyzer = new SEOAnalyzer();
    }

    public function analyze(): void {
        $listing = $this->getListing();
        $analysis = $this->seoAnalyzer->analyzeListing($listing);
        
        header('Content-Type: application/json');
        echo json_encode($analysis);
    }

    private function getListing(): array {
        // In a real application, this would come from POST data or database
        return [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? '',
            'images' => $_POST['images'] ?? [],
            'price' => (float) ($_POST['price'] ?? 0),
            'comparePrice' => isset($_POST['comparePrice']) ? (float) $_POST['comparePrice'] : null,
            'category' => $_POST['category'] ?? '',
            'attributes' => $_POST['attributes'] ?? []
        ];
    }
}