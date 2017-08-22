// JavaScript Document
$(document).ready(function(){
	
	var $body =  $("body");
	var base_url = $("#base_url").attr("class");
	
	$(function(){
		
		$("#third").on("change",function(){
			
			var Id = $(this).val();	
			$("button[type='submit']").attr("disabled",true);			
			
			$.ajax({
					url: "register/AjaxLoadThird/",
					type: "POST",               
					data: 'Id='+Id,   
					dataType: 'json',
					cache: false,
					beforeSend: function(){
							 
						$body.addClass("loading");
					},
					complete : function(data){
							
						$body.removeClass("loading");													
					},
					success: function(data){
												
						$("#ClTr").val(data.Clase);
						$("#NuId").val(data.NumeroIdentificacion);
						$("#PrNo").val(data.PrimerNombre);
						$("#SeNo").val(data.SegundoNombre);
						$("#PrAp").val(data.PrimerApellido);
						$("#SeAp").val(data.SegundoApellido);
						$("#NoCo").val(data.NombreCompleto);
						$("#Gene").val(data.Genero);
						$("#Dire").val(data.Direccion);	
						$("#Tele").val(data.Telefono);
						$("#Celu").val(data.Celular);
						$("#Ciudad").val(data.Ciudad);
						
						$("#Requirements *").empty();
						
						$("button[type='submit']").removeAttr("disabled");	
						
					}/*End succes AjaxLoadThird*/	
					
			   });//end ajax AjaxLoadThird
							
		});
	});
	
	
	/*$(function(){
	
		$("#RldRequirements").on("click",function(){
			
			var Id = $("#third").val();	
						
			$.ajax({
					url: "register/AjaxLoadRequirements/",
					type: "POST",               
					data: 'Id='+Id,   
					dataType: 'json',
					cache: false,
					beforeSend: function(){
							 
						$body.addClass("loading");
					},
					complete : function(data){
							
						$body.removeClass("loading");													
					},
					success: function(data){
						
						if(data != false){
																		
							var $Main = $("#Requirements");
								$FrmGrp = $('<div>').attr('class','form-group');								
								$DvLbl = $('<div>').attr('class','control-label col-md-3 col-sm-3 col-xs-3').text(data.Nombre);
								$Sbmt = $('<button/>').attr('type', 'submit').attr('class','btn btn-success').html("Guardar");
								$Rst = $('<button/>').attr('type', 'reset').attr('class','btn btn-primary').html("Limpiar");
														
							$Main.empty();
							
							$.each(data, function(i, item){
								
								var $Lbl = $('<label/>').attr('class','control-label col-md-3 col-sm-3 col-xs-3').html(i+" "+data[i].Nombre);
									$Hddn = $('<input/>').attr('type', 'hidden').attr('name', 'RequisitoId[]').attr('value', data[i].RequisitoId);
								    $File = $('<input/>').attr('type', 'file').attr('name', 'Archivo[]').attr('class', 'form-control');
									$FrmGrp = $('<div>').attr('class','form-group');
									
									$Main.append($FrmGrp,$FrmGrp.append($Lbl,$File,$Hddn)).after();
							});
							
							$("button[type='submit']").removeAttr("disabled");
														
						}else{
							
							$("button[type='submit']").removeAttr("disabled");							
						}
						
					}
					
			   });
		});
		
	});*/
	
	
});	