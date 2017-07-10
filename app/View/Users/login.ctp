<div class="account-wall">
    <?php echo $this->Form->create('User', array('class' => "form-signin",
                                                 'type' => 'post',
                                                 'div' => false)); ?>
        <h2 class="form-signin-heading">Iniciar sesión</h2>
            <?php echo $this->Session->flash('auth'); ?>
        <label for="inputEmail" class="sr-only">Usuario</label>
            <?php echo $this->Form->input('username', array(
                'id'    => 'inputEmail',
                'class' => 'form-control',
                'div' => false,
                'label' => false,
                'value' => 'admin',
                'placeholder' => 'Usuario'
            )); ?>
        <label for="inputPassword" class="sr-only">Password</label>
            <?php echo $this->Form->input('password', array(
                'id'    => 'inputPassword',
                'class' => 'form-control',
                'div' => false,
                'label' => false,
                'value' => '123456',
                'placeholder' => 'Contraseña'
            )); ?>
    <?php
        echo $this->Form->button('Entrar', array(
            'type' => 'submit',
            'class' => 'btn btn-lg btn-primary btn-block',
            'div' => false,
            'label' => false
            ));
        echo $this->Form->end();
    ?>        
</div>