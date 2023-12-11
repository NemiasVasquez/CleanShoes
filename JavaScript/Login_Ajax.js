$(document).ready(function () {
    $('#form_Login').on("submit", function (event) {
        event.preventDefault();
        if ($('#usuario').val() == "") {
            alert("Debe ingresar su usuario.");
        } else if ($('#contraseña').val() == "") {
            alert("Debe ingresar su contraseña.");
        } else {
            $.ajax({        
                url: "index.php?c=Cliente_Controller&a=Login",          
                method: "POST",
                data: $('#form_Login').serialize(),
                success: function (data) {
                    $('#form_Login')[0].reset();
                    console.log("Terminando Registro");
                    console.log("Respuesta del servidor:", data);
                    // Si el inicio de sesión es exitoso, redirige a index.php
                    if (data.mensaje == "Inicio de sesion exitoso.") {
                        console.log("Redirigiendo");
                        window.location.href = "index.php";
                    }else{
                        
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud Ajax:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);
                }
            });
        }
    });
});
