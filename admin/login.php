<?php include("includes/header.php");?>
	<div class="loginBlock" id="login" style="display: block;">
        <h1>Welcome. Please Sign In</h1>
        <div class="dr"><span></span></div>
        <div class="loginForm">
        <div class="loginNotification"></div>
            <form class="form-horizontal loginNow" action="" method="post" id="validation">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" placeholder="Email" class="loginEmail form-control validate[required]"/>
                    </div>                
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="password" placeholder="Password" class="loginPassword form-control validate[required]" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group" style="margin-top: 5px;">
                            <label class="checkbox"><input type="checkbox" name="tick" class="form-check-input" value="yup"id="materialUnchecked">  Remember me</label>
                        </div>                     
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-default btn-block">Sign in</button>       
                    </div>
                </div>
            </form>  
            <div class="dr"><span></span></div>
            <div class="controls">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-link btn-block" onClick="loginBlock('#forgot');">Forgot password?</button>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loginBlock" id="forgot">
        <h1>Forgot your password?</h1>
        <div class="dr"><span></span></div>
        <div class="loginForm">
        <div class="passwordNotification"></div>
            <form class="passwordNow form-horizontal" action="" method="post">
                <p>This form help you return your password. Please, enter your email, and send request</p>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" placeholder="Your email" class="passwordEmail form-control"/>
                    </div>                
                </div>                
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-default btn-block">Send request</button>       
                    </div>
                </div>
            </form>  
            <div class="dr"><span></span></div>
            <div class="controls">
                <div class="row">                    
                    <div class="col-md-12">
                        <button class="btn btn-link" onClick="loginBlock('#login');">&laquo; Back to login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/login.js"></script>
<?php include("includes/footer.php");?>