var loadingCounter = 0;

var _startLoading = function() {
    loadingCounter++;
    if (loadingCounter <= 1) {
        $('#form-black-overlay').show();
        $('#loading-message').show();
    }
};

var _stopLoading = function() {
    loadingCounter--;
    if (loadingCounter <= 0) {
        $('#form-black-overlay').hide();
        $('#loading-message').hide();
    }
};

$(function(){
    var blackOverlay = $('#black-overlay');
    var loginModal = $('#user-login-modal');
    var registerModal = $('#user-register-modal');


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