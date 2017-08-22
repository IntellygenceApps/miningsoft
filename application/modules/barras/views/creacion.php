<form class="form-horizontal form-label-left" accept-charset="utf-8" enctype="application/x-www-form-urlencoded" action="<?php echo base_url(); ?>barras/guardar" method="post">
  
    <div class="row">
        <!-- form input mask -->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Creacion de Barras</h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>                  

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Producto</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">                                
                                <select class="select2_single form-control" tabindex="-1" name="idProducto" required>
                                    <option value="">Selecciona un Producto</option>                                                                                       
                                    <?php foreach($productos as $itemp){ ?>
                                        <option value="<?php echo $itemp->id; ?>"><?php echo $itemp->nombre; ?></option>
                                    <?php } ?>                                                                                      
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Descripcion</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="descripcion" required>
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Peso en bruto (Grs)</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" step='0.01' name="peso" required>
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Peso humedo (Grs)</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" step='0.01' name="peso_humedo" required>
                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
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
                       
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="reset" class="btn btn-primary">Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <a class="btn btn-warning" href="<?php echo base_url(); ?>barras">Volver a la Lista</a>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <!-- /form input mask -->


        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Resultado por Densidad</h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                   
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">1 Resultado densidad</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="number" class="form-control" name="resultado" readonly required>
                            <span class="fa fa-cubes form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Densidad</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="number" class="form-control" name="densidad" readonly required>
                            <span class="fa fa-cubes form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Ley Densidad</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="number" class="form-control" name="ley" readonly required>
                            <span class="fa fa-cubes form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Finos Densidad</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <input type="number" class="form-control" name="finos" readonly required>
                            <span class="fa fa-cubes form-control-feedback right" aria-hidden="true"></span>
                        </div>
                    </div>
    </div>  

</form>

