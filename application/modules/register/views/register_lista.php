<div class="">
    <div class="page-title">
        <div class="title">
            <h3><?php echo $title; ?></h3>
        </div>
    </div>
    <div class="clearfix"></div>

 	<div class="row">
    	<?php echo $this->session->flashdata('msg'); ?>
    </div>
 
    <div class="row">
        <!-- form input mask -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
                    
                    <br />
                    
                    <table class="table table-hover datatables">
                    	<thead>
                        	<tr>
                            	<th>Codigo</th>
                                <th>Cliente</th>
                                <th>Fecha Solicitud</th>
                                <th>Hora Solicitud</th>
                                <th>Acciones</th>
                            </tr>                        
                        </thead>
                        
                        <tbody>
                        	
                            <?php foreach($data as $datax){ ?>
                        		
                                <tr>
                                	<td><?php echo $datax->Codigo; ?></td>
                                    <td><?php echo $datax->PrimerNombre." ".$datax->PrimerApellido; ?></td>
                                    <td><?php echo $datax->FechaSolicitud; ?></td>
                                    <td><?php echo $datax->HoraSolicitud; ?></td>
                                    <td>
                                    	
                                    	<a data-toggle="tooltip" data-placement="top" title="Registro de Valoraciones" href="<?php echo base_url(); ?>register/verify_process/<?php echo $datax->RegistroId; ?>"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="tooltip" data-placement="top" title="Carga de Documentos" href="<?php echo base_url(); ?>register/upload_requirements/<?php echo $datax->RegistroId; ?>"><i class="fa fa-file-text-o"></i></a>
                                    	
                                        <?php 
										$auxCumpVery = auxCumplimientoVerify($session["CargoId"]);
										
										if($auxCumpVery == true){
										?>
                                        	<a data-toggle="tooltip" data-placement="top" title="Ver Registro" href="<?php echo base_url(); ?>register/view/<?php echo $datax->RegistroId; ?>"><i class="fa fa-eye"></i></a>
                                                                                    
											<?php 
                                            $result = estados($datax->RegistroId);										
                                            if($result == true){
                                            ?>                                        
                                                <a style="color:#00A021" data-toggle="tooltip" data-placement="top" title="Finalice el registro (Aceptable)" href="<?php echo base_url(); ?>register/complete_register/<?php echo $datax->RegistroId; ?>/1"><i class="fa fa-check"></i></a>
                                            <?php
                                            }else{
                                            ?>                                        
                                                <a style="color:#A30305" data-toggle="tooltip" data-placement="top" title="Finalice el registro (Inaceptable)" href="<?php echo base_url(); ?>register/complete_register/<?php echo $datax->RegistroId; ?>/0"><i class="fa fa-check"></i></a>
                                            <?php
                                            }
                                            ?>
                                            
                                            
                                        <?php
										}
										?>   
                                        
                                        </td>
                                        	 
                                    </td>
                                    
                                </tr>
                        
                        	<?php } ?>
                        	
                            
                                
                        </tbody>                     
                    
                    
                    </table>
                                   	
                
            </div>
        </div>
        <!-- /form input knob -->
       
</div> 

