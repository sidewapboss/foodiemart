$(document).ready(() => {
    const loginNotification = $('.loginNotification');
    const passwordNotification = $('.passwordNotification');
    const handleNotification = (type, message, className) => {
        if(type === 1){
            loginNotification.removeClass('alert alert-warning alert-success');
            loginNotification.text('');
            loginNotification.addClass(`alert ${className}`);
            loginNotification.text(message);
        }else if(type === 2){
            passwordNotification.removeClass('alert alert-warning alert-success');
            passwordNotification.text('');
            passwordNotification.addClass(`alert ${className}`);
            passwordNotification.text(message);
        }
        $("#mode1").addClass("none");
		$("#mode2").addClass("none");
    }
    $('loginNow').submit((e) => {
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const email = $('.loginEmail').val();
        const password = $('.loginPassword').val();
        {email ? null : handleNotification(1, 'Email field can not be empty', 'alert alert-warning')}
        {password ? null : handleNotification(1, 'Password field can not be empty', 'alert alert-warning')}
        $.post('mint?action=login', {email: email, password: password}, (data) => {
            handleNotification(1, data.message, '')
        });
    });
});