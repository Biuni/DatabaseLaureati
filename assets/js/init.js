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

        var pwd_studente = validate.password;
        var user_studente = validate.username;

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

        var pwd_aziende = validate.password;
        var user_aziende = validate.username;

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

    // Validazione del form di update username aziende
    $('#mod-user-azienda').submit(function(e){

        var all_right = true;
        var form = $(this).serialize();
        var validate = deparam(form);

        var new_user = validate.new_user_azienda;

        if (new_user == '' || !validUsername(new_user)) {
            all_right = false;
            $('.input_new-user-azienda').addClass('has-danger');
        } else {
            $('.input_new-user-azienda').removeClass('has-danger');
        }

        if (!all_right) {
            e.preventDefault();
        }
    });

    // Validazione del form di update password aziende
    $('#mod-pwd-azienda').submit(function(e){

        var all_right = true;
        var form = $(this).serialize();
        var validate = deparam(form);

        var pwd_attuale = validate.pwd_attuale;
        var pwd_nuova = validate.pwd_nuova;
        var pwd_nuova2 = validate.pwd_nuova2;

        if (pwd_attuale == '') {
            all_right = false;
            $('.input_old-pwd-azienda').addClass('has-danger');
        } else {
            $('.input_old-pwd-azienda').removeClass('has-danger');
        }

        if (pwd_nuova == '') {
            all_right = false;
            $('.input_new-pwd-azienda').addClass('has-danger');
        } else {
            $('.input_new-pwd-azienda').removeClass('has-danger');
        }

        if (pwd_nuova2 == '') {
            all_right = false;
            $('.input_new2-pwd-azienda').addClass('has-danger');
        } else {
            $('.input_new2-pwd-azienda').removeClass('has-danger');
        }

        if (!all_right) {
            e.preventDefault();
        }
    });

    // Validazione del form di update password studenti
    $('#mod-pwd-studente').submit(function(e){

        var all_right = true;
        var form = $(this).serialize();
        var validate = deparam(form);

        var pwd_attuale = validate.pwd_attuale;
        var pwd_nuova = validate.pwd_nuova;
        var pwd_nuova2 = validate.pwd_nuova2;

        if (pwd_attuale == '') {
            all_right = false;
            $('.input_old-pwd-studente').addClass('has-danger');
        } else {
            $('.input_old-pwd-studente').removeClass('has-danger');
        }

        if (pwd_nuova == '') {
            all_right = false;
            $('.input_new-pwd-studente').addClass('has-danger');
        } else {
            $('.input_new-pwd-studente').removeClass('has-danger');
        }

        if (pwd_nuova2 == '') {
            all_right = false;
            $('.input_new2-pwd-studente').addClass('has-danger');
        } else {
            $('.input_new2-pwd-studente').removeClass('has-danger');
        }

        if (!all_right) {
            e.preventDefault();
        }
    });

    // Validazione del form di update dei dati degli studenti
    $('#mod-dati-studente').submit(function(e){

        var all_right = true;
        var form = $(this).serialize();
        var validate = deparam(form);

        var Data_n = validate.Data_n;
        var CF = validate.CF;
        var Luogo_n = validate.Luogo_n;
        var Luogo_r = validate.Luogo_r;
        var Telefono = validate.Telefono;
        var e_mail = validate.e_mail;
        var Visibility = validate.Visibility;

        if (Visibility == '' || (Visibility != 1 && Visibility != 0)) {
            all_right = false;
        }
        if (Data_n != '' && !validDate(Data_n)) {
            all_right = false;
            $('.input_data-n').addClass('has-danger');
        } else {
            $('.input_data-n').removeClass('has-danger');
        }
        if (CF != '' && !validCF(CF)) {
            all_right = false;
            $('.input_CF').addClass('has-danger');
        } else {
            $('.input_CF').removeClass('has-danger');
        }
        if (Luogo_n != '' && !validText(Luogo_n)) {
            all_right = false;
            $('.input_Luogo-n').addClass('has-danger');
        } else {
            $('.input_Luogo-n').removeClass('has-danger');
        }
        if (Luogo_r != '' && !validText(Luogo_r)) {
            all_right = false;
            $('.input_Luogo-r').addClass('has-danger');
        } else {
            $('.input_Luogo-r').removeClass('has-danger');
        }
        if (Telefono != '' && !validInteger(Telefono)) {
            all_right = false;
            $('.input_Telefono').addClass('has-danger');
        } else {
            $('.input_Telefono').removeClass('has-danger');
        }
        if (e_mail != '' && !validEmail(e_mail)) {
            all_right = false;
            $('.input_e_mail').addClass('has-danger');
        } else {
            $('.input_e_mail').removeClass('has-danger');
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

    function validDate(text) {
        var pattern = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
        return pattern.test(text);
    };

    function validCF(text) {
        var pattern = /^(?:[B-DF-HJ-NP-TV-Z](?:[AEIOU]{2}|[AEIOU]X)|[AEIOU]{2}X|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}[\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[1256LMRS][\dLMNP-V])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM])(?:[A-MZ][1-9MNP-V][\dLMNP-V]{2}|[A-M][0L](?:[\dLMNP-V][1-9MNP-V]|[1-9MNP-V][0L]))[A-Z]$/i;
        return pattern.test(text);
    };

});