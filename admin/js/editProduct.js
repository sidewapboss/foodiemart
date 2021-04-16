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
    $(".image").hover((e) => {
        const mid = e.currentTarget.id;
        $("."+mid).removeClass("hide");
    }, (e) => {
        const mid = e.currentTarget.id;
        $("."+mid).addClass("hide");
    });
    $(".delete-image-btn").click((e) =>{
        const imgz = $(".deleteImg").val();
        const del = e.currentTarget.id;
        const newDel = del.replace('del', '');
        const newImgz = imgz+""+newDel+",";
        $(".deleteImg").val(newImgz);
        $("."+del).remove();
    });

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
    $(document).on("click", ".removeSpecx", (e) => {
        const imgz = $(".deletesp").val();
        const del = e.target.id;
        const newDel = del.replace('valid00000000', '');
        const newImgz = imgz+""+newDel+",";
        $(".deletesp").val(newImgz);
        $("."+del).remove();
    });
    $(document).on("click", ".removeFeatx", (e) => {
        const imgz = $(".deleteft").val();
        const del = e.target.id;
        const newDel = del.replace('valid0000000', '');
        const newImgz = imgz+""+newDel+",";
        $(".deleteft").val(newImgz);
        $("."+del).remove();
    });
    const loadCats = () => {
        const emx = $(".piker");
        const uid = $(".ctxx").val();
        emx.html('<option value=""><i>Loading...</i></option>');
        emx.load("cte.php?id="+uid);
    }
    loadCats();
    $(".editProduct").submit((e)=>{
        e.preventDefault();
        $("#mode1").removeClass("none");
		$("#mode2").removeClass("none");
        const newProd = $('#editProd');
        const datum = new FormData(newProd[0]);
        $.ajax({  
            url: "editProduct.php",  
            type: "POST",  
            data: datum,
            contentType: false,
            processData:false,
            dataType: 'json',
            success: (data) => {  
                console.log(data)
                 if(data.status === 1){
                    handleNotification(data.message, 'alert alert-success');
                    //window.location = 'products';
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
})