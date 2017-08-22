<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MiningSoft | <?php  echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>public/img/favicon.ico" type="image/x-icon">
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="<?php echo base_url(); ?>public/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/css/select/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/switchery/switchery.min.css" />
    <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>       
    <!--[if lt IE 9]>
        <script src="<?php echo base_url(); ?>assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <?php if(isset($css_files)) foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()."public/".$file.".css"; ?>" />
	<?php endforeach; ?>
        
</head>

<body class="nav-md">

<div class="LoadingModal"><!-- Place at bottom of page --></div>	    	

    <div class="container body">

        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo base_url(); ?>home" class="site_title"><i class="fa fa-book"></i> <span>MiningSoft</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        
                        
                        <div class="profile_pic">
                            <img src="<?php echo base_url(); ?>assets/uploads/profiles/<?=$session['picture']; ?>" alt="..." class="img-circle profile_img">
                        </div>
                        
                        <!--<div class="profile_pic">
                            <img src="<?php echo base_url(); ?>public/images/img.jpg" alt="..." class="img-circle profile_img">
                        </div>-->
                        
                        
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2><?=$session['username']." ".$session['secondname'];?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                  	<?php echo $this->load->view("templates/v1/sidemenu"); ?>	

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url(); ?>assets/uploads/profiles/<?=$session['picture']; ?>"><?=$session['username']." ".$session['secondname'];?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo base_url(); ?>profile"> Perfil</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Configuración</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Ayuda</a>
                                    </li>
                                    <li><?=anchor(base_url().'login/logout_ci', 'Cerrar sesión')?>
                                    </li>
                                </ul>
                            </li>


                        </ul>
                
                </nav></div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">
            
                <?php if($this->session->flashdata('msg')){ ?>

                    <div class="row">

                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <p><?php echo $this->session->flashdata('msg'); ?></p>
                        </div>

                    </div>
                
                <?php } ?>
                    
            	<div class="row">
                    
                    <?php $this->load->view($content); ?>            
            	
            	</div>
            	
            </div>
            <!-- /page content -->

       </div>

    </div><a>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    
    <p id="base_url" class="<?php echo base_url(); ?>"></p>

    <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>  
    <script src="<?php echo base_url(); ?>public/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/switchery/switchery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/icheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/select/select2.full.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/js/datepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>public/js/custom.js"></script>
    <script src="<?php echo base_url(); ?>public/js/app.js"></script>
    <script src="<?php echo base_url(); ?>public/js/jquery.serializejson.js"></script>
    <script src="<?php echo base_url(); ?>public/js/bootstrap-validator-master/dist/validator.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/DataTables_v1.10.15/media/js/jquery.dataTables.js"></script>  
    <script src="<?php echo base_url(); ?>public/js/DataTables_v1.10.15/media/js/dataTables.bootstrap.min.js"></script>    
    <script src="<?php echo base_url(); ?>public/js/skycons/skycons.js"></script>    
    <script src="<?php echo base_url(); ?>public/js/chartjs/chart.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/chartjs/Chart.bundle.js"></script>
    <script src="<?php echo base_url(); ?>public/js/chartjs/utils.js"></script>
    <script src="<?php echo base_url(); ?>public/js/money.min.js"></script>
    
    <script>
        var icons = new Skycons({
                "color": "#73879C"
            }),
            list = [
                "clear-day", "clear-night", "partly-cloudy-day",
                "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                "fog"
            ],
            i;

        for (i = list.length; i--;)
            icons.set(list[i], list[i]);

        icons.play();
    </script>

    <?php if(isset($js_files)) foreach($js_files as $file): ?>
		<script src="<?php echo base_url()."public/".$file.".js"; ?>"></script>
	<?php endforeach; ?>

</body>

</html>
