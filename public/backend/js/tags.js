$(document).ready(function(){
    $(".tags_select_choose").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
    $('.role_select2').select2({
        'placeholder': 'Chọn vai trò'
    })
});