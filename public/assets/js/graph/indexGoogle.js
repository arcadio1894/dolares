let $optionGoogle = "d";
let $params;

$(document).ready(function () {

    $optionGoogle = $('#statusGoogle').val();
    chartGoogle();

    $('#statusGoogle').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        $optionGoogle = this.value;

        chartGoogle();
    });

    /*$(document).on('click','[data-tab]', getTipoCambioDolareros);*/
});

function chartGoogle() {
    var options = {
        series: [
            /*{
                name: "High - 2013",
                data: [28, 29, 33, 36, 32, 32, 33]
            },
            {
                name: "Low - 2013",
                data: [12, 11, 14, 18, 17, 13, 13]
            }*/
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
            enabled: false
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                inverseColors: false,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 10, 20]
            },
        },
        markers: {
            size: 3,
            colors: ["#000524"],
            strokeColor: "#00BAEC",
            strokeWidth: 3
        },
        xaxis: {
            /*categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            title: {
                text: 'Month'
            }*/
        },
        yaxis: {
            title: {
                text: 'S/.'
            },
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            floating: true,
            /*offsetY: -25,
            offsetX: -5*/
        },

    };

    var chart = new ApexCharts(document.querySelector("#chartGoogle"), options);
    chart.render();

    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/history/options';

    $params = {
        "token":"dolareros2023secret",
        "option":$optionGoogle,
        "nameWeb":"Google"
    };

    $.ajax({
        url: url,
        method: 'POST',
        //headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify($params),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,
        /* dataType: 'jsonp', */
        success: function(response){
            //console.log(response.data);
            chart.updateOptions({
                series: [
                    {
                        name: "Compra",
                        data: response.data.map((val) => val.x)
                    }/*,
                    {
                        name: "Venta",
                        data: response.data.map((val) => val.x2)
                    }*/
                ],
                xaxis: {
                    categories: response.data.map((val) => val.y)
                }
            });
        },
        error: function(data){
            //console.log(data);
        }
    });

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify($params),
            contentType:'application/json; charset=utf-8',
            processData: false,
            dataType : "json",
            crossDomain: true,
            /* dataType: 'jsonp', */
            success: function(response){
                //console.log(response.data);
                chart.updateOptions({
                    series: [
                        {
                            name: "Compra",
                            data: response.data.map((val) => val.x)
                        }/*,
                        {
                            name: "Venta",
                            data: response.data.map((val) => val.x2)
                        }*/
                    ],
                    xaxis: {
                        categories: response.data.map((val) => val.y)
                    }
                });
            },
            error: function(data){
                //console.log(data);
            }
        });
    }, 60000);
}


