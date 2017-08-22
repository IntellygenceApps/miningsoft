// JavaScript Document

function formatearNumero(nStr) {

    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';

    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }

    return x1 + x2;
}

function clearSelect(str) {

    $("select[name='" + str + "'] option").remove();
}

function delBarras(id) {

    /*Funcion para agregar las barras al grid */

    var elem = "idBarra";
    var $body = $("body");
    var base_url = $("#base_url").attr("class");
    var html;

    $.ajax({
        url: "compras/delBarra/",
        type: "POST",
        data: 'id=' + id,
        dataType: 'json',
        cache: false,
        beforeSend: function() {

            $body.addClass("loading");
        },
        complete: function(data) {

            $body.removeClass("loading");
        },
        error: function(data) {

            console.log(data);
        },
        success: function(data) {

            if (data.error == 1) {

                loadMessage("Error!", data.data);

            } else {

                ajaxListBarras();
            }

        } /*End succes AjaxLoadThird*/
    });
}


function addBarras(id) {

    /*Funcion para agregar las barras al grid */

    var elem = "idBarra";
    var $body = $("body");
    var base_url = $("#base_url").attr("class");
    var html;

    $.ajax({
        url: "compras/addBarra/",
        type: "POST",
        data: 'id=' + id,
        dataType: 'json',
        cache: false,
        beforeSend: function() {

            $body.addClass("loading");
        },
        complete: function(data) {

            $body.removeClass("loading");
        },
        error: function(data) {

            console.log(data);
        },
        success: function(data) {

            if (data.error == 1) {

                loadMessage("Error!", data.data);

            } else {

                loadMessage("Error!", "Ya existe este item en la bolsa");
                ajaxListBarras();
            }

        } /*End succes AjaxLoadThird*/
    });
}



function loadBarras(id) {

    /*Carga las barras de la sucursal seleccionada*/

    var elem = "idBarra";
    var $body = $("body");
    var base_url = $("#base_url").attr("class");
    var html;

    clearSelect(elem);

    $.ajax({
        url: "compras/cargaBarras/",
        type: "POST",
        data: 'id=' + id,
        dataType: 'json',
        cache: false,
        beforeSend: function() {

            $body.addClass("loading");
        },
        complete: function(data) {

            $body.removeClass("loading");
        },
        error: function(data) {

            console.log(data);
        },
        success: function(data) {

            if (data.error == 1) {

                loadMessage("<i class='fa fa-warning'></i> Advertencia!", "No hay material disponible en esta sucursal.");

            } else {

                $.each(data, function(key, value) {

                    html += "<option value='" + value.id + "'>" + value.descripcion + " { " + formatearNumero(value.peso) + " Grs}</option>";
                });

                $("select[name='" + elem + "']").html(html);

                $("#add").removeClass("disabled");
            }

        } /*End succes AjaxLoadThird*/
    });
}


function ajaxListBarras() {

    /*Lista las barras en la session*/

    var $body = $("body");
    var base_url = $("#base_url").attr("class");
    var html;

    $("#listBarras tbody").find("*").remove();

    $.ajax({

        url: "compras/ajaxLoadBarras/",
        type: "POST",
        dataType: 'json',
        cache: false,
        beforeSend: function() {

            $body.addClass("loading");
        },
        complete: function(data) {

            $body.removeClass("loading");
        },
        error: function(data) {

            $body.removeClass("loading");
            console.log(data);
        },
        success: function(data) {

            console.log(data.data);

            if (data.error != 1) {

                $.each(data.data, function(key, value) {

                    html += "<tr>";
                    html += "<td>" + value.descripcion + "</td>";
                    html += "<td>" + formatearNumero(value.peso) + "</td>";
                    html += "<td>" + value.sucursal + "</td>";
                    html += "<td><button class='btn btn-danger btn-xs delete' data-i='" + value.idBarra + "'><i class='fa fa-minus' ></i></button></td>";
                    html += "</tr>";
                });

            } else {

                html += "<tr>";
                html += "<td colspan='4'>No hay información disponible</td>";
                html += "</tr>";
            }

            $("#listBarras tbody").append(html);

        } /*End succes AjaxLoadThird*/
    });
}


$(document).ready(function() {



    $("body").on("focusout", "input[name='peso_humedo']", function(e) {

        e.preventDefault();

        var pesoBru = new Number($("input[name='peso']").val()).toFixed(2);
        var pesoDen = new Number($(this).val()).toFixed(2);

        if (pesoDen > 0 && pesoBru > 0) {

            resDen = pesoBru - pesoDen;
            densid = new Number(pesoBru / resDen.toFixed(2));
            leyDen = new Number((parseFloat(23.03) / densid - parseFloat(2.1912)) / -1);
            finoDen = pesoBru * leyDen;

            $("input[name='resultado']").val(resDen.toFixed(2));
            $("input[name='densidad']").val(densid.toFixed(6));
            $("input[name='ley']").val(leyDen.toFixed(4));
            $("input[name='finos']").val(finoDen.toFixed(4));

        } else {

            loadMessage("Advertencia!", "Debe digitar un valor mayor a 0");
        }

    });

});