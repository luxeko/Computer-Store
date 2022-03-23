$(function(){
    $(document).ready(function(){
        $('input').attr('readonly', true);
        $('textarea').attr('readonly', true);
        $('select').attr('disabled', true);
        $(".profile_update").hide();
        $(".avatar_profile").hide();    
        $(".profile_cancel").hide();

        // $("#profile_alert").show().delay(3000).queue(function(n) {
        //     $(this).hide(); n();
        // });
        
        // $("#profile_alert").show();
        // setTimeout(function() { $("#profile_alert").hide(); }, 5000);
        
        $("#profile_alert").show().delay(5000).fadeOut();
        $("#password_alert").show().delay(5000).fadeOut();

        $(".profile_edit").click(function() {
            $(".profile_update").show(300);
            $(".profile_cancel").show(200);
            $(".avatar_profile").show(200);  
            $(".profile_edit").hide(300);
            $('input').attr('readonly', false);
            $('textarea').attr('readonly', false);
            $('select').attr('disabled', false);
        });
        $(".profile_cancel").click(function() {
            $(".profile_update").hide(300);
            $(".profile_cancel").hide(200);
            $(".profile_edit").show(300);
            $(".avatar_profile").hide(200);  
            $('input').attr('readonly', true);
            $('select').attr('disabled', true);
            $('textarea').attr('readonly', true);
        });
    })
})