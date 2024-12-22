<?php
namespace Services;

class TimeframeService {
    public function getTimeFilter($timeframe) {
        switch($timeframe) {
            case 'hourly':
                return [
                    "query" => " AND DateRev >= DATEADD(day, -1, GETDATE())",
                    "interval" => "hour"
                ];
            case 'daily':
                return [
                    "query" => " AND DateRev >= DATEADD(month, -1, GETDATE()) 
                               AND DATEPART(HOUR, TimeRev) = 0",
                    "interval" => "day"
                ];
            case 'weekly':
                return [
                    "query" => " AND DateRev >= DATEADD(month, -3, GETDATE()) 
                               AND DATEPART(WEEKDAY, DateRev) = 1",
                    "interval" => "week"
                ];
            case 'monthly':
                return [
                    "query" => " AND DateRev >= DATEADD(year, -1, GETDATE()) 
                               AND DAY(DateRev) = 1",
                    "interval" => "month"
                ];
            case 'yearly':
                return [
                    "query" => " AND DateRev >= DATEADD(year, -5, GETDATE()) 
                               AND MONTH(DateRev) = 1 AND DAY(DateRev) = 1",
                    "interval" => "year"
                ];
            default:
                return $this->getTimeFilter('daily');
        }
    }
}