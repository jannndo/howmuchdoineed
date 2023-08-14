<div x-data="{ 
        chartData: @entangle('chartData'), 
        initChart: window.ChartComponent().initChart 
    }" 
    x-init="initChart()" 
    id="chartContainer">

    <div style="width: 800px;"><canvas id="data"></canvas></div>
    <pre x-text="JSON.stringify(chartData, null, 2)"></pre>
</div>
