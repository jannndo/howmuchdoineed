<div>
    <div style="width: 800px;"><canvas id="dataPlot"></canvas></div>

    @push('scripts')
    <script>
       document.addEventListener("livewire:load", function() {
            window.livewire.on('updateChart', function(data) {
                // Delay the execution of this code block by 100 milliseconds
                setTimeout(function() {
                    const ctx = document.getElementById('dataPlot').getContext('2d');
                    new window.Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Array.from({length: data.numberOfPeriods + 1}, (_, i) => i),
                            datasets: [
                                {
                                    label: 'Present Values',
                                    data: data.presentValues,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Simple Interest Values',
                                    data: data.simpleInterestValues,
                                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                    borderColor: 'rgba(255, 206, 86, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Compound Interest Values',
                                    data: data.compoundInterestValues,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }, 100); // Adjust this delay as needed
            });
        });
    </script>
    @endpush
</div>
