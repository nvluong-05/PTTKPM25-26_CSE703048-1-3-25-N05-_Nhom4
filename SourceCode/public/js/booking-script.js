window.fieldsData = window.fieldsData || [];
window.bookedTimes = window.bookedTimes || {};
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dat-san-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (typeof window.isGuest !== 'undefined' && window.isGuest) {
                e.preventDefault();
                alert('Bạn cần đăng nhập để đặt sân!');
            } else {
                const modal = document.getElementById('booking-modal');
                if (modal) modal.classList.remove('hidden');
            }
        });
    });
});
if (window.bookingHasError) {
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('booking-modal');
        if (modal) modal.classList.remove('hidden');
    });
}