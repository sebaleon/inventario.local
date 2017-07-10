<?php echo $this->Html->script(     array(), 
                                    array('block' => 'plugins'));
?>

<div class="row">
    <div class="col-lg-13">
        <div class="panel panel-success">
            <div class="panel-heading">  Listado de fechas de vencimientos  </div>
            <div class="panel-body">
                <table id="listexpirations" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead style="background-color: #C6E1DD">
                            <tr>
                                <th>Descripcion</th>
                                <th>Fecha Vecimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #EAF4F2">
                            <?php
                            foreach ($expirations as $expiration) : ?>
                                <tr>
                                    <td><?php echo strtoupper($expiration['Expiration']['description']);?></td>
                                    <td>
                                        <?php
                                            echo date('d-m-Y', strtotime($expiration['Expiration']['date_exp']));
                                        ?>
                                    </td>
                                    <td>
                                        <?php
//                                            echo $this->Html->link('Editar',                           
//                                                array('controller' => 'expirations',                        
//                                                      'action' => 'edit', $expiration['Expiration']['id'])); 
//                                            echo '<br>';
                                            echo $this->Form->postLink('Eliminar',                           
                                                array('controller' => 'expirations',                        
                                                    'action' => 'delete', $expiration['Expiration']['id'],
                                                    'admin'  => true),
                                                    array('confirm' => __('¿Seguro quiere eliminar la fecha de vecimiento?'))); 
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

        