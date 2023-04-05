$(document).ready(function () {

    chartWelcome();


});

function chartWelcome() {
    var options = {
        series: [],
        chart: {
            /*toolbar: {
                show: false,
            },*/
            height: 350,
            width: "100%",
            type: 'line',
            /*zoom: {
                enabled: false
            }*/
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
        "nameWeb":"Bloomberg"
    };

    $.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({
            "token":'dolareros2023secret',
            "option":"d",
            "nameWeb":"Dolareros"
        }),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /* dataType: 'jsonp', */
        success: function(response){
            console.log(response.data);
            /*chart.updateSeries([{
                name: 'monthly Volume In USD',
                data: response.data.map((val) => val.x)
            }])*/
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
    /*$.post(url, params, function(response) {
        console.log(response.data);
        chart.updateSeries([{
            name: 'Lecturas',
            data: response.data
        }])
    });*/

   /* window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify({
                "token":"dolareros2023secret",
                "option":"d",
                "nameWeb":"Bloomberg"
            }),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /!* dataType: 'jsonp', *!/
            success: function(response){
                console.log(response.data);
                chart.updateSeries([{
                    name: 'Lecturas',
                    data: response.data
                }])
            },
            error: function(data){
                console.log(data);
            }
        });

        /!*$.post(url, params, function(response) {
            console.log(response.data);
            chart.updateSeries([{
                name: 'Lecturas',
                data: response.data
            }])
        });*!/
    }, 10000);*/
}