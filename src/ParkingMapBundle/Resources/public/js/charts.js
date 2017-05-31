$(document).ready(function() {
    // var trafficByHour = $.parseJSON(chartData);

    var categories = new Array();
    var entry = new Array();
    var exit = new Array();
    chartData.forEach(function(el, index) {
        categories.push(moment(el.prev).format("hh:mm a"));
        entry.push(el.totalEntries);
        exit.push(el.totalExits);
    });


    Highcharts.chart('chart-container', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: categories.reverse(),
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Traffic by hours'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Entry',
        data: entry.reverse(),
        color: "#55d62d"

    }, {
        name: 'Exit',
        data: exit.reverse(),
        color: "#197BA8"
    }]
});
});
