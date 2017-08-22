 <form action="<?php echo base_url().$action; ?>" method="post" enctype="application/x-www-form-urlencoded">
 
    <h1>Recuperar Clave</h1>
    <div>
    	<?php if(strlen(form_error('email')) > 0){ ?>
    	
            <div class="alert alert-danger animated fadeInLeft" role="alert">          
              <?php echo form_error('email'); ?>
            </div>
        
        <?php } ?>
        <input type="email" class="form-control" placeholder="Email" name="Email"  value="<?php echo set_value('Email'); ?>"/>
    </div>
    <div>
    	<div class="g-recaptcha" data-sitekey="6LezGiATAAAAADtc3ETQvbGI-ZpeNfUGFYNTm_b3"></div>
    </div>
    <br>
	
    <div>
        <button type="submit" class="btn btn-default">Enviar</button>
        <a class="reset_pass" href="<?php echo base_url(); ?>login">Volver a Login.</a>
    </div>
    
    <hr>
    
       	<?php 
		if($this->session->flashdata('usuario_incorrecto'))
		{
		?>
            <div class="alert alert-danger animated fadeIn">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <strong><i class="fa fa-close"></i></strong> <?=$this->session->flashdata('usuario_incorrecto'); ?>.
            </div></p>
            
		<?php
		}
		?>
    
    
    <div class="clearfix"></div>
    <div class="separator">
       
        <div class="clearfix"></div>
        <br />
        <div>
            <h1><i class="fa fa-book" style="font-size: 26px;"></i> MiningSoft</h1>

            <p>©2016 All Rights Reserved. MiningSoft.</p>
        </div>
    </div>
    	<?=form_hidden('token',$token)?>		
</form>
<!-- form -->
