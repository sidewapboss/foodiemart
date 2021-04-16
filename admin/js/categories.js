$(document).ready(() => {
    const notification = $('.categoryNotification');
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
    $('.newCategory').submit((e) =>{
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const newCat = $('#newCat');
        const datum = new FormData(newCat[0]);
        $.ajax({  
            url: "newCategory.php",  
            type: "POST",  
            data: datum,
            contentType: false,
            processData:false,
            dataType: 'json',
            success: (data) => {  
                 if(data.status === 1){
                    handleNotification(data.message, 'alert alert-success');
                    loadCats();
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
    const loadCats = () =>{
        const emx = $(".piker");
        emx.html('<option value=""><i>Loading...</i></option>');
        emx.load("ctx.php");
    }
    const loadCatx = () =>{
        const enx = $(".categoriesView");
        enx.html('<i>Loading...</i>');
        enx.load("cta.php");
    }
    loadCats();
    loadCatx();
});