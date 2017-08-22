// JavaScript Document
"use-strict";

var base_url = $("#base_url").text();
var body = $("body");

function loadTree() {

    var result = "";

    $.ajax({
        url: base_url + "filemanager/get_folders",
        type: "POST",
        dataType: 'json',
        async: false,
        cache: false,
        beforeSend: function() {

        },
        complete: function(data) {

        },
        error: function(data) {

            console.log(data);
        },
        success: function(data) {

            result = data;
        }
    });

    return result;
}


$(document).ready(function() {

    var data = loadTree();

    $('#jstree').jstree({
        'core': {
            'data': data
        }
    });

    /*$("#jstree").jstree({
    		"plugins": ["themes", "json_data", "ui"],
    		"json_data": {
    			"ajax": {
    				"type": 'GET',
    				"url": function(node) {
    					var nodeId = "";
    					var url = ""
    					if (node == -1) {
    						url = base_url + "filemanager/get_folders";
    					} else {
    						nodeId = node.attr('id');
    						url = base_url + "filemanager/get_folder_child" + nodeId;
    					}

    					return url;
    				},
    				"success": function(new_data) {
    					return new_data;
    				}
    			}
    		}
    	});*/

    //$('#filetable').DataTable();

});