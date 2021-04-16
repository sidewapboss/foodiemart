<?php include("includes/header.php");?>
<?php include("includes/navigation.php");?>
<div class="workplace">
<div class="row">
    <div class="col-md-12">
        <div class="head clearfix">
            <div class="isw-user"></div>
            <h1>Account Settings</h1>
        </div>
        <div class="block-fluid">
			<div class="adminNotification"></div>
        	<form method="post" action="" class="updateSettings" id="upSet">
	            <div class="row-form clearfix">
	                <div class="col-md-3">Name:</div>
	                <div class="col-md-9"><input type="text" name="name" value="<?php echo $user['name'];?>" id="accountName" required="required" /></div>
	            </div>        
	            <div class="row-form clearfix">
	                <div class="col-md-3">Email:</div>
	                <div class="col-md-9"><input type="email" value="<?php echo $user['email'];?>" readonly="readonly" /></div>
	            </div>
	            <div class="row-form clearfix">
	                <div class="col-md-3">New Password:</div>
	                <div class="col-md-9"><input type="password" name="password" class="npwd" placeholder="Leave Blank to retain old password" /><input type="hidden" name="id" value="<?php echo $user['id'];?>" /></div>
	            </div>
	            <div class="footer tar">
	                <button class="btn btn-default">Submit</button>
	            </div>  
	    	</form>
        </div>
    </div>
</div>
</div>
    <script type="text/javascript" src="js/updateSettings.js"></script>
<?php include("includes/footer.php");?>