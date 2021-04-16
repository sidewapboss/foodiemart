$(document).ready(() => {
    const notification = $('.productNotification');
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
    $(".deleteProduct").click((e) => {
        const code = $(e.currentTarget).data("code");
        if(confirm("Are you sure you want to permanently delete this product?")){
            $("#mode1").removeClass("none");
		    $("#mode2").removeClass("none");
            //Delete and hide
            $.post('mint?action=deleteProduct', {code: code}, (data) => {
                if(data.status === 1){
                    handleNotification(data.message, 'alert-success');
                    $("tr#"+code).remove();
                }else if(data.status === 0){
                    handleNotification(data.message, 'alert-warning');
                }
            });
        }else{
            return false;
        }
    });
});