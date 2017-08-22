// JavaScript Document
var $body = $("body");
var base_url = $("#base_url").attr("class");



function loadActions(id, fecha, aDen, aRFX, aCop, sha_pdf, estado) {

    var actions = "";

    //Ver acta
    actions += "<a href='#' class='btn-accion btn btn-success view btn-xs' data-i='" + id + "'><i class='fa fa-eye'></i></a>";

    //Imprimir Acta
    actions += "<a target='_blank' href='#' class='btn-accion btn btn-default disabled btn-xs'><i class='fa fa-print'></i></a>";

    return actions;
}


function loadBarras(idActa) {

    var result = "";
    var html = "";

    $.ajax({
        url: base_url + "compras/loadBarras",
        data: { id: idActa },
        type: 'post',
        dataType: 'json',
        async: false,
        success: function(data) {

            if (data.length > 0) {

                $.each(data, function(i, value) {

                    html += "<tr>" +
                        "<td>" + value.barra + "</td>" +
                        "<td>" + value.peso + "</td>" +
                        "<td>" + value.pesohumedo + "</td>" +
                        "</tr>";
                });

            } else {

                html += "No hay informacion disponible";
            }
        },
        complete: function(data) {
            console.log(data);
        },
        error: function(data) {
            console.log(data);
        }
    });

    return html;
}


function loadActa(idActa) {

    var result = "";

    $.ajax({
        url: base_url + "compras/loadActa",
        data: { id: idActa },
        type: 'post',
        dataType: 'json',
        async: false,
        success: function(data) {

            result = data;
        },
        complete: function(data) {
            console.log(data);
        },
        error: function(data) {
            console.log(data);
        }
    });

    return result;
}



function clear() {

    $("#myModal form").attr("id", "");
    $("#myModalLabel").find("*").remove();
    $(".modal-body").find("*").remove();
    $(".modal-footer").find("*").remove();
}


$(document).ready(function() {

    $('#example').dataTable();


    $("body").on("click", ".view", function() {

        //Analisis por Densidad    
        clear();

        id = $(this).attr("data-i");
        barras = "";
        acta = loadActa(id);
        barras = loadBarras(id);

        //content   
        title = "Visualizacion del acta";
        html = '<div class="container">' +
            '<div class="row">' +
            '<div class="col-xs-12">' +
            '<div class="text-center">' +
            '<i class="fa fa-hash pull-left icon"></i>' +
            '<h2>Acta de registro de material #' + acta.id + '</h2>' +
            '</div>' +
            '<hr>' +
            '<div class="row">' +

            '<div class="col-xs-12 col-md-6 col-lg-6 pull-right">' +
            '<div class="panel panel-default height">' +
            ' <div class="panel-heading">Información del Acta</div>' +
            '<div class="panel-body">' +
            '<strong>Sucursal: ' + acta.sucursal + '</strong><br>' +
            '<strong>Tercero: ' + acta.nombre_completo + '</strong><br>' +
            '<span>Fecha Recepción: ' + acta.fechaA + '</span><br>' +
            '<span>Usuario: ' + acta.Usuario + '</span><br>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="row">' +
            '<div class="col-md-12">' +
            '<div class="panel panel-default">' +
            '<div class="panel-heading">' +
            '<h3 class="text-center"><strong>Detalle del Acta</strong></h3>' +
            ' </div>' +
            '<div class="panel-body">' +
            ' <div class="table-responsive">' +
            ' <table class="table table-condensed table-hover table-stripped">' +
            '<thead>' +
            '<tr>' +
            '<td><strong>Barra</strong></td>' +
            '<td class="text-center"><strong>Peso bruto</strong></td>' +
            '<td class="text-center"><strong>Peso Humeno</strong></td>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +

            barras

            '</tbody>' +
            '</table>' +
            '</div>' +
            '</div>' +

            ' </div>' +
            '</div>' +
            '</div>' +
            '</div>';

        //Transform
        $("#myModal .modal-dialog").addClass("modal-lg");
        $("#myModal form").attr("id", "saveAnalisis");
        $("#myModalLabel").text(title);
        $(".modal-body").html(html);
        //$(".modal-footer").append(foot);

        $("#myModal").modal("show");
    });



});