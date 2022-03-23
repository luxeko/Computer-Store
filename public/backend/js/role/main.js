$(function(){
    $(document).ready(function(){
        $('.checkbox_wrapper').on('click', function (){
            $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'))
        })
        $('.checked_all').on('click', function (){
            if($(this).is(":checked")) {
                $(".checkbox_wrapper").prop('checked', true);
                $(".checkbox_childrent").prop('checked', true);
            } else {
                $(".checkbox_wrapper").prop('checked', false);
                $(".checkbox_childrent").prop('checked', false);
            }
        })
    });
    $(document).ready(function(){
        $('#collapsePermission').addClass('show');
        $('.role_active').addClass('active');
        $("#role_alert").show().delay(5000).fadeOut();
    });
})