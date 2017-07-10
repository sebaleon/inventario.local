<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
        <?php if (!empty($seo['title'])): ?>
            <title><?php echo $seo['title']; ?></title>
            <meta name="title" content="<?php echo $seo['title']; ?>" />
        <?php endif; ?>
        <?php if (!empty($seo['description'])): ?>
            <meta name="description" content="<?php echo $seo['description']; ?>" />
        <?php endif; ?>
        <?php if (!empty($seo['keywords'])): ?>
            <meta name="keywords" content="<?php echo $seo['keywords']; ?>" />
        <?php endif; ?>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array(
                    'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
                    'bootstrapFlatly.min',
                    'cake-styles',
                    'dashboard',
					'jquery-ui',
                    'dataTables.bootstrap',
//                    'https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css'
                    ));
		echo $this->Html->script(array(
//                    'plugins/jquery',
                    'plugins/jquery-min',
                    'plugins/jquery.dataTables',
                    'plugins/dataTables.bootstrap.min',
                    'plugins/modal',
                    'plugins/jquery-ui',
                    'scripts/app',
                    ));

	?>
  <!--
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  -->
        
</head>
<body>
    
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <!--<a class="navbar-brand" href="#">titulo</a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a class="navbar-brand" href="#">Control de Stock v1.0</a></li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul id="averga" class="nav nav-sidebar">
            <?php
                $active = '';
                if ( ($this->params['controller'] == 'products')
                       && ($this->params['action'] == 'admin_index') ) {
                        $active = 'active';
                }
            ?>
            <li class="<?php echo $active;?>">
                <?php
                    echo $this->Html->link(
                        'PRODUCTOS',
                        array(
                            'controller' => 'products',
                            'action' => 'admin_index',
                            'full_base' => true,
                        )
                    );
                ?>

            </li>
            
            <?php
                $active = '';
                if ( ($this->params['controller'] == 'products')
                       && ($this->params['action'] == 'admin_add') ) {
                        $active = 'active';
                }
            ?>
            <li class="<?php echo $active;?>">
                
                <?php
                    echo $this->Html->link(
                        'AGREGAR PRODUCTO',
                        array(
                            'controller' => 'products',
                            'action' => 'add',
                            'full_base' => true
                        )
                    );
                ?>
            </li>
          </ul>
            
            
          <ul class="nav nav-sidebar">
            <?php
                $active = '';
                if ( ($this->params['controller'] == 'expirations')
                       && ($this->params['action'] == 'admin_index') ) {
                        $active = 'active';
                }
            ?>
            <li class="<?php echo $active;?>">
                
                <?php
                    echo $this->Html->link(
                        'VENCIMIENTOS',
                        array(
                            'controller' => 'expirations',
                            'action' => 'index',
                            'full_base' => true
                        )
                    );
                ?>
            </li>
            <?php
                $active = '';
                if ( ($this->params['controller'] == 'expirations')
                       && ($this->params['action'] == 'admin_add') ) {
                        $active = 'active';
                }
            ?>
            <li class="<?php echo $active;?>">
                
                <?php
                    echo $this->Html->link(
                        'AGREGAR VENCIMIENTO',
                        array(
                            'controller' => 'expirations',
                            'action' => 'add',
                            'full_base' => true
                        )
                    );
                ?>
            </li>
          </ul>
            
            <ul class="nav nav-sidebar"></ul>
            
            <ul class="nav nav-sidebar">
                <li><a href="/users/logout">SALIR</a></li>
            </ul>  
            
        </div>
    </div>    
    </div>    
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            
          <?php echo $this->Flash->render(); ?>
        
            <?php echo $this->element('Expirations/alerts');?>
        
          <?php echo $this->fetch('content'); ?>
        
    </div>          
          
        
	<?php
        echo $this->element('sql_dump');
        echo $this->fetch('plugins');
        echo $this->fetch('script');
        ?>
</body>
</html>
