Highcharts.chart('con_status_surat_masuk', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'PERSENTASE SATUS SURAT MASUK'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Status Surat Masuk',
        data: [
            {
                name: 'PENDING',
                y: 50,
                sliced: true,
                selected: true
            },
            ['DISPOSISI', 25],
            ['PROSES', 25]
        ]
    }],
    
    responsive: {
      rules: [{
        condition: {
          maxWidth: 500
        },
        chartOptions: {
          legend: {
            enabled: false
          }
        }
      }]
    }

});