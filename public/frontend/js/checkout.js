function submitForm(e) {
    e.preventDefault();
    var errors = validateInputFields();

    if (errors.fname_error !== '' || errors.lname_error !== '' || errors.email_error !== '' || errors.phone_error !== '' || errors.direccion1_error !== '' || errors.region_error !== '' || errors.ciudad_error !== '' || errors.comuna_error !== '') {
        return false;
    } else {
        
    }
}

$(document).ready(function () {
    $('.pagoBtn').click(submitForm);
});



function validateInputFields() {
    var fname = $('.fname').val();
    var lname = $('.lname').val();
    var email = $('.email').val();
    var phone = $('.phone').val();
    var direccion1 = $('.direccion1').val();
    var direccion2 = $('.direccion2').val();
    var region = $('.region').val();
    var ciudad = $('.ciudad').val();
    var comuna = $('.comuna').val();

    var fname_error = "",
        lname_error = "",
        email_error = "",
        phone_error = "",
        direccion1_error = "",
        region_error = "",
        ciudad_error = "",
        comuna_error = "";

    if (!fname) {
        fname_error = "El nombre es requerido";
        $('#fname_error').html(fname_error);
    } else {
        $('#fname_error').html('');
    }
    if (!lname) {
        lname_error = "El apellido es requerido";
        $('#lname_error').html(lname_error);
    } else {
        $('#lname_error').html('');
    }
    if (!email) {
        email_error = "El email es requerido";
        $('#email_error').html(email_error);
    } else {
        $('#email_error').html('');
    }
    if (!phone) {
        phone_error = "El teléfono es requerido";
        $('#phone_error').html(phone_error);
    } else {
        $('#phone_error').html('');
    }
    if (!direccion1) {
        direccion1_error = "La dirección 1 es requerida";
        $('#direccion1_error').html(direccion1_error);
    } else {
        $('#direccion1_error').html('');
    }
    if (!region) {
        region_error = "La región es requerida";
        $('#region_error').html(region_error);
    } else {
        $('#region_error').html('');
    }
    if (!ciudad) {
        ciudad_error = "La ciudad es requerida";
        $('#ciudad_error').html(ciudad_error);
    } else {
        $('#ciudad_error').html('');
    }
    if (!comuna) {
        comuna_error = "La comuna es requerida";
        $('#comuna_error').html(comuna_error);
    } else {
        $('#comuna_error').html('');
    }

    return {
        fname_error: fname_error,
        lname_error: lname_error,
        email_error: email_error,
        phone_error: phone_error,
        direccion1_error: direccion1_error,
        region_error: region_error,
        ciudad_error: ciudad_error,
        comuna_error: comuna_error,
    };
}

