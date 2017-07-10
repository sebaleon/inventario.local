$(function(){
    
    $('.close-alert').on('click',function(){
        var alertId = $(this).attr('id');
        $.ajax({                                           
            type: 'POST',
            data: {id: alertId},
            url:  '/admin/expirations/updateExpiration',
//            dataType:"json",
            success: function() {
                $("#alert-"+alertId).hide();
            }
        });
    });
    
    $('.close-alert-flash').on('click',function(){
        $(".alert-info").hide();
    });

});
