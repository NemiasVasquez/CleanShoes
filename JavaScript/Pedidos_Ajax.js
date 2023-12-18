$(document).ready(function(){
   
    $("#form_Buscar").on("submit",function(event){
        event.preventDefault();
        var estadoPedido=$("#select_TipoPedido").val();
        $.ajax({
            url:"index.php?c=Venta_Controller&a=FiltrarPedidos",
            method:"POST",
            data:$('#form_Buscar').serialize(),
            success:function(data){
                console.log(data);
                if(data.Pedidos != false){
                    $("#contenedorPedidos").html(data);
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
    

});