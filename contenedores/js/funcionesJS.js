//FUNCION QUE CALCULA LA MEDIA DE UN CONTENEDOR ELEGIGO POR LA MAÑANA 10:00:04
function calculaMedia() {
    var idContenedor = document.getElementById("contenedor").value;
    var media = 0;
    var cont = 0;
    for (var i in contenedores) {
        for (var j in medidas) {
            if (contenedores[i].device === medidas[j].device && contenedores[i].device === idContenedor) {
                var fechaYhora = medidas[j].date.split("T");
                var hora = fechaYhora[1].substring(0, 8);
                if (hora === "10:00:04") {
                    cont++;
                    media += medidas[j].measure_porcentage;
                }
            }
        }
    }
    if ($("#contenedor").val() === "") {
        $('#texto').empty();
        $('#media').empty();
    }
    else {
        $('#media').empty();
        jQuery('#media').append('<p><strong></strong></p>');
        jQuery('#media').append("<input type='text' size='1'  class='form-control' value=" + media / cont + "  name='valorMedia' readonly>");

        $('#texto').empty();
        jQuery('#texto').append('Media mensual del contenedor elegido por la mañana a la 10:00:04');
    }
}
//FUNCION QUE ENVIO EL FORMULARIO PARA CREO EL ARCHIVO EXCEL
$(document).ready(function () {
    $(".botonExcel").click(function (event) {
        $("#datos_a_enviar").val($("<div>").append($("#tablaContenedores").eq(0).clone()).html());
        $("#FormularioExportacion").submit();
    });
});

//FUNCION QUE LLAMA A LA FUNCION genera_tabla SI CAMBIAN ALGUN CAMPO SELECT
$(document).ready(function () {
    $('select[id=hora],select[id=contenedor]').on('change', function () {
        genera_tabla();
    });
});

//FUNCION QUE VACIA LA TABLA
function borraTabla() {
    var tabla = document.getElementById("tablaContenedores");
    var numFilasTabla = document.getElementById("tablaContenedores").rows.length;
    if (numFilasTabla > 1) {
        for (var x = numFilasTabla - 1; x > 0; x--) {
            tabla.deleteRow(x);
        }
    }
}
//FUNCION QUE GENERA LA TABLA
function genera_tabla() {
    borraTabla();
    if ($('#contenedor').val() !== "" && $('#hora').val()) {

        var resultados = 0;
        var tabla = document.getElementById("tablaContenedores");

        var idContenedor = document.getElementById("contenedor").value;
        var horaObj = document.getElementById("hora").value;

        for (var i in contenedores) {
            for (var j in medidas) {
                if (contenedores[i].device === medidas[j].device && contenedores[i].device === idContenedor) {

                    var fechaYhora = medidas[j].date.split("T");
                    var hora = fechaYhora[1].substring(0, 8);

                    if (hora === horaObj) {
                        resultados++;
                        var row = tabla.insertRow(1);
                        row.setAttribute("class", "warning");
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);

                        cell1.innerHTML = "<h4 class='text-center'>" + medidas[j].measure + "</h4>";
                        cell2.innerHTML = "<h4 class='text-center'>" + medidas[j].measure_porcentage + "</h4>";
                        cell3.innerHTML = "<h4 class='text-center'>" + medidas[j].temperature + "</h4>";
                        cell4.innerHTML = "<h4 class='text-center'>" + medidas[j].battery_one + "</h4>";
                    }
                }
            }
        }
    }
}
