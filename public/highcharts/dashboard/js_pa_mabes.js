Highcharts.chart('con_pa_mabes', {
    data: {
        table: 'serapan_pa_mabes'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'TOP 10 PENYERAPAN ANGGARAN SATKER MABES'
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
    }
});