class FilterService {
    static id;

    static async GetMarkets(id) {
        const select_pasar = document.querySelector('.select-pasar');
        const placeholderPasar = document.getElementById('select-pasar-placeholder');

        this.id = id;

        placeholderPasar.innerText = "Loading... 🔃";
        placeholderPasar.selected = true;
        placeholderPasar.disabled = true;

        while (select_pasar.options.length > 1) {
            select_pasar.remove(select_pasar.options.length - 1);
        }

        const res = await fetch(`api/filter/show_market.php?id=${this.id}`);
        const data = await res.json();

        data.data.forEach(market => {
            let opt = document.createElement("option");
            opt.value = market.id;
            opt.text = market.name;
            select_pasar.appendChild(opt);
        });

        placeholderPasar.innerHTML = "Pilih Pasar";
    }

    static async FilteredCommodities(id_market, status, id_kecamatan) {
        console.log(id_market + status + id_kecamatan);
        const res = await fetch(`api/filter/filtered_commodities.php?id_market=${id_market}&status=${status}&id_kecamatan=${id_kecamatan}`);
        const json = await res.json();

        const container = document.getElementById("komoditas-grid");
        container.innerHTML = ""; // Bersihkan sebelumnya

        if (json.data && json.data.length > 0) {
            json.data.forEach(item => {
                let icon_status = 'bx bx-stroke-pen';
                if(item.status == 'Naik'){
                    icon_status = 'bx bx-arrow-up-right-stroke';
                } else if(item.status == 'Turun'){
                    icon_status = 'bx bx-arrow-down-right-stroke';
                }

                const div = document.createElement("div");
                div.innerHTML = `<div class="card animate-fadein" onclick="chartModal()" style="margin: 0; margin-top: 12px;">
                <div class="harga">
                    <span>Rp. ${item.price} / ${item.unit}</span>
                </div>
                <img src="public/images/${item.image}" class="card-img" alt="${item.commodity_name}">
                <div class="view-detail">View Detail</div>
                <div class="card-body">
                    <h4 class="card-title">${item.icon} ${item.commodity_name}</h4>
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
            container.innerHTML = '<h4 align="center">Data tidak ditemukan</h4>';
        }
    }
}
