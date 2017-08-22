<div class="row">
  
  <div class="col-md-12">

    <div class="x_panel">
        <div class="x_title">
            <h2><a href="<?php echo base_url(); ?>barras/crear" class="btn btn-primary">Crear Barra</a></h2>
            <div class="clearfix"></div>
        </div>   

        <div class="x_content">
          
            <div class="dataTablesContainer">

                <table id="example" class="table table-hover table-bordered table-striped table-condensed responsive-utilities jambo_table">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Producto</th>
                      <th>Descripcion</th>
                      <th>Peso</th>
                      <th>Peso Humedo</th>
                      <th>Fecha Creacion</th>
                      <th>Usuario</th>
                      <th>Sucursal</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                      foreach($barras as $key){                       
                      ?>
                      
                      <tr>
                        <td><?php echo $key['id'] ?></td>
                        <td><?php echo $key['producto'] ?></td>
                        <td><?php echo $key['descripcion'] ?></td>
                        <td><i class="fa fa-cubes"></i> <?php echo str_replace(",",".",number_format($key['peso'],0)); ?> Grs</td>
                        <td><i class="fa fa-cubes"></i> <?php echo str_replace(",",".",number_format($key['peso_humedo'],0)); ?> Grs</td>
                        <td><i class="fa fa-calendar-o"></i> <?php echo $key['fechaCreacion']; ?></td>
                        <td><i class="fa fa-user"></i> <?php echo $key['Usuario'] ?></td>
                        <td><i class="fa fa-home"></i> <?php echo $key['sucursal'] ?></td>
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