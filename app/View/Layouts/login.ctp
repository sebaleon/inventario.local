<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <?php
//    die('asdasd');
    echo $this->Html->charset();
//    echo $this->element('Layouts/headers');
    echo $this->Html->meta('icon');
    echo $this->Html->meta(array('name'=>'viewport','content'=>'width=device-width,initial-scale=1'));
    echo $this->fetch('meta');
    echo $this->Html->css(array(
        'bootstrapFlatly.min',
        'bootstrap.min',
        'login',
        ));
    echo $this->Html->script(array(
        'plugins/jquery',
        'plugins/bootstrap.min',
        'plugins/npm',
        ));    
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    
</head>
<body>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div> <!-- /container -->    
</body>
</html>
