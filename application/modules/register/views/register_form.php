<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo $title; ?># <?php echo $token; ?></h3>
        </div>      
    </div>
    
    <div class="clearfix"></div>

 <form class="form-horizontal form-label-left" accept-charset="utf-8" enctype="application/x-www-form-urlencoded" action="<?php echo base_url().$action; ?>" method="post">
 
 	<div class="row">
    	<?php echo $this->session->flashdata('msg'); ?>
    </div>
 
    <div class="row">
        <!-- form input mask -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                    <br />
                
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tercero</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" id="third" name="TerceroId">
                                    <option value="">Selecciona un Tercero</option>                                                                                       
                                    <?php foreach($third as $item){ ?>
                                    	<option value="<?php echo $item->TerceroId; ?>"><?php echo "[ ".$item->NumeroIdentificacion." ] ".$item->NombreCompleto." - ".$item->PrimerNombre." ".$item->SegundaNombre." ".$item->PrimerApellido." ".$item->SegundaApellido; ?></option>
                                    <?php } ?>                                                                                      
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Fecha Registro</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="<?php echo date("Y-m-d"); ?>">
                                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Hora Registro</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="<?php echo date("h:i:s"); ?>">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                          
                </div>
            </div>
        </div>
        <!-- /form input mask -->
        
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                
                	<p><?php echo $barcode; ?></p>
                    
                </div>
                
            </div>
                
        </div>
</div>      
 
<div class="">       
       <div class="page-title">
         <div class="title_left">
            <h3>Información del Tercero</h3>
         </div>
   	   </div>
       
       <div class="clearfix"></div>
       
       <div class="row">
        <!-- form input mask -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                       	
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Clase Tercero</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="ClTr">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>       
                                                
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Identificación</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="NuId">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Primer Nombre</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="PrNo">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Segundo Nombre</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="SeNo">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>           
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Primer Apellido</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="PrAp">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Segundo Apellido</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="SeAp">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Nombre Completo</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="NoCo">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>                         
                </div>
            </div>
        </div>
        <!-- /form input mask -->
       
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                
                	 <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Genero</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="Gene">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Dirección</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="Dire">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Teléfono</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="Tele">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>           
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Celular</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="Celu">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Ciudad</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="" id="Ciud">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                </div>
                
            </div>                
        </div>
              
       
        <!-- form input knob -->
        <div class="col-md-12">
            <div class="x_panel">
                
                <hr>
                    
                <div class="form-group" style="margin-top:10px;">
                    <div class="col-md-3">
                        <button type="reset" class="btn btn-primary">Limpiar</button>
                        <button type="submit" class="btn btn-success" disabled>Guardar</button>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- /form input knob -->
       
</div> 

<input type="hidden" name="token" value="<?php echo $token; ?>">
 
</form>