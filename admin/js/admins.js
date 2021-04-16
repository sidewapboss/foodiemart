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
    $('.newAdmin').submit((e) =>{
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const newCat = $('#newAdm');
        const datum = new FormData(newCat[0]);
        $.ajax({  
            url: "mint?action=newAdmin",  
            type: "POST",  
            data: datum,
            contentType: false,
            processData:false,
            dataType: 'json',
            success: (data) => {  
                 if(data.status === 1){
                    handleNotification(data.message, 'alert alert-success');
                    loadCatx();
                    newCat[0].reset();
                 }else if(data.status === 0){
                    handleNotification(data.message, 'alert alert-warning');
                }
            },
            error: (err) => {
                console.log(err);
            }
        });  
    });
    const loadCatx = () =>{
        const enx = $(".adminView");
        enx.html('<i>Loading...</i>');
        enx.load("adm.php");
    }
    loadCatx();
    $(document).on('click', '.restrict', (e) => {
        const id = e.target.id;
        $.post('mint?action=restrict', {id: id}, (data) => {
            if(data.status === 1){
                handleNotification(data.message, 'alert-success');
                loadCatx();
            }else if(data.status === 0){
                handleNotification(data.message, 'alert-warning');
            }
        });
    });
    $(document).on('click', '.release', (e) => {
        const id = e.target.id;
        $.post('mint?action=release', {id: id}, (data) => {
            if(data.status === 1){
                handleNotification(data.message, 'alert-success');
                loadCatx();
            }else if(data.status === 0){
                handleNotification(data.message, 'alert-warning');
            }
        });
    });
    $(document).on('click', '.delete', (e) => {
        const id = e.target.id;
        $.post('mint?action=deleteAdmin', {id: id}, (data) => {
            if(data.status === 1){
                handleNotification(data.message, 'alert-success');
                loadCatx();
            }else if(data.status === 0){
                handleNotification(data.message, 'alert-warning');
            }
        });
    });
});