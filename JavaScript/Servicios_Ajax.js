$(document).ready(function () {
    const priceMin = $("#rango_Minimo");
    const priceMax = $("#rango_Maximo");
    const outputMin = $("#indicador_Minimo");
    const outputMax = $("#indicador_Maximo");

    outputMin.text(priceMin.val());
    outputMax.text(priceMax.val());

    priceMin.on("input", function () {
        outputMin.text(priceMin.val());
    });

    priceMax.on("input", function () {
        outputMax.text(priceMax.val());
    });

    $("#form_Filtro").on("submit", function (event) {
        event.preventDefault();

        const minPrice = parseFloat(priceMin.val());
        const maxPrice = parseFloat(priceMax.val());

        if (minPrice >= maxPrice) {
            alert("El precio mínimo no puede ser mayor o igual al precio máximo ");
        } else {
            $.ajax({
                url: "index.php?c=Servicio_Controller&a=FiltrarServicios",
                method: "POST",
                data: $(this).serialize(),
                success: function (data) {
                    console.log("Terminando Registro");
                    console.log(data);
                    if (data && data.status === "success" && data.data) {
                        const contenidoServicios = $("#contenido_Servicios");
                        contenidoServicios.empty();

                        $.each(data.data, function (categoria, servicios) {
                            console.log("INICIO " + categoria);

                            if (Array.isArray(servicios) && servicios.length > 0) {
                                const titulo = categoria === "Principal" ? "Servicios Principales" : categoria === "Promocion" ? "Promociones" : "Servicios Adicionales";
                                contenidoServicios.append('<div class="bloque_Titulo_Seccion"><h2>' + titulo + ':</h2></div>');

                                const categoriaClass = categoria === "Principal" ? "cajitainfo-lavado" : categoria === "Promocion" ? "cajitainfo-lavado" : "cajitainfo-Servicio_Adicional";
                                const bloqueServicios = $('<div class="bloque_Servicios"></div>');

                                $.each(servicios, function (index, servicio) {
                                    agregarServicioAlHTML(bloqueServicios, servicio, categoria, categoriaClass);
                                });

                                contenidoServicios.append(bloqueServicios);
                            } else {
                                console.error("La propiedad 'data." + categoria + "' no es un array o está vacía.");
                            }
                        });
                    } else {
                        console.error("La respuesta del servidor no es válida:", data);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud Ajax:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);
                },
            });
        }
    });

    function agregarServicioAlHTML(contenedor, servicio, categoria, categoriaClass) {
        const servicioHTML = $('<div class="caja-servicio"></div>');
        servicioHTML.append('<div class="cajita-tituloLavado"><h2>' + (categoria === "Principal" ? servicio.nombre : categoria === "Promocion" ? servicio.nombre : "Servicio Adicional") + '</h2></div>');

        console.log("Servicio insertado: ", JSON.stringify(servicio, null, 2));

        if (categoriaClass) {
            const categoriaDiv = $('<div class="' + categoriaClass + '"></div>');

            if (categoria === "Adicional") {
                categoriaDiv.append('<div class="cajita-nombre"><h2>' + servicio.nombre + '</h2></div>');
            }

            if (categoria === "Principal" || categoria === "Promocion") {
                categoriaDiv.append('<div class="cajita-precio"><h2>s/' + servicio.precio + '.00</h2></div><div class="cajita-descripcion"></div>');
            }

            if (categoria === "Adicional") {
                categoriaDiv.append('<div class="cajita-descripcion"></div>');
            }

            if (servicio.tiempo_estimado_entrega !== null) {
                categoriaDiv.find(".cajita-descripcion").append('<p>' + servicio.tiempo_estimado_entrega + ' días hábiles</p><br><p> -----------------------------</p><br>');
            }

            if (servicio.descripcion_Simple !== null) {
                categoriaDiv.find(".cajita-descripcion").append('<p>' + servicio.descripcion_Simple + '</p>');
            }

            if (servicio.Descripcion && servicio.Descripcion.length > 0) {
                const lista = $('<ul></ul>');
                $.each(servicio.Descripcion, function (i, descripcion) {
                    lista.append('<li>' + descripcion.nombre + '</li>');
                });
                categoriaDiv.find(".cajita-descripcion").append(lista);
            }

            if (categoria === "Adicional") {
                categoriaDiv.append('<div class="cajita-precio_Servicio_Adicional"><h2>s/' + servicio.precio + '.00</h2></div>');
            }

            servicioHTML.append(categoriaDiv);
        }

        servicioHTML.append(`<div class="cajita-reservarServicio"><button class="btn-reservar-servicio"  type="button" value="${servicio.id_Servicio} id="${servicio.id_Servicio}"><h2>Reservar <br> Servicio</h2></button></div>`);
        contenedor.append(servicioHTML);
    }

    $(document).on('click', '.btn-reservar-servicio', function () {
        console.log('Clic en el botón de reservar servicio');
        var idServicio = $(this).val();

        $.ajax({
            url: 'index.php?c=Venta_Controller&a=AgregarServicio',
            type: 'POST',
            dataType: 'json',
            data: { idServicio: idServicio },
            success: function (response) {
                alert(response.mensaje);
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud AJAX:', status, error);
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        });
    });

});
