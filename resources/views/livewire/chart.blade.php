<div x-data="{ 
        chartData: @entangle('chartData'), 
        drawChart: window.ChartComponent().drawChart 
    }" 
    x-init="$watch('chartData', value => { if(value) drawChart() })" 
    id="chartContainer">

    <div style="width: 800px;"><canvas id="data"></canvas></div>
    <pre x-text="JSON.stringify(chartData, null, 2)"></pre>
</div>