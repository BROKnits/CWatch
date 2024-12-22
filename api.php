<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/src/autoload.php';

header('Content-Type: application/json');

use Services\PortfolioService;

try {
    $timeframe = $_GET['timeframe'] ?? 'daily';
    $currency = $_GET['currency'] ?? null;
    $coin = $_GET['coin'] ?? null;

    $service = new PortfolioService();
    $data = $service->getPortfolioData($timeframe, $currency, $coin);
    
    echo json_encode(['success' => true, 'data' => $data]);
} catch (Exception $e) {
    error_log("API Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}