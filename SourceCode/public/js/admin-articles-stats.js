document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('topArticlesChart').getContext('2d');
    const labels = window.topArticlesLabels || [];
    const views = window.topArticlesViews || [];
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Lượt xem',
                data: views,
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Top 5 bài viết nhiều lượt xem nhất' }
            }
        }
    });
});