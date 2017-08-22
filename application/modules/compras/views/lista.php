<div class="row">
  
  <div class="col-md-12">

    <div class="x_panel">
        <div class="x_title">
            <h2><a href="<?php echo base_url(); ?>compras/creacion" class="btn btn-primary">Recibir Material</a></h2>
            <div class="clearfix"></div>
        </div>   

        <div class="x_content">

          <div class="dataTablesContainer">

            <table id="example" class="table table-hover table-bordered table-striped table-condensed responsive-utilities jambo_table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Fecha</th>                  
                  <th>Lugar</th>
                  <th>Tercero</th>
                  <th>Usuario</th>
                  <th>Sucursal</th>
                  <th>Entregado</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  for ($i=0; $i < count($actas) ; $i++) { 
                  ?>

                  <tr >
                    <td><?php echo $actas[$i]['id'] ?></td>
                    <td><i class='fa fa-calendar'></i> <?php echo $actas[$i]['fechaA'] ?></td>                    
                    <td><?php echo $actas[$i]['lugar'] ?></td>
                    <td><i class='fa fa-user'></i> <?php echo $actas[$i]['nombre']." [".$actas[$i]['nombre_completo']."]"; ?></td>
                    <td><?php echo $actas[$i]['Usuario'] ?></td>
                    <td><?php echo $actas[$i]['sucursal'] ?></td>
                    <td>
                        <?php 
                          if($actas[$i]['fechaRecepcion'] == "0000-00-00 00:00:00"){
                            echo icon_activate(0,"No se ha entregado en oficina principal.");
                          }else{
                            echo icon_activate(1,"Ya se entrego en oficina principal.");
                          } 
                        ?>
                    </td>
                    <td>
                        <?php                           
                            echo status_letter($actas[$i]['estado']);                           
                        ?>
                    </td>
                    <td>
                        <?php echo icon_state($actas[$i]['estado']); ?> 
                        <?php 
                            
                            if($this->session->flashdata('recent') && $this->session->flashdata('recent') == $actas[$i]['id']){  
                                  echo "<button class='btn btn-success btn-xs' >Nuevo!</button>"; 
                            }                                 
                        ?>
                        
                        <a class='btn btn-success btn-xs' target="_blank" href="<?php echo base_url()."compras/pdfExport/".$actas[$i]['sha_pdf'] ?>"> 
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        </a>

                        <a class='btn btn-success btn-xs view' data-i="<?php echo $actas[$i]["id"]; ?>" target="_blank"> 
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        
                        
                        </td>
                  </tr>
                  
                  <?php
                  }
                  ?>
              </tbody>
            </table>

          </div>

      </div>

    </div>

</div>



<!-- Modal -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>  
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"> </h4>
          </div>
          <div class="modal-body">

              

            
          </div>
          <div class="modal-footer">

            
          </div>
      </form>  
    </div>
  </div>
</div>

