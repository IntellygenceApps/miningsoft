<div class="row">
    <!-- form input mask -->
    <div class="col-md-6 col-sm-12 col-xs-12">

        <form class="form-horizontal form-label-left" accept-charset="utf-8" enctype="application/x-www-form-urlencoded" action="<?php echo base_url().$action; ?>" method="post">

            <div class="x_panel">
                
                <div class="x_content">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="Nombre" value="" required>
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Folder Padre</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <?php 
                                if(select_folder() != ""){

                                    echo select_folder(); 

                                }else{

                                    ?>

                                        <select name='FolderPadreId' class='select2_single form-control' tabindex='-1' id='third' required>
                                            <option value='1'>Root</option>
                                        </select>

                                    <?php
                                }
                                ?> 

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Estatus</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="select2_single form-control" tabindex="-1" id="Status" name="Status">
                                    <option value="1">Activo</option>                                                                                       
                                    <option value="0">Inactivo</option>                                                                                                
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuarios</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                    <ol>
                                    <?php foreach($usuario as $usuarios){ ?>
                                    
                                    <li><i class="fa fa-user"></i> <?php echo $usuarios["Nombres"]." ".$usuarios["Apellidos"]; ?> <?php echo $usuarios["UsuarioId"]; ?> - [ <input type="checkbox" name="Usuarios[]" value="<?php echo $usuarios["UsuarioId"]; ?>"> ]</li>
                                    
                                    <?php } ?>
                                    </ol>
                                    
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="form-group">
                            <input class="form-input btn btn-sm btn-primary" type="submit" value="Grabar">
                        </div>
                            
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
       
        <div class="x_panel">
            
            <div class="x_content">
            
                <div id="jstree">
                
                    <?php   
                
                        //echo folders();
                    
                    ?>

                </div>
            </div>                    
        </div>    
    </div>   
        
 
<div class="row">   

	
</div> 

<div class="row">


<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
            
            <div class="x_content">
            
                <table class="table table-striped table-bordered table-hovered" id="filetable">
                    <thead>
                        <tr>
                            <th>Folder Id</th>
                            <th>Nombre</th>
                            <th>Folder Padre</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($folder as $folders){ ?>
                        <tr>
                            <td><?php echo $folders["FolderId"]; ?></td>
                            <td><?php echo $folders["Nombre"]; ?></td>
                            <td><?php echo $folders["FolderPadre"]; ?></td>
                            <td>[<a class="text-primary" href="<?php echo base_url(); ?>filemanager/edit/<?php echo $folders["FolderId"]; ?>/<?php echo $folders["Encriptado"]; ?>">Editar <i class="fa fa-edit"></i> </a> ] 
                            	[<a class="text-warning" href="<?php echo base_url(); ?>filemanager/file_upload/<?php echo $folders["FolderId"]; ?>/<?php echo $folders["Encriptado"]; ?>">Cargar <i class="fa fa-cloud-upload"></i> </a> ]
                                [<a class="text-danger" href="#">Eliminar <i class="fa fa-close"></i> </a> ]</td>
                        </tr>
                        <?php } ?> 
                    </tbody>
                </table>
                
            </div>
            
        </div>
            
    </div>
</div>

