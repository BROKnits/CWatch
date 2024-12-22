<?php
namespace Services;

use Database\Connection;

class PortfolioService {
    private $db;

    public function __construct() {
        $this->db = Connection::getInstance()->getConnection();
    }

    public function getPortfolioData($timeframe, $currency = null, $coin = null) {
        $query = $this->buildQuery($timeframe, $currency, $coin);
        $params = $this->buildParams($currency, $coin);
        
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    private function buildQuery($timeframe, $currency, $coin) {
        $query = "SELECT [DateRev], [TimeRev], [Price], [Currency], [Coin], 
                  [HodlValue], [CurrentBTCCoins] 
                  FROM [Crypto].[dbo].[vwCoinValueTime]
                  WHERE 1=1";
        
        if ($currency) $query .= " AND [Currency] = ?";
        if ($coin) $query .= " AND [Coin] = ?";
        
        $query .= $this->getTimeframeFilter($timeframe);
        $query .= " ORDER BY [DateRev], [TimeRev]";
        
        return $query;
    }

    private function buildParams($currency, $coin) {
        $params = [];
        if ($currency) $params[] = $currency;
        if ($coin) $params[] = $coin;
        return $params;
    }

    private function getTimeframeFilter($timeframe) {
        switch($timeframe) {
            case 'weekly':
                return " AND DateRev >= DATEADD(week, -1, GETDATE())";
            case 'monthly':
                return " AND DateRev >= DATEADD(month, -1, GETDATE())";
            case 'yearly':
                return " AND DateRev >= DATEADD(year, -1, GETDATE())";
            default: // daily
                return " AND DateRev >= DATEADD(day, -1, GETDATE())";
        }
    }
}