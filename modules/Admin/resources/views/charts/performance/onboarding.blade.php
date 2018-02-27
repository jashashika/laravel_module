<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

{{ print_r($percentages) }}

<script>
    // Data retrieved from http://vikjavev.no/ver/index.php?spenn=2d&sluttid=16.06.2015.

    Highcharts.chart('container', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Application Registration Performance'
        },
        subtitle: {
            text: 'weekly statistics'
        },
        xAxis: {
            type: 'category',
            labels: {
                overflow: 'justify'
            },
            categories : [10, 20, 30, 40, 50, 60, 70, 80, 90, 100]
        },

        yAxis: {
            title: {
                text: ''
            },
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
            plotBands: [{
                from: 0,
                to: 20,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: '',
                    style: {
                        color: '#606060'
                    }
                }
            }, {
                from: 20,
                to: 40,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: '',
                    style: {
                        color: '#606060'
                    }
                }
            }, {
                from: 40,
                to: 60,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: '',
                    style: {
                        color: '#606060'
                    }
                }
            }, {
                from: 60,
                to: 80,
                color: 'rgba(0, 0, 0, 0)',
                label: {
                    text: '',
                    style: {
                        color: '#606060'
                    }
                }
            }, {
                from: 80,
                to: 100,
                color: 'rgba(68, 170, 213, 0.1)',
                label: {
                    text: '',
                    style: {
                        color: '#606060'
                    }
                }
            }]
        },
        tooltip: {
            valueSuffix: ' %'
        },
        plotOptions: {
            spline: {
                lineWidth: 4,
                states: {
                    hover: {
                        lineWidth: 5
                    }
                },
                marker: {
                    enabled: false
                }
              //  pointInterval: 3600000*24*7, // one hour
              //  pointStart: Date.UTC(2015, 4, 31, 0, 0, 0)
//                pointStart: 'week'
            }
        },
        series: [{
            name: 'Week 1',
            data: [100, 100, 90, 60, 40, 30, 20, 20, 10, 0]

        }, {
            name: 'week 2',
            data: [100, 98, 80, 40, 40, 35, 10, 0, 0]
        }],
        navigation: {
            menuItemStyle: {
                fontSize: '10px'
            }
        }
    });

</script>