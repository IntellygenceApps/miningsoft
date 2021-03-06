// JavaScript Document
//var $body = $("body");
var base_url = $("#base_url").attr("class");


function loadActions(id, fecha, aDen, aRFX, aCop, sha_pdf, estado) {

    var actions = "";

    //Receive
    if (fecha == "0000-00-00 00:00:00") {

        actions += "<a href='#' data-toggle='tooltip' data-placement='top' title='Recibir Material' class='btn-accion btn btn-success receive btn-xs' data-i='" + id + "'><i class='fa fa-hand-grab-o'></i></a>";

    } else {

        actions += "<a href='#' data-toggle='tooltip' data-placement='top' title='Recibir Material (Inactivo)' class='btn-accion btn btn-success disabled btn-xs' data-i='" + id + "'><i class='fa fa-hand-paper-o'></i></a>";
    }

    //Tomar muestra
    if (fecha != "0000-00-00 00:00:00" && estado == "A") {

        actions += "<a href='#' data-toggle='tooltip' data-placement='top' title='Tomar Muestra' class='btn-accion btn btn-success takeSample btn-xs' data-i='" + id + "'><i class='fa fa-hand-scissors-o'></i></a>";

    } else {

        actions += "<a href='#' data-toggle='tooltip' data-placement='top' title='Tomar Muestra (Inactivo)' class='btn-accion btn btn-success disabled btn-xs' data-i='" + id + "'><i class='fa fa-hand-scissors-o'></i></a>";
    }

    //Analisis por Densidad
    if (fecha != "0000-00-00 00:00:00" && aDen == 0 && estado == "A") {

        actions += "<a href='#' data-toggle='tooltip' data-placement='top' title='Analisis por densidad' class='btn-accion btn btn-primary aDen btn-xs' data-i='" + id + "' >D</a>";

    } else {

        actions += "<a href='#' data-toggle='tooltip' data-placement='top' title='Analisis por densidad (Inactivo)' class='btn-accion btn btn-primary btn-xs disabled'>D</a>";
    }

    //Analisis por RFX
    if (fecha != "0000-00-00 00:00:00" && aRFX == 0 && estado == "A") {

        actions += "<a href='#' class='btn-accion btn btn-primary aRFX btn-xs' data-i='" + id + "' >RFX</a>";

    } else {

        actions += "<a href='#' class='btn-accion btn btn-primary btn-xs disabled'>RFX</a>";
    }

    //Analisis por COP
    if (fecha != "0000-00-00 00:00:00" && aCop >= 0 && estado == "A") {

        actions += "<a href='#' class='btn-accion btn btn-primary aCop btn-xs' data-i='" + id + "' >C</a>";

    } else {

        actions += "<a href='#' class='btn-accion btn btn-primary disabled btn-xs'>C</a>";
    }

    //Ver acta
    actions += "<a href='#' class='btn-accion btn btn-success view btn-xs' data-i='" + id + "'><i class='fa fa-eye'></i></a>";

    //Imprimir Acta
    if (fecha != "0000-00-00 00:00:00") {

        actions += "<a target='_blank' href='" + base_url + "laboratorio/printPDF/" + sha_pdf + "' class='btn-accion btn btn-default print btn-xs' data-i='" + id + "'><i class='fa fa-print'></i></a>";

    } else {

        actions += "<a target='_blank' href='#' class='btn-accion btn btn-default disabled btn-xs'><i class='fa fa-print'></i></a>";
    }

    //Finalizar Acta
    if (fecha != "0000-00-00 00:00:00" && aDen > 0 && aRFX > 0 && aCop > 0 && estado == "A") {

        actions += "<a href='#' class='btn-accion btn btn-success finish btn-xs' data-i='" + id + "'><i class='fa fa-check'></i></a>";

    } else {

        actions += "<a href='#' class='btn-accion btn btn-success disabled btn-xs'><i class='fa fa-check'></i></a>";
    }

    //Desaparecer el Acta de la lista
    if (estado == "A") {

        actions += "<a href='#' class='btn-accion btn btn-danger delete btn-xs' data-i='" + id + "'><i class='fa fa-remove'></i></a>";

    } else {

        actions += "<a href='#' class='btn-accion btn btn-danger disabled btn-xs'><i class='fa fa-remove'></i></a>";
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
            url: base_url + "laboratorio/reloadData/",
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
            $('td', row).eq(0).html('<i class="fa fa-hashtag"></i> ' + data.id);
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


var dataAnalisis = "";
var menorFinos = 0;
var mayorFinos = 0;

function loadAnalisis(idActa) {

    var result = "";
    var htmls = "";
    var finos = "";
    var arrFinos = [];

    $.ajax({
        url: "laboratorio/loadAnalisis",
        data: { id: idActa },
        type: 'post',
        dataType: 'json',
        async: false,
        success: function(data) {

            if (data.length > 0) {

                dataAnalisis = data;

                $.each(data, function(i, value) {

                    if (value.tipo == "Densidad") {

                        finos = value.finos_den;
                        arrFinos.push(finos);
                    }

                    if (value.tipo == "RFX") {

                        finos = value.finos_rx;
                        arrFinos.push(parseInt(finos));
                    }

                    if (value.tipo == "Copelacion") {

                        finos = value.finos_au;
                        arrFinos.push(parseInt(finos));
                    }

                    htmls += "<tr id='" + value.id + "' class='" + parseInt(finos) + "' >" +
                        "<td>" + value.idBarra + "</td>" +
                        "<td>" + value.barra + "</td>" +
                        "<td>" + value.peso + "</td>" +
                        "<td>" + value.peso_humedo + "</td>" +
                        "<td><i class='fa fa-hashtag'></i> " + value.id + "</td>" +
                        "<td><i class='fa fa-calendar'></i> " + value.fecha + "</td>" +
                        "<td>" + value.tipo + "</td>" +
                        "<td>" + finos + "</td>" +
                        "<td>" + constructAnalisis(value.tipo, value) + "</td>" +
                        "<td><input type='radio' name='liq" + value.idBarra + "'> Liquidar</td>" +
                        "</tr>";
                });

                mayorFinos = Math.max.apply(null, arrFinos);
                menorFinos = Math.min.apply(null, arrFinos);

            } else {

                htmls += "No hay informacion disponible";
            }
        },
        complete: function(data) {
            console.log(data);
        },
        error: function(data) {
            console.log(data);
        }
    });

    return htmls;
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


var dataGraphTitle = [];
var dataGraphValue = [];
var dataGraphColor = [];

function loadGrafica() {

    dataGraphTitle = [];
    dataGraphValue = [];
    dataGraphColor = [];

    var result = dataAnalisis;
    var finos = 0;
    var color = "";

    $.each(result, function(i, value) {

        if (value.tipo == "Densidad") {

            finos = value.finos_den;
            color = 'rgba(255, 99, 132';
        }

        if (value.tipo == "RFX") {

            finos = value.finos_rx;
            color = 'rgba(75, 192, 192';
        }

        if (value.tipo == "Copelacion") {

            finos = value.finos_au;
            color = 'rgba(54, 162, 235';
        }

        dataGraphTitle.push(value.tipo);
        dataGraphValue.push(finos);
        dataGraphColor.push(color + ', 0.7)');
    })
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


    $("body").on("click", ".takeSample", function() {

        //Analisis por Densidad    
        clear();

        id = $(this).attr("data-i");
        barras = "";
        barras = loadBarras(id);

        title = "Tomar una muestra";

        //content            
        html = "<fieldset>";
        html += "<legend>Ingresar el peso de la muestra</legend>";
        html += "<input type='hidden' name='anType' value='muestra' required>";
        html += "<input type='hidden' name='id' value='" + id + "' required>";

        html += '<table class="table table-hover table-bordered table-striped table-condensed responsive-utilities jambo_table">';
        html += '    <thead>';
        html += '       <tr>';
        html += '          <th>Barra</th>';
        html += '          <th>Peso Bruto</th>';
        html += '          <th>Peso de la muestra</th>';
        html += '       </tr>';
        html += '    </thead>';
        html += '    <tbody>';

        $.each(barras, function(i, value) {

            html += ' <tr>';
            html += '   <td><input type="hidden" name="idBarra[]" value="' + value.idBarra + '">' + value.descripcion + '</td>';
            html += '   <td><input class="form-control" type="number" readonly name="peso[]" step="any" value="' + value.peso + '"></td>';
            html += '   <td><input class="form-control" type="number" required name="peso_mu[]" step="any" value=""></td>';
            html += ' </tr>';
        })

        html += '    </tbody>';
        html += '</table>';

        html += "</fieldset>";

        //footer
        foot = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
        foot += '<button type="submit" class="btn btn-primary">Guardar Muestra</button>';

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
        graph = loadGrafica();

        //content   
        title = "Visualizacion del acta";
        html = '<div class="container">' +
            '<div class="row">' +
            '<div class="col-xs-12">' +
            '<div class="text-center">' +
            '<i class="fa fa-hashtag pull-left icon"></i>' +
            '<h2>Acta de registro de material #' + acta.id + '</h2>' +
            '</div>' +
            '<hr>' +
            '<div class="row">' +
            '<div class="col-xs-12 col-md-6 col-lg-6">' +
            '<div class="panel panel-default height">' +
            ' <div class="panel-heading">Gráfica de Analisis </div>' +
            '<div class="panel-body" id="graficaChart">' +
            '<canvas id="canvas" width="400" height="400"></canvas>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="col-xs-12 col-md-6 col-lg-6 pull-right">' +
            '<div class="panel panel-default height">' +
            '<div class="panel-heading">Información del Acta</div>' +
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
            ' <table class="table table-condensed table-stripped">' +
            '<thead>' +
            '<tr>' +
            '<td><strong>Id Barra</strong></td>' +
            '<td><strong>Barra</strong></td>' +
            '<td class="text-center"><strong>Peso bruto</strong></td>' +
            '<td class="text-center"><strong>Peso Humeno</strong></td>' +
            '<td class="text-center"><strong>Id Analisis</strong></td>' +
            '<td class="text-center"><strong>Fecha Analisis</strong></td>' +
            '<td class="text-center"><strong>Tipo Analisis</strong></td>' +
            '<td class="text-center"><strong>Finos</strong></td>' +
            '<td class="text-right"><strong>Analisis</strong></td>' +
            '<td class="text-right"><strong>Liquidación</strong></td>' +
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

        $(".modal-body table.table tbody").find("tr." + mayorFinos).addClass("alert-success");

        $(".modal-body table.table tbody").find("tr." + menorFinos).addClass("alert-danger");
        //$(".modal-footer").append(foot);

        //Graph
        var ctx = $("#canvas");

        var graph = new Chart(ctx, {

            type: "bar",
            label: dataGraphTitle,
            data: {
                labels: dataGraphTitle,
                datasets: [{
                    label: "Valor del Analisis",
                    data: dataGraphValue,
                    backgroundColor: dataGraphColor
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }

        })


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
        $("#myModal#myModalLabel").text(title);
        $("#myModal.modal-body").append(html);
        $("#myModal.modal-footer").append(foot);

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