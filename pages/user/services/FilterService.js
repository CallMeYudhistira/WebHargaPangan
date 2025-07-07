class FilterService {
    static async GetMarkets(id) {
        const select_pasar = document.querySelector('.select-pasar');
        const placeholderPasar = document.getElementById('select-pasar-placeholder');

        placeholderPasar.innerText = "Loading... 🔃";
        placeholderPasar.selected = true;
        placeholderPasar.disabled = true;

        while (select_pasar.options.length > 1) {
            select_pasar.remove(select_pasar.options.length - 1);
        }

        const res = await fetch(`api/filter/show_market.php?id=${id}`);
        const data = await res.json();

        data.data.forEach(market => {
            let opt = document.createElement("option");
            opt.value = market.id;
            opt.text = market.name;
            select_pasar.appendChild(opt);
        });

        placeholderPasar.innerText = "Semua Pasar";
        placeholderPasar.selected = true;
        placeholderPasar.disabled = false;
    }

    static async FilteredCommodities(id_market, status, id_kecamatan, keyword) {
        const container = document.getElementById("komoditas-grid");
        container.innerHTML = '<h4 align="center">Loading... 🔃</h4>';

        const res = await fetch(`api/filter/filtered_commodities.php?id_market=${id_market}&status=${status}&id_kecamatan=${id_kecamatan}&keyword=${keyword}`);
        const json = await res.json();

        container.innerHTML = "";

        if (json.data && json.data.length > 0) {
            json.data.forEach(item => {
                let icon_status = 'bx bx-stroke-pen';
                if (item.status == 'Naik') {
                    icon_status = 'bx bx-arrow-up-right-stroke';
                } else if (item.status == 'Turun') {
                    icon_status = 'bx bx-arrow-down-right-stroke';
                }

                let formatter = new Intl.NumberFormat('id-ID');

                const div = document.createElement("div");
                div.innerHTML = `<div class="card animate-fadein" onclick="ChartService.ChartModal('${item.commodity_name}', '${item.id_commodity}', '${id_market}', '${status}', '${id_kecamatan}')" style="margin: 0; margin-top: 12px;">
                <div class="harga">
                    <span>Rp. ${formatter.format(item.price)} / ${item.unit}</span>
                </div>
                <img src="public/images/${item.image}" class="card-img" alt="${item.commodity_name}">
                <div class="view-detail">View Detail</div>
                <div class="card-body">
                    <h4 class="card-title">${item.icon} <span id="nama_komoditas">${item.commodity_name}</h4>
                    <div class="info-grid">
                        <div class="status ${item.status}">
                            <i class="${icon_status}"></i> <span class="card-text">${item.status}</span>
                        </div>
                        <div class="vertical-line" style="height: 30px;"></div>
                        <span>${item.percent}%</span>
                    </div>
                </div>
            </div>`;
                container.appendChild(div);
            });
        } else {
            container.innerHTML = '<h4 align="center">Data tidak ditemukan.</h4>';
        }

        if (keyword !== 'all') {
            const ress = await fetch("api/logs/search_log.php", {
                method: "POST",
                body: JSON.stringify({ keyword }),
            });
        }
    }

    static async GetStats(month, marketId) {
        const container = document.getElementById("table-body");
        container.innerHTML = '<tr><td colspan="7"><h4 align="center">Loading... 🔃</h4></td></tr>';

        const res = await fetch(`api/filter/get_stats.php?month=${month}&marketId=${marketId}`);
        const json = await res.json();

        container.innerHTML = "";

        if (json.data && json.data.length > 0) {
            json.data.forEach(item => {
                const tr = document.createElement("tr");
                let rata_rata = parseInt(item.avg_price);
                let max_price = parseInt(item.max_price);
                let min_price = parseInt(item.min_price);

                if(isNaN(rata_rata)){
                    rata_rata = item.price;
                }

                if(isNaN(max_price)){
                    max_price = item.price;
                }

                if(isNaN(min_price)){
                    min_price = item.price;
                }

                tr.innerHTML = `<td><img src="public/images/${item.image}" alt="${item.name}" class="table-image">
                                </td>
                                <td>${item.icon} ${item.name}</td>
                                <td>${rata_rata.toLocaleString()} / ${item.unit}</td>
                                <td>${max_price.toLocaleString()} / ${item.unit}</td>
                                <td>${min_price.toLocaleString()} / ${item.unit}</td>
                                <td>${item.market_name}</td>`;
                container.appendChild(tr);
            });
        } else {
            container.innerHTML = '<tr><td colspan="7"><h4 align="center">Data tidak ditemukan.</h4></td></tr>';
        }
    }
}
