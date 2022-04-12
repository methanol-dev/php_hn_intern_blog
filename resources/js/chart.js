import Chart from 'chart.js/auto';
const ctx = document.getElementById('myChart');
const data = ctx.getAttribute('data-chart');
const initSongChart = async function () {
    if (ctx) {
        return new Chart(ctx, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Post',
                    data: JSON.parse(data),
                    fill: false,
                    backgroundColor: 'rgb(34,128,198)',
                }]
            },
        });
    }
}

initSongChart();
