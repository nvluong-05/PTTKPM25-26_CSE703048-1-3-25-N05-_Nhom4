document.addEventListener('DOMContentLoaded', function () {
    // Xử lý mở modal xem video
    document.querySelectorAll('.play-video-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const videoLink = this.getAttribute('data-video-link');
            const videoId = this.closest('[data-video-id]')?.getAttribute('data-video-id');
            let embedLink = videoLink;

            // Nếu là link YouTube, chuyển sang embed
            const youtubeMatch = videoLink.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([^\s&]+)/);
            if (youtubeMatch) {
                embedLink = 'https://www.youtube.com/embed/' + youtubeMatch[1] + '?autoplay=1';
            }

            // Gọi AJAX tăng views
            if (videoId) {
                fetch(`/videos/${videoId}/increase-view`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }).then(res => res.json()).then(data => {
                    // Tìm đúng phần tử views-count trong card video này
                    const card = this.closest('[data-video-id]');
                    const viewsElem = card.querySelector('.video-views-count');
                    if (viewsElem) viewsElem.textContent = data.views.toLocaleString();
                });
            }

            document.getElementById('videoIframe').src = embedLink;
            document.getElementById('videoModal').classList.remove('hidden');
        });
    });

    // Đóng modal
    document.getElementById('closeVideoModalBtn').onclick = function () {
        document.getElementById('videoModal').classList.add('hidden');
        document.getElementById('videoIframe').src = '';
    };
});