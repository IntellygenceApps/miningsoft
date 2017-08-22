<div class="row">
	<div class="col-md-10 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="title">
                <h3><i class="fa fa-folder"></i> Folder | <i class="fa fa-folder"></i> <?php echo $folderData->Nombre; ?></h3>
            </div>
                        
        </div>
   
 	</div>
</div>
 
<div class="row">

        <!-- form input mask -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">                
                <div class="x_content">
                         
                     <div class="title">
                        <h3><i class="fa fa-sitemap"></i> Directorios</h3>
                     </div>
                     
                     <hr>

                     <div class="list-group">
                     	
                     <?php if($folder != false){ ?>   
                        
                         <?php foreach($folder as $folders){ ?>
                              
                             <a href="<?php echo base_url(); ?>filemanager/files_folder_view/<?php echo $folders->FolderId; ?>/<?php echo $folders->Encriptado; ?>" class="list-group-item"><i class="fa fa-folder"></i> <?php echo $folders->Nombre; ?></a>
                                
                         <?php } ?> 
                     
                     <?php }else{ ?>
                     
                     <p>No hay elementos para mostrar</p>
                     
                     <?php } ?>
                     
                     </div>     
                     
                     <hr>
                     
                     <a href="javascript:history.back()"> <i class="fa fa-reply"></i> Volver al directorio anterior</a>
                                                            
                </div>
            </div>
        </div>
        <!-- /form input mask -->
           
</div>  

<div class="row">

        <!-- form input mask -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">                
                <div class="x_content">
                         
                     <div class="title">
                        <h3><i class="fa fa-file-o"></i> Archivos del directorio | <i class="fa fa-folder"></i> <?php echo $folderData->Nombre; ?></h3>
                     </div>
                     
                     <hr>
					
                     <?php if($archivo!== false){ ?>                    
						
                         <table class="table table-striped table-bordered table-hovered" id="filetable" width="100%">
                            <thead>
                                <tr>
                                    <th width="65%">Nombre Archivo</th>   
                                    <th width="5%">Tamaño</th>
                                    <th width="30%">Acciones</th>
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
                                        <td><?php echo recortar_texto($archivo->Nombre,50); ?></td>                                                             
                                        <td><?php echo $archivo->Tamano; ?> Kb</td>
                                        <td>
                                            <a href="<?php echo  base_url(); ?>filemanager/download_file/<?php echo $archivo->ArchivoId; ?>/<?php echo $archivo->Encriptado; ?>/<?php echo $archivo->NombreArchivo; ?>/<?php echo $archivo->Tamano; ?>Kb">[ <i class="fa fa-download"></i> Descargar]</a>
                                            <a href="<?php echo  base_url(); ?>filemanager/share_file/<?php echo $archivo->ArchivoId; ?>/<?php echo $archivo->Encriptado; ?>/<?php echo $archivo->NombreArchivo; ?>/<?php echo $archivo->Tamano; ?>Kb">[ <i class="fa fa-share-alt"></i> Compartir]</a>
                                        </td>	
                                    </tr>
                                    <?php } ?>
                                    
                                <?php } ?>    
                            </tbody>
                        </table>
                      
                     <?php } ?>  
                                                                     
                </div>
            </div>
        </div>
        <!-- /form input mask -->
           
</div>      
 
