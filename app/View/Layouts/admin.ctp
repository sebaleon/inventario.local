<!DOCTYPE html>
<html lang="es">
    
	<!--<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.3.min.js"></script>-->
    <head>
            <?php
        echo $this->Html->charset();
//        echo $this->element('Layouts/headers');
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        echo $this->Html->css(array('style.css', 'bootstrap.min.css', 'bootstrap-theme.css',
            'dataTables.bootstrap.min.css', 
            ));
        echo $this->Html->script(array(
                                       'plugins/jquery',
                                       'plugins/jquery.dataTables.min.js',
                                       'plugins/bootstrap.min.js',
                                       'plugins/docs.min.js',
                                   ));
        ?>
        
  	<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
//                $('#example').DataTable();
                
                $('#lisproducts').DataTable( {
                    "scrollY":        "500px",
                    "scrollCollapse": true,
                    "paging":         false,
                    "language": {
                        "sSearch": "Buscar producto",
                        "oPaginate": {
                                "sFirst":    	"Primero",
                                "sPrevious": 	"Anterior",
                                "sNext":     	"Siguiente",
                                "sLast":     	"Último"
                        },
                    "info":                 "Mostrando página _PAGE_ de _PAGES_",
                    "sInfoPostFix":  	"",
                    "sInfoThousands":  	".",
                    "lengthMenu":       "Mostrando _MENU_ resultados por página",
                    "sProcessing":   	"Procesando...",
                    "sZeroRecords":  	"NO SE ENCONTRARON RESULTADOS PARA EL PRODUCTO SOLICITADO",
                    }
                } );

//                var table = $('#lisproducts').DataTable();
//                $('#lisproducts tbody').on( 'click', 'tr', function () {
//                        if ( $(this).hasClass('selected') ) {
//                                $(this).removeClass('selected');
//                        }
//                        else {
//                                table.$('tr.selected').removeClass('selected');
//                                $(this).addClass('selected');
//                        }
//                } );
//
//                $('#button').click( function () {
//                        table.row('.selected').remove().draw( false );
//                } );
                
                
//                    $('.checkbox_item').on('click', function(){
//        var idItem = $(this).attr('id');
////        alert(idItem);
//        if ($('#hidden-'+idItem).val() === '') {
//            $('#hidden-'+idItem).val('1');
//        } else {
//            $('#hidden-'+idItem).val('');
//        }
//        
//        $('#lisproducts input[type="checkbox"]').each(function() {
//            if ($(this).is(":checked")) {
//                $("#button-change").prop("disabled",false);
////                alert('adsasd');
//    //            anyBoxesChecked = true;
//            } else {
//                $("#button-change").prop("disabled",true);
//            }
//        });
//    });
                
            } );
	

	</script>          
        
    </head>
    <body>
        
        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Bootstrap theme</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li class="dropdown-header">Nav header</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="#">One more separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>        
        
        <div class="container theme-showcase" role="main">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        <?php
        echo $this->fetch('plugins');
        echo $this->fetch('script');
        echo $this->element('sql_dump');
        ?>
    </body>
</html>
