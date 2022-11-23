var ctx = document.getElementById('barChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['2023', '2024', '2025', '2026', '2027', '2028'],
        datasets: [{
            label: 'Number of Contracts',
            data: [6, 7, 10, 18, 18, 15],
            backgroundColor: [
                'rgba(2, 99, 255, 1)',
                'rgba(255, 119, 35, 1)',
                'rgba(142, 48, 255, 1)',
                'rgba(237, 172, 121, 1)',
                'rgba(173, 51, 190, 1)',
                'rgba(173, 51, 19, 1)',
            ],
            borderColor: [
                'rgba(2, 99, 255, 1)',
                'rgba(255, 119, 35, 1)',
                'rgba(142, 48, 255, 1)',
                'rgba(237, 172, 121, 1)',
                'rgba(173, 51, 190, 1)',
                'rgba(173, 51, 19, 1)',
            ],
            borderWidth: 1
        }]
    },
    // OR only to specific charts:
    plugins: [ChartDataLabels],
    options: {
        maintainAspectRatio: false,
        responsive: true,
        
        plugins:{
            layout: {
                padding: 20
            },
            legend:{
                display: false
            },
            datalabels:{
                anchor: 'end',
                align: 'top'
            }
           
        },
        scales: {
            y:{
                grace: '10%'
            }
        },
    },

        color: 'black',
        
});




// Doughnut Chart 