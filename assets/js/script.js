MicroModal.init();

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.querySelectorAll('input[type="text"]').forEach(function (input) {
            input.value = '';
        });
    }

    MicroModal.show(modalId);
}
