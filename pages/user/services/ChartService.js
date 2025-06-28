class ChartService {
    static async ChartModal(commodity, id) {
        const res = await fetch(`api/chart/charts_data.php?id=${id}`);
        const json = await res.json();

        MicroModal.show("modal-chart", {
            disableScroll: true,
            disableFocus: true
        });

        const title = document.getElementById('modal-chart-title');
        title.innerHTML = 'Analisis Harga ' + commodity;

        const ctx = document.getElementById('hargaChart').getContext('2d');

        let harga = [];

        json.data.forEach(item => {
            harga.push(item.price_after)
        });

        let tanggal = [];

        json.data.forEach(item => {
            tanggal.push(item.tanggal)
        });

        const gradient = ctx.createLinearGradient(0, 0, 0, 200);
        gradient.addColorStop(0, 'rgba(0, 200, 83, 0.2)');
        gradient.addColorStop(1, 'rgba(0, 200, 83, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: tanggal,
                datasets: [{
                    label: 'Harga',
                    data: harga,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#00c853',
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 0,
                    pointHoverRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        titleFont: {
                            family: 'Poppins',
                            size: 13,
                            weight: '500'
                        },
                        bodyFont: {
                            family: 'Poppins',
                            size: 12,
                            weight: '400'
                        },
                        callbacks: {
                            label: function (context) {
                                const value = context.parsed.y;
                                return 'Harga: Rp ' + value.toLocaleString();
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: { display: false },
                    y: { display: false }
                }
            }
        });
    }
}
