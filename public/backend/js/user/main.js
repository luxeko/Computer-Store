$(function(){
    $(document).ready(function(){
        $('#collapsePermission').addClass('show');
        $('.user_active').addClass('active');
        $("#user_alert").show().delay(5000).fadeOut();
        $('.address_form').hide();
        $(".form-check-input").click(function() {
            if($(this).is(":checked")) {
                $(".address_form").show(300);
            } else {
                $(".address_form").hide(200);
            }
        });
    });
})