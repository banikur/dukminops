var chart = Highcharts.chart('container_kondisi_material', {

    chart: {
        type: 'column'
    },

    title: {
        text: 'GRAFIK KONDISI MATERIAL'
    },

    subtitle: {
        text: ''
    },

    legend: {
        align: 'right',
        verticalAlign: 'middle',
        layout: 'vertical'
    },

    xAxis: {
        categories: ['BB', 'RR', 'RB', 'TOTAL'],
        labels: {
            x: -10
        }
    },

    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Amount'
        }
    },

    series: [{
        name: 'R2',
        data: [1, 4, 3, 15]
    }, {
        name: 'R4',
        data: [6, 4, 2, 20]
    }, {
        name: 'SENPI',
        data: [8, 4, 3, 30]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                yAxis: {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -5
                    },
                    title: {
                        text: null
                    }
                },
                subtitle: {
                    text: null
                },
                credits: {
                    enabled: false
                }
            }
        }]
    }
});

$( document ).ready(function() {
    chart.setSize(null);
});
