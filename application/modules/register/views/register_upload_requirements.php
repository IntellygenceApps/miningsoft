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
                
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Codigo</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <label><?php echo $data->Code; ?></label>
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
    
    
<div class="">       
       <div class="page-title">
         <div class="title_left">
            <h3>Documentación requerida.</h3>
         </div>
   	   </div>
       
       <div class="clearfix"></div>
       
       <div class="row">
        <!-- form input mask -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                 	
                    <table class="table table-stripped">
                   		<tr> 
                    		<td>FT.CO.05 Conocimiento de Aliados Comercialess</td>
                            <td><input type="file"></td>
                        </tr>
                        <tr>
                            <td>FT.CO.06 Acuerdo de Seguridad</td>
                            <td><input type="file"></td>
                    	</tr>
                    </table>  	
                 	
                    <hr>
                    
                    <input type="submit" value="Guardar"> | 
                    
                    <a class="link" href="<?php echo base_url()."register/lista"; ?>">Volver</a>
                    
                </div>     
                
            </div>
        </div>
        <!-- /form input knob -->
       
</div> 
