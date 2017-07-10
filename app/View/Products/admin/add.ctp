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
                echo $this->Form->create('Product', array(
                    'class' => 'form-horizontal',
                    'role'  => 'form',
                    'type'         => 'file',
                    'novalidate'   => true,
                    'autocomplete' => 'off'
                )); 
            ?>                
                <fieldset>
                  <legend>AGREGAR NUEVO PRODUCTO</legend>
                  <div class="form-group">
                    <label for="inputBrand" class="col-lg-2 control-label">Marca / Descripción</label>
                    <div class="col-lg-10">
                        <?php
                            echo $this->Form->input('name', array(
                                'label' => false,
                                'div' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Ejemplo: Levité Naranja, Sancor Chocolatada, Pureza harina pizza, Patrichs desodorante hombre',
                            ));
                        ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputCode" class="col-lg-2 control-label">Código</label>
                    <div class="col-lg-10">
                        <?php
                            echo $this->Form->input('code', array(
                                'label' => false,
                                'div'   => false,
                                'class'   => 'form-control',
                                'placeholder'   => 'Código de barra o cualquier código que tenga el producto',
                            ));
                        ?>                        
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPresentation" class="col-lg-2 control-label">Presentación</label>
                    <div class="col-lg-4">
                        <?php
                        echo $this->Form->input('presentation', array(
                        //                'label' => __('Presentación') . ' (Ejemplo: Sachet, Lata, Botella vidrio, Frasco, etc.)',
                            'label' => false,
                            'div'   => false,
                            'class' => 'form-control',
                            'empty' => __('Seleccionar presentación'),
                            'type'  => 'select',
                            'options' => $presentations
                        ));
                        ?>                      
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Contenido</label>
                    <div class="col-lg-4">
                        <?php
                        echo $this->Form->input('quantity', array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                            'placeholder' => 'Ej: 500cc, 1 litro, 1 kilo, 500grs, 1 unidad',
                        ));
                        ?>
                    </div>                    
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Precio Costo</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <?php
                            echo $this->Form->input('cost_price', array(
                                'type'  => 'text',
                                'label' => false,
                                'div' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Ej: 125, 12.50 (ingresar sólo números. decimal con punto.)',
                            ));
                          ?>
                        </div>                  
                    </div>                  
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Precio Venta</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <?php
                            echo $this->Form->input('sale_price', array(
                              'type'  => 'text',
                              'label' => false,
                              'div'   => false,
                              'class'   => 'form-control',
                              'placeholder' => 'Calcular según precio de costo. decimal con punto.',
                            ));
                          ?>
                        </div>                  
                    </div>                  
                    <label class="col-lg-2 control-label">Calcular</label>
                    <div class="col-lg-4">
                        <?php
                            echo $this->Form->input('calculate_percent', array(
                                'label' => false,
                                'div'   => false,
                                'class' => 'form-control',
                                'empty' => __('Seleccione un porcentaje'),
                                'type'  => 'select',
                                'options' => Configure::read('PERCENTAGES_PRICES')
                            )); 

                            // hidden    
                            echo $this->Form->hidden('percentage', array(
                                'id'   => 'percentage_applied'
                            ));
                        ?>
                    </div>                  
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2"></label>
                    <input type="checkbox" name="checkbox" id="checkbox5" class="ciengramos" />
                    <div class="col-lg-4">
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <?php
                            echo $this->Form->input('Product.price_per_grams', array(
                              'label' => false,
                              'div'   => false,
                              'class'   => 'form-control grams',
                              'placeholder' => 'Precio de los 100 gramos',
                            ));
                          ?>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                        <div class="col-lg-12">
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
