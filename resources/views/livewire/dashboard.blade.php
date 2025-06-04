<div class="flex flex-col gap-2 md:gap-4 lg:gap-6">
    <div class="flex flex-col">
        <div class="text-lg font-medium">
            Transaksi Peminjaman Buku
        </div>
        <livewire:utils.breadcrumbs :breadcrumbs="$breadcrumbs" />
    </div>
    <div class="d-card bg-base-100 flex flex-col gap-2 md:gap-4 lg:gap-6 p-2 md:p-4 lg:p-6">
        <canvas id="weeklyChart"></canvas>
        @script
        <script>
            $wire.on('updateChart', (data) => {
                const ctx = document.getElementById('weeklyChart').getContext('2d');
                var data = data[0];
                var chartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                                label: 'Peminjaman',
                                data: data.peminjamanData,
                                backgroundColor: data.backgroundColors[0],
                                borderWidth: 1
                            },
                            {
                                label: 'Pengembalian',
                                data: data.pengembalianData,
                                backgroundColor: data.backgroundColors[1],
                                borderWidth: 1
                            }
                        ]
                    },

                });

                chartInstance.update();
            });
        </script>

        @endscript
    </div>
</div>