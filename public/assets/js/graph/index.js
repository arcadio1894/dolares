$(document).ready(function () {

    chartKambista();
    chartBloomberg();
    /*chartGoogle();
    chartCocosylucas();
    chartTKambio();
    chartSecuEx();*/

    /*$(document).on('click','[data-tab]', getTipoCambioDolareros);*/
});

function chartKambista() {
    var options = {
        series: [
            {
                name: "High - 2013",
                data: [28, 29, 33, 36, 32, 32, 33]
            },
            {
                name: "Low - 2013",
                data: [12, 11, 14, 18, 17, 13, 13]
            }
        ],
        chart: {
            type: 'area',
            stacked: false,
            height: 350,
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                autoSelected: 'zoom'
            }
        },
        colors: ['#77B6EA', '#545454'],
        dataLabels: {
            enabled: false,
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 90, 100]
            },
        },
        markers: {
            size: 1
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return (val / 1000000).toFixed(0);
                },
            },
            title: {
                text: 'Price'
            },
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            floating: true,
            /*offsetY: -25,
            offsetX: -5*/
        },
        tooltip: {
            shared: false,
            y: {
                formatter: function (val) {
                    return (val / 1000000).toFixed(0)
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chartKambista"), options);
    chart.render();

    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/history/options';

    var params = {
        "token":"dolareros2023secret",
        "option":"d",
        "nameWeb":"Kambista"
    };

    /*$.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify(params),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /!* dataType: 'jsonp', *!/
        success: function(response){
            console.log(response.data);
            chart.updateOptions({
                series: [
                    {
                        name: "Tipo de cambio",
                        data: response.data.map((val) => val.x)
                    }
                ],
                xaxis: {
                    categories: response.data.map((val) => val.y)
                }
            });
        },
        error: function(data){
            console.log(data);
        }
    });

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify(params),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /!* dataType: 'jsonp', *!/
            success: function(response){
                console.log(response.data);
                chart.updateOptions({
                    series: [
                        {
                            name: "Tipo de cambio",
                            data: response.data.map((val) => val.x)
                        }
                    ],
                    xaxis: {
                        categories: response.data.map((val) => val.y)
                    }
                });
            },
            error: function(data){
                console.log(data);
            }
        });
    }, 5000);*/
}

function chartBloomberg() {
    var data = generateDayWiseTimeSeries(new Date("22 Apr 2017").getTime(), 115, {
        min: 30,
        max: 90
    });
    var options1 = {
        chart: {
            id: "chart2",
            type: "area",
            height: 230,
            foreColor: "#ccc",
            toolbar: {
                autoSelected: "pan",
                show: false
            }
        },
        colors: ["#00BAEC"],
        stroke: {
            width: 3
        },
        grid: {
            borderColor: "#555",
            clipMarkers: false,
            yaxis: {
                lines: {
                    show: false
                }
            }
        },
        dataLabels: {
            enabled: false
        },
        fill: {
            gradient: {
                enabled: true,
                opacityFrom: 0.55,
                opacityTo: 0
            }
        },
        markers: {
            size: 5,
            colors: ["#000524"],
            strokeColor: "#00BAEC",
            strokeWidth: 3
        },
        series: [
            {
                data: data
            }
        ],
        tooltip: {
            theme: "dark"
        },
        xaxis: {
            type: "datetime"
        },
        yaxis: {
            min: 0,
            tickAmount: 4
        }
    };

    var chart1 = new ApexCharts(document.querySelector("#chart-area"), options1);

    chart1.render();

    var options2 = {
        chart: {
            id: "chart1",
            height: 130,
            type: "bar",
            foreColor: "#ccc",
            brush: {
                target: "chart2",
                enabled: true
            },
            selection: {
                enabled: true,
                fill: {
                    color: "#fff",
                    opacity: 0.4
                },
                xaxis: {
                    min: new Date("27 Jul 2017 10:00:00").getTime(),
                    max: new Date("14 Aug 2017 10:00:00").getTime()
                }
            }
        },
        colors: ["#FF0080"],
        series: [
            {
                data: data
            }
        ],
        stroke: {
            width: 2
        },
        grid: {
            borderColor: "#444"
        },
        markers: {
            size: 0
        },
        xaxis: {
            type: "datetime",
            tooltip: {
                enabled: false
            }
        },
        yaxis: {
            tickAmount: 2
        }
    };

    var chart2 = new ApexCharts(document.querySelector("#chart-bar"), options2);

    chart2.render();




    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/history/options';

    var params = {
        "token":"dolareros2023secret",
        "option":"d",
        "nameWeb":"Kambista"
    };

    /*$.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify(params),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /!* dataType: 'jsonp', *!/
        success: function(response){
            console.log(response.data);
            chart.updateOptions({
                series: [
                    {
                        name: "Tipo de cambio",
                        data: response.data.map((val) => val.x)
                    }
                ],
                xaxis: {
                    categories: response.data.map((val) => val.y)
                }
            });
        },
        error: function(data){
            console.log(data);
        }
    });

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify(params),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /!* dataType: 'jsonp', *!/
            success: function(response){
                console.log(response.data);
                chart.updateOptions({
                    series: [
                        {
                            name: "Tipo de cambio",
                            data: response.data.map((val) => val.x)
                        }
                    ],
                    xaxis: {
                        categories: response.data.map((val) => val.y)
                    }
                });
            },
            error: function(data){
                console.log(data);
            }
        });
    }, 5000);*/
}
function generateDayWiseTimeSeries(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
        var x = baseval;
        var y =
            Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

        series.push([x, y]);
        baseval += 86400000;
        i++;
    }
    return series;
}
/*function chartGoogle() {
    var options = {
        /!*type: 'category',*!/
        series: [],
        chart: {
            /!*toolbar: {
                show: false,
            },*!/
            height: 350,
            width: "100%",
            type: 'line',
            /!*zoom: {
                enabled: false
            }*!/
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                autoSelected: 'zoom'
            },
        },
        noData: { text: "Cargando ..."},
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: '',
            align: ''
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: [],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/history/options';

    var params = {
        "token":"dolareros2023secret",
        "option":"d",
        "nameWeb":"Kambista"
    };

    $.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify(params),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /!* dataType: 'jsonp', *!/
        success: function(response){
            console.log(response.data);
            chart.updateOptions({
                series: [
                    {
                        name: "Tipo de cambio",
                        data: response.data.map((val) => val.x)
                    }
                ],
                xaxis: {
                    categories: response.data.map((val) => val.y)
                }
            });
        },
        error: function(data){
            console.log(data);
        }
    });

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify(params),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /!* dataType: 'jsonp', *!/
            success: function(response){
                console.log(response.data);
                chart.updateOptions({
                    series: [
                        {
                            name: "Tipo de cambio",
                            data: response.data.map((val) => val.x)
                        }
                    ],
                    xaxis: {
                        categories: response.data.map((val) => val.y)
                    }
                });
            },
            error: function(data){
                console.log(data);
            }
        });
    }, 5000);
}

function chartCocosylucas() {
    var options = {
        /!*type: 'category',*!/
        series: [],
        chart: {
            /!*toolbar: {
                show: false,
            },*!/
            height: 350,
            width: "100%",
            type: 'line',
            /!*zoom: {
                enabled: false
            }*!/
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                autoSelected: 'zoom'
            },
        },
        noData: { text: "Cargando ..."},
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: '',
            align: ''
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: [],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/history/options';

    var params = {
        "token":"dolareros2023secret",
        "option":"d",
        "nameWeb":"Kambista"
    };

    $.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify(params),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /!* dataType: 'jsonp', *!/
        success: function(response){
            console.log(response.data);
            chart.updateOptions({
                series: [
                    {
                        name: "Tipo de cambio",
                        data: response.data.map((val) => val.x)
                    }
                ],
                xaxis: {
                    categories: response.data.map((val) => val.y)
                }
            });
        },
        error: function(data){
            console.log(data);
        }
    });

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify(params),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /!* dataType: 'jsonp', *!/
            success: function(response){
                console.log(response.data);
                chart.updateOptions({
                    series: [
                        {
                            name: "Tipo de cambio",
                            data: response.data.map((val) => val.x)
                        }
                    ],
                    xaxis: {
                        categories: response.data.map((val) => val.y)
                    }
                });
            },
            error: function(data){
                console.log(data);
            }
        });
    }, 5000);
}

function chartTKambio() {
    var options = {
        /!*type: 'category',*!/
        series: [],
        chart: {
            /!*toolbar: {
                show: false,
            },*!/
            height: 350,
            width: "100%",
            type: 'line',
            /!*zoom: {
                enabled: false
            }*!/
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                autoSelected: 'zoom'
            },
        },
        noData: { text: "Cargando ..."},
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: '',
            align: ''
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: [],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/history/options';

    var params = {
        "token":"dolareros2023secret",
        "option":"d",
        "nameWeb":"Kambista"
    };

    $.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify(params),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /!* dataType: 'jsonp', *!/
        success: function(response){
            console.log(response.data);
            chart.updateOptions({
                series: [
                    {
                        name: "Tipo de cambio",
                        data: response.data.map((val) => val.x)
                    }
                ],
                xaxis: {
                    categories: response.data.map((val) => val.y)
                }
            });
        },
        error: function(data){
            console.log(data);
        }
    });

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify(params),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /!* dataType: 'jsonp', *!/
            success: function(response){
                console.log(response.data);
                chart.updateOptions({
                    series: [
                        {
                            name: "Tipo de cambio",
                            data: response.data.map((val) => val.x)
                        }
                    ],
                    xaxis: {
                        categories: response.data.map((val) => val.y)
                    }
                });
            },
            error: function(data){
                console.log(data);
            }
        });
    }, 5000);
}

function chartSecuEx() {
    var options = {
        /!*type: 'category',*!/
        series: [],
        chart: {
            /!*toolbar: {
                show: false,
            },*!/
            height: 350,
            width: "100%",
            type: 'line',
            /!*zoom: {
                enabled: false
            }*!/
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            },
            toolbar: {
                autoSelected: 'zoom'
            },
        },
        noData: { text: "Cargando ..."},
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: '',
            align: ''
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: [],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/history/options';

    var params = {
        "token":"dolareros2023secret",
        "option":"d",
        "nameWeb":"Kambista"
    };

    $.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify(params),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /!* dataType: 'jsonp', *!/
        success: function(response){
            console.log(response.data);
            chart.updateOptions({
                series: [
                    {
                        name: "Tipo de cambio",
                        data: response.data.map((val) => val.x)
                    }
                ],
                xaxis: {
                    categories: response.data.map((val) => val.y)
                }
            });
        },
        error: function(data){
            console.log(data);
        }
    });

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify(params),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /!* dataType: 'jsonp', *!/
            success: function(response){
                console.log(response.data);
                chart.updateOptions({
                    series: [
                        {
                            name: "Tipo de cambio",
                            data: response.data.map((val) => val.x)
                        }
                    ],
                    xaxis: {
                        categories: response.data.map((val) => val.y)
                    }
                });
            },
            error: function(data){
                console.log(data);
            }
        });
    }, 5000);
}*/


