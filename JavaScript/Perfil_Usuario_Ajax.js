$(document).ready(function () {

    console.log("El script se está ejecutando.");
    cargarDirecciones();
    $('#form_ActualizarDireccion .bloqueForm, #bloque_Formulario_Direcciones').hide();
    $('#form_ActualizarDireccion .bloque_SubmitForm').hide();

    $('#Selector_Direccion').on("change", function(){
        var selectedDireccion = $(this).val();
        if (selectedDireccion !== "NA") {
            cargarDireccionSeleccionada(selectedDireccion);
            // Mostrar elementos dentro del formulario de actualización
            $('#form_ActualizarDireccion .bloqueForm').show();
            $('#form_ActualizarDireccion .bloque_SubmitForm').show();
        } else {
            $('#form_ActualizarDireccion .bloqueForm').hide();
            $('#form_ActualizarDireccion .bloque_SubmitForm').hide();
        }
    });

    $('#form_AñadirDireccion').hide();
    $('#btn_AgregarDireccion').on("click", function(){
        $('#form_AñadirDireccion').show();
    });

    function cargarDirecciones() {
        $.ajax({
            url: 'index.php?c=Direccion_Controller&a=getDirecionesCliente',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log("Terminando Registro");
                console.log("Respuesta del servidor:", response);
                var contador = 1;

                $('#Selector_Direccion').empty();
                $('#Selector_Direccion').append('<option value="NA">Elija una dirección</option>');
                $.each(response, function(index, direccion) {
                    $('#Selector_Direccion').append('<option value="' + direccion.id_Direccion_Envio + '">' + contador+" - "  + direccion.direccion + ' - ' + direccion.distrito + '</option>');
                    contador++;
                });
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
            }
        });
    }

    function cargarDireccionSeleccionada(selectedDireccion) {
        $.ajax({
            url: 'index.php?c=Direccion_Controller&a=buscarDireccion',
            type: 'POST', 
            dataType: 'json',
            data: { id_Direccion: selectedDireccion }, 
            success: function(response) {
                $('#direccion_actualizar').val(response.direccion);
                $('#referencia_actualizar').val(response.referencia);
                $('#distrito_actualizar').val(response.distrito);
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
            }
        });
    }

    cargarDirecciones();

    $('#btn_actualizar_direccion').on("click", function(event) {
        event.preventDefault();
        cargarDirecciones();
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
        } else if ($('#usuario').val() == "") {
            alert("Debe ingresar un usuario.");
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

    $("#form_ActualizarDireccion").on("submit",function(event){
        event.preventDefault();
        if ($('#direcicon_actualizar').val() == "") {
            alert("Debe ingresar una dirección para actualizar.");
        } else if ($('#referencia_actualizar').val() == "") {
            alert("Debe ingresar una referencia para actualizar.");
        } else if ($('#distrito_actualizar').val() == "") {
            alert("Debe especificar un distrito para actualizar.");
        } else {
            $.ajax({        
                url: "index.php?c=Direccion_Controller&a=ActualizarDireccion",          
                method: "POST",
                data: $('#form_ActualizarDireccion').serialize(),
                success: function (data) {
                    $('#form_ActualizarDireccion')[0].reset();
                    console.log("Terminando Registro");
                    console.log("Respuesta del servidor:", data);
                    cargarDirecciones();
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
