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
                )); 
            ?>                
                <fieldset>
                  <legend>
					EDITAR PRODUCTO
					<?php
						if (!empty($this->request->data['Product']['modified'])
							and ($this->request->data['Product']['modified'] != $this->request->data['Product']['created'])) :
							echo " - <i>Última modificación {$this->Time->format($this->request->data['Product']['modified'], '%d/%m/%Y %H:%M:%S')}</i>";
						endif;
					?>
				  </legend>
                  <div class="form-group">
                    <label for="inputBrand" class="col-lg-2 control-label">Marca / Descripciónn</label>
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
                            'label'   => false,
                            'div'     => false,
                            'class'   => 'form-control',
                            'empty'   => __('Seleccionar presentación'),
                            'type'    => 'select',
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
                            echo $this->Form->input('Price.cost_price', array(
							    'type'  => 'text',
                                'label' => false,
                                'div'   => false,
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
                            echo $this->Form->input('Price.sale_price', array(
							  'type'  => 'text',
                              'label' => false,
                              'div'   => false,
                              'class' => 'form-control',
                              'placeholder' => 'Calcular según precio de costo. decimal con punto.',
                            ));
                          ?>
                        </div>                  
                    </div>                  
                    <label class="col-lg-2 control-label">Calcular</label>
                    <div class="col-lg-4">
                        <?php
                            echo $this->Form->input('Price.percentage_applied', array(
                                'label' => false,
                                'div'   => false,
                                'class' => 'form-control',
                                'empty' => __('Seleccione un porcentaje'),
                                'type'  => 'select',
                                'options' => Configure::read('PERCENTAGES_PRICES')
                            )); 

                            // hidden    
                            echo $this->Form->hidden('Price.id');
                        ?>
                    </div>                  
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label"></label>
                    <input type="checkbox" name="checkbox" id="checkbox5" class="ciengramos" />
                    <div class="col-lg-4">
                        <div class="input-group">
                          <div class="input-group-addon">$</div>
                          <?php
                            echo $this->Form->input('Price.price_per_grams', array(
                              'type'  => 'text',
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
                  
                  <hr>
                  
                    <?php if (isset($beforePrice)) :?>
                        <table id="last-price" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead style="background-color: #FA5858">
                                <tr>
                                    <th>Precio Costo Anterior</th>
                                    <th>Precio Venta Anterior</th>
                                    <th>Precio 100 gramos Anterior</th>
                                    <th>Porcentaje Anterior</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #DF0101">
                                <?php
                                $percentage = Configure::read('PERCENTAGES_PRICES');
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                                if (!empty($beforePrice['cost_price'])) {
                                                    echo "$ " . strtoupper($beforePrice['cost_price']);
                                                }
                                            ?>
                                        </td>
                                        <td style="color: red">
                                            <?php 
                                                if (!empty($beforePrice['sale_price'])) {
                                                    echo "$ " . strtoupper($beforePrice['sale_price']);
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if (!empty($beforePrice['price_per_grams'])) {
                                                    echo "$ " . $beforePrice['price_per_grams'];
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if (!empty($beforePrice['percentage_applied'])) {
                                                    echo $percentage[$beforePrice['percentage_applied']];
                                                }
                                            ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>                  
                    <?php endif;?>
                  
                </fieldset>
            <?php
                echo $this->Form->end();
            ?>
            </div>
          </div>
</div>
