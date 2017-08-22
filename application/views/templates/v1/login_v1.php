<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MiningSoft | <?php echo $title; ?></title>
    <!-- Bootstrap core CSS -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>public/img/favicon.ico" type="image/x-icon">
    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url(); ?>public/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/icheck/flat/green.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/animate.min.css">
    <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    
                    <?php   
					   $correcto = $this->session->flashdata('message');
                       if ($correcto){
                    ?>
                    
                       <span id="registroCorrecto"><?= $correcto ?></span>
                    
					<?php
                   	   }
                    ?>
                                       
                                      
                   <?php $this->load->view($content); ?>
                                      
                   
                </section>                    
            </div>
        </div>
    </div>
    
    <script src='https://www.google.com/recaptcha/api.js'></script>

</body>

</html>