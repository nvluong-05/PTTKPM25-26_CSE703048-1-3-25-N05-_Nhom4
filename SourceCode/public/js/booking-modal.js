document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("booking-modal");
    const fieldSelect = document.getElementById("field_id");
    const startTimeInput = document.getElementById("start_time");
    const endTimeInput = document.getElementById("end_time");
    const totalPriceInput = document.getElementById("total_price");

    const openButtons = document.querySelectorAll(".dat-san-btn");

    openButtons.forEach(button => {
        button.addEventListener("click", function () {
            const fieldCard = button.closest("[data-field-id]");
            const fieldId = fieldCard.dataset.fieldId;

            // Hiển thị modal
            modal.classList.remove("hidden");

            // Chọn sân tương ứng
            fieldSelect.value = fieldId;

            // Reset giờ và giá
            startTimeInput.value = "06:00";
            endTimeInput.value = "07:00";
            // Tính tổng tiền ngay khi mở modal
            calculatePrice();
        });
    });

    // Đóng modal khi click ra ngoài
    modal.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });

    // Tính tổng tiền
    function calculatePrice() {
        const start = startTimeInput.value;
        const end = endTimeInput.value;
        const fieldId = fieldSelect.value;

        if (!start || !end || !fieldId) return;

        const startHour = parseInt(start.split(":")[0]);
        const endHour = parseInt(end.split(":")[0]);
        const duration = endHour - startHour;

        if (duration <= 0) {
            totalPriceInput.value = 0;
            return;
        }

        const field = window.fieldsData.find(f => f.id == fieldId);
        const price = field?.price_per_hour ?? 0;

        totalPriceInput.value = duration * price;
    }

    startTimeInput.addEventListener("change", calculatePrice);
    endTimeInput.addEventListener("change", calculatePrice);
    fieldSelect.addEventListener("change", calculatePrice);
});
