$(function(){
    
    // replica inputs en agregar orden
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 0; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group number-'+x+'"><div class="col-lg-2"><input name="data[orderlist]['+x+'][quantity]" class="form-control" placeholder="Cantidad" id="orderlist'+x+'Quantity" type="text"></div><div class="col-lg-4"><input name="data[orderlist]['+x+'][description]" class="form-control" placeholder="Descripcion" id="orderlist'+x+'Description" type="text"></div><div class="col-lg-4"><div class="input-group"><div class="input-group-addon">Precio &nbsp;&nbsp;&nbsp;$</div><input name="data[orderlist]['+x+'][price]" class="form-control sumtotal" autocomplete="off" placeholder="Precio" id="orderlist'+x+'Price" type="text"></div></div><a href="#" class="remove_field btn btn-danger" data-remove="'+x+'">Eliminar item</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
//        alert($(this).parent('.numer'+x));
//        $(this).parent('div').remove();
        var divDel = $(this).data("remove"); // numero de add
        var priceField = $("#orderlist"+divDel+"Price").val(); // precio individual del input price
        var totalPrice = $(".totalPrice").val(); // suma total de los precios
        
//        alert(priceField);
        $('.number-'+divDel).remove();
        
        if (totalPrice > 0) {
            var newTotalPrice = totalPrice - priceField;
            $(".totalPrice").val(newTotalPrice);
        }
        
        x--;
        // si elimino
    });
    
    // calcula suma total de precios al agregar una orden
    $("#sumtest").on('input', '.sumtotal', function (e) {
        e.preventDefault();
        var calculated_total_sum = 0;
        $("#sumtest .sumtotal").each(function () {
           var get_textbox_value = Number($(this).val());
            if ($.isNumeric(get_textbox_value)) {
                calculated_total_sum += get_textbox_value;
            }                  
        });
        $(".totalPrice").val(calculated_total_sum);
    });  
    
    // calcular saldo de una orden
    $( '.calculate-rest-pay' ).on( 'click', function(e) {
        e.preventDefault();
        var totalPrice = $("#OrderAmount").val(); // total de la compra
        var partPay = $('#OrderPartPay').val(); // entrega
        
        $("#OrderRestPay").val(totalPrice-partPay);
    });    
    
});    