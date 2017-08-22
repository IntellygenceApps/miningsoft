<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Perfil de Usuario</h3>
        </div>    
       
    </div>
    <div class="clearfix"></div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">
    
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
    
                        <div class="profile_img">
    
                            <!-- end of image cropping -->
                            <div id="crop-avatar">
                                <!-- Current avatar -->
                                <div class="avatar-view" title="Change the avatar">
                                	<img src="<?php echo base_url(); ?>assets/uploads/profiles/<?=$view->Foto; ?>" width="224" height="305" alt=""/>                                    
                                </div>                                    
                            </div>
                            <!-- end of image cropping -->
    
                        </div>
                        
                        <br>

                        <h3><?=$view->Nombres." ".$view->Apellidos; ?></h3>
    
                        <ul class="list-unstyled user_data">
                            
                            <li>
                            	<i class="fa fa-envelope-o user-profile-icon"></i> <?=$view->Email; ?>
                            </li>
    
                            <li>
                                <i class="fa fa-phone user-profile-icon"></i> <?=$view->Telefono; ?>
                            </li>
                            
                            <li>
                            	<i class="fa fa-map-marker user-profile-icon"></i> <?=$view->Direccion; ?>
                            </li>
    
                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> <?=$view->Cargo; ?>
                            </li>
                            
    
                            <li class="m-top-xs">
                                <i class="fa fa-external-link user-profile-icon"></i>
                                <a href="<?=$view->LinkedIn; ?>" target="_blank">www.linkedin.com</a>
                            </li>
                        </ul>
 
                        <br />
    
    
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
    
                        <div class="profile_title">
                            <div class="col-md-6">
                                <h2>Reporte de actividades de usuario</h2>
                            </div>
                            <div class="col-md-6">
                                <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span><?php echo date("Y-m-d"); ?></span> <b class="caret"></b>
                                </div>
                            </div>
                        </div>
                        <!-- start of user-activity-graph -->
                        <div id="graph_bar" style="width:100%; height:280px;"></div>
                        <!-- end of user-activity-graph -->
    

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
