$(function(){
    var blackOverlay = $('#black-overlay');
    var loginModal = $('#user-login-modal');
    var registerModal = $('#user-register-modal');

    // $('.toggleable-modal').hide();

    $('#login-button').click(function(){
        blackOverlay.show();
        loginModal.show();
    });

    $('#register-button').click(function(){
        blackOverlay.show();
        registerModal.show();
    });


    blackOverlay.click(function(){
        blackOverlay.hide();
        $('.toggleable-modal').hide();
    });
});