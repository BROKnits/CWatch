<?php
namespace Services;

use Database\Connection;
use PDO;

class PortfolioService {
    private $db;
    private $timeframeService;

    public function __construct() {
        $this->db = Connection::getInstance()->getConnection();
        $this->timeframeService = new TimeframeService();
    }

    public function getPortfolioData($timeframe, $currency = null, $coin = null) {
        $timeFilter = $this->timeframeService->getTimeFilter($timeframe);
        $query = $this->buildQuery($timeFilter['query'], $currency, $coin);
        $params = $this->buildParams($currency, $coin);
        
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Database error: " . $e->getMessage());
        }
    }

    private function buildQuery($timeFilter, $currency, $coin) {
        $query = "SELECT [DateRev], [TimeRev], [Price], [Currency], [Coin], 
                  [HodlValue], [CurrentBTCCoins] 
                  FROM [Crypto].[dbo].[vwCoinValueTime]
                  WHERE 1=1";
        
        if ($currency) $query .= " AND [Currency] = ?";
        if ($coin) $query .= " AND [Coin] = ?";
        
        $query .= $timeFilter;
        $query .= " ORDER BY [DateRev], [TimeRev]";
        
        return $query;
    }

    private function buildParams($currency, $coin) {
        $params = [];
        if ($currency) $params[] = $currency;
        if ($coin) $params[] = $coin;
        return $params;
    }
}