let $modalCreate;
let $modalRefresh;
let $formCreate;
let $formRefresh;
let _pincode;

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
    var debug = false;

    // main form
    var $form = $('#formRefresh');

    // pincode group
    var $group = $form.find('.form__pincode1');

    // all input fields
    var $inputs = $group.find(':input');

    // input fields
    var $first = $form.find('[name=pincode-1]')
        , $second = $form.find('[name=pincode-2]')
        , $third = $form.find('[name=pincode-3]')
        , $fourth = $form.find('[name=pincode-4]');

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
    // Obtener la URL
    $("#btn-renew").attr("disabled", true);
    var createUrl = $formRefresh.data('url');
    $.ajax({
        url: createUrl,
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({
            "token":_pincode
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
            $("#btn-renew").attr("disabled", false);
            location.reload();

        },
    });
}

function saveToken() {
    event.preventDefault();
    // Obtener la URL
    $("#btn-save").attr("disabled", true);
    var createUrl = $formCreate.data('url');
    $.ajax({
        url: createUrl,
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: JSON.stringify({
            "token":_pincode
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



