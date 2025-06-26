class MarketService {
  static condition = "new";
  static id;

  static HandleNew() {
    document.getElementById("modal-pasar-title").innerHTML = "Tambah Pasar";
    this.condition = "new";
    this.id = null;
  }

  static async HandleEdit(id) {
    const name = document.querySelector('[name="name"]');
    const region = document.querySelector('[name="region"]');
    const regionPlaceholderOption = document.getElementById("select-region-placeholder");

    document.getElementById("modal-pasar-title").innerHTML = "Edit Pasar";
    this.condition = "edit";
    this.id = id;

    region.value = "";
    name.value = "Loading... 🔃";
    regionPlaceholderOption.innerText = "Loading... 🔃";

    name.disabled = true;
    region.disabled = true;

    const res = await fetch(`api/markets/find.php?id=${this.id}`);
    const data = await res.json();

    name.disabled = false;
    region.disabled = false;

    name.value = data.data.name;
    region.value = data.data.id_region;
    regionPlaceholderOption.innerHTML = "Pilih Pasar";
  }

  static async InsertOrUpdateMarket() {
    const name = document.querySelector('[name="name"]').value;
    const region = document.querySelector('[name="region"]').value;

    if (this.condition === "new") {
      const res = await fetch("api/markets/insert.php", {
        method: "POST",
        body: JSON.stringify({ name, region }),
      });
    } else {
      const res = await fetch("api/markets/update.php", {
        method: "POST",
        body: JSON.stringify({ name, region, id: this.id }),
      });
    }
    window.location.reload();
  }

  static async DeleteMarket(id) {
    const res = await fetch("api/markets/delete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id }),
    });
  }

  static async ConfirmAndDelete(e, id) {
    e.preventDefault();
    const isConfirmed = confirm(
      "Apakah Anda yakin ingin menghapus pasar ini?"
    );
    if (!isConfirmed) return;

    await this.DeleteMarket(id);
    window.location.reload();
  }
}
