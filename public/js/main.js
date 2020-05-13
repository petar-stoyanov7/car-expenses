var loadingCounter = 0;
var $blackLvl1;
var $blackLvl2;
var $blackLvl3;
var $loadingBlack;
var $loadingMessage;

var _startLoading = function() {
    loadingCounter++;
    if (loadingCounter <= 1) {
        $loadingBlack.show();
        $loadingMessage.show();
    }
};

var _stopLoading = function() {
    loadingCounter--;
    if (loadingCounter <= 0) {
        $loadingBlack.hide();
        $loadingMessage.hide();
    }
};



var _toggleBlack1 = function()
{
    $blackLvl1.toggle();
};

var _toggleBlack2 = function()
{
    $blackLvl2.toggle();
};

var _toggleBlack3 = function()
{
    $blackLvl3.toggle();
};

$(function(){
    $blackLvl1 = $('#black-lvl-1');
    $blackLvl2 = $('#black-lvl-2');
    $blackLvl3 = $('#black-lvl-3');
    $loadingBlack = $('#loading-black');
    $loadingMessage = $('#loading-message');
    var loginModal = $('#user-login-modal');
    var registerModal = $('#user-register-modal');


    $('#login-button').click(function(){
        $blackLvl1.show();
        loginModal.show();
    });

    $('#register-button').click(function(){
        $blackLvl1.show();
        registerModal.show();
    });

    $blackLvl1.click(function(){
        $('.modal-lvl-1').hide();
        $blackLvl1.hide();
    });

    $blackLvl2.click(function(){
        $('.modal-lvl-2').hide();
        $blackLvl2.hide();
    });

    $blackLvl3.click(function(){
        $('.modal-lvl-3').hide();
        $blackLvl3.hide();
    });

});