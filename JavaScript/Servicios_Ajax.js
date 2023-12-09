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

                    // Verificar si la respuesta es un objeto válido con la propiedad 'status'
                    if (data && data.status === 'success' && data.data) {
                        // Limpiar el contenido actual de los servicios
                        $("#contenido_Servicios").empty();

                        // Iterar sobre las categorías y servicios para construir el HTML
                        $.each(data.data, function(categoria, servicios) {
                            // Verificar si servicios es un array
                            if (Array.isArray(servicios)) {
                                // Filtrar servicios por categoría
                                var serviciosFiltrados = servicios.filter(function(servicio) {
                                    return servicio.categoria === categoria;
                                });
                                var datosFiltrados = serviciosFiltrados;
                                console.log("filtrados por : ",categoria,"Servicios filtrados ",JSON.stringify(datosFiltrados,null,2));
                                // Verificar si hay servicios para la categoría actual
                                if (datosFiltrados.length > 0) {

                                    // Agregar el título de la categoría
                                    var titulo = categoria === 'Principal' ? 'Servicios Principales' : 'Servicios Adicionales';
                                    $("#contenido_Servicios").append('<div class="bloque_Titulo_Seccion"><h2>' +  titulo + ':</h2></div>');
    
                                    // Agregar el bloque_Servicios para la categoría
                                    var categoriaClass = categoria === 'Principal' ? 'cajitainfo-lavado' : 'cajitainfo-Servicio_Adicional';
                                    $("#contenido_Servicios").append('<div class="bloque_Servicios">');
    
                                  
                                    // Iterar sobre los servicios de la categoría
                                    $.each(datosFiltrados, function(index, servicio) {
                                        
                                        agregarServicioAlHTML(servicio, categoria, categoriaClass);
                                    });
    
                                    // Cerrar el bloque_Servicios
                                    $("#contenido_Servicios").append('</div>');
                                }    
                            } else {
                                console.error("La propiedad 'data." + categoria + "' no es un array.");
                            }
                        });
                    } else {
                        console.error("La respuesta del servidor no es válida:", data);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud Ajax:", status, error);
                    console.log("Respuesta del servidor:", xhr.responseText);
                }
            });
        }
    });

    function agregarServicioAlHTML(servicio, categoria, categoriaClass) {

        console.log("Servicio que será añadido" + JSON.stringify(servicio,null,2));
        // Construir la caja del servicio con la información del servicio
        var servicioHTML = '<div class="caja-servicio">';
        servicioHTML += '<div class="cajita-tituloLavado"><h2>' + (categoria === 'Principal' ? servicio.nombre : 'Servicio Adicional') + '</h2></div>';

        if (categoriaClass) {
            servicioHTML += '<div class="' + categoriaClass + '">';

            // Agregar el nombre para servicios adicionales
            if (categoria === 'Adicional') {
                servicioHTML += '<div class="cajita-nombre"><h2>' + servicio.nombre + '</h2></div>';
            }
            if(categoria=="Principal"){
                servicioHTML += '<div class="cajita-precio"><h2>s/' + servicio.precio + '.00</h2></div>' +
                '<div class="cajita-descripcion">';
            }
       
            // Verificar y agregar tiempo_estimado_entrega si no es null
            if (servicio.tiempo_estimado_entrega !== null) {
                servicioHTML += '<p>' + servicio.tiempo_estimado_entrega + ' días hábiles</p>' +
                    
                    '<p> ----------------------------- </p>';
            }

            // Verificar si hay descripciones disponibles
            if (servicio.Descripcion && servicio.Descripcion.length > 0) {

                servicioHTML += '<p>' + (servicio.descripcion_Simple !== null ? servicio.descripcion_Simple : '') + '</p>' +
                    '<ul>';

                // Agregar la lista de descripciones
                $.each(servicio.Descripcion, function(i, descripcion) {
                    servicioHTML += '<li>' + descripcion.nombre + '</li>';
                });

                servicioHTML += '</ul>';
            } else {

                servicioHTML += '<div class="cajita-descripcion"><p>' + (servicio.descripcion_Simple !== null ? servicio.descripcion_Simple : '') + '</p></div>';
            }

            if(categoria=="Adicional"){
                servicioHTML += '<div class="cajita-precio_Servicio_Adicional"><h2>s/' + servicio.precio + '.00</h2></div>' +
                '<div class="cajita-descripcion">';
            }
            // Continuar con la construcción del servicioHTML
            servicioHTML += '</div>';
            servicioHTML += '</div>';
        }

        servicioHTML += '<div class="cajita-reservarServicio"><a href=""><h2>Reservar <br> Servicio</h2></a></div>';
        servicioHTML += '</div>';
        console.log("Fin de añadir");
        // Agregar el servicio al contenido
        $("#contenido_Servicios .bloque_Servicios").append(servicioHTML);
    }
});
