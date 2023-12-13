$(document).ready(function () {
    
    $("#bloque_TablaVenta").on("click", ".btn_RestarUnidadServicio, .btn_SumarUnidadServicio, .btn_EliminarServicioCarrito", function() {
        var idDetalleServicio = $(this).val();
  
        $.ajax({
            url: "index.php?c=Venta_Controller&a=EliminarServicioCarrito",  
            method: "POST",  
            data: { idDetalleServicio: idDetalleServicio },
            success: function (response) {

                if (response.mensaje === "Elimardo con exito.") {

                    $("#bloque_TablaVenta table tbody").empty();
            

                    $.each(response.ServicioVenta, function(index, S) {
                        var nuevaFila = `
                            <tr class="tabla_elementos">
                                <th scope="row">${S.contador}</th>
                                <th>${S.id_Servicio}</th>
                                <td>${S.nombre}</td>
                                <td>${S.categoria}</td>
                                <td>${S.cantidad}</td>
                                <td>${S.precio}</td>
                                <td>${S.precio * S.cantidad}</td>
                                <td id="celda_Acciones">
                                    <button class="btn_RestarUnidadServicio" value="${S.id_DetalleServicio}"><img src="Imagenes/Carrito/restar.png" alt="Imagen para restar servicios"></button>
                                    <p id="contadorServicios"></p>
                                    <button class="btn_SumarUnidadServicio" value="${S.id_DetalleServicio}"><img src="Imagenes/Carrito/sumar.png" alt="Imagen para sumar servicios"></button>
                                    <button class="btn_EliminarServicioCarrito" value="${S.id_DetalleServicio}"><img src="Imagenes/Carrito/eliminar.png" alt="Imagen para eliminar un producto"></button>
                                </td>
                            </tr>
                        `;
                      
                        $("#bloque_TablaVenta table tbody").append(nuevaFila);
                    });

                    if (response.ServicioVenta.length === 0) {
                        $("main").empty();

                        $("main").append(`
                            <div id="bloque_CarroVacio">
                            <div>
                                <h3>No tiene productos en su carrito</h3>
                            </div>
                            <div>
                                <img src="Imagenes/Carrito/carro-vacio.png" alt="Carrito Vacío.">
                            </div>
                            </div>

                        `);

                    }
                } else {
                    console.log("No se logró eliminar");
                }
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    });
});