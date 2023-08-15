<div x-data="{ 
        chartData: @entangle('chartData'), 
        initChart: window.ChartComponent().initChart 
    }" 
    x-init="initChart()" 
    id="chartContainer"
    class="flex justify-center items-center bg-gray-100">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full md:max-w-2xl">
        <h2 class="text-2xl font-bold mb-6 text-center">Your Chart Title</h2>
        <div class="flex justify-center w-full">
            <!-- Set canvas to occupy full width of its parent -->
            <canvas id="data" class="w-full"></canvas>
        </div>
    </div>

    <!-- for debugging purposes -->
    <!-- <pre x-text="JSON.stringify(chartData, null, 2)" class="mt-4 text-xs"></pre> -->
    
</div>