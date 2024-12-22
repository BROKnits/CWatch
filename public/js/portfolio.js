import { fetchPortfolioData } from './services/api.js';
import { PortfolioChart } from './components/Chart.js';

document.addEventListener('DOMContentLoaded', async function() {
    try {
        console.log('Initializing portfolio tracker...');
        const chart = new PortfolioChart('portfolioChart');
        
        async function refreshData() {
            try {
                const timeframe = document.getElementById('timeframe').value;
                const currency = document.getElementById('currency').value;
                const coin = document.getElementById('coin').value;

                console.log('Fetching data with params:', { timeframe, currency, coin });
                const data = await fetchPortfolioData(timeframe, currency, coin);
                chart.update(data);
            } catch (error) {
                console.error('Error refreshing data:', error);
            }
        }

        // Event listeners for filters
        ['timeframe', 'currency', 'coin'].forEach(id => {
            document.getElementById(id).addEventListener('change', refreshData);
        });

        // Initial load
        await refreshData();

        // Refresh every 5 minutes
        setInterval(refreshData, 5 * 60 * 1000);
        
    } catch (error) {
        console.error('Failed to initialize portfolio tracker:', error);
    }
});