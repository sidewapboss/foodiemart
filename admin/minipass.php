<?php include("includes/header.php");?>
	<div class="loginBlock" id="login" style="display: block;">
        <div class="dr"><span></span></div>
        <div class="loginForm">
        <?php $db->notification();?>
        <div id="note" style="text-align: center; color: brown"></div>
            <form class="form-horizontal" action="mint?action=updatePass" method="post" id="validation">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" id="inputEmail" name="password" placeholder="New Password" class="form-control validate[required]"/>
                    </div>                
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" id="inputPassword" name="cpassword" placeholder="Confirm Password" class="form-control validate[required]" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" id="validatePass" class="btn btn-default btn-block">Update Password</button>       
                    </div>
                </div>
            </form>  
            <div class="dr"><span></span></div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#validatePass").click(function(){
                var pass = $("#inputEmail").val();
                var cpass = $("#inputPassword").val();
                if(pass != cpass){
                    $("#note").html("Passwords do not match");
                    return false;
                }
            });
        });
    </script>
<?php include("includes/footer.php");?>