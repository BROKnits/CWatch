<?php
require_once __DIR__ . '/../src/autoload.php';
use Services\PortfolioService;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Portfolio Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon"></script>
    <script type="module" src="/js/portfolio.js"></script>
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h1 class="text-2xl font-bold mb-4">Crypto Portfolio Tracker</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <select id="timeframe" class="form-select rounded border p-2">
                    <option value="hourly">Hourly</option>
                    <option value="daily" selected>Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
                <select id="currency" class="form-select rounded border p-2">
                    <option value="USD" selected>USD</option>
                    <option value="">All Currencies</option>
                </select>
                <select id="coin" class="form-select rounded border p-2">
                    <option value="BTC" selected>BTC</option>
                    <option value="">All Coins</option>
                </select>
            </div>
            <div class="h-[600px]">
                <canvas id="portfolioChart"></canvas>
            </div>
        </div>
    </div>
</body>
</html>