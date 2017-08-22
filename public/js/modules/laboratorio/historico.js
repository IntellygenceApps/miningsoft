// JavaScript Document
//var $body = $("body");
var base_url = $("#base_url").attr("class");


function loadActions(id, fecha, aDen, aRFX, aCop, sha_pdf, estado) {

    var actions = "";

    //Ver acta
    actions += "<a href='#' class='btn-accion btn btn-success view btn-xs' data-i='" + id + "'><i class='fa fa-eye'></i></a>";

    //Imprimir Acta
    if (fecha != "0000-00-00 00:00:00") {

        actions += "<a target='_blank' href='" + base_url + "laboratorio/printPDF/" + sha_pdf + "' class='btn-accion btn btn-default print btn-xs' data-i='" + id + "'><i class='fa fa-print'></i></a>";

    } else {

        actions += "<a target='_blank' href='#' class='btn-accion btn btn-default disabled btn-xs'><i class='fa fa-print'></i></a>";
    }

    return actions;
}

function reloadData() {

    $('#example').dataTable().fnDestroy();
    var actions;
    var table = $('#example').DataTable({

        autoWidth: false,
        searching: true,
        bProcessing: true,
        paging: true,
        fixedHeader: true,
        responsive: true,
        scrollX: true,
        processing: true,
        serverSide: false,
        ajax: {
            method: "POST",
            async: false,
            url: base_url + "laboratorio/reloadDataHistory/",
            beforeSend: function() {
                //waitingDialog.show("Cargando...");
            },
            complete: function() {
                //waitingDialog.hide();
            }
        },
        columns: [
            { "data": "id" },
            { "data": "fecha" },
            { "data": "lugar" },
            { "data": "nombre" },
            { "data": "Usuario" },
            { "data": "sucursal" },
            { "data": "sucursal" },
        ],
        createdRow: function(row, data, index) {

            //$('td', row).addClass('center');
            $('td', row).eq(0).html('<i class="fa fa-hash"></i> ' + data.id);
            $('td', row).eq(1).html('<i class="fa fa-calendar"></i> ' + data.fecha.substr(0, 10));
            $('td', row).eq(2).html('<i class="fa fa-home"></i> ' + data.lugar);
            $('td', row).eq(3).html('<i class="fa fa-group"></i> ' + data.nombre);
            $('td', row).eq(4).html('<i class="fa fa-user"></i> ' + data.Usuario);
            $('td', row).eq(5).html('<i class="fa fa-university"></i> ' + data.sucursal);
        },
        rowCallback: function(row, data, index) {

            $('td:eq(6)', row).html(loadActions(data.id, data.fechaRecepcion, data.cantDensidad, data.cantRfx, data.cantCopela, data.sha_pdf, data.estado, data.peso));
        }
    });

    table.columns.adjust().draw();
}


function saveDatadata(data, action) {

    $.ajax({
        url: "laboratorio/" + action,
        data: data,
        type: 'post',
        dataType: 'json',
        success: function(data) {
            loadMessage(data.type, data.mns);
            $('#myModal').modal('hide');
            reloadData();
        },
        complete: function(data) {
            console.log(data);
            $('#myModal').modal('hide');
        },
        error: function(data) {
            console.log(data);
            $('#myModal').modal('hide');
        }
    });
}

