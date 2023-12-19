$(document).ready(function(){
   
    $("#form_Buscar").on("submit",function(event){
        event.preventDefault();
        
        $.ajax({
            url:"index.php?c=Venta_Controller&a=FiltrarPedidosPendientes",
            method:"POST",
            data:$('#form_Buscar').serialize(),
            success:function(data){
                console.log(data);
                if(data.Pedidos != false){
                    construirPedidos(data);
                }else{
                    alert("No tienes pedidos con ese estado.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
            }
        });
        
    });

    $("#contenedorPedidos").on("click",".btn_Rechazar", function () {
        var idOrden = $(this).val();
        console.log(idOrden);
        $.ajax({
            url: "index.php?c=Venta_Controller&a=RechazarPedido",
            method: "POST",
            data: { idOrden: idOrden },
            success: function (data) {
                console.log(data.mensaje);
                alert(data.mensaje);
                construirPedidos(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
            }
        });
    });

    $("#contenedorPedidos").on("click",".btn_Aceptar", function () {
        var idOrden = $(this).val();
        console.log(idOrden);
        $.ajax({
            url: "index.php?c=Venta_Controller&a=AceptarPedido",
            method: "POST",
            data: { idOrden: idOrden },
            success: function (data) {
                console.log(data.mensaje);
                alert(data.mensaje);
                construirPedidos(data);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
            }
        });
    });
 
    function construirPedidos(data) {
        var contenedorPedidos = document.getElementById('contenedorPedidos');
        contenedorPedidos.innerHTML = ''; 

        data.Pedidos.forEach(function (P) {
            var bloquePedido = document.createElement('div');
            bloquePedido.className = 'bloque_Pedido';

            var bloqueBarraLateral = document.createElement('div');
            bloqueBarraLateral.className = 'bloque_Barra_Lateral';

            var seccion1 = document.createElement('div');
            seccion1.className = 'seccion1';

            var seccion1Parte1 = document.createElement('div');
            seccion1Parte1.className = 'seccion1_parte1';
            seccion1Parte1.innerHTML = '<p>Orden: ' + P.id_Orden + '</p>' +
                                        '<p>' + P.estado_orden + '</p>'+
                                        '<p>Total: S/. ' + P.total + '</p>';

            var seccion1Parte7 = document.createElement('div');
            seccion1Parte7.className='seccion1_parte1';
            seccion1Parte7.innerHTML=' <p> '+ P.nombres + ' ' + P.apellidos + ' </p>'+
                                     '<p>'+P.dni +'</p>'   ; 

            var seccion1Parte2 = document.createElement('div');
            seccion1Parte2.className = 'seccion1_parte1';
            seccion1Parte2.innerHTML = '<p>Despacho: ' + P.tipoDespacho + '</p>' +
                                        '<p>' + P.fecha_creacion.substring(0,10) + '</p>';
                                      

            var seccion1Parte3 = document.createElement('div');
            seccion1Parte3.className = 'seccion1_parte1';
            if (P.Direccion !== undefined) {
                seccion1Parte3.innerHTML = '<p>Envío: ' + P.Direccion + ' - ' + P.Distrito + '</p>';
            }

            if (P.tipoPago !== undefined) {
                var seccion1Parte4 = document.createElement('div');
                seccion1Parte4.className = 'seccion1_parte1';
                seccion1Parte4.innerHTML = '<p>' + P.tipoPago + '</p>' +
                                          '<p>'+'Estado de pago: ' + P.estado_pago + '</p>';

                if(P.tiempoTotalEntrega != undefined){
                    var seccion1Parte5 = document.createElement('div');
                    seccion1Parte5.className = 'seccion1_parte1';
                    seccion1Parte5.innerHTML = '<p>' + P.tiempoTotalEntrega + '</p>';
                }
              
            }

            var seccion1Parte6 = document.createElement('div');
            seccion1Parte6.className = 'seccion1_parte1';
            
            seccion1Parte6.innerHTML =
            '<button class="btn_Rechazar" value="' + P.id_Orden + '">Rechazar</button>'+
        
            '<button class="btn_Aceptar" value="' + P.id_Orden + '">Aceptar</button>';
            
            var seccion1Parte8 = document.createElement('div');
            seccion1Parte8.className = 'seccion1_parte1';
            seccion1Parte8.innerHTML ='<p>'+'Pago: '+P.estado_pago +'</p>';
            
            seccion1.appendChild(seccion1Parte1);
            seccion1.appendChild(seccion1Parte7);
            seccion1.appendChild(seccion1Parte2);
            seccion1.appendChild(seccion1Parte3);
            if (P.tipoPago != undefined && P.estado_orden != "Rechazado") {
                seccion1.appendChild(seccion1Parte4);
                if(P.tiempoTotalEntrega != undefined){
                    seccion1.appendChild(seccion1Parte5);
                }
                
            }

            if(P.estado_orden == "Pendiente") {
                seccion1.appendChild(seccion1Parte6);
            }

            if(P.estado_orden =="Aceptado"){
                seccion1.appendChild(seccion1Parte8);
            }

            bloqueBarraLateral.appendChild(seccion1);

            var bloqueDetallePedido = document.createElement('div');
            bloqueDetallePedido.className = 'bloque_DetallePedido';

            var tituloPedido = document.createElement('div');
            tituloPedido.innerHTML=`<h3>Detalle del pedido:</h3>`;

            var detalleTabla = document.createElement('table');
            detalleTabla.className = 'tabla_Servicios';
            var cabeceraTabla = document.createElement('thead');
            cabeceraTabla.innerHTML = '<tr class="cabecera">' +
                                     '<th>#</th>' +
                                     '<th>NOMBRE</th>' +
                                     '<th>CATEGORIA</th>' +
                                     '<th>PRECIO</th>' +
                                     '<th>CANT.</th>' +
                                     '<th>SUBTOTAL</th>' +
                                     '</tr>';

            var cuerpoTabla = document.createElement('tbody');
            P.Servicios.forEach(function (S, index) {
                var fila = document.createElement('tr');
                fila.innerHTML = '<td>' + (index + 1) + '</td>' +
                                 '<td>' + S.nombre + '</td>' +
                                 '<td>' + S.categoria + '</td>' +
                                 '<td>S/.' + S.precio + '</td>' +
                                 '<td>' + S.cantidad + '</td>' +
                                 '<td>S/.' + S.subTotal + '</td>';
                cuerpoTabla.appendChild(fila);
            });

            bloqueDetallePedido.appendChild(tituloPedido);

            detalleTabla.appendChild(cabeceraTabla);
            detalleTabla.appendChild(cuerpoTabla);

            bloqueDetallePedido.appendChild(detalleTabla);

            bloquePedido.appendChild(bloqueBarraLateral);
            bloquePedido.appendChild(bloqueDetallePedido);

            contenedorPedidos.appendChild(bloquePedido);
        });
    } 
    
});