import { formatCurrency, formatTooltipLabel, formatChartLabel } from '../utils/formatters.js';

export class PortfolioChart {
    constructor(canvasId) {
        const canvas = document.getElementById(canvasId);
        if (!canvas) {
            throw new Error(`Canvas element with id '${canvasId}' not found`);
        }
        this.ctx = canvas.getContext('2d');
        this.chart = null;
    }

    update(data) {
        console.log('Updating chart with data:', data);
        
        if (!Array.isArray(data) || data.length === 0) {
            console.warn('No data available for chart');
            return;
        }

        if (this.chart) {
            this.chart.destroy();
        }

        const chartData = {
            labels: data.map(formatChartLabel),
            datasets: [{
                label: 'Portfolio Value',
                data: data.map(item => parseFloat(item.HodlValue)),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                fill: true,
                tension: 0.1
            }]
        };

        console.log('Chart data:', chartData);

        this.chart = new Chart(this.ctx, {
            type: 'line',
            data: chartData,
            options: this.getChartOptions(data)
        });
    }

    getChartOptions(data) {
        return {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: (context) => formatTooltipLabel(data[context.dataIndex])
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Date/Time'
                    }
                },
                y: {
                    display: true,
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Portfolio Value (USD)'
                    },
                    ticks: {
                        callback: (value) => formatCurrency(value)
                    }
                }
            }
        };
    }
}