function loadBarras(idActa) {

    var result = "";

    $.ajax({
        url: "laboratorio/loadBarras",
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


function constructAnalisis(type, data) {

    var html = "";

    switch (type) {
        case "Densidad":

            html += "<b>Res Den: </b> " + data.res_den;
            html += "<b> Densidad: </b> " + data.densidad;
            html += "<b> Ley Den: </b> " + data.ley_den;
            html += "<b> Finos Den: </b> " + data.finos_den;

            break;
        case "RFX":
            html += "<b>Ley RX: </b> " + data.ley_rx;
            html += "<b> Finos RX: </b> " + data.finos_rx;
            break;

        case "Copelacion":
            html += "<b>Ley AU: </b> " + data.ley_au;
            html += "<b> Ley AG: </b> " + data.ley_ag;
            html += "<b> Ley Copela: </b> " + data.ley_copela;
            html += "<b> Finos AU: </b> " + data.finos_au;
            html += "<b> Finos AG: </b> " + data.finos_ag;
            break;
    }

    return html;
}


function loadAnalisis(idActa) {

    var result = "";
    var html = "";

    $.ajax({
        url: "laboratorio/loadAnalisis",
        data: { id: idActa },
        type: 'post',
        dataType: 'json',
        async: false,
        success: function(data) {

            if (data.length > 0) {

                $.each(data, function(i, value) {

                    html += "<tr>" +
                        "<td>" + value.id + "</td>" +
                        "<td>" + value.barra + "</td>" +
                        "<td>" + value.peso + "</td>" +
                        "<td>" + value.peso_humedo + "</td>" +
                        "<td>" + value.tipo + "</td>" +
                        "<td>" + constructAnalisis(value.tipo, value) + "</td>" +
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
        url: "laboratorio/loadActa",
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

    reloadData();

    /* Actions
         1. receiveMaterial
         2. aDen
         3. aRFX
         4. aCop
         5. Finish
         6. Delete
    */

    //Recibir Material
    $("body").on("click", ".receive", function() {

        //Recibir Material
        clear();

        id = $(this).attr("data-i");
        //content            
        title = "Recepción de material";
        html = "<p>¿Confirma la recepcion del material?</p>";
        html += "<input type='hidden' name='id' value='" + id + "' required>";
        //footer
        foot = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
        foot += '<button type="submit" class="btn btn-primary" id="receiveMaterial" data-i="' + id + '">Guardar Cambios</button>';
        //Transform
        $("#myModal form").attr("id", "receiveMaterial");
        $("#myModalLabel").text(title);
        $(".modal-body").append(html);
        $(".modal-footer").append(foot);

        $("#myModal").modal("show");
    });


    $("body").on("click", ".aDen", function() {

        //Analisis por Densidad    
        clear();

        id = $(this).attr("data-i");
        barras = "";
        barras = loadBarras(id);

        title = "Analisis por Densidad";

        //content            
        html = "<fieldset>";
        html += "<legend>Ingresar peso humedo</legend>";
        html += "<input type='hidden' name='anType' value='D' required>";
        html += "<input type='hidden' name='id' value='" + id + "' required>";

        html += '<table class="table table-hover table-bordered table-striped table-condensed responsive-utilities jambo_table">';
        html += '    <thead>';
        html += '       <tr>';
        html += '          <th>Barra</th>';
        html += '          <th>Peso Bruto</th>';
        html += '          <th>Peso Humedo</th>';
        html += '       </tr>';
        html += '    </thead>';
        html += '    <tbody>';

        $.each(barras, function(i, value) {

            html += ' <tr>';
            html += '   <td><input type="hidden" name="idBarra[]" value="' + value.idBarra + '">' + value.descripcion + '</td>';
            html += '   <td><input class="form-control" type="number" readonly name="peso[]" step="any" value="' + value.peso + '"></td>';
            html += '   <td><input class="form-control" type="number" required name="peso_humedo[]" step="any" value=""></td>';
            html += ' </tr>';
        })

        html += '    </tbody>';
        html += '</table>';

        html += "</fieldset>";

        //footer
        foot = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
        foot += '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';

        //Transform
        $("#myModal form").attr("id", "saveAnalisis");
        $("#myModalLabel").text(title);
        $(".modal-body").append(html);
        $(".modal-footer").append(foot);

        $("#myModal").modal("show");
    });


    $("body").on("click", ".aRFX", function() {

        //Analisis por Densidad    
        clear();

        id = $(this).attr("data-i");
        barras = "";
        barras = loadBarras(id);

        title = "Analisis por RFX";

        //content            
        html = "<fieldset>";
        html += "<legend>Ingresar ley</legend>";
        html += "<input type='hidden' name='anType' value='RFX' required>";
        html += "<input type='hidden' name='id' value='" + id + "' required>";

        html += '<table class="table table-hover table-bordered table-striped table-condensed responsive-utilities jambo_table">';
        html += '    <thead>';
        html += '       <tr>';
        html += '          <th>Barra</th>';
        html += '          <th>Peso Bruto</th>';
        html += '          <th>Ley por RFX</th>';
        html += '       </tr>';
        html += '    </thead>';
        html += '    <tbody>';

        $.each(barras, function(i, value) {

            html += ' <tr>';
            html += '   <td><input type="hidden" name="idBarra[]" value="' + value.idBarra + '">' + value.descripcion + '</td>';
            html += '   <td><input class="form-control" type="number" readonly name="peso[]" step="any" value="' + value.peso + '"></td>';
            html += '   <td><input class="form-control" type="number" required name="ley_rx[]" step="any" value=""></td>';
            html += ' </tr>';
        })

        html += '    </tbody>';
        html += '</table>';

        html += "</fieldset>";

        //footer
        foot = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
        foot += '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';

        //Transform
        $("#myModal form").attr("id", "saveAnalisis");
        $("#myModalLabel").text(title);
        $(".modal-body").append(html);
        $(".modal-footer").append(foot);

        $("#myModal").modal("show");
    });


    $("body").on("click", ".aCop", function() {

        //Analisis por Densidad    
        clear();

        id = $(this).attr("data-i");
        barras = "";
        barras = loadBarras(id);

        title = "Analisis por Copelación";

        //content            
        html = "<fieldset>";
        html += "<legend>Ingresar ley</legend>";
        html += "<input type='hidden' name='anType' value='C' required>";
        html += "<input type='hidden' name='id' value='" + id + "' required>";

        html += '<table class="table table-hover table-bordered table-striped table-condensed responsive-utilities jambo_table">';
        html += '    <thead>';
        html += '       <tr>';
        html += '          <th>Barra</th>';
        html += '          <th>Peso Bruto</th>';
        html += '          <th>Ley Au</th>';
        html += '         <th>Ley Ag</th>';
        html += '       </tr>';
        html += '    </thead>';
        html += '    <tbody>';

        $.each(barras, function(i, value) {

            html += ' <tr>';
            html += '   <td><input type="hidden" name="idBarra[]" value="' + value.idBarra + '">' + value.descripcion + '</td>';
            html += '   <td><input class="form-control" type="number" readonly name="peso[]" step="any" value="' + value.peso + '"></td>';
            html += '   <td><input class="form-control" type="number" required name="ley_au[]" step="any" value=""></td>';
            html += '   <td><input class="form-control" type="number" required name="ley_ag[]" step="any" value=""></td>';
            html += ' </tr>';
        })

        html += '    </tbody>';
        html += '</table>';

        html += "</fieldset>";

        //footer
        foot = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
        foot += '<button type="submit" class="btn btn-primary">Guardar Cambios</button>';

        //Transform
        $("#myModal form").attr("id", "saveAnalisis");
        $("#myModalLabel").text(title);
        $(".modal-body").append(html);
        $(".modal-footer").append(foot);

        $("#myModal").modal("show");
    });


    $("body").on("click", ".view", function() {

        //Analisis por Densidad    
        clear();

        id = $(this).attr("data-i");
        barras = "";
        acta = loadActa(id);
        barras = loadAnalisis(id);

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
            '<td><strong>Id</strong></td>' +
            '<td><strong>Barra</strong></td>' +
            '<td class="text-center"><strong>Peso bruto</strong></td>' +
            '<td class="text-center"><strong>Peso Humeno</strong></td>' +
            '<td class="text-center"><strong>Tipo Analisis</strong></td>' +
            '<td class="text-right"><strong>Analisis</strong></td>' +
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


    $('#myModal').on('hidden.bs.modal', function() {

        $("#myModal .modal-dialog").removeClass("modal-lg");

    })


    $("body").validator().on("submit", "#myModal form", function(e) {

        if (e.isDefaultPrevented()) {

            e.preventDefault();

            loadMessage("Advertencia!", "Por favor completa todos los campos requeridos.", "error");

        } else {

            e.preventDefault();

            action = $(this).attr("id");
            data = $(this).serializeJSON();

            saveDatadata(data, action);
        }

    });


    $("body").on("click", ".finish", function() {

        //Recibir Material
        clear();

        id = $(this).attr("data-i");
        //content            
        title = "Confirmar el estado del acta";
        html = "<p>¿Confirma que el acta y sus analisis se encuentran correctos?</p>";
        html += "<input type='hidden' name='id' value='" + id + "' required>";
        //footer
        foot = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
        foot += '<button type="submit" class="btn btn-success" id="finish" data-i="' + id + '">Finalizar</button>';
        //Transform
        $("#myModal form").attr("id", "finish");
        $("#myModalLabel").text(title);
        $(".modal-body").append(html);
        $(".modal-footer").append(foot);

        $("#myModal").modal("show");

    });


    $("body").on("click", ".delete", function() {

        //Recibir Material
        clear();

        id = $(this).attr("data-i");
        //content            
        title = "Confirmar cancelación acta";
        html = "<p>¿Confirma que desea cancelar el acta?</p>";
        html += "<input type='hidden' name='id' value='" + id + "' required>";
        //footer
        foot = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
        foot += '<button type="submit" class="btn btn-danger" id="cancel" data-i="' + id + '">Cancelar Acta</button>';
        //Transform
        $("#myModal form").attr("id", "cancel");
        $("#myModalLabel").text(title);
        $(".modal-body").append(html);
        $(".modal-footer").append(foot);

        $("#myModal").modal("show");

    });


    $("body").on("submit", "#finish", function() {

        //Recibir Material
        var id = $("input[name='id']").val();
        var result = "";
        var html = "";

        $.ajax({
            url: "laboratorio/finish",
            data: { id: id },
            type: 'post',
            dataType: 'json',
            async: false,
            cache: false,
            success: function(data) {

                if (data.length > 0) {

                    loadMessage(data.type, data.mns, data.estado);
                    reloadData();
                }
            },
            complete: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });

        $("#myModal").modal("hide");

    });


    $("body").on("submit", "#cancel", function() {

        //Recibir Material
        var id = $("input[name='id']").val();
        var result = "";
        var html = "";

        $.ajax({
            url: "laboratorio/cancel",
            data: { id: id },
            type: 'post',
            dataType: 'json',
            async: false,
            cache: false,
            success: function(data) {

                if (data.length > 0) {

                    loadMessage(data.type, data.mns, data.estado);
                    reloadData();
                }
            },
            complete: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });

        $("#myModal").modal("hide");


    });


});