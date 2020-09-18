Highcharts.chart('con_serapan_slog_persen', {
    data: {
        table: 'serapan_slog_persen'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'GRAFIK SERAPAN SLOG POLRI (%)'
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