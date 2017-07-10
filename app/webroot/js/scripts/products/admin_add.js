$(function(){
    
     $("#ProductCalculatePercent").change(function () {
        var percent = $(this).val();
        var priceCost = $("#ProductCostPrice").val();
        priceCost = priceCost.replace(",", ".");
        
        if (priceCost !== '') {
			var priceCalculated = priceCost*percent/100;
            $('#ProductSalePrice').val(parseFloat(priceCalculated)+parseFloat(priceCost));
            $('#percentage_applied').val(percent);
        } else if (priceCost === '') {
            alert('Debe ingresar un precio de costo');
        }
    });
    
    // calcular 100 gramos de producto
    $( '#checkbox5' ).on( 'click', function() {
        var salePrice = $('#ProductSalePrice').val();
        salePrice = salePrice.replace(",", ".");
        
        if( $(this).is(':checked') ){
            $(".grams").val(100*salePrice/1000);
        } else {
            $(".grams").val('');
        }
    });
	
	$("#ProductName").autocomplete({
		source: "autoComplete",
		minLength: 4
	});

});