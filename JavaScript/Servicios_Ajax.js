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
        if ($('#rango_Minimo').val()>= $('#rango_Maximo').val()) {
            alert("El precio mínimo no puede ser mayor o igual al precio máximo ");
        }else{
            $.ajax({        
                url: "",          
                method: "POST",
                data: $('#form_Login').serialize(),
                success: function (data) {
                    $('#form_Login')[0].reset();
                    console.log("Terminando Registro");
                    console.log("Respuesta del servidor:", data);
                    // Si el inicio de sesión es exitoso, redirige a index.php
                    if (data.mensaje == "Inicio de sesion exitoso.") {
                        console.log("Redirigiendo");
                        window.location.href = "index.php?";
                    }else{
                        
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
