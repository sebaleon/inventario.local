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
                )); 
            ?>                
                <fieldset>
                  <legend>AGREGAR NUEVO PRODUCTO</legend>
                  <div class="form-group">
                    <label for="inputBrand" class="col-lg-2 control-label">Marca / Descripcion</label>
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
                    <label for="inputCode" class="col-lg-2 control-label">Codigo</label>
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
                    <label for="inputPresentation" class="col-lg-2 control-label">Presentacion</label>
                    <div class="col-lg-4">
                        <?php
                        echo $this->Form->input('presentation', array(
                        //                'label' => __('Presentación') . ' (Ejemplo: Sachet, Lata, Botella vidrio, Frasco, etc.)',
                            'label' => false,
                            'div'   => false,
                            'class' => 'form-control',
                            'empty' => __('Seleccionar presentación'),
                            'type'  => 'select',
                            'options' => Configure::read('PRESENTATION_TYPES')
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
                                'type'  => 'number',
                                'label' => false,
                                'div' => false,
                                'class' => 'form-control',
                                'placeholder' => 'Ej: 125 (ingresar sólo números con punto o coma)',
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
                              'type'  => 'number',
                              'label' => false,
                              'div'   => false,
                              'class'   => 'form-control',
                              'placeholder' => 'Calcular según precio de costo',
                            ));
                          ?>
                        </div>                  
                    </div>                  
                    <label class="col-lg-2 control-label">Calcular</label>
                    <div class="col-lg-4">
                        <?php
                            $options = array();
                            for( $i=10; $i<=99; $i++ ){
                                $options['1.'.$i] = $i.'%';
                            }
                            $options['2'] = '100%';

                                echo $this->Form->input('calculate_percent', array(
                                    'label' => false,
                                    'div'   => false,
                                    'class' => 'form-control',
                                    'empty' => __('Seleccione un porcentaje'),
                                    'type'  => 'select',
                                    'options' => $options
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
                            echo $this->Form->input('Price.price_per_grams', array(
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
                        <div class="col-sm-12">
                        <?php
                            echo $this->Form->button('Agregar', array(
                                'type' => 'submit',
                                'class' => 'btn btn-success pull-right',
                                'div' => false,
                                'label' => false
                                ));
                        ?> 
                        </div>                  
                  </div>
                </fieldset>
            <?php
                echo $this->Form->end();
            ?>
            </div>
          </div>
</div>
