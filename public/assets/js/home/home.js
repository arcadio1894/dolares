let $tipoCambioCompra;
let $tipoCambioVenta;

let $tipoCambioCompraControl;
let $tipoCambioVentaControl;

let $tipoCambioCompraWithCoupon = 0;
let $tipoCambioVentaWithCoupon = 0;

$(document).ready(function () {

    $tipoCambioCompra = parseFloat($('#tipoCambioCompra').val());
    $tipoCambioVenta = parseFloat($('#tipoCambioVenta').val());
    $tipoCambioCompraControl = parseFloat($('#tipoCambioCompraControl').val());
    $tipoCambioVentaControl = parseFloat($('#tipoCambioVentaControl').val());

    $('#div-couponBuy').hide();
    $('#div-couponSell').hide();

    getTipoCambioDolareros();

    $('#btn-reload').on('click', reloadPage);

    $('#btn-coupon').on('click', applyCoupon);

    $(document).on('click','[data-tab]', checkTabPane);

    $(document).on('input', '#sendBuy', changeSendBuy);

    $(document).on('input', '#sendSell', changeSendSell);

    $(document).on('input', '#getBuy', changeGetBuy);

    $(document).on('input', '#getSell', changeGetSell);

});

function applyCoupon() {
    var urlApply = $(this).attr('data-url');
    var coupon = $('#coupon').val();
    var req1 = $.ajax({
        url: urlApply,
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({
            "coupon":coupon
        }),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function(response){
            console.log(response.stopData);
            console.log(response.coupon);
            toastr.success(response.message, 'Éxito',
                {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            let stopData = response.stopData;
            let coupon = response.coupon;

            let buyStop = parseFloat(stopData.buyStop);
            let sellStop = parseFloat(stopData.sellStop);
            let buyControl = parseFloat(stopData.buyControl);
            let sellControl = parseFloat(stopData.sellControl);

            let buyCoupon = parseFloat(coupon.amountBuy);
            let sellCoupon = parseFloat(coupon.amountSell);

            $tipoCambioCompra = buyStop;
            $tipoCambioVenta = sellStop;
            $tipoCambioCompraControl = buyControl;
            $tipoCambioVentaControl = sellControl;

            $tipoCambioCompraWithCoupon = buyCoupon;
            $tipoCambioVentaWithCoupon = sellCoupon;

            checkTabPane();

            checkCoupons();

        },
        error: function(data){
            if( data.responseJSON.message && !data.responseJSON.errors )
            {
                toastr.error(data.responseJSON.message, 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            for ( var property in data.responseJSON.errors ) {
                toastr.error(data.responseJSON.errors[property], 'Error',
                    {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
        }
    });
}

function checkCoupons() {
    var ref_tab = $("ul.nav-tabs  a.active");
    console.log(ref_tab.attr('data-tab'));

    var typeTab = ref_tab.attr('data-tab');

    if ( typeTab == 'buy' )
    {
        if ( $tipoCambioCompraWithCoupon != 0 )
        {
            $('#div-couponBuy').show();
            $('#div-couponSell').hide();

            var couponBuyNew = parseFloat($tipoCambioCompra + $tipoCambioCompraWithCoupon).toFixed(3);

            $('#cuponBuyOld').html($tipoCambioCompra);
            $('#cuponBuyNew').html(couponBuyNew);
        }

    } else {
        if ( $tipoCambioVentaWithCoupon != 0 )
        {
            $('#div-couponBuy').hide();
            $('#div-couponSell').show();

            var couponSellNew = parseFloat($tipoCambioVenta - $tipoCambioVentaWithCoupon).toFixed(3);

            $('#cuponSellOld').html($tipoCambioVenta);
            $('#cuponSellNew').html(couponSellNew);
        }

    }
}

function reloadPage() {
    location.reload();
}

function checkTabPane() {
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
        var getBuy = parseFloat(sendBuy*($tipoCambioCompra+$tipoCambioCompraWithCoupon)).toFixed(2);
        $('#getBuy').val(getBuy);
        var ahorroBuy = getAhorroBuy(sendBuy);
        $('#ahorroBuy').html('Estás ahorrando aprox. S/ '+ahorroBuy);
    } else {
        $('#text_sell').removeClass('text-muted');
        $('#text_sell').addClass('text-primary');
        $('#text_buy').removeClass('text-primary');
        $('#text_buy').addClass('text-muted');

        var sendSell = parseFloat($('#sendSell').val());
        var getSell = parseFloat(sendSell/($tipoCambioVenta-$tipoCambioVentaWithCoupon)).toFixed(2);
        $('#getSell').val(getSell);
        var ahorroSell = getAhorroSell(sendSell);
        $('#ahorroSell').html('Estás ahorrando aprox. USD '+ahorroSell)
    }

    checkCoupons();
}

function getTipoCambioDolareros() {
    $('#text_buy').html('Compra: '+($tipoCambioCompra+$tipoCambioCompraWithCoupon));
    $('#text_sell').html('Venta: '+($tipoCambioVenta-$tipoCambioVentaWithCoupon));

    checkTabPane();

    checkCoupons();
}

function changeSendBuy() {
    var sendBuy = parseFloat(($('#sendBuy').val() == '') ? 0:$('#sendBuy').val());
    var getBuy = parseFloat(sendBuy*($tipoCambioCompra+$tipoCambioCompraWithCoupon)).toFixed(2);
    $('#getBuy').val(getBuy);
    var ahorroBuy = getAhorroBuy(sendBuy);
    $('#ahorroBuy').html('Estás ahorrando aprox. S/ '+ahorroBuy);
}

function changeSendSell() {
    var sendSell = parseFloat(($('#sendSell').val() == '') ? 0:$('#sendSell').val());
    var getSell = parseFloat(sendSell/($tipoCambioVenta-$tipoCambioVentaWithCoupon)).toFixed(2);
    $('#getSell').val(getSell);
    var ahorroSell = getAhorroSell(sendSell);
    $('#ahorroSell').html('Estás ahorrando aprox. USD '+ahorroSell)
}

function changeGetBuy() {
    var getBuy = parseFloat(($('#getBuy').val() == '') ? 0:$('#getBuy').val());
    var sendBuy = parseFloat(getBuy/($tipoCambioCompra+$tipoCambioCompraWithCoupon)).toFixed(2);
    $('#sendBuy').val(sendBuy);
    var ahorroBuy = getAhorroBuy(sendBuy);
    $('#ahorroBuy').html('Estás ahorrando aprox. S/ '+ahorroBuy);
}

function changeGetSell() {
    var getSell = parseFloat(($('#getSell').val() == '') ? 0:$('#getSell').val());
    var sendSell = parseFloat(getSell*($tipoCambioVenta-$tipoCambioVentaWithCoupon)).toFixed(2);
    $('#sendSell').val(sendSell);
    var ahorroSell = getAhorroSell(sendSell);
    $('#ahorroSell').html('Estás ahorrando aprox. USD '+ahorroSell)
}

function getAhorroBuy( sendBuy ) {
    return parseFloat((($tipoCambioCompra+$tipoCambioCompraWithCoupon) - $tipoCambioCompraControl)*sendBuy).toFixed(2);
}

function getAhorroSell( sendSell ) {
    return parseFloat((($tipoCambioVentaControl - ($tipoCambioVenta-$tipoCambioVentaWithCoupon))*sendSell)/($tipoCambioVenta-$tipoCambioVentaWithCoupon)).toFixed(2);
}

