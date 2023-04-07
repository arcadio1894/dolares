let $tipoCambioCompra;
let $tipoCambioVenta;

let $tipoCambioCompraControl;
let $tipoCambioVentaControl;
$(document).ready(function () {

    getTipoCambioDolareros();

    $(document).on('click','[data-tab]', getTipoCambioDolareros);

    $(document).on('input', '#sendBuy', changeSendBuy);

    $(document).on('input', '#sendSell', changeSendSell);

    $(document).on('input', '#getBuy', changeGetBuy);

    $(document).on('input', '#getSell', changeGetSell);

});

function getTipoCambioDolareros() {
    var url = 'https://www.api-dolareros.sbs/api/tipoCambio/retrieve';
    var urlControl = 'https://www.api-dolareros.sbs/api/tipoCambio/retrieve/control';

    $.ajax({
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

    $.ajax({
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

