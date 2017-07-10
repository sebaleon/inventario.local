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
//            pr($provider);die;
                echo $this->Form->create('Order', array(
                    'class' => 'form-horizontal',
                    'role'  => 'form',
                )); 
                
                echo $this->Form->hidden('provider_id', array(
                    'label' => false,
                    'div' => false,
                ));                
            ?>                
                <fieldset>
                    <legend>AGREGAR NUEVA ORDEN</legend>
                    <div id="sumtest" class="input_fields_wrap prices">
                        <div class="form-group">
                            <div class="col-lg-2">
                                  <?php
                                    echo $this->Form->input('orderlist.'. '0' .'.quantity', array(
                                      'label' => false,
                                      'div'   => false,
                                      'class'   => 'form-control',
                                      'placeholder' => 'Cantidad',
                                    ));
                                  ?>
                            </div>                  
                            <div class="col-lg-4">
                                <?php
                                    echo $this->Form->input('orderlist.'. '0' .'.description', array(
                                      'label' => false,
                                      'div'   => false,
                                      'class'   => 'form-control',
                                      'placeholder' => 'Descripcion',
                                    ));
                                ?>
                            </div>                  
                            <div class="col-lg-4">
                                <div class="input-group">
                                  <div class="input-group-addon">Precio &nbsp;&nbsp;&nbsp;$</div>
                                <?php
                                    echo $this->Form->input('orderlist.'. '0' .'.price', array(
                                      'label' => false,
                                      'div'   => false,
                                      'class'   => 'form-control sumtotal',
                                      'placeholder' => 'Precio',
                                      'autocomplete' => "off"
                                    ));
                                ?>
                                </div>                  
                            </div>                  
                 
                            <button class="add_field_button btn btn-info">Agregar item</button>
                        </div>
                    </div>    
                    
                    <div class="form-group">
                        <div class="col-lg-2">
                        </div>                  
                        <div class="col-lg-4">
                        </div>                  
                        <div class="col-lg-4">
                            <div class="input-group">
                              <div class="input-group-addon">Total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$</div>
                                <?php
                                    echo $this->Form->input('amount', array(
                                      'label' => false,
                                      'div'   => false,
                                      'class'   => 'form-control totalPrice',
                                      'placeholder' => 'Total',
                                      'autocomplete' => "off"
                                    ));
                                ?>
                            </div>                  
                        </div>                  
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2">
                        </div>                  
                        <div class="col-lg-4">
                        </div>                  
                        <div class="col-lg-4">
                            <div class="input-group">
                              <div class="input-group-addon">Entrega $</div>
                                <?php
                                    echo $this->Form->input('part_pay', array(
                                      'label' => false,
                                      'div'   => false,
                                      'class'   => 'form-control partPay',
                                      'placeholder' => 'Entrega',
                                      'autocomplete' => "off"  
                                    ));
                                ?>
                            </div>                  
                        </div>                  
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2">
                        </div>                  
                        <div class="col-lg-4">
                        </div>                  
                        <div class="col-lg-4">
                            <div class="input-group">
                              <div class="input-group-addon">Saldo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$</div>
                                <?php
                                    echo $this->Form->input('rest_pay', array(
                                      'label' => false,
                                      'div'   => false,
                                      'class'   => 'form-control restPay',
                                      'placeholder' => 'Saldo',
                                      'autocomplete' => "off"  
                                    ));
                                ?>
                            </div>        
                        </div>                  
                        <?php
                        echo $this->Form->button('Calcular saldo', array(
                            'label' => false,
                            'div' => false,
                            'class' => 'calculate-rest-pay btn btn-info',
                        ));
                        ?>
                    </div>
                    
                  <div class="form-group">
                    <label for="inputComments" class="col-lg-2 control-label">Aclaraciones</label>
                    <div class="col-lg-10">
                        <?php
                            echo $this->Form->input('comments', array(
                                'label' => false,
                                'div'   => false,
                                'class'   => 'form-control',
                            ));
                        ?>                        
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
