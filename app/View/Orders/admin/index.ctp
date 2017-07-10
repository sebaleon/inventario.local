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
    <div class="col-lg-13">
        <div class="panel panel-success">
            <div class="panel-heading">  Listado y buscador de productos  </div>
            <div class="panel-body">
                <table id="lisproducts" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead style="background-color: #C6E1DD">
                            <tr>
                                <!--<th>Seleccionar</th>-->
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Presentación</th>
                                <th>Cantidad/Contenido</th>
                                <th>Precio Costo</th>
                                <th>Precio Venta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
<!--                        <tfoot>
                            <tr>
                                <th>Seleccionar</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Presentación</th>
                                <th>Cantidad/Contenido</th>
                                <th>Precio Costo</th>
                                <th>Precio Venta</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>-->
                        <tbody style="background-color: #EAF4F2">
                            <?php
                            $presentations = Configure::read('PRESENTATION_TYPES');
                            foreach ($products as $product) : ?>
                                <tr>
                                    <!--<td>-->
                                        <?php
//                                            echo $this->Form->input('change_price',
//                                            array('name'        => 'data[Product][id][' . $product['Product']['id'] . ']',
//                                                  'id'          => 'data-product-'.$product['Product']['id'],
//                                                  'type'        => 'checkbox',
//                                                  'div'         => false,
//                    //                              'class'       => 'check-price checkbox_item',
//                                                  'label'       => false,
//                    //                                  'title'       => $statuses[$invoice['Invoice']['status']],
//                                                  'hiddenField' => false,
//                                                ));
                                        ?> 
                                    <!--</td>-->
                                    <td style="font-size: 0.9em"><?php echo strtoupper($product['Product']['code']);?></td>
                                    <td><?php echo strtoupper($product['Product']['name']);?></td>
                                    <td><?php echo strtoupper($presentations[$product['Product']['presentation']]);?></td>
                                    <td><?php echo strtoupper($product['Product']['quantity']);?></td>
                                    <td><?php echo "$" . strtoupper($product['Price']['cost_price']);?></td>
                                    <td style="color: red"><?php echo "$" . strtoupper($product['Price']['sale_price']);?></td>
                                    <td>
                                        <?php
                                            echo $this->Html->link('Editar',                           
                                                array('controller' => 'products',                        
                                                      'action' => 'edit', $product['Product']['id'])); 
                                        ?>
                                            <br>
                                            <a href="#" data-toggle="modal" data-target="#exampleModal<?php echo $product['Product']['id']; ?>" data-whatever="@mdo">Ver producto</a>
                                        <?php
                                            echo $this->element('Products/edit-product', array('product' => $product));
                                        ?>
                                            <br>
                                        <?php
                                            echo $this->Form->postLink('Eliminar',                           
                                                array('controller' => 'products',                        
                                                    'action' => 'delete', $product['Product']['id'],
                                                    'admin'  => true),
                                                    array('confirm' => __('¿Seguro quiere eliminar este producto?'))); 
                                        ?>

                                    </td>
                                </tr>
                           <?php endforeach;?>
                        </tbody>
                    </table>
            </div>    
        </div>    
    </div>    
</div>    

        <?php echo $this->Form->create('Product',
                                 array( 'url' => 'http://inventario.local/admin/products/change_price',
                                        'type' => 'post',
                                       'class'      => '',
                                       'novalidate' => true)); ?>
        <?php foreach ($products as $product): ?>
            <?php echo $this->Form->input('product',
                                    array('name'  => 'data[ids]['.$product['Product']['id'].']',
                                          'id'    => 'hidden-data-product-'.$product['Product']['id'],
                                          'type'  => 'hidden',
                                          'label' => false)); ?>

        <?php endforeach ?>

        <hr />
        
        <div>
            <?php
                //el mensaje esta en el script admin_index.js
                echo $this->Form->button(__('Cambiar precios de los productos seleccionados'),
                        array(
                              'type'    => 'submit',
                              'escape'  => false,
                              'div'     => false,
                              'disabled' => 'disabled',
                              'id'      => 'button-change',
                              'onclick' => "if (!confirm('Está seguro cambiar el precio a los productos seleccionados?')) return false;"
                              ));
                              //'onclick' => "if(confirm('$message')){ $('#new_status').val('$key')} else return false;"));

            ?>
        </div>
    <?php echo $this->Form->end(); ?>

        