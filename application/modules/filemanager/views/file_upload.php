<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="title_left">
                <h3><a style="color:#2A3F54" href="<?php echo base_url(); ?>filemanager"><i class="fa fa-folder"></i> Folder [ <?php echo $folder->Nombre; ?> ] </h3></a>
            </div>
                        
        </div>
        <div class="clearfix"></div>
 	</div>
</div>


<div class="row">
        <!-- form input mask -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                    <br />
                    <form action="<?php echo base_url().$action; ?>" class='form-horizontal form-label-left' method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Folder </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" disabled name="Nombre" value="<?php echo $folder->Nombre; ?>" required>
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Archivo </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="Nombre" required>
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Archivo</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="file" class="form-control" name="Archivo" required>
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        
                        <input type="hidden" name="FolderId" value="<?php echo $folder->FolderId; ?>">
                        <input type="hidden" name="encriptado" value="<?php echo $encriptado ?>">
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" /> 
                                                
                        <hr>
                        
                        <div class="form-group">
                            <button class="form-input btn btn-sm btn-primary" type="submit" value="Grabar">Subir</button>
                        </div>

                    </form>      
                </div>
            </div>
        </div>
        <!-- /form input mask -->
</div>      
 


<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
                
                <div class="x_content">
                
                    <table class="table table-striped table-bordered table-hovered" id="filetable" width="100%">
                        <thead>
                            <tr>
                            	<th width="40%">Nombre Archivo</th>                            
                                <th width="30%">Nombre Interno</th>
                                <th width="10%">Extension</th>
                                <th width="5%">Tamaño</th>
                                <th width="10%">Fecha Carga</th>
                            </tr>
                        </thead>
                        <tbody>	
                        	<?php if($archivo == false){ ?>
                        	<tr>
                            	<td colspan="5">No hay ficheros en este directorio</td>
                            </tr>
                            <?php }else{ ?>
                            
								<?php foreach($archivo as $archivo){ ?>
                                <tr>
                                    <td><?php echo recortar_texto($archivo->Nombre,20); ?></td>
                                    <td><?php echo recortar_texto($archivo->NombreArchivo,60); ?></td>
                                    <td><?php echo $archivo->Extension; ?></td>
                                    <td><?php echo $archivo->Tamano; ?> Kb</td>
                                    <td><?php echo $archivo->FecCrea; ?></td>	
                                </tr>
                                <?php } ?>
                                
                            <?php } ?>    
                        </tbody>
                    </table>
                    
                </div>
                
            </div>
            
    	</div>
</div>

