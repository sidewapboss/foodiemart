$(document).ready(() => {
    const loginNotification = $('.loginNotification');
    const passwordNotification = $('.passwordNotification');
    const handleNotification = (type, message, className) => {
        loginNotification.removeClass('alert alert-warning alert-success');
        loginNotification.text('');
        passwordNotification.removeClass('alert alert-warning alert-success');
        passwordNotification.text('');
        if(type === 1){
            loginNotification.addClass(`alert ${className}`);
            loginNotification.text(message);
        }else if(type === 2){
            passwordNotification.addClass(`alert ${className}`);
            passwordNotification.text(message);
        }
        $("#mode1").addClass("none");
		$("#mode2").addClass("none");
    }
    $('.loginNow').submit((e) => {
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const email = $('.loginEmail').val();
        const password = $('.loginPassword').val();
        {email ? null : handleNotification(1, 'Email field can not be empty', 'alert alert-warning')}
        {password ? null : handleNotification(1, 'Password field can not be empty', 'alert alert-warning')}
        $.post('mint?action=login', {email: email, password: password}, (data) => {
            if(data.status === 1){
                handleNotification(1, data.message, 'alert-success');
                window.location = 'dashboard';
            }else if(data.status === 0){
                handleNotification(1, data.message, 'alert-warning');
            }
        });
    });
    $('.passwordNow').submit((e) => {
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const email = $('.passwordEmail').val();
        {email ? null : handleNotification(1, 'Email field can not be empty', 'alert alert-warning')}
        $.post('mint?action=requestPassword', {email: email}, (data) => {
            if(data.status === 1){
                handleNotification(2, data.message, 'alert-success');
            }else if(data.status === 0){
                handleNotification(2, data.message, 'alert-warning');
            }
        });
    });
});