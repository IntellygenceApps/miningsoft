<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo $title; ?></h3>
        </div>	        
    </div>
    <div class="clearfix"></div>

 <form class="form-horizontal form-label-left" accept-charset="utf-8" enctype="application/x-www-form-urlencoded" action="<?php echo base_url().$action; ?>" method="post">
 
 	<div class="row">
    	<?php echo $this->session->flashdata('msg'); ?>
    </div>
 
    <div class="row">
        <!-- form input mask -->
        <div class="col-md-7 col-sm-12 col-xs-12">
            <div class="x_panel">
                              
                <div class="x_content">
                    <br />
                
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus Aceptable</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" id="third" name="TerceroId">
                                    <option value="">Selecciona un Estatus</option>                                                                                       
                                   
                                    <?php foreach($status as $item){ ?>
                                    	<option <?php if($data["StatusAceptable"] == $item->RegistroEstadoId){ echo "selected"; } ?> value="<?php echo $item->RegistroEstadoId; ?>"><?php echo "[ ".$item->Nombre." ] "; ?></option>
                                    <?php } ?>
                                                                                                        
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus Tolerable</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" id="third" name="TerceroId">
                                    <option value="">Selecciona un Estatus</option>                                                                                       
                                    <?php foreach($status as $item){ ?>
                                    	<option <?php if($data["StatusTolerable"] == $item->RegistroEstadoId){ echo "selected"; } ?> value="<?php echo $item->RegistroEstadoId; ?>"><?php echo "[ ".$item->Nombre." ] "; ?></option>
                                    <?php } ?>                                                                           
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus Inaceptable</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="select2_single form-control" tabindex="-1" id="third" name="TerceroId">
                                    <option value="">Selecciona un Estatus</option>                                                                                       
                                    <?php foreach($status as $item){ ?>
                                    	<option <?php if($data["StatusInaceptable"] == $item->RegistroEstadoId){ echo "selected"; } ?> value="<?php echo $item->RegistroEstadoId; ?>"><?php echo "[ ".$item->Nombre." ] "; ?></option>
                                    <?php } ?>                                                                                   
                                </select>
                            </div>
                        </div>
                            
                </div>
            </div>
        </div>
        <!-- /form input mask -->
       
</div>      
 

<input type="submit" value="Guardar">
 
</form>