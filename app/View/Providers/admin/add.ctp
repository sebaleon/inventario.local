<?php
//
//echo $this->Html->script(array(
//                                    'plugins/jquery.replicate'
//                                ),
//                               array('block' => 'plugins'));
?>

<div class="row">
          <div class="col-lg-13">
            <div class="well bs-component">
            <?php
                echo $this->Form->create('Provider', array(
                    'class' => 'form-horizontal',
                    'role'  => 'form',
                )); 
            ?>                
                <fieldset>
                  <legend>AGREGAR NUEVO PROVEEDOR</legend>
                  <div class="form-group">
                    <label for="inputName" class="col-lg-2 control-label">Nombre</label>
                    <div class="col-lg-10">
                        <?php
                            echo $this->Form->input('name', array(
                                'label' => false,
                                'div' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Nombre de la empresa o nombre y apellido del proveedor',
                            ));
                        ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Marcas</label>
                    <div class="col-lg-10">
                        <?php
                        echo $this->Form->input('brands', array(
                            'type' => 'text',
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                            'placeholder' => 'Ingresar marcas con las que trabaja este proveedor',
                        ));
                        ?>
                    </div>                    
                  </div>
                  <div class="form-group">
                    <label for="inputPhone" class="col-lg-2 control-label">Telefonos</label>
                    <div class="col-lg-10">
                        <?php
                            echo $this->Form->input('phone', array(
                                'label' => false,
                                'div'   => false,
                                'class'   => 'form-control',
                                'placeholder'   => 'Ingrese el/los numeros de telefonos de contacto',
                            ));
                        ?>                        
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputCity" class="col-lg-2 control-label">Ciudad</label>
                    <div class="col-lg-4">
                        <?php
                            echo $this->Form->input('city', array(
                                'label' => false,
                                'div'   => false,
                                'class'   => 'form-control',
                                'placeholder'   => 'Ejemplo: Santa Fe Ciudad (3000)',
                            ));
                        ?>                        
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-4">
                        <?php
                        echo $this->Form->input('email', array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                            'placeholder' => 'Ingresar correo electronico',
                        ));
                        ?>
                    </div>                    
                  </div>
                  <div class="form-group">
                        <div class="col-sm-12">
                            <div class="text-right">
                            <?php
                                echo $this->Form->button('Agregar', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-success',
                                    'div' => false,
                                    'label' => false
                                    ));
                            ?> 
                            <?php
                                echo $this->Html->link('Cancelar',
                                                 array('action' => 'index'),
                                                 array('class'  => 'btn btn-default',
                                                       'div'    => false,
                                                       'label'  => false));
                            ?> 
                            </div>                             
                        </div>                  
                  </div>
                </fieldset>
            <?php
                echo $this->Form->end();
            ?>
            </div>
          </div>
</div>
