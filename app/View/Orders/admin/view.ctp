<?php // echo $this->Html->script(array(
                                    //    'plugins/jquery.selecttocombo',
                                    //'plugins/jquery.validate',
                                    //'plugins/jquery.validate.rules',
//                                    'plugins/jquery.dataTables.js',
//                                    'plugins/dataTables.bootstrap.min.js',
//                                    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
//                                    ), 
//                                    array('block' => 'plugins'));

//        echo $this->Html->css(array(
////            'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
//            'dataTables.bootstrap.min.css',
//            'jquery.dataTables.css',
//        ));

?>
<div class="row">
  <div class="col-lg-12">
    <h2>INFORMACIÓN DEL PRODUCTO</h2>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="bs-component">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">MARCA / DESCRIPCIÓN</h3>
        </div>
          <div class="panel-body" style="font-size: 2em">
            <?php
                echo strtoupper($product['Product']['name']);
            ?>
        </div>
      </div>

      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">PRESENTACIÓN</h3>
        </div>
        <div class="panel-body" style="font-size: 2em">
            <?php
                echo strtoupper($product['Product']['presentation']);
            ?>
        </div>
      </div>

    <?php if (!empty($product['Product']['entry_quantity'])): ?>
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">STOCK</h3>
        </div>
        <div class="panel-body" style="font-size: 2em">
            <?php
                echo strtoupper($product['Product']['entry_quantity']);
            ?>
        </div>
      </div>
    <?php endif;?>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="bs-component">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">CÓDIGO</h3>
        </div>
        <div class="panel-body" style="font-size: 2em">
            <?php
                echo strtoupper($product['Product']['code']);
            ?>
        </div>
      </div>

      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">CANTIDAD DE CONTENIDO</h3>
        </div>
        <div class="panel-body" style="font-size: 2em">
            <?php
                echo strtoupper($product['Product']['quantity']);
            ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="bs-component">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">PRECIO DE COSTO</h3>
        </div>
          <div class="panel-body" style="font-size: 2em">
            <?php
                echo '$' . strtoupper($product['Price']['cost_price']);
            ?>
        </div>
      </div>

    </div>
  </div>
  <div class="col-lg-6">
    <div class="bs-component">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <h3 class="panel-title">PRECIO DE VENTA ACTUAL</h3>
        </div>
        <div class="panel-body" style="font-size: 2em">
            <?php
                echo '$' . strtoupper($product['Price']['sale_price']);
            ?>
        </div>
      </div>

      <?php if (!empty($product['Price']['entry_quantity'])) : ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">PRECIO DE LOS 100 GRAMOS</h3>
        </div>
        <div class="panel-body" style="font-size: 2em">
            <?php
                echo '$' . strtoupper($product['Price']['price_per_grams']);
            ?>
        </div>
      </div>
      <?php endif;?>  
    </div>
  </div>
</div>

<div class="panel panel-warning">
    <div class="panel-heading">
      <h3 class="panel-title">HISTORIAL DE PRECIOS</h3>
    </div>
    <div class="panel-body">
        <div class="bs-component">
            <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th>#</th>
                <th>Column heading</th>
                <th>Column heading</th>
                <th>Column heading</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="info">
                <td>3</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="success">
                <td>4</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="danger">
                <td>5</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="warning">
                <td>6</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
              <tr class="active">
                <td>7</td>
                <td>Column content</td>
                <td>Column content</td>
                <td>Column content</td>
              </tr>
            </tbody>
            </table> 
        </div><!-- /example -->
    </div>
</div>