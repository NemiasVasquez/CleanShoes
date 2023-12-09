$(document).ready(function () {

    const priceMin = document.querySelector("#rango_Minimo");
    const priceMax = document.querySelector("#rango_Maximo");
    const outputMin = document.querySelector("#indicador_Minimo");
    const outputMax = document.querySelector("#indicador_Maximo");

    outputMin.textContent = priceMin.value;
    outputMax.textContent = priceMax.value;

    priceMin.addEventListener("input", function () {
        outputMin.textContent = priceMin.value;
    });

    priceMax.addEventListener("input", function () {
        outputMax.textContent = priceMax.value;
    });

    $('#form_Filtro').on("submit", function (event) {
        event.preventDefault();
        if ($('#rango_Minimo').val() >= $('#rango_Maximo').val()) {
            alert("El precio mínimo no puede ser mayor o igual al precio máximo ");
        } else {
            $.ajax({
                url: "index.php?c=Servicio_Controller&a=FiltrarServicios",
                method: "POST",
                data: $('#form_Filtro').serialize(),
                success: function (data) {
                    console.log("Terminando Registro");
                    console.log("Respuesta del servidor:", data);

                    // Verificar si la respuesta tiene la propiedad "status" y su valor es "success"
                    if (data.status === "success") {
                        // Limpiar el contenido actual de los servicios
                        $("#contenido_Servicios").empty();

                        // Iterar sobre las categorías y servicios para construir el HTML
                        $.each(data.data, function (categoria, servicios) {
                            // Agregar el título de la categoría
                            $("#contenido_Servicios").append('<div class="bloque_Titulo_Seccion"><h2>' + categoria + ':</h2></div>');

                            // Agregar los servicios de la categoría
                            $.each(servicios, function (index, servicio) {
                                // Construir la caja del servicio con la información del servicio
                                var servicioHTML = '<div class="caja-servicio">' +
                                    '<div class="cajita-tituloLavado"><h2>' + servicio.nombre + '</h2></div>' +
                                    '<div class="cajitainfo-lavado">' +
                                    '<div class="cajita-precio"><h2>s/' + servicio.precio + '.00</h2></div>' +
                                    '<div class="cajita-descripcion">' +
                                    '<p>' + servicio.tiempo_estimado_entrega + ' días hábiles</p>' +
                                    '<br>' +
                                    '<p> ----------------------------- </p>' +
                                    '<br>' +
                                    '<p>' + servicio.descripcion_Simple + '</p>' +
                                    '<ul>';

                                // Agregar la lista de descripciones
                                $.each(servicio.Descripcion, function (i, descripcion) {
                                    servicioHTML += '<li>' + descripcion.nombre + '</li>';
                                });

                                // Continuar con la construcción del servicioHTML
                                servicioHTML += '</ul>' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="cajita-reservarServicio"><a href=""><h2>Reservar <br> Servicio</h2></a></div>' +
                                    '</div>';

                                // Agregar el servicio al contenido
                                $("#contenido_Servicios").append(servicioHTML);
                            });
                        });
                    } else {
                        // Mostrar algún mensaje de error si la respuesta no es exitosa
                        console.error("Error en la respuesta del servidor:", data);
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
