$(document).ready(function(){
    $(".tags_select_product").select2({
        tags: true,
        tokenSeparators: [','],
    })
    $(".discount_select").select2({
        'placeholder': 'Select the values'
    })
    $('.role_select2').select2({
        'placeholder': 'Select the roles'
    })
});