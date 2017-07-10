<?php echo $this->Html->script(     array(), 
                                    array('block' => 'plugins'));
?>

<div class="row">
    <div class="col-lg-13">
        <div class="panel panel-success">
            <div class="panel-heading">  Listado de proveedores  </div>
            <div class="panel-body">
                <table id="listproviders" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead style="background-color: #C6E1DD">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Marcas</th>
                                <th>Ciudad</th>
                                <th>Telefonos</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #EAF4F2">
                            <?php
                            foreach ($providers as $provider) : ?>
                                <tr>
                                    <td><?php echo strtoupper($provider['Provider']['id']);?></td>
                                    <td><?php echo strtoupper($provider['Provider']['name']);?></td>
                                    <td><?php echo strtoupper($provider['Provider']['brands']);?></td>
                                    <td><?php echo strtoupper($provider['Provider']['city']);?></td>
                                    <td><?php echo strtoupper($provider['Provider']['phone']);?></td>
                                    <td><?php echo strtoupper($provider['Provider']['email']);?></td>
                                    <td>
                                        <?php
                                            echo $this->Html->link('Editar',                           
                                                array('controller' => 'providers',                        
                                                      'action' => 'edit', $provider['Provider']['id'])); 
                                            echo '<br>';
                                            echo $this->Form->postLink('Eliminar',                           
                                                array('controller' => 'providers',                        
                                                    'action' => 'delete', $provider['Provider']['id'],
                                                    'admin'  => true),
                                                    array('confirm' => __('¿Seguro quiere eliminar este proveedor?'))); 
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

        