var showUserModal = function(userId)
{
    $('#black-overlay').show();
    $('#user-summary-modal').show();
    renderUser(userId);
};


$(function(){
    $('tr.table-user-row').click(function(){
        var userId = $(this).attr('userId');
        showUserModal(userId);
    });
});