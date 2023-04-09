let $tipoCambioCompra;
let $tipoCambioVenta;

let $tipoCambioCompraControl;
let $tipoCambioVentaControl;
$(document).ready(function () {

    chartWelcome();

    getTipoCambioDolareros();

    $(document).on('click','[data-tab]', getTipoCambioDolareros);

    $(document).on('input', '#sendBuy', changeSendBuy);

    $(document).on('input', '#sendSell', changeSendSell);

    $(document).on('input', '#getBuy', changeGetBuy);

    $(document).on('input', '#getSell', changeGetSell);

});

function chartWelcome() {
    var options = {
        /*type: 'category',*/
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
        "nameWeb":"Dolareros"
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

    window.setInterval(function () {

        $.ajax({
            url: url,
            method: 'POST',
            headers: {'Accept': 'application/json','X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: JSON.stringify({
                "token":"dolareros2023secret",
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
    }, 60000);
}

function getTipoCambioDolareros() {
    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/retrieve';
    var urlControl = 'https://www.api-dolareros.sbs/api/tipoCambio/retrieve/control';

    var req1 = $.ajax({
        url: urlControl,
        method: 'POST',
        data: JSON.stringify({
            "token":'dolareros2023secret'
        }),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,

        success: function(response){
            console.log(response.tipoCambio);
            $tipoCambioCompraControl = response.tipoCambio.buy;
            $tipoCambioVentaControl = response.tipoCambio.sell;

        },
        error: function(data){
            console.log(data);
        }
    });

    var req2 = $.ajax({
        url: url,
        method: 'POST',
        data: JSON.stringify({
            "token":'dolareros2023secret'
        }),
        contentType:'application/json; charset=utf-8',
        processData: false,
        dataType : "json",
        crossDomain: true,

        success: function(response){
            $.when(req1).done(function(){
                console.log(response.tipoCambio);
                var buy = response.tipoCambio.buy;
                var sell = response.tipoCambio.sell;

                $tipoCambioCompra = buy;
                $tipoCambioVenta = sell;

                $('#text_buy').html('Compra: '+buy);
                $('#text_sell').html('Venta: '+sell);

                var ref_tab = $("ul.nav-tabs  a.active");
                console.log(ref_tab.attr('data-tab'));

                var typeTab = ref_tab.attr('data-tab');

                if ( typeTab == 'buy' )
                {
                    $('#text_buy').removeClass('text-muted');
                    $('#text_buy').addClass('text-primary');
                    $('#text_sell').removeClass('text-primary');
                    $('#text_sell').addClass('text-muted');

                    var sendBuy = parseFloat($('#sendBuy').val());
                    var getBuy = parseFloat(sendBuy*$tipoCambioCompra).toFixed(2);
                    $('#getBuy').val(getBuy);
                    var ahorroBuy = getAhorroBuy(sendBuy);
                    $('#ahorroBuy').html('Estás ahorrando aprox. S/ '+ahorroBuy);
                } else {
                    $('#text_sell').removeClass('text-muted');
                    $('#text_sell').addClass('text-primary');
                    $('#text_buy').removeClass('text-primary');
                    $('#text_buy').addClass('text-muted');

                    var sendSell = parseFloat($('#sendSell').val());
                    var getSell = parseFloat(sendSell/$tipoCambioVenta).toFixed(2);
                    $('#getSell').val(getSell);
                    var ahorroSell = getAhorroSell(sendSell);
                    $('#ahorroSell').html('Estás ahorrando aprox. USD '+ahorroSell)
                }
            });

        },
        error: function(data){
            console.log(data);
        }
    });
}

function changeSendBuy() {
    var sendBuy = parseFloat($('#sendBuy').val());
    var getBuy = parseFloat(sendBuy*$tipoCambioCompra).toFixed(2);
    $('#getBuy').val(getBuy);
    var ahorroBuy = getAhorroBuy(sendBuy);
    $('#ahorroBuy').html('Estás ahorrando aprox. S/ '+ahorroBuy);
}

function changeSendSell() {
    var sendSell = parseFloat($('#sendSell').val());
    var getSell = parseFloat(sendSell/$tipoCambioVenta).toFixed(2);
    $('#getSell').val(getSell);
    var ahorroSell = getAhorroSell(sendSell);
    $('#ahorroSell').html('Estás ahorrando aprox. USD '+ahorroSell)
}

function changeGetBuy() {
    var getBuy = parseFloat($('#getBuy').val());
    var sendBuy = parseFloat(getBuy/$tipoCambioCompra).toFixed(2);
    $('#sendBuy').val(sendBuy);
    var ahorroBuy = getAhorroBuy(sendBuy);
    $('#ahorroBuy').html('Estás ahorrando aprox. S/ '+ahorroBuy);
}

function changeGetSell() {
    var getSell = parseFloat($('#getSell').val());
    var sendSell = parseFloat(getSell*$tipoCambioVenta).toFixed(2);
    $('#sendSell').val(sendSell);
    var ahorroSell = getAhorroSell(sendSell);
    $('#ahorroSell').html('Estás ahorrando aprox. USD '+ahorroSell)
}

function getAhorroBuy( sendBuy ) {
    return parseFloat(($tipoCambioCompra - $tipoCambioCompraControl)*sendBuy).toFixed(2);
}

function getAhorroSell( sendSell ) {
    return parseFloat((($tipoCambioVentaControl - $tipoCambioVenta)*sendSell)/$tipoCambioVenta).toFixed(2);
}

