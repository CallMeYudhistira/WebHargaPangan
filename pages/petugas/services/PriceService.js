class PriceService {
  static condition = "new";
  static id;

  static HandleNew() {
    document.getElementById("modal-harga-title").innerHTML = "Tambah Harga";
    this.condition = "new";
    this.id = null;
  }

  static async HandleEdit(id) {
    const commodity = document.querySelector('[name="commodity"]');
    const market = document.querySelector('[name="market"]');
    const price = document.querySelector('[name="price"]');
    const commodityPlaceholderOption = document.getElementById(
      "select-commodity-placeholder"
    );
    const marketPlaceholderOption = document.getElementById(
      "select-market-placeholder"
    );

    document.getElementById("modal-harga-title").innerHTML = "Edit Harga";
    this.condition = "edit";
    this.id = id;

    price.value = "Loading... 🔃";
    market.value = "";
    commodity.value = "";
    marketPlaceholderOption.innerText = "Loading... 🔃";
    commodityPlaceholderOption.innerText = "Loading... 🔃";

    market.disabled = true;
    commodity.disabled = true;

    const res = await fetch(`api/prices/find.php?id=${this.id}`);
    const data = await res.json();

    market.disabled = false;
    commodity.disabled = false;

    price.value = data.data.price;
    market.value = data.data.id_market;
    commodity.value = data.data.id_commodity;
    commodityPlaceholderOption.innerHTML = "Pilih Komoditas";
    marketPlaceholderOption.innerHTML = "Pilih Pasar";
  }

  static async InsertOrUpdatePrice() {
    const commodity = document.querySelector('[name="commodity"]').value;
    const market = document.querySelector('[name="market"]').value;
    const price = document.querySelector('[name="price"]').value;

    if (this.condition === "new") {
      const res = await fetch("api/prices/insert.php", {
        method: "POST",
        credentials: "include",
        body: JSON.stringify({ commodity, market, price }),
      });
      if (!res.ok) {
        alert("Harga Komoditas sudah tersedia untuk Waktu ini");
      }
    } else {
      const res = await fetch("api/prices/update.php", {
        method: "POST",
        credentials: "include",
        body: JSON.stringify({ id: this.id, commodity, market, price }),
      });
    }
    window.location.reload();
  }

  static async DeletePrice(id) {
    const res = await fetch("api/prices/delete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id }),
    });
  }

  static async ConfirmAndDelete(e, id) {
    e.preventDefault();
    const isConfirmed = confirm("Apakah Anda yakin ingin menghapus harga ini?");
    if (!isConfirmed) return;

    await this.DeletePrice(id);
    window.location.reload();
  }
}
