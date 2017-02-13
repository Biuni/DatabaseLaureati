jQuery(document).ready(function($) {

    $('.counter').counterUp();
    
    $('#openInviaCurriculum').click(function(){
        $('#inviaCurriculum').modal('show');
    });

    var sidenav = $('#mySidenav');
    var overlay = $('.overlay-sidenav');

    $('.openbtn-sidenav').click(function(){
    	sidenav.css('width','250px');
    	overlay.show();
    });
    $('.closebtn-sidenav').click(function(){
    	sidenav.css('width','0');
    	overlay.hide();
    });

    var table = $('#student-list').DataTable({
        "order": [[ 4, "desc" ]],
        "autoWidth": false,
        "searching": false,
        "language": {
            "lengthMenu": "Mostra _MENU_ laureati per pagina.",
            "zeroRecords": "Nessun laureato trovato.",
            "info": "Pagina _PAGE_ di _PAGES_",
            "sInfoEmpty":      "",
            "sInfoFiltered":   "(filtrati da _MAX_ elementi totali)",
            "oPaginate": {
                "sFirst":      "Inizio",
                "sPrevious":   '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>',
                "sNext":       '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>',
                "sLast":       "Fine"
            },
            "sLoadingRecords": "Caricamento...",
            "sProcessing":     "Elaborazione..."
        },
        "columns": [
            { "width": "10%" },
            { "width": "10%" },
            { "width": "40%" },
            { "width": "15%" },
            { "width": "15%" },
            { "widht": "10%" }
        ]
    });
    var count_row = table.rows().count();
    $('.dataTables_length').prepend('<p class="lead text-warning"><strong>'+count_row+' laureati trovati</strong></p>');

    // Validazione del form di registrazione delle aziende
    $('#form-reg-azienda').submit(function(e){

        var all_right = true;
        var form = $(this).serialize();
        var validate = deparam(form);

        var ragionesociale = validate.ragionesociale;
        var nomereferente = validate.nomereferente;
        var cognomereferente = validate.cognomereferente;
        var emailreferente = validate.emailreferente;

        if (validate.privacy == undefined) {
            all_right = false;
            $('.required-privacy').remove();
            $('.privacy-check').append(
                '<p class="text-danger required-privacy">'
                +'E\' obbligatorio accettare!'+
                '</p>'
            );
        } else {
            $('.required-privacy').remove();
        }

        if (ragionesociale == '') {
            all_right = false;
            $('.input-ragionesociale').removeClass('has-success');
            $('.input-ragionesociale').addClass('has-danger');
        } else {
            $('.input-ragionesociale').removeClass('has-danger');
            $('.input-ragionesociale').addClass('has-success');
        }

        if (nomereferente == '' || !validText(nomereferente)) {
            all_right = false;
            $('.input-nomereferente').removeClass('has-success');
            $('.input-nomereferente').addClass('has-danger');
        } else {
            $('.input-nomereferente').removeClass('has-danger');
            $('.input-nomereferente').addClass('has-success');
        }

        if (cognomereferente == '' || !validText(cognomereferente)) {
            all_right = false;
            $('.input-cognomereferente').removeClass('has-success');
            $('.input-cognomereferente').addClass('has-danger');
        } else {
            $('.input-cognomereferente').removeClass('has-danger');
            $('.input-cognomereferente').addClass('has-success');
        }

        if (emailreferente == '' || !validEmail(emailreferente)) {
            all_right = false;
            $('.input-emailreferente').removeClass('has-success');
            $('.input-emailreferente').addClass('has-danger');
        } else {
            $('.input-emailreferente').removeClass('has-danger');
            $('.input-emailreferente').addClass('has-success');
        }

        if (!all_right) {
            e.preventDefault();
        }
        
    });

    // Validazione del form di login degli studenti
    $('#form-log-studenti').submit(function(e){

        var all_right = true;
        var form = $(this).serialize();
        var validate = deparam(form);

        var pwd_studente = validate.pwd_studente;
        var user_studente = validate.user_studente;

        if (user_studente == '' || !validInteger(user_studente)) {
            all_right = false;
            $('.input-user_studente').addClass('has-danger');
        } else {
            $('.input-user_studente').removeClass('has-danger');
        }
        if (pwd_studente == '') {
            all_right = false;
            $('.input-pwd_studente').addClass('has-danger');
        } else {
            $('.input-pwd_studente').removeClass('has-danger');
        }

        if (!all_right) {
            e.preventDefault();
        }
    });

    // Validazione del form di login delle aziende
    $('#form-log-aziende').submit(function(e){

        var all_right = true;
        var form = $(this).serialize();
        var validate = deparam(form);

        var pwd_aziende = validate.pwd_aziende;
        var user_aziende = validate.user_aziende;

        if (user_aziende == '' || !validUsername(user_aziende)) {
            all_right = false;
            $('.input-user_aziende').addClass('has-danger');
        } else {
            $('.input-user_aziende').removeClass('has-danger');
        }
        if (pwd_aziende == '') {
            all_right = false;
            $('.input-pwd_aziende').addClass('has-danger');
        } else {
            $('.input-pwd_aziende').removeClass('has-danger');
        }

        if (!all_right) {
            e.preventDefault();
        }
    });

    function deparam(query) {
        var pairs, i, keyValuePair, key, value, map = {};
        if (query.slice(0, 1) === '?') {
            query = query.slice(1);
        }
        if (query !== '') {
            pairs = query.split('&');
            for (i = 0; i < pairs.length; i += 1) {
                keyValuePair = pairs[i].split('=');
                key = decodeURIComponent(keyValuePair[0]);
                value = (keyValuePair.length > 1) ? decodeURIComponent(keyValuePair[1]) : undefined;
                map[key] = value;
            }
        }
        return map;
    };

    function validEmail(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    };

    function validText(text) {
        var pattern = /^[a-zA-Z]*$/;
        return pattern.test(text);
    };

    function validUsername(text) {
        var pattern = /^[^<>&]*(?:&(?!(?:[a-z\d]+|#\d+|#x[a-f\d]+);)[^<>&]*)*$/i;
        return pattern.test(text);
    };

    function validInteger(text) {
        var pattern = /^[0-9]*$/;
        return pattern.test(text);
    };

});