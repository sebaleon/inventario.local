<?php echo $this->Html->script(array(
//                                    'plugins/jquery.selecttocombo',
//                                    //'plugins/jquery.validate',
//                                    //'plugins/jquery.validate.rules',
//                                    'plugins/jquery.dataTables.js',
//                                    'plugins/demo.js',
//                                    'plugins/shCore.js',
                                    ), 
                                    array('block' => 'plugins')); ?>

<?php
//pr($product);die;
echo $this->Form->create('Product', array(
    'url' => array('controller' => 'products', 'action' => 'change_price'),
    'type' => 'post'
)); ?>

    <?php
        echo $this->Form->hidden('id', array(
            'label' => false,
            'div' => false,
            'value' => $product['Product']['id']
        ));
    ?> 

    <?php
        echo $this->Form->input('new_cost_price', array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
            'placeholder' => 'p c',
        ));
    ?> 

    <?php
        echo $this->Form->input('new_sale_price', array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
            'placeholder' => 'p v',
        ));
    ?>  

    <?php
        echo $this->Form->input('new_percentage_applied', array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
            'placeholder' => '%',
        ));
    ?>    

    <?php
        echo $this->Form->input('new_price_per_grams', array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
            'placeholder' => 'grs',
        ));
    ?>    
        
<?php echo $this->Form->end(__('Cambiar')); ?>