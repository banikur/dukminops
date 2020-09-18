Highcharts.chart('con_as_mabes', {
    data: {
        table: 'serapan_as_mabes'
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