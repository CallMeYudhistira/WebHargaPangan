class LogService {
    static async GetLogDetail(id) {
        const price_before = document.querySelector('[name="price_before"]');
        const price_after = document.querySelector('[name="price_after"]');
        const status_before = document.querySelector('[name="status_before"]');
        const status_after = document.querySelector('[name="status_after"]');
        const percent_before = document.querySelector('[name="percent_before"]');
        const percent_after = document.querySelector('[name="percent_after"]');

        price_before.disabled = true;
        price_after.disabled = true;
        status_before.disabled = true;
        status_after.disabled = true;
        percent_before.disabled = true;
        percent_after.disabled = true;

        price_before.value = "Loading... 🔃";
        price_after.value = "Loading... 🔃";
        status_before.value = "Loading... 🔃";
        status_after.value = "Loading... 🔃";
        percent_before.value = "Loading... 🔃";
        percent_after.value = "Loading... 🔃";

        const res = await fetch(`api/logs/log.php?id=${id}`);
        const data = await res.json();

        price_before.value = data.data.price_before;
        price_after.value = data.data.price_after;
        status_before.value = data.data.status_before;
        status_after.value = data.data.status_after;
        percent_before.value = data.data.percent_before;
        percent_after.value = data.data.percent_after;
    }

    static async RemoveLog(id) {
    const res = await fetch("api/logs/remove.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id }),
    });
  }

  static async ConfirmAndRemove(e, id) {
    e.preventDefault();
    const isConfirmed = confirm(
      "Apakah Anda yakin ingin menghilangkan log ini?"
    );
    if (!isConfirmed) return;

    await this.RemoveLog(id);
    window.location.reload();
  }
}