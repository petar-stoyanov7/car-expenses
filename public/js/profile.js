var $userId;
var $pwd1;
var $pwd2;
var $firstName;
var $lastName;
var $email;
var $city;
var $oldPwd;
var $sex;
var $currentUser;

var userCache = {};

var _resetUserForm = function() {
    $userId.val('');
    $userId.val('');
    $pwd1.val('');
    $pwd2.val('');
    $firstName.val('');
    $lastName.val('');
    $email.val('');
    $city.val('');
    $oldPwd.val('');
};

var _closeModal = function()
{
    $('#black-overlay').hide();
    $('#user-form-modal').hide();
};

var _addErrorClass = function(element)
{
    element.closest('div.form-wrapper').addClass('form-error');
};

var _toggleUserModal = function()
{
    $('#black-overlay').toggle();
    $('#user-form-modal').toggle();
};

var _checkForm = function()
{
    var isValid = true;

    $('#account-edit-form div.form-wrapper').removeClass('form-error');

    if ($pwd1.val() !== $pwd2.val()) {
        _addErrorClass($pwd1);
        _addErrorClass($pwd2)
        isValid = false;
    }
    if ($firstName.val() === '') {
        _addErrorClass($firstName);
        isValid = false;
    }
    if ($lastName.val() === '') {
        _addErrorClass($lastName);
        _addErrorClass($lastName);
    }
    if ($city.val() === '') {
        _addErrorClass($city);
        isValid = false;
    }
    return isValid;
};

var _resetPage = function(data)
{
    $('#profile-user-id').val(data['user-id']);
    $('#profile-username').text(data['username']);
    $('#profile-name').text(data['firstname'] + ' ' + data['lastname']);
    $('#profile-email').text(data['$email']);
    $('#profile-city').text(data['$city']);
    $('#edit-user').attr(
        'onclick',
        'drawUserForm(' + data['user-id'] + ');'
    );
    $oldPwd.val('');
};

var renderUser = function(userId)
{
    _startLoading();
    if (undefined === userCache[userId]) {
        $.ajax({
            type: 'POST',
            url: '/account/get-user-info',
            dataType: 'JSON',
            data: {
                userId: userId
            },
            error: function(response) {
                console.log('Error with user data extraction');
                console.log(response);
                _stopLoading();
            },
            success: function(data) {
                userCache[userId] = data;
            }
        }).done(function(){
            _resetPage(userCache[userId]);
            _stopLoading();
        });
    } else {
        _resetPage(userCache[userId]);
        _stopLoading();
    }
};

var drawUserForm = function(userId)
{
    _toggleUserModal();
    var user = userCache[userId];
    $('#username').val(user['username']);
    $('#email1').val(user['email']);
    $('#firstname').val(user['firstname']);
    $('#lastname').val(user['lastname']);
    $('#city').val(user['city']);
    $('#sex').val(user['sex']);
    $('#user-id').val(user['user-id'])
};

var editUser = function()
{
    var success = false;
    if (_checkForm()) {
        _startLoading();
        var userId = $userId.val();
        var newValues = {
            'old-password': $oldPwd.val(),
            'firstname': $firstName.val(),
            'lastname': $lastName.val(),
            'sex': $sex.val(),
            'city': $city.val(),
            'email': $email.val(),
            'password1': $pwd1.val(),
            'password2': $pwd2.val(),
            'user-id': userId
        };
        $.ajax({
            type: 'POST',
            url: '/account/edit',
            dataType: 'JSON',
            data: newValues,
            error: function(response) {
                console.log('error with user edit');
                console.log(response);
                _stopLoading();
            },
            success: function(data){
                success = data['success'];
                userCache[userId] = newValues;
            }
        }).done(function(){
            _stopLoading();
            _toggleUserModal();
            _resetPage(newValues);
        });
    }
};

$(function(){
    $pwd1 = $('#password1');
    $pwd2 = $('#password2');
    $firstName = $('#firstname');
    $lastName = $('#lastname');
    $email = $('#email1');
    $city = $('#city');
    $oldPwd = $('#old-password');
    $userId = $('#user-id');
    $sex = $('#sex');
    $currentUser = $('#profile-user-id');

    $('#account-edit-form').submit(function(e){
        e.preventDefault();
        editUser();
    });

    if ($currentUser.val() !== '') {
        renderUser($currentUser.val());
    }
});