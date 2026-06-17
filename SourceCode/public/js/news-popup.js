document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.read-more-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const articleId = this.dataset.articleId;
            // AJAX tăng views như cũ...
            fetch('/news/increase-views/' + articleId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            }).then(res => res.json())
              .then(data => {
                document.querySelectorAll(`[data-article-id="${articleId}"] .views-count`).forEach(span => {
                    span.textContent = data.views + ' lượt xem';
                });
            });

            // Thử mở trong iframe, nếu lỗi thì mở tab mới
            const iframe = document.getElementById('readMoreIframe');
            iframe.src = this.dataset.link;
            document.getElementById('readMoreModal').classList.remove('hidden');
            iframe.onerror = function() {
                window.open(btn.dataset.link, '_blank');
                document.getElementById('readMoreModal').classList.add('hidden');
                iframe.src = '';
            };
        });
    });
    document.getElementById('closeModalBtn').onclick = function() {
        document.getElementById('readMoreModal').classList.add('hidden');
        document.getElementById('readMoreIframe').src = '';
    };
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('readMoreModal').classList.add('hidden');
            document.getElementById('readMoreIframe').src = '';
        }
    });
});