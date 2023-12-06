$(document).ready(function () {
    $('#form_Registro').on("submit", function (event) {
        event.preventDefault();
        var regexDNI = /^\d{8}$/; /* Variable para validar el formato del DNI - Acepta 8 dígitos */
        var regexCelular = /^9\d{8}$/; 
        
        if ($('#nombres').val() == "") {
            alert("Debe ingresar un nombre en el formulario.");
        } else if ($('#apellidos').val() == "") {
            alert("Debe ingresar sus apellidos en el formulario.");
        } else if ($('#dni').val() == "") {
            alert("Debe ingresar el número de DNI.");
        } else if (!regexDNI.test($('#dni').val()) || isNaN($('#dni').val())) {
            alert("Ingrese un número de DNI válido.");
        } else if ($('#celular').val() == "") {
            alert("Debe ingresar un celular.");
        } else if (!regexCelular.test($('#celular').val()) || isNaN($('#celular').val())) {
            alert("Ingrese un número de celular válido que empiece con '9' y tenga 9 dígitos.");
        } else if ($('#correo').val() == "") {
            alert("Debe ingresar un correo.");
        } else if ($('#referencia').val() == "") {
            alert("Debe ingresar una referencia.");
        } else if ($('#distrito').val() == "") {
            alert("Debe ingresar un distrito.");
        } else if ($('#contraseña').val() == "") {
            alert("Debe ingresar una contraseña.");
        } else if ($('#contraseña').val().length < 8) {
            alert("La contraseña debe tener al menos 8 caracteres.");
        } else if ($('#contraseña2').val() == "") {
            alert("Debe ingresar confirmar su contraseña.");
        } else if ($('#contraseña').val() != $('#contraseña2').val()) {
            alert("ERROR!, Las contraseñas no son iguales.");
        } else {
            $.ajax({        
                url: "index.php?c=Cliente_Controller&a=Registrar",          
                method: "POST",
                data: $('#form_Registro').serialize(),
                success: function (data) {
                    $('#form_Registro')[0].reset();
                    console.log("Terminando Registro");
                    console.log("Respuesta del servidor:", data);
                    alert(data.mensaje);
                    // Puedes realizar acciones adicionales según sea necesario con la respuesta del servidor (data).
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud Ajax:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);
                }
            });
        }
    });
});
