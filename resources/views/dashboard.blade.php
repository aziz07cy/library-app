<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <canvas id="myChart"></canvas>

    </div>
    @script
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('myChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar', // Change to 'line', 'pie', etc.
                data: {
                    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    datasets: [{
                        label: 'Weekly Sales',
                        data: [12, 19, 3, 5, 2, 3, 7],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)'
                    }]
                }
            });
        });
    </script>
    @endscript
</x-layouts.app>