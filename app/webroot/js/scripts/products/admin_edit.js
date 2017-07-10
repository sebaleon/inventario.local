$(function(){
    
     $("#PricePercentageApplied").change(function () {
        var percent = $(this).val();
        var priceCost = $("#PriceCostPrice").val();
		priceCost = priceCost.replace(",", ".");
        
        if (priceCost !== '') {
			var priceCalculated = priceCost*percent/100;
            $('#PriceSalePrice').val(parseFloat(priceCalculated)+parseFloat(priceCost));
        } else if (priceCost === '') {
            alert('Debe ingresar un precio de costo');
        }

    });
    
    // calcular 100 gramos de producto
    $( '#checkbox5' ).on( 'click', function() {
        var salePrice = $('#PriceSalePrice').val();
		salePrice = salePrice.replace(",", ".");
        if( $(this).is(':checked') ){
            $(".grams").val(100*salePrice/1000);
        } else {
            $(".grams").val('');
        }
    });

});