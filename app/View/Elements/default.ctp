<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    echo $this->Html->charset();
    echo $this->element('Layouts/headers');
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->Html->css('admin/cake.generic');
    echo $this->Html->css('admin/custom.generic');
    echo $this->Html->css('plugins/jquery.ui/ui-lightness/jquery.ui.css');
    echo $this->fetch('css');
    ?>
    <style type="text/css">body{margin-top:0;}#content{margin:0;}</style>
</head>
<body>
    <div id="container">
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
    <?php 
    echo $this->Html->script(array('plugins/jquery.js',
                                   //'plugins/jquery.ui/jquery.ui',
                                   'plugins/jquery.tools.js'),
                             array('block' => 'script'));
    echo $this->fetch('script');
    echo $this->element('sql_dump');
    ?>
</body>
</html>
