$(function(){
    $(document).ready(function(){
        // const active = document.querySelector(".active_category");
        // active.addEventListener('click', () => {
        $('.manage_active').addClass('active');
        $('.active_category').addClass('active');
        $(".manage_show").css('display', 'block')
        // })
        $("#category_alert").show().delay(8000).fadeOut();
        $(".category_alert").show().delay(8000).fadeOut();
    });
})