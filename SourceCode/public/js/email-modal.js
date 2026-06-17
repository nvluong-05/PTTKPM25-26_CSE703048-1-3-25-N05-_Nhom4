document.addEventListener('DOMContentLoaded', function () {
    // Mở modal và điền email người nhận
    document.querySelectorAll('.open-email-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('emailTo').value = this.getAttribute('data-email');
            document.getElementById('emailModal').classList.remove('hidden');
        });
    });

    // Đóng modal
    document.getElementById('closeEmailModalBtn').onclick = function () {
        document.getElementById('emailModal').classList.add('hidden');
    };
});