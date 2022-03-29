$(function(){
    $(document).ready(function(){
        $('.manage_active').addClass('show');
        $('.active_product').addClass('active');
        $(".manage_show").css('display', 'block')
        $(".product_alert").show().delay(5000).fadeOut();
    });
    // $(document).ready(function(){
    //     $(".add_discount").click(function() {
    //         if($(this).is(":checked")) {
    //             $("#price_after_discount").attr('hidden', false).hide().delay(700).fadeIn(500);
    //             $("#discount_check").attr('hidden', false).hide().delay(100).fadeIn();
    //         } else {
    //             $("#price_after_discount").delay(100).attr('hidden', true);
    //             $("#discount_check").delay(700).attr('hidden', true);
    //         }
    //     });

    //     $('.price_after_discount').key('up', function(){
            
    //     })
    // })
    $(document).ready(function(){
        $('#thumbnails').change(function(){
            var err = '';
            var file = $('#thumbnails')[0].files;
            console.log(file);
            if(file.length > 5){
                err += '<p>You are only allowed to choose up to 5 images</p>'
            } else if(file.size > 2000000){
                err += '<p>The size of the image should not be more than 2MB</p>'
            } else if(file.length < 3){
                err += '<p>Number of images should not be less than 3</p>'
            }
            if(err === ''){
                $('#err_thumbnail').hide(0);
            } else {
                $('#thumbnails').val('');
                $('#err_thumbnail').html(`<span class="text-danger">${err}</span>`)
                return false
            } 
        })
    });
  
})