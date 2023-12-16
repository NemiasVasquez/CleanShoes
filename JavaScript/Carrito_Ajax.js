$(document).ready(function () {

    tipoEnvioDireccion();

    function tipoEnvioDireccion(){
        if ($("#selector_TipoDespacho").val() =="NA" ||  $("#selector_TipoDespacho").val() =="Tienda"){
            $("#selectDireccion").hide();
        }else{
            $("#selectDireccion").show();
        };
    }

    $("#selector_TipoDespacho").on("change",function(e){
        tipoEnvioDireccion();
    });
 
    function construirTabla(ServicioVenta) {
        $("#bloque_TablaVenta table tbody").empty();
        
        let $i = 1;
        $.each(ServicioVenta, function(index, S) {
            var nuevaFila = `
                <tr class="tabla_elementos">
                    <th scope="row">${$i}</th>
                    <th>${S.id_Servicio}</th>
                    <td>${S.nombre}</td>
                    <td>${S.categoria}</td>
                    <td>${S.cantidad}</td>
                    <td>S/${S.precio}</td>
                    <td>S/${S.subTotal}</td>
                    <td id="celda_Acciones">
                        <button class="btn_RestarUnidadServicio" value="${S.id_DetalleServicio}"><img src="Imagenes/Carrito/restar.png" alt="Imagen para restar servicios"></button>
                        <p id="contadorServicios"></p>
                        <button class="btn_SumarUnidadServicio" value="${S.id_DetalleServicio}"><img src="Imagenes/Carrito/sumar.png" alt="Imagen para sumar servicios"></button>
                        <button class="btn_EliminarServicioCarrito" value="${S.id_DetalleServicio}"><img src="Imagenes/Carrito/eliminar.png" alt="Imagen para eliminar un producto"></button>
                    </td>
                </tr>
            `;
            $i++;
            $("#bloque_TablaVenta table tbody").append(nuevaFila);
        });
    }

    function CalcularTotales() {
        $.ajax({
            url: "index.php?c=Venta_Controller&a=CalcularTotales",
            method: "POST",
            success: function (totalesResponse) {
                $("#subTotalPago").text("S/" + totalesResponse.subtotal.toFixed(2));
                $("#IGV").text("S/" + totalesResponse.igv.toFixed(2));
                $("#totalPago").text("S/" + totalesResponse.total.toFixed(2));
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX de cálculo de totales:", error);
            }
        });
    }

    CalcularTotales();

    $("#bloque_TablaVenta").on("click", ".btn_EliminarServicioCarrito", function () {
        var idDetalleServicio = $(this).val();

        $.ajax({
            url: "index.php?c=Venta_Controller&a=EliminarServicioCarrito",
            method: "POST",
            data: { idDetalleServicio: idDetalleServicio },
            success: function (response) {
                if (response.mensaje === "Elimardo con exito.") {
                    construirTabla(response.ServicioVenta);
                    CalcularTotales();

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

    $("#bloque_TablaVenta").on("click", ".btn_SumarUnidadServicio", function () {
        var idDetalleServicio = $(this).val();

        $.ajax({
            url: "index.php?c=Venta_Controller&a=SumarDetalleServicio",
            method: "POST",
            data: { idDetalleServicio: idDetalleServicio },
            success: function (response) {
                if (response.mensaje === "Sumado con exito.") {
                    construirTabla(response.ServicioVenta);
                    CalcularTotales();

                   
                } else {
                    console.log("No se logró Sumar");
                }
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    });

    $("#bloque_TablaVenta").on("click", ".btn_RestarUnidadServicio", function () {
        var idDetalleServicio = $(this).val();

        $.ajax({
            url: "index.php?c=Venta_Controller&a=RestarDetalleServicio",
            method: "POST",
            data: { idDetalleServicio: idDetalleServicio },
            success: function (response) {
                if (response.mensaje === "Restado con exito.") {
                    construirTabla(response.ServicioVenta);
                    CalcularTotales();

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
                    console.log("No se logró Restar");
                }
            },
            error: function (error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    });
});
