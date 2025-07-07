class ChartService {
    static chartInstance = null; // Simpan chart instance secara global

    static async ChartModal(commodity, id, id_market, status, id_kecamatan) {
        MicroModal.show("modal-chart", {
            disableScroll: true,
            disableFocus: true
        });

        const title = document.getElementById('modal-chart-title');
        const loadingText = document.getElementById('loading-chart');
        const canvas = document.getElementById('hargaChart');

        title.innerHTML = 'Pergerakan Harga ' + commodity;

        // Tampilkan loading dan sembunyikan canvas sementara
        loadingText.style.display = 'flex';
        loadingText.innerHTML = `<span>Loading... 🔃</span>`
        canvas.style.display = 'none';

        try {
            const res = await fetch(`api/chart/charts_data.php?id=${id}&id_market=${id_market}&status=${status}&id_kecamatan=${id_kecamatan}`);
            const json = await res.json();

            const ctx = canvas.getContext('2d');

            // Hancurkan chart lama jika ada
            if (ChartService.chartInstance) {
                ChartService.chartInstance.destroy();
            }

            if (json.data.length < 2) {
                canvas.style.display = 'none';
                loadingText.innerHTML = `<span>🚨 Data Hanya Ada Satu 🚨</span>`
                return;
            }

            const harga = json.data.map(item => item.price_after);
            const tanggal = json.data.map(item => item.tanggal);

            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(0, 200, 83, 0.2)');
            gradient.addColorStop(1, 'rgba(0, 200, 83, 0)');

            // Sembunyikan loading dan tampilkan canvas
            loadingText.style.display = 'none';
            canvas.style.display = 'block';

            ChartService.chartInstance = new Chart(ctx, {
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

        } catch (err) {
            loadingText.innerHTML = "Gagal memuat data grafik.";
        }
    }

}
