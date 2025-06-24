class CommodityService {
  static condition = "new";
  static id;

  static HandleNew() {
    document.getElementById("modal-komoditas-title").innerHTML =
      "Tambah Komoditas";
    this.condition = "new";
    this.id = null;
  }

  static async HandleEdit(id) {
    const name = document.querySelector('[name="name"]');
    const icon = document.querySelector('[name="icon"]');
    const unit = document.querySelector('[name="unit"]');
    document.getElementById("modal-komoditas-title").innerHTML =
      "Edit Komoditas";
    this.condition = "edit";
    this.id = id;

    name.value = "Loading... 🔃";
    icon.value = "Loading... 🔃";
    unit.value = "Loading... 🔃";

    name.disabled = true;
    icon.disabled = true;
    unit.disabled = true;

    const res = await fetch(`api/commodities/find.php?id=${this.id}`);
    const data = await res.json();

    name.disabled = false;
    icon.disabled = false;
    unit.disabled = false;

    name.value = data.data.name;
    icon.value = data.data.icon;
    unit.value = data.data.unit;
  }

  static async InsertOrUpdateCommodity(e) {
    event.preventDefault();
    const name = document.querySelector('[name="name"]').value;
    const icon = document.querySelector('[name="icon"]').value;
    const unit = document.querySelector('[name="unit"]').value;

    if (this.condition === "new") {
      const res = await fetch("api/commodities/insert.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ name, icon, unit }),
      });
      window.location.reload();
    } else {
      const res = await fetch("api/commodities/update.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: this.id, name, icon, unit }),
      });
      window.location.reload();
    }
  }

  static async DeleteCommodity(id) {
    const res = await fetch("api/commodities/delete.php", {
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
      "Apakah Anda yakin ingin menghapus komoditas ini?"
    );
    if (!isConfirmed) return;

    await this.DeleteCommodity(id);
    window.location.reload();
  }
}
