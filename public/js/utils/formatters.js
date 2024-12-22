export function formatCurrency(value) {
    return '$' + value.toLocaleString();
}

export function formatTooltipLabel(item) {
    return [
        `Value: ${formatCurrency(item.HodlValue)}`,
        `Price: ${formatCurrency(item.Price)}`,
        `Coins: ${item.CurrentBTCCoins.toFixed(8)}`
    ];
}

export function formatChartLabel(item) {
    return `${item.DateRev} ${item.TimeRev}`;
}