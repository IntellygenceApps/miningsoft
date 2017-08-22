<?php
$session = $this->session->userdata('data');
?>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                
                <li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display: none">
                        <li><a href="<?php echo base_url(); ?>">Dashboard</a></li>                                       
                    </ul>
                </li>
                
                <?php 
                $menu = menu(); 
                foreach($menu as $menu_a){																
                ?>                            
            
                <li><a><i class="<?php echo $menu_a->Icono; ?>"></i> <?php echo $menu_a->Nombre; ?> <span class="fa fa-chevron-down"></span></a>
                    
                    <?php 
                    $submenu = submenu($menu_a->ModuloId,$session["id_usuario"]); 
                 					                                    
                    if(is_array($submenu)){																
                    ?> 
                    
                        <ul class="nav child_menu" style="display: none">
                        
                         <?php 										 
                         foreach($submenu as $submenu_a){																
                         ?>
                        
                            <li><a href="<?php echo base_url(); ?><?php echo $submenu_a->Link; ?>"><?php echo "<i class='".$submenu_a->Simbolo."'></i> ".$submenu_a->Nombre; ?></a></li>                                       
                         
                         <?php
                         }
                         ?> 
                            
                        </ul>
                    
                    <?php
                    }
                    ?>
                    
                    
                </li>
                
                <?php 
                }
                ?>
                
            </ul>
        </div>
        
    
    </div>
    <!-- /sidebar menu -->
    
    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url().'login/logout_ci'; ?>">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
    </div>
    <!-- /menu footer buttons -->
    </div>
</div>