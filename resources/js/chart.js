import Chart from 'chart.js/auto';

export function ChartComponent() {
    console.log('exported function loaded'); //debug

    let component = {
        chart: null,
        chartData: {},

        initChart() {
            console.log('Chart.js version:', Chart.version); // Log the version of Chart.js
            console.log('initChart function loaded'); //debug
            
            this.$watch('chartData', (newData) => {
                console.log('chartData updated in watch function:', newData);

                if (!newData || JSON.stringify(newData) === JSON.stringify(component.chartData)) {
                    return; // Exit if data is unchanged
                }

                component.chartData = newData; // Update the chart data
                component.drawChart(); // Draw the chart with the new data
            });
        },

        drawChart() {
            console.log('drawChart function loaded with data:', component.chartData);

            if (component.chart) {
                component.chart.destroy(); // Destroy the previous instance of the chart
            }
        
            component.chart = new Chart(
                document.getElementById('data'),
                {
                    type: 'bar',
                    data: {
                        labels: Array.from({ length: parseInt(component.chartData.numberOfPeriods) + 1 }, (_, i) => i),
                        datasets: [
                            { label: 'Present Values', data: component.chartData.presentValues, stack: 'Stack 0' },
                            { label: 'Simple Interest Values', data: component.chartData.simpleInterestValues, stack: 'Stack 0' },
                            { label: 'Compound Interest Values', data: component.chartData.compoundInterestValues, stack: 'Stack 0' }
                        ]
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: true,
                            },
                            y: {
                                beginAtZero: true,
                                stacked: true
                            }
                        }
                    }
                }
            );
        },

        setData(newData) {
            this.chartData = newData; // Update chartData and watcher will be triggered if you're using some reactive mechanism
        }
    };

    return component;
}
    