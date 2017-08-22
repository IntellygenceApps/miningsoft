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
                                <th>Aliado Comercial</th>
                                <th>Clase</th>
                                <th>Fecha Solicitud</th>
                                <th>Hora Solicitud</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>                        
                        </thead>
                        
                        <tbody>
                        	
                            <?php foreach($data as $datax){ ?>
                        		
                                <tr>
                                	<td><?php echo $datax->Codigo; ?></td>
                                    <td><?php echo $datax->PrimerNombre." ".$datax->PrimerApellido; ?></td>
                                    <td><?php echo $datax->ClaseTercero; ?></td>
                                    <td><?php echo $datax->FechaSolicitud; ?></td>
                                    <td><?php echo $datax->HoraSolicitud; ?></td>
                                    <td><?php echo $datax->Estado; ?></td>
                                    <td>
                                    	<a data-toggle="tooltip" data-placement="top" title="Ver Registro" href="<?php echo base_url(); ?>register/view/<?php echo $datax->RegistroId; ?>"><i class="fa fa-eye"></i></a> 
                                    </td>
                                    
                                </tr>
                        
                        	<?php } ?>
                        	
                            
                                
                        </tbody>                     
                    
                    
                    </table>
                                   	
                
            </div>
        </div>
        <!-- /form input knob -->
       
</div> 

