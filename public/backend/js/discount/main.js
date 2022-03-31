$(function(){
    $(document).ready(function(){
        $('.manage_active').addClass('show');
        $('.active_discount').addClass('active');
        $(".manage_show").css('display', 'block')
        $(".discount_alert").show().delay(5000).fadeOut();
    });
    $('#apply_for').change(function(){
        let select_category = $(this).children("option:selected").val();
        if(select_category === 'Category' ){
            $('.list_category').prop('hidden', false);
            $('.list_product').prop('hidden', true);
        } 
        if(select_category === 'Product'){
            $('.list_product').prop('hidden', false);
            $('.list_category').prop('hidden', true);
        }
        if(select_category === ''){
            $('.list_category').prop('hidden', true);
            $('.list_product').prop('hidden', true);
        }
    })
    $('#apply_for option').each(function(){
        if($(this).is(':selected')){
            // console.log(this.value);
            if(this.value === 'Category' ){
                $('.list_category').prop('hidden', false);
                $('.list_product').prop('hidden', true);
            } 
            if(this.value === 'Product'){
                $('.list_product').prop('hidden', false);
                $('.list_category').prop('hidden', true);
            }
            if(this.value === ''){
                $('.list_category').prop('hidden', true);
                $('.list_product').prop('hidden', true);
            }
        }
    })
    $('#discount_type').change(function(){
        let select_discount = $(this).children("option:selected").val();
        // console.log(select_discount);
        if(select_discount === 'Price'){
            $('.discount_price').prop('hidden', false);
            $('.discount_percent').prop('hidden', true);
        } 
        if(select_discount === 'Percent'){
            $('.discount_percent').prop('hidden', false);
            $('.discount_price').prop('hidden', true);
            $('#discount_percent').keyup(function(){
                let value = $('#discount_percent').val();
                if(value > 100 || value < 0){
                    $('.error_percent').prop('hidden', false);
                    $('.error_percent').html('The percentage must be between 0% and 100%!').addClass("text-danger").addClass('fw-bold').addClass('mt-2');
                } else {
                    $('.error_percent').prop('hidden', true);
                    $('.error_percent').html('').removeClass("text-danger").removeClass('fw-bold').removeClass('mt-2');
                }
            })
        }
        if(select_discount === ''){
            $('.discount_price').prop('hidden', true);
            $('.discount_percent').prop('hidden', true);
        }
    })
    $('#discount_type option').each(function(){
        if($(this).is(':selected')){
            // console.log(this.value);
            if(this.value === 'Price'){
                $('.discount_price').prop('hidden', false);
                $('.discount_percent').prop('hidden', true);
            } 
            if(this.value === 'Percent'){
                $('.discount_percent').prop('hidden', false);
                $('.discount_price').prop('hidden', true);
                $('#discount_percent').keyup(function(){
                    let value = $('#discount_percent').val();
                    if(value > 100 || value < 0){
                        $('.error_percent').prop('hidden', false);
                        $('.error_percent').html('The percentage must be between 0% and 100%!').addClass("text-danger").addClass('fw-bold').addClass('mt-2');
                    } else {
                        $('.error_percent').prop('hidden', true);
                        $('.error_percent').html('').removeClass("text-danger").removeClass('fw-bold').removeClass('mt-2');
                    }
                })
            }
            if(this.value === ''){
                $('.discount_price').prop('hidden', true);
                $('.discount_percent').prop('hidden', true);
            }
        }
    })
})