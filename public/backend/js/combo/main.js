$(function(){
    $(document).ready(function(){
        $('#collapseOne').addClass('show');
        $('.combo_active').addClass('active');
        $("#combo_alert").show().delay(5000).fadeOut();

    });
    $(document).ready(function(){
        $('input.numberformat').keyup(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;
    
            // format number
            $(this).val(function(index, value) {
            return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            ;
            });
        });
    
    })
    $(document).ready(function(){
      
    })
    
})