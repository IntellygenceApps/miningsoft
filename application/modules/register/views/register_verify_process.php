   <div class="page-title">
        <div class="title" style="background-color:#C9C9C9; padding:10px;">
            <h3 style="color:#000"><?php echo $title; ?> # <?php echo $data->Code; ?></h3>
        </div>
        
        <br>
        
        <div class="title_left">
            <h3>Información del registro</h3>
        </div>
      
    </div>
    <div class="clearfix"></div>

 <form class="form-horizontal form-label-left" accept-charset="utf-8" enctype="application/x-www-form-urlencoded" action="<?php echo base_url().$action; ?>" method="post">
 
 	<div class="row">
    	<?php echo $this->session->flashdata('msg'); ?>
    </div>
 
    <div class="row" style="background-color:#D5D5D5;">
        <!-- form input mask -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel" style="margin-top:10px;">
                
                <div class="x_content">
                    <br />
                		<h4>Información de Acceso</h4>
                    	
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Codigo</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <label><?php echo $data->Code; ?></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Clave </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <label><?php echo $data->Clave; ?></label> [ <a data-toggle="tooltip" style="color:#37C32C" data-placement="top" title="Enviar datos de acceso al cliente" href="<?php echo base_url() ?>" target="_blank"><i class="fa fa-envelope-o"></i></a> ]
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Fecha Registro</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <label><?php echo $data->FechaSolicitud; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Hora Registro</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            	<label><?php echo $data->HoraSolicitud; ?></label>
                            </div>
                        </div>
                         
                </div>
            </div>
        </div>
        <!-- /form input mask -->
        
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel" style="margin-top:10px;">
                
                <div class="x_content">
                
                	 <br />
                
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tercero</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <label><?php echo $data->NombreCompleto; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Nit: </label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <label><?php echo $data->NumeroIdentificacion; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Dirección</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            	<label><?php echo $data->Direccion; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Teléfono:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                            	<label><?php echo $data->Telefono; ?></label>
                            </div>
                        </div> 
                    
                </div>
                
            </div>
                
        </div>
        
	</div>             
       
    <div class="row">
        <!-- form input mask -->
        <div class="col-md-6 col-sm-12 col-xs-12">  

        	<br>
            <h1><i class="fa fa-check"></i> Valoraciones</h1>
            <hr>
            
        </div>
        
    </div>
      
        
    <div class="row" style="background-color:#C7C7C7">
        <!-- form input mask -->
        
        <?php if(isset($detValorations)){ 
				
			foreach($detValorations as $valoration_a){ 
		?>		
		
        	<div class="col-md-6 col-sm-12 col-xs-12">                
                 	
                <div class="page-title">
                   <div class="title_left">
                    <h3><i class="fa fa-terminal"></i> <?php echo  $valoration_a->NombreValoracion; ?></h3>
                   </div>
                </div>
                
                <table class="table">
                    <tr> 
                        <td><textarea <?php if($valoration_a->Habilita == 1){echo "readonly";} ?> class="form-control" name="Valoracion[]"><?php echo  $valoration_a->Valoracion; ?></textarea></td>
                    </tr>
                    <tr>
                         <td>
                         	 <select class="form-control" name="RegistroEstadoId[]" <?php if($valoration_a->Habilita == 1){echo "readonly";} ?>>
                             
                         		<option value="">Seleccione</option>
                                
                                <?php foreach($register_status as $register_status_a){ ?>
                                
                                	<option <?php if($register_status_a->RegistroEstadoId == $valoration_a->RegistroEstadoId){echo "selected";} ?> value="<?php echo $register_status_a->RegistroEstadoId; ?>"><?php echo $register_status_a->Nombre; ?></option>                                
                                
                                <?php } ?> 
                                    
                             </select>
                        </td>
                    </tr>
                    
                </table> 
                
                <input type="hidden" name="RegistroId" value="<?php echo $valoration_a->RegistroId; ?>"> 	
                <input type="hidden" name="ValoracionId[]" value="<?php echo $valoration_a->ValoracionId; ?>">    
                                
           </div>     
          
        <?php 		
				}
					
		} else{
				
				foreach($register_valoration as $valoration_a){ 				
		?>                      
        
        		<div class="col-md-6 col-sm-12 col-xs-12">                
                 	
                <div class="page-title">
                   <div class="title_left">
                    <h3><i class="fa fa-terminal"></i> <?php echo  $valoration_a->NombreValoracion; ?></h3>
                   </div>
                </div>
                
                <table class="table">
                    <tr> 
                        <td><textarea <?php if($valoration_a->Habilita == 1){echo "readonly";} ?> class="form-control" name="Valoracion[]"><?php echo  $valoration_a->Valoracion; ?></textarea></td>
                    </tr>
                    <tr>
                         <td>
                         	 <select class="form-control" name="RegistroEstadoId[]" <?php if($valoration_a->Habilita == 1){echo "readonly";} ?>>
                             
                         		<option value="">Seleccione</option>
                                
                                <?php foreach($register_status as $register_status_a){ ?>
                                
                                	<option <?php if($register_status_a->RegistroEstadoId == $valoration_a->RegistroEstadoId){echo "selected";} ?> value="<?php echo $register_status_a->RegistroEstadoId; ?>"><?php echo $register_status_a->Nombre; ?></option>                                
                                
                                <?php } ?> 
                                    
                             </select>
                        </td>
                    </tr>
                    
                </table> 
                
                <input type="hidden" name="RegistroId" value="<?php echo $valoration_a->RegistroId; ?>"> 	
                <input type="hidden" name="ValoracionId[]" value="<?php echo $valoration_a->ValoracionId; ?>">    
                                
           </div>     
                
        <?php
				}
			}
		?>
        
	</div>       

   	<div class="row" style="background-color:#8E8E8E; padding-top:10px;">
        <!-- form input mask -->
        <div class="col-md-3 col-sm-12 col-xs-12">    
        	<input class="form-control link" type="submit" value="Grabar">
        </div>
        
        <div class="col-md-3 col-md-offset-3 col-sm-12 col-xs-12">            	
            <br>
            <p><a class="link" target="_blank" href="<?php echo base_url()."register/upload_requirements/".$registro_id; ?>">Cargar Requerimientos</a></p> 
        	<br>
            <p><a class="link" href="<?php echo base_url()."register/lista"; ?>">Volver</a></p>
        </div>
               
    </div>           
       
</div> 
