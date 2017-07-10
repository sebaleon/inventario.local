(function($) {
    $('#listproviders').DataTable( {
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 1 ],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [ 2 ],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [ 3 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 4 ],
                "visible": true,
                "searchable": true
            },
            {
                "targets": [ 5 ],
                "visible": true,
                "searchable": false
            },
            {
                "targets": [ 6 ],
                "visible": true,
                "searchable": false
            },
        ],                    
        "ordering": false,
        "paging":   false,
        "info":     false,
    //                    "scrollY":        "400px",
    //                    "scrollCollapse": true,
        "language": {
            "sSearch": "<span class='clean-search' style='cursor: pointer;'>Limpiar</span>",
            "oPaginate": {
                    "sFirst":    	"Primero",
                    "sPrevious": 	"Anterior",
                    "sNext":     	"Siguiente",
                    "sLast":     	"Último"
            },
        "info":             "Mostrando página _PAGE_ de _PAGES_",
        "sInfoPostFix":  	"",
        "sInfoThousands":  	".",
        "lengthMenu":       "Mostrando _MENU_ resultados por página",
        "sProcessing":   	"Procesando...",
        "sZeroRecords":  	"NO SE ENCONTRARON RESULTADOS",
        }
    } );                


    $('#listproviders tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

     // limpiar buscador
    $('.clean-search').click(function(e){
        var table = $('#listproviders').DataTable();
            table
                .search( '' )
                .columns().search( '' )
                .draw();
    });
    
})(jQuery);