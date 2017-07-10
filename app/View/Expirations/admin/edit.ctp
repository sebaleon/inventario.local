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
                echo $this->Form->create('Expiration', array(
                    'class' => 'form-horizontal',
                    'role'  => 'form',
                    'type'         => 'file',
                     'novalidate'   => true,
//                     'autocomplete' => 'off'
                )); 
            ?>                
                <fieldset>
                  <legend>AGREGAR NUEVO VENCIMIENTO</legend>
                  <div class="form-group">
                    <label for="inputDescription" class="col-lg-2 control-label">Descripcion</label>
                    <div class="col-lg-8">
                        <?php
                            echo $this->Form->input('Expiration.description', array(
                                'label' => false,
                                'div' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese la descripcion del producto',
                            ));
                        ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDateExp" class="col-lg-2 control-label">Fecha de vencimiento</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                        <?php
                            echo $this->Form->input('date_exp', array(
                                'type' => 'text',
                                'label' => false,
                                'div' => false,
                                'id'  => 'datepicker',
                                'class' => 'form-control',
                                'placeholder' => 'Ingrese fecha de vencimiento',
                            ));
                        ?>
                            <div class="input-group-addon"><img src="https://cdn0.iconfinder.com/data/icons/news-and-magazine/512/calendar-32.png" border="0" alt="Calendario" height="22" width="22"></div>
                        </div>          
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-sm-12">
                            <div class="text-right">
                            <?php
                                echo $this->Form->button('Editar', array(
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
