<?php echo $this->Html->script(     array(), 
                                    array('block' => 'plugins'));
?>

<div class="row">
    <div class="col-lg-13">
        <div class="panel panel-success">
            <div class="panel-heading">  Listado de productos  </div>
            <div class="panel-body">
                <table id="listproducts" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead style="background-color: #C6E1DD">
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Presentación</th>
                                <th>Precio Costo</th>
                                <th>Precio Venta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #EAF4F2">
                            <?php
                            $presentations = Configure::read('PRESENTATION_TYPES');
                            foreach ($products as $product) : ?>
                                <tr>
                                    <td style="font-size: 0.9em"><?php echo strtoupper($product['Product']['code']);?></td>
                                    <td>
                                        <?php 
                                            if (!empty($product['Product']['name'])) {
                                                echo strtoupper($product['Product']['name']);
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if (!empty($product['Product']['presentation'])) {
                                                echo strtoupper($presentations[$product['Product']['presentation']]);
                                                echo " ";
                                                echo "<b>";
                                                echo strtoupper($product['Product']['quantity']);
                                                echo "</b>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo "$" . strtoupper($product['Price']['cost_price']);?></td>
                                    <td style="color: red"><?php echo "$" . strtoupper($product['Price']['sale_price']);?></td>
                                    <td>
                                        <?php
                                            echo $this->Html->link('Editar',                           
                                                array('controller' => 'products',                        
                                                      'action' => 'edit', $product['Product']['id'])); 
                                        ?>
                                        
                                        -
                                            <a href="#" data-toggle="modal" data-target="#exampleModal<?php echo $product['Product']['id']; ?>" data-whatever="@mdo">Ver</a>
                                        <?php
                                            echo $this->element('Products/view-product', array('product' => $product, 'presentation_types' => $presentations, 'percentages' => Configure::read('PERCENTAGES_PRICES')));
                                        ?>
                                        -
                                        <?php
                                            /*echo $this->Form->postLink('Ver producto',                           
                                                array('controller' => 'products',                        
                                                    'action' => 'view', $product['Product']['id'],
                                                    'admin'  => true));*/
                                        ?>
                                        
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
    <?php echo $this->Form->end(); ?>

        