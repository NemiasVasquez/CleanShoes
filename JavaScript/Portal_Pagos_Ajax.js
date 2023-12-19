$(document).ready(function(event){
    console.log("INCIANDO");
    
    $("#bloque_TarjetaDebito").hide();
    $("#bloque_Yape").hide();

    $("#select_TipoPago").on("change",function(event){
        if($("#select_TipoPago").val() == "NA"){
            $("#bloque_TarjetaDebito").hide();
            $("#bloque_Yape").hide();
        }else if($("#select_TipoPago").val() == "Tarjeta de débito"){
            $("#bloque_TarjetaDebito").show();
            $("#bloque_Yape").hide();
        }else if($("#select_TipoPago").val() == "Yape"){
            $("#bloque_TarjetaDebito").hide();
            $("#bloque_Yape").show();
        }
    });

    $("#form_Pago").on("submit", function(event){
        event.preventDefault();
        var regexNumeroTarjeta = /^(\d{4}-){3}\d{4}$/;
        var regexFechaTarjeta = /^(0[1-9]|1[0-2])\/\d{2}$/;
        var regexCsvTarjeta = /^\d{3}$/;
        var regexCodigoOperacion = /^\d{6}$/;

        var id_Orden = $("#btn_Pagar").val();
        console.log(id_Orden);
        
        if ($("#select_TipoPago").val() == "NA") {
            alert("Debe seleccionar un tipo de pago.");
        } else if ($("#select_TipoPago").val() == "Tarjeta de débito") {
            if (!regexNumeroTarjeta.test($("#numeroDebito").val())) {
                alert("Número de tarjeta no válido.");
            } else if (!regexFechaTarjeta.test($("#fechaDebito").val())) {
                alert("Fecha de vencimiento no válida.");
            } else if (!regexCsvTarjeta.test($("#csvDebito").val())) {
                alert("Código de seguridad no válido.");
            } else if ($("#nombreDebito").val() == "") {
                alert("Debe ingresar el nombre de la tarjeta.");
            } else if ($("#apellidosDebito").val() == "") {
                alert("Debe ingresar sus apellidos.");
            }else{
                $.ajax({
                    url:"index.php?c=Venta_Controller&a=Pagar",
                    method:"POST",
                    data:$("#form_Pago").serialize()+ "&id_Orden=" + id_Orden,
                    success:function(data){
                        alert(data.mensaje);
                        window.location.href = "index.php?&c=Venta_Controller&a=Pedidos_Views";
                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud Ajax:", status, error);
                        console.log("Respuesta del servidor:", xhr.responseText);
                    }
                });
            }
        } else if ($("#select_TipoPago").val() == "Yape") {
            if ($("#codigoPago_Yape").val() == "") {
                alert("Debe ingresar un número de operación.")
            }else if(!regexCodigoOperacion.test($("#codigoPago_Yape").val())){
                alert("Formato de código de operación no es correcto.");
            }else{
                $.ajax({
                    url:"index.php?c=Venta_Controller&a=Pagar",
                    method:"POST",
                    data:$("#form_Pago").serialize()+ "&id_Orden=" + id_Orden,
                    success:function(data){
                        alert(data.mensaje);
                        window.location.href = "index.php?&c=Venta_Controller&a=Pedidos_Views";
                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud Ajax:", status, error);
                        console.log("Respuesta del servidor:", xhr.responseText);
                    }
                });
            }
        }
        
    });
    
});