Highcharts.chart('con_as_wilayah', {
    data: {
        table: 'serapan_as_wilayah'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'TOP 10 PENYERAPAN ANGGARAN SATKER WILAYAH'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: ''
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    },
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