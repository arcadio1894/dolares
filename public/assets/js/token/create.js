let $modalCreate;
let $modalRefresh;
let $formCreate;
let $formRefresh;
let _pincode;
let _pincodel;
let $code = [];
let $codel = [];
let $coden = [];

$(document).ready(function () {
    $modalCreate = $('#modalCreate');
    $modalRefresh = $('#modalRefresh');

    $formCreate = $('#formCreate');
    $formRefresh = $('#formRefresh');

    $('#btn-create').on('click', showModalCreate);
    $('#btn-refresh').on('click', showModalRefresh);

    $('#btn-save').on('click', saveToken);
    $('#btn-renew').on('click', refreshToken);

    // pincode
    _pincode = [];
    _pincodel = [];
    var debug = false;

    // main form
    var $form = $('#formRefresh');

    // pincode group
    var $group = $form.find('.form__pincode1');
    var $groupl = $form.find('.form__pincodel1');

    // all input fields
    var $inputs = $group.find(':input');
    var $inputsl = $groupl.find(':input');

    // input fields
    var $first = $form.find('[name=pincode-1]')
        , $second = $form.find('[name=pincode-2]')
        , $third = $form.find('[name=pincode-3]')
        , $fourth = $form.find('[name=pincode-4]');

    var $firstl = $form.find('[name=pincodel-1]')
        , $secondl = $form.find('[name=pincodel-2]')
        , $thirdl = $form.find('[name=pincodel-3]')
        , $fourthl = $form.find('[name=pincodel-4]');

    // all fields
    $inputsl
        .on('keyup', function(event) {
            var code = event.keyCode || event.which;

            if (code === 9 && ! event.shiftKey) {
                // prevent default event
                event.preventDefault();
            }
        })
        .inputmask({
            mask: '9',
            placeholder: '',
            showMaskOnHover: false,
            showMaskOnFocus: false,
            clearIncomplete: true,
            onincomplete: function() {
                ! debug || console.log('inputmask incomplete');
            },
            oncleared: function() {
                var index = $inputsl.index(this)
                    , prev = index - 1
                    , next = index + 1;

                if (prev >= 0) {
                    // clear field
                    $inputsl.eq(prev).val('');

                    // focus field
                    $inputsl.eq(prev).focus();

                    // remove last nubmer
                    _pincodel.splice(-1, 1)
                } else {
                    return false;
                }

                ! debug || console.log('[oncleared]', prev, index, next);
            },
            onKeyValidation: function(key, result) {
                var index = $inputsl.index(this)
                    , prev = index - 1
                    , next = index + 1;

                // focus to next field
                if (prev < 6) {
                    $inputsl.eq(next).focus();
                }

                ! debug || console.log('[onKeyValidation]', index, key, result, _pincodel);
            },
            onBeforePaste: function (data, opts) {
                $.each(data.split(''), function(index, value) {
                    // set value
                    $inputsl.eq(index).val(value);

                    ! debug || console.log('[onBeforePaste:each]', index, value);
                });

                return false;
            }
        });

    // first field
    $('[name=pincodel-1]')
        .on('focus', function(event) {
            _pincode = [];
            $inputsl
                .each(function() {
                    // clear each field
                    $(this).val('');
                });
            ! debug || console.log('[1:focus]', _pincodel);
        })
        .inputmask({
            oncomplete: function() {
                // add first character
                _pincodel.push($(this).val());

                // focus to second field
                $('[name=pincodel-2]').focus();

                ! debug || console.log('[1:oncomplete]', _pincodel);
            }
        });

    // second field
    $('[name=pincodel-2]')
        .on('focus', function(event) {
            if ( ! ($firstl.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincodel = [];

                // handle each field
                $inputsl
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $firstl.focus();
            }

            ! debug || console.log('[2:focus]', _pincodel);
        })
        .inputmask({
            oncomplete: function() {
                // add second character
                _pincodel.push($(this).val());

                // focus to third field
                $('[name=pincodel-3]').focus();

                ! debug || console.log('[2:oncomplete]', _pincodel);
            }
        });

    // third field
    $('[name=pincodel-3]')
        .on('focus', function(event) {
            if ( ! ($firstl.val().trim() !== '' &&
                $secondl.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincodel = [];

                // handle each field
                $inputsl
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $firstl.focus();
            }

            ! debug || console.log('[3:focus]', _pincodel);
        })
        .inputmask({
            oncomplete: function() {
                // add third character
                _pincodel.push($(this).val());

                // focus to fourth field
                $('[name=pincodel-4]').focus();

                ! debug || console.log('[3:oncomplete]', _pincodel);
            }
        });

    // fourth field

    $('[name=pincodel-4]')
        .on('focus', function(event) {
            if ( ! ($firstl.val().trim() !== '' &&
                $secondl.val().trim() !== '' &&
                $thirdl.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincodel = [];

                // handle each field
                $inputsl
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $firstl.focus();
            }

            ! debug || console.log('[4:focus]', _pincodel);
        })
        .inputmask({
            oncomplete: function() {
                // add fo fourth character
                _pincodel.push($(this).val());

                ! debug || console.log('[4:oncomplete]', _pincodel);
            }
        });
    // all fields
    $inputs
        .on('keyup', function(event) {
            var code = event.keyCode || event.which;

            if (code === 9 && ! event.shiftKey) {
                // prevent default event
                event.preventDefault();
            }
        })
        .inputmask({
            mask: '9',
            placeholder: '',
            showMaskOnHover: false,
            showMaskOnFocus: false,
            clearIncomplete: true,
            onincomplete: function() {
                ! debug || console.log('inputmask incomplete');
            },
            oncleared: function() {
                var index = $inputs.index(this)
                    , prev = index - 1
                    , next = index + 1;

                if (prev >= 0) {
                    // clear field
                    $inputs.eq(prev).val('');

                    // focus field
                    $inputs.eq(prev).focus();

                    // remove last nubmer
                    _pincode.splice(-1, 1)
                } else {
                    return false;
                }

                ! debug || console.log('[oncleared]', prev, index, next);
            },
            onKeyValidation: function(key, result) {
                var index = $inputs.index(this)
                    , prev = index - 1
                    , next = index + 1;

                // focus to next field
                if (prev < 6) {
                    $inputs.eq(next).focus();
                }

                ! debug || console.log('[onKeyValidation]', index, key, result, _pincode);
            },
            onBeforePaste: function (data, opts) {
                $.each(data.split(''), function(index, value) {
                    // set value
                    $inputs.eq(index).val(value);

                    ! debug || console.log('[onBeforePaste:each]', index, value);
                });

                return false;
            }
        });

    // first field
    $('[name=pincode-1]')
        .on('focus', function(event) {
            // reset pincode
            _pincode = [];
            $inputs
                .each(function() {
                    // clear each field
                    $(this).val('');
                });
            ! debug || console.log('[1:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add first character
                _pincode.push($(this).val());

                // focus to second field
                $('[name=pincode-2]').focus();

                ! debug || console.log('[1:oncomplete]', _pincode);
            }
        });

    // second field
    $('[name=pincode-2]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '')) {
                // prevent default
                event.preventDefault();
                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();

            }


            ! debug || console.log('[2:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add second character
                _pincode.push($(this).val());

                // focus to third field
                $('[name=pincode-3]').focus();

                ! debug || console.log('[2:oncomplete]', _pincode);
            }
        });

    // third field
    $('[name=pincode-3]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '' &&
                $second.val().trim() !== '')) {
                // prevent default
                event.preventDefault();
                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();

            }

            ! debug || console.log('[3:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add third character
                _pincode.push($(this).val());

                // focus to fourth field
                $('[name=pincode-4]').focus();

                ! debug || console.log('[3:oncomplete]', _pincode);
            }
        });

    // fourth field
    $('[name=pincode-4]')
        .on('focus', function(event) {
            if ( ! ($first.val().trim() !== '' &&
                $second.val().trim() !== '' &&
                $third.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first.focus();
            }


            ! debug || console.log('[4:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add fo fourth character
                _pincode.push($(this).val());

                ! debug || console.log('[4:oncomplete]', _pincode);
            }
        });

    // main form
    var $form1 = $('#formCreate');

    // pincode group
    var $group1 = $form1.find('.form__pincode1');

    // all input fields
    var $inputs1 = $group1.find(':input');

    // input fields
    var $first1 = $form1.find('[name=pincode-5]')
        , $second1 = $form1.find('[name=pincode-6]')
        , $third1 = $form1.find('[name=pincode-7]')
        , $fourth1 = $form1.find('[name=pincode-8]');

    // all fields
    $inputs1
        .on('keyup', function(event) {
            var code = event.keyCode || event.which;

            if (code === 9 && ! event.shiftKey) {
                // prevent default event
                event.preventDefault();
            }
        })
        .inputmask({
            mask: '9',
            placeholder: '',
            showMaskOnHover: false,
            showMaskOnFocus: false,
            clearIncomplete: true,
            onincomplete: function() {
                ! debug || console.log('inputmask incomplete');
            },
            oncleared: function() {
                var index = $inputs1.index(this)
                    , prev = index - 1
                    , next = index + 1;

                if (prev >= 0) {
                    // clear field
                    $inputs1.eq(prev).val('');

                    // focus field
                    $inputs1.eq(prev).focus();

                    // remove last nubmer
                    _pincode.splice(-1, 1)
                } else {
                    return false;
                }

                ! debug || console.log('[oncleared]', prev, index, next);
            },
            onKeyValidation: function(key, result) {
                var index = $inputs1.index(this)
                    , prev = index - 1
                    , next = index + 1;

                // focus to next field
                if (prev < 6) {
                    $inputs1.eq(next).focus();
                }

                ! debug || console.log('[onKeyValidation]', index, key, result, _pincode);
            },
            onBeforePaste: function (data, opts) {
                $.each(data.split(''), function(index, value) {
                    // set value
                    $inputs1.eq(index).val(value);

                    ! debug || console.log('[onBeforePaste:each]', index, value);
                });

                return false;
            }
        });

    // first field
    $('[name=pincode-5]')
        .on('focus', function(event) {
            _pincode = [];
            $inputs1
                .each(function() {
                    // clear each field
                    $(this).val('');
                });
            ! debug || console.log('[1:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add first character
                _pincode.push($(this).val());

                // focus to second field
                $('[name=pincode-6]').focus();

                ! debug || console.log('[1:oncomplete]', _pincode);
            }
        });

    // second field
    $('[name=pincode-6]')
        .on('focus', function(event) {
            if ( ! ($first1.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs1
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first1.focus();
            }

            ! debug || console.log('[2:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add second character
                _pincode.push($(this).val());

                // focus to third field
                $('[name=pincode-7]').focus();

                ! debug || console.log('[2:oncomplete]', _pincode);
            }
        });

    // third field
    $('[name=pincode-7]')
        .on('focus', function(event) {
            if ( ! ($first1.val().trim() !== '' &&
                $second1.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs1
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first1.focus();
            }

            ! debug || console.log('[3:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add third character
                _pincode.push($(this).val());

                // focus to fourth field
                $('[name=pincode-8]').focus();

                ! debug || console.log('[3:oncomplete]', _pincode);
            }
        });

    // fourth field
    $('[name=pincode-8]')
        .on('focus', function(event) {
            if ( ! ($first1.val().trim() !== '' &&
                $second1.val().trim() !== '' &&
                $third1.val().trim() !== '')) {
                // prevent default
                event.preventDefault();

                // reset pincode
                _pincode = [];

                // handle each field
                $inputs1
                    .each(function() {
                        // clear each field
                        $(this).val('');
                    });

                // focus to first field
                $first1.focus();
            }

            ! debug || console.log('[4:focus]', _pincode);
        })
        .inputmask({
            oncomplete: function() {
                // add fo fourth character
                _pincode.push($(this).val());

                ! debug || console.log('[4:oncomplete]', _pincode);
            }
        });
});

function refreshToken() {
    event.preventDefault();

    $('.codel').each(function() {
        $codel.push($(this).val());
    });

    $('.code').each(function() {
        $code.push($(this).val());
    });

    console.log($codel);

    console.log($code);

    // Obtener la URL
    $("#btn-renew").attr("disabled", true);
    var createUrl = $formRefresh.data('url');
    $.ajax({
        url: createUrl,
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({
            "token":$code,
            "tokenl":$codel
        }),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            console.log(data);
            $modalRefresh.modal('hide');
            toastr.success(data.message, 'Éxito',
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
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            setTimeout( function () {
                $("#btn-renew").attr("disabled", false);
                _pincode = [];
                $code = [];
                $codel = [];
                location.reload();
            }, 1500 )
        },
        error: function (data) {
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
                        "hideDuration": "1000",
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
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            _pincode = [];
            $code = [];
            $codel = [];
            $("#btn-renew").attr("disabled", false);
            //location.reload();

        },
    });
}

function saveToken() {
    $('.coden').each(function() {
        $coden.push($(this).val());
    });

    event.preventDefault();
    // Obtener la URL
    $("#btn-save").attr("disabled", true);
    var createUrl = $formCreate.data('url');
    $.ajax({
        url: createUrl,
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({
            "token":$coden
        }),
        processData:false,
        contentType:'application/json; charset=utf-8',
        success: function (data) {
            console.log(data);
            $modalCreate.modal('hide');
            toastr.success(data.message, 'Éxito',
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
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            setTimeout( function () {
                $("#btn-save").attr("disabled", false);
                _pincode = [];
                $coden = [];
                location.reload();
            }, 1500 )
        },
        error: function (data) {
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
                        "hideDuration": "1000",
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
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
            }
            _pincode = [];
            location.reload();
            $("#btn-save").attr("disabled", false);
        },
    });
}

function showModalCreate() {
    console.log('Llegue');
    $modalCreate.modal('show');
}

function showModalRefresh() {
    $modalRefresh.modal('show');
}



