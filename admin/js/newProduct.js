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
    const setValidx = (valid) => {
        $('.validx').val(valid);
    }
    $('.newFeat').click(() => {
        const validx = $('.validx').val();
        const newValid = validx + 1;
        const upDiv = $('<div>',{
            "class": `valid${newValid}`
        });
        const inputGroup = $('<div>', {
            "class": "input-group"
        });
        const featName = $('<input>', {
            "type": "text",
            "name": "featName[]",
            "class": "form-control",
            "placeholder": "Title",
            "required": "required"
        });
        const featValue = $('<input>', {
            "type": "text",
            "name": "featValue[]",
            "class": "form-control",
            "placeholder": "Value",
            "required": "required"
        });
        const span = $('<span>', {
            "class": "input-group-addon",
            "text": "-"
        });
        const removeSpan = $('<span>', {
            "class": "input-group-btn removeFeat"
        });
        const rmb = $('<button>', {
            "class": "btn btn-primary",
            "text": "X",
            "type": "button",
            "id": `valid${newValid}`
        });
        removeSpan.html(rmb);
        inputGroup.append(featName).append(span).append(featValue).append(removeSpan);
        inputGroup.appendTo(upDiv);
        $(".feats").append(upDiv);
        setValidx(newValid);
    });
    $(document).on("click", ".removeFeat", (e) => {
        const parent = e.target.id;
        $(`.${parent}`).remove();
    });

    //Fire specifications
    $('.newSpec').click(() => {
        const validx = $('.validx').val();
        const newValid = validx + 1;
        const upDiv = $('<div>',{
            "class": `val${newValid}`
        });
        const inputGroup = $('<div>', {
            "class": "input-group"
        });
        const specName = $('<input>', {
            "type": "text",
            "name": "specName[]",
            "class": "form-control",
            "placeholder": "Title",
            "required": "required"
        });
        const specValue = $('<input>', {
            "type": "text",
            "name": "specValue[]",
            "class": "form-control",
            "placeholder": "Value",
            "required": "required"
        });
        const span = $('<span>', {
            "class": "input-group-addon",
            "text": "-"
        });
        const removeSpan = $('<span>', {
            "class": "input-group-btn removeSpec"
        });
        const rmb = $('<button>', {
            "class": "btn btn-primary",
            "text": "X",
            "type": "button",
            "id": `val${newValid}`
        });
        removeSpan.html(rmb);
        inputGroup.append(specName).append(span).append(specValue).append(removeSpan);
        inputGroup.appendTo(upDiv);
        $(".specs").append(upDiv);
        setValidx(newValid);
    });
    $(document).on("click", ".removeSpec", (e) => {
        const parent = e.target.id;
        $(`.${parent}`).remove();
    });
    $('.pImages').on('change', () => {
        //Count and display number of images selected
        const numFiles = $(".pImages")[0].files.length;
        console.log(numFiles);
        $('span.action').text(numFiles +' images selected')
    });
    $(".newProduct").submit((e)=>{
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const newProd = $('#newProd');
        const datum = new FormData(newProd[0]);
        $.ajax({  
            url: "newProduct.php",  
            type: "POST",  
            data: datum,
            contentType: false,
            processData:false,
            dataType: 'json',
            success: (data) => {  
                 if(data.status === 1){
                    handleNotification(data.message, 'alert alert-success');
                    loadCats();
                    newProd[0].reset();
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
    loadCats();
});