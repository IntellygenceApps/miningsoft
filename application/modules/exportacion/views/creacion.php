<form class="form-horizontal form-label-left" accept-charset="utf-8" enctype="application/x-www-form-urlencoded" action="<?php echo base_url(); ?>compras/guardar" method="post">

    <div class="row">
        <!-- form input mask -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>REGISTRO DE RECIBO DE MATERIAL</h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Fecha</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" disabled value="<?php echo date("Y-m-d"); ?>">
                                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Sucursal</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">                                
                                <select class="select2_single form-control" tabindex="-1" name="idSucursal" required>
                                    <option value="">Selecciona una Sucursal</option>                                                                                       
                                    <?php foreach($sucursales as $item){ ?>
                                        <option value="<?php echo $item->SucursalId; ?>"><?php echo $item->sucursal; ?></option>
                                    <?php } ?>                                                                                      
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Proveedor</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">                                
                                <select class="select2_single form-control" tabindex="-1" name="idTercero" required>
                                    <option value="">Selecciona un Proveedor</option>                                                                                       
                                    <?php foreach($terceros as $item){ ?>
                                        <option value="<?php echo $item->TerceroId; ?>"><?php echo $item->NombreCompleto; ?></option>
                                    <?php } ?>                                                                                      
                                </select>
                            </div>
                        </div>
                        
                       
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="reset" class="btn btn-primary">Cancelar</button>                                
                                <a class="btn btn-warning" href="<?php echo base_url(); ?>barras">Volver a la Lista</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>MATERIAL</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                                           
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Buscar Material</label>
                        <div class="col-md-8 col-sm-9 col-xs-9">                                
                            <select class="select2_single form-control" name="idBarra" required>
                                <option>Seleccione una sucursal</option>
                                                                                                                    
                            </select>                                
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">  
                            <button class="btn btn-success disabled" id="add">+</button>
                        </div>  
                        
                    </div>

                    <hr>

                    <fieldset>
                        <legend>Material en la bolsa</legend>    
                    
                        <div class="form-group">

                            <table class="table table-hover table-bordered table-striped  responsive-utilities jambo_table dataTable" id="listBarras">
                                <thead>
                                    <tr>
                                        <td>Descripción</td>
                                        <td>Peso (Grs)</td>
                                        <td>Sucursal</td>
                                        <td>Quitar</td>
                                    </tr>
                                </thead>
                                <tbody>


                                                            
                                </tbody>

                            </table>

                        </div>                        
                    </fieldset>
                </div>
            </div>


        <!-- /form input mask -->
        
    </div>

</form>

