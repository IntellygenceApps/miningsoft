function addCommas(nStr) {

    //Funcion para agregar comas a un numero entero.

    nStr += '';
    var x = "";
    var x1 = "";
    var x2 = "";

    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}




function loadMessage(title, content, error = "") {

    //Funcion para cargar un mensaje tipo modal con alguna informacion.
    var html;

    html += '<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
    html += '<div class="modal-dialog" role="document">';
    html += '<div class="modal-content">';
    html += '<div class="modal-header">';
    html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    html += '<h4 class="modal-title" id="myModalLabel">' + title + '</h4>';
    html += '</div>';
    html += '<div class="modal-body">';
    html += content;
    html += '</div>';
    html += '<div class="modal-footer">';
    html += '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';
    //html += '<button type="button" class="btn btn-primary">Guardar Cambios</button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    $("body").append(html);

    $("#myModalMessage").modal("show");

    $('#myModalMessage').on('hidden.bs.modal', function() {
        $('#myModalMessage').remove();
    })
}