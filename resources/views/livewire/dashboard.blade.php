<div>
    <!-- Include the Annuity component -->
    <livewire:annuity />

    <!-- Conditionally display the Chart component with data -->

        @livewire('chart', ['chartData' => $chartData])

</div>  