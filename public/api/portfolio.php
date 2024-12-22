<?php
require_once __DIR__ . '/../../src/autoload.php';

header('Content-Type: application/json');

use Services\PortfolioService;

try {
    $service = new PortfolioService();
    $data = $service->getPortfolioData(
        $_GET['timeframe'] ?? 'daily',
        $_GET['currency'] ?? null,
        $_GET['coin'] ?? null
    );
    
    echo json_encode(['success' => true, 'data' => $data]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}