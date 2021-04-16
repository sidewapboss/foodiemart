$(document).ready(() => {    
    const notification = $('.adminNotification');
    const handleNotification = (message, className) => {
        notification.removeClass('alert alert-warning alert-success');
        notification.text('');
        notification.removeClass('alert alert-warning alert-success');
        notification.text('');
        notification.addClass(`alert ${className}`);
        notification.text(message);
        $("#mode1").addClass("none");
		$("#mode2").addClass("none");
    }
    $('.updateSettings').submit((e) =>{
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const newCat = $('#upSet');
        const npwd = $('.npwd');
        const datum = new FormData(newCat[0]);
        $.ajax({  
            url: "mint?action=settings",  
            type: "POST",  
            data: datum,
            contentType: false,
            processData:false,
            dataType: 'json',
            success: (data) => {  
                 if(data.status === 1){
                    handleNotification(data.message, 'alert alert-success');
                    npwd.val('');
                 }else if(data.status === 0){
                    handleNotification(data.message, 'alert alert-warning');
                }
            },
            error: (err) => {
                console.log(err);
            }
        });  
    });
});