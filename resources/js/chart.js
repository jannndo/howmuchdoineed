import { Chart } from 'chart.js';

export function ChartComponent() {
    console.log('exported function loaded') //debug
    return {
        chart: null,
        chartData: {},
        initChart() {
            console.log('Chart.js version:', Chart.version); // Log the version of Chart.js
            console.log('initChart function loaded'); //debug

            this.$watch('chartData', (value) => {
                if (value) {
                    this.drawChart();
                }
            });
        },
        drawChart() {
            let data = this.chartData;

            console.log('drawChart function loaded') //debug
            
            if (this.chart) {
                this.chart.destroy(); // Destroy the previous instance of the chart
            }     
        
            this.chart = new Chart(
                document.getElementById('data'),
                {
                    type: 'bar',
                    data: {
                        labels: [...Array(data.numberOfPeriods + 1).keys()],
                        datasets: [
                            { label: 'Present Values', data: data.presentValues, stack: 'Stack 0' },
                            { label: 'Simple Interest Values', data: data.simpleInterestValues, stack: 'Stack 0' },
                            { label: 'Compound Interest Values', data: data.compoundInterestValues, stack: 'Stack 0' }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                stacked: true
                            }
                        }
                    }
                }
            );
            this.chart.update();
        },
    }
}
