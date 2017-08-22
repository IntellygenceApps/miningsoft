<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="title">
                <h3><a style="color:#2A3F54" href="<?php echo base_url(); ?>filemanager"><i class="fa fa-folder"></i> <?php echo $title; ?></a> | Archivo [ <?php echo $archivo->Nombre; ?> ] </h3>
            </div>
                        
        </div>
        <div class="clearfix"></div>
 	</div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if($this->session->flashdata('msg')){ ?>
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
                   <?php echo $this->session->flashdata('msg'); ?>
            </div>    
        <?php } ?>   
        
        <?php if($this->session->flashdata('msg_success')){ ?>
            <div class="alert alert-success" role="alert">
              <span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span>
              <span class="sr-only">Satísfactorio:</span>
                   <?php echo $this->session->flashdata('msg_success'); ?>
            </div>    
        <?php } ?>               	        	
    </div>
</div>

<form action="<?php echo base_url().$action; ?>" class='form-horizontal form-label-left' method="post" enctype="multipart/form-data">

<div class="row">
        <!-- form input mask -->
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                    <br />
                
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Limite de descargas : </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="CantDesc" required size="4" min="0" placeholder="1">
                                <span class="fa fa-check-square-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email : </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" class="form-control" name="Email" required>
                                <span class="fa fa-envelope-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>      
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Asunto : </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="Asunto" required>
                                <span class="fa fa-comment-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>           
                        
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Mensaje :  </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea class="form-control" name="Mensaje" required></textarea>                                
                            </div>
                        </div>                                         
                       
                        <hr>
                        
                        <div class="form-group">
                            <input class="form-input" type="submit" value="Compartir">
                        </div>
                           
                </div>
            </div>
        </div>
        <!-- /form input mask -->
        
        
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                <br />
                
                <table class="table table-stripped">
                	<tr>
                		<td colspan="2">Nombre: <b><?php echo $archivo->Nombre; ?></b></td>
                	</tr>
                    <tr>
                		<td>Tipo: </td><td><?php echo $archivo->Extension; ?></td>
                	</tr>
                    <tr>
                		<td>Tamaño : </td><td><?php echo $archivo->Tamano; ?> Kb</td>
                	</tr>
                    <tr>
                		<td>Fecha Creación : </td><td><?php echo $archivo->FecCrea; ?></td>
                	</tr>
                    
                </table>
                
                </div>
            </div>
        </div>        
</div>      
 
<input type="hidden" name="archivoId" value="<?php echo $archivo->ArchivoId; ?>">
 
<?php echo form_close(); ?>

<hr>

<a href="javascript:history.back()"> <i class="fa fa-reply"></i> Volver al directorio.</a>
