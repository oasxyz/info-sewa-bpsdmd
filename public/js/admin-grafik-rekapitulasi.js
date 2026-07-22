document.addEventListener('DOMContentLoaded', function () {
    const chartLabels = window.chartLabels;
    const chartDatasets = window.chartDatasets;
    const pieLabels = window.pieLabels;
    const pieData = window.pieData;
    
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: chartDatasets,
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Jumlah Pemakai' },
                },
            },
        },
    });

    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: pieLabels,
            datasets: [{
                data: pieData,
                backgroundColor: ['#fed136', '#212529', '#4caf50', '#ff9800', '#2196f3', '#e91e63', '#9c27b0', '#00bcd4', '#795548', '#607d8b'],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        },
    });
});