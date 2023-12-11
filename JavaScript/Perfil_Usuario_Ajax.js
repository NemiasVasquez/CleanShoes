
$(document).ready(function () {
    /* Para el selector de direcciones */
    $('#Selector_Direccion').on("click", function(){
        $.ajax({
            url: 'index.php?c=Direccion_Controller&a=getDirecionesCliente',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log("Terminando Registro");
                console.log("Respuesta del servidor:", response);

                data = response;
                $('#Selector_Direccion').empty();
                $('#Selector_Direccion').append('<option value="NA">Elija una dirección</option>');

                $.each(data, function(index, direccion) {
                    $('#Selector_Direccion').append('<option value="' + direccion.id_Direccion + '">' + direccion.direccion + ' - ' + direccion.distrito + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
            }
        });
    });
    
    $('#Selector_Direccion').on("change", function(){
        var selectedDireccion = $(this).val();
    
        // Verificar si selectedDireccion no es NA
        if (selectedDireccion !== "NA") {
            // Realizar una nueva solicitud AJAX para obtener información detallada
            $.ajax({
                url: 'index.php?c=Direccion_Controller&a=buscarDireccion',
                type: 'POST',  // Cambiado a método POST
                dataType: 'json',
                data: { id_Direccion: selectedDireccion },  // Asegúrate de que selectedDireccion tenga un valor definido aquí
                success: function(response) {
                    // Imprimir información en la consola para depuración
                    console.log('Selected Direction:', selectedDireccion);
                    console.log('Response from AJAX:', response);
    
                    // Asignar los valores al formulario con la información obtenida
                    $('#direccion_actualizar').val(response.direccion);
                    $('#referencia_actualizar').val(response.referencia);
                    $('#distrito_actualizar').val(response.distrito);
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);
                }
            });
        } else {
            console.error("selectedDireccion es NA.");
            $('#direccion_actualizar, #referencia_actualizar, #distrito_actualizar').val('');
        }
    });
    
    
    $('#form_ActualizarDatos').on("submit", function (event) {
        event.preventDefault();
        var regexCelular = /^9\d{8}$/; 
        
        if ($('#nombres').val() == "") {
            alert("Debe ingresar un nombre en el formulario.");
        } else if ($('#apellidos').val() == "") {
            alert("Debe ingresar sus apellidos en el formulario.");
        } else if ($('#celular').val() == "") {
            alert("Debe ingresar un celular.");
        } else if (!regexCelular.test($('#celular').val()) || isNaN($('#celular').val())) {
            alert("Ingrese un número de celular válido que empiece con '9' y tenga 9 dígitos.");
        } else if ($('#correo').val() == "") {
            alert("Debe ingresar un correo.");
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
                url: "index.php?c=Cliente_Controller&a=ActualizarCliente",          
                method: "POST",
                data: $('#form_ActualizarDatos').serialize(),
                success: function (data) {
                    $('#form_ActualizarDatos')[0].reset();
                    console.log("Terminando Registro");
                    console.log("Respuesta del servidor:", data);
                    alert(data.mensaje);
                    
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud Ajax:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);
                }
            });
        }
    });

    $('#form_AñadirDireccion').on("submit", function (event) {
        event.preventDefault();
        if ($('#direcicon_añadir').val() == "") {
            alert("Debe ingresar una dirección.");
        } else if ($('#referencia_añadir').val() == "") {
            alert("Debe ingresar una referencia.");
        } else if ($('#distrito_añadir').val() == "") {
            alert("Debe especificar un distrito.");
        } else {
            $.ajax({        
                url: "index.php?c=Direccion_Controller&a=AñadirDireccion",          
                method: "POST",
                data: $('#form_AñadirDireccion').serialize(),
                success: function (data) {
                    $('#form_AñadirDireccion')[0].reset();
                    console.log("Terminando Registro");
                    console.log("Respuesta del servidor:", data);
                    alert(data.mensaje);
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud Ajax:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);
                }
            });
        }
    });

});
