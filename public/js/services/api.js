export async function fetchPortfolioData(timeframe, currency, coin) {
    try {
        const url = `/api.php?timeframe=${timeframe}&currency=${currency}&coin=${coin}`;
        console.log('Fetching data from:', url);
        
        const response = await fetch(url);
        const result = await response.json();
        
        console.log('API response:', result);
        
        if (!result.success) {
            throw new Error(result.error);
        }
        
        return result.data;
    } catch (error) {
        console.error('Error fetching data:', error);
        throw error;
    }
}