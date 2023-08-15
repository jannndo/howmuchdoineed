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
                            { label: 'Present Values', data: component.chartData.presentValues, stack: 'Stack 0', backgroundColor: 'rgb(80, 64, 153)' }, // Red
                            { label: 'Simple Interest Values', data: component.chartData.simpleInterestValues, stack: 'Stack 0', backgroundColor: 'rgb(151, 78, 195)' }, // Green
                            { label: 'Compound Interest Values', data: component.chartData.compoundInterestValues, stack: 'Stack 0', backgroundColor: 'rgb(254, 123, 229)' } // Blue
                        ]
                    },
                    options: {
                        scales: {
                            x: {
                                beginAtZero: false,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    min: 1, // Start from the second value
                                    callback: function(value, index) {
                                        // Skip the first tick
                                        if (index === 0) return '';
                                        else return value;
                                    }
                                }
                            },
                            y: {
                                beginAtZero: false,
                                stacked: true,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    min: 10, // Start from the second value, assuming it's 10
                                    callback: function(value, index, values) {
                                        // Skip the first tick
                                        if (index === 0) return '';
                                
                                        // Format the y-axis labels as currency
                                        let formattedValue = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(value);
                                        if (value >= 1000000000) {
                                            formattedValue = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR', minimumFractionDigits: 0 }).format(value / 1000000) + 'M';
                                        } else if (value >= 1000000) {
                                            formattedValue = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR', minimumFractionDigits: 0 }).format(value / 1000) + 'K';
                                        }
                                        return formattedValue;
                                    }
                                },
                                font: {
                                    size: 16,  // Adjust this value to change the font size
                                    weight: 'bold'  // Set to 'bold' for thicker text
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false,
                                position: 'bottom',
                                align: 'start',
                                labels: {
                                    usePointStyle: true,  // Use point styles (dots) instead of rectangles
                                    padding: 20,  // Increase padding to ensure labels are placed beneath each other
                                },
                                fullSize: false,
                                layout: {
                                    padding: {
                                        left: 10  // Add some left padding to move legend slightly away from the edge
                                    }
                                }
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
    