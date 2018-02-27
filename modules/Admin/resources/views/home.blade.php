<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'}
    </script>
    <title>Laravel Module</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
    <obgraph></obgraph>
</div>

<div id="obgraphdiv" style="min-width: 310px; height: 600px; margin: 0 auto"></div>


{{-- These libraries should go to build with webpack. all should be gone to vendor.js file --}}
<script src="https://unpkg.com/vue@2.4.2"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

{{-- vue --}}
<script src="{{ asset('js/app.js') }}"></script>

<script>
    var oChart = {
        aChartSeries: [],
        init: function () {
            this.getGraphData();
        },

        getGraphData: function () {
            var oThis = this;
            $.get("/admin/app/performance/onboarding", function (data) {
                oThis.aChartSeries = data;
                oThis.drawGraph();
            });
        },

        drawGraph: function () {

            var options = {
                chart: {
                    type: 'spline',
                    renderTo: 'obgraphdiv'
                },
                title: {
                    text: 'Application Registration Performance'
                },
                subtitle: {
                    text: 'weekly statistics of the year'
                },
                xAxis: {
                    title: {
                        text: 'Onboard Process % '
                    },
                    type: 'category',
                    max: 100,
                    labels: {
                        overflow: 'justify'
                    },
                    plotBands: [{
                        from: 0,
                        to: 100
                    }]
                },

                yAxis: {
                    title: {
                        text: 'Retention %'
                    },
                    max: 100,
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
                    }
                },
                series: this.aChartSeries,
                navigation: {
                    menuItemStyle: {
                        fontSize: '10px'
                    }
                }
            };

            var oChart = new Highcharts.Chart(options);
        }

    }

    $(function () {
        oChart.init();
    });


</script>

</body>
</html>
