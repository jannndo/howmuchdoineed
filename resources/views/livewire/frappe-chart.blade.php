<div>
    <div id="chart"></div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            let chart = null;

            window.addEventListener('redraw-chart', (event) => {
                const data = event.detail;
                console.log(data);

                if (chart) {
                    chart.destroy();
                }

                chart = new window.frappe.Chart("#chart", {
                    title: "My Awesome Chart",
                    data: data,
                    type: 'bar',
                    height: 500,
                });
            });
        });
        </script>
    @endpush

</div>
