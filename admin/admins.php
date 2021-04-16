<?php include("includes/header.php");?>
<?php include("includes/navigation.php");?>
	<div class="workplace">
		<div class="row">
            <div class="col-md-5">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>New Admin</h1>
                </div>
                <div class="block-fluid">
                    <div class="adminNotification"></div>
                    <form method="post" action="" class="newAdmin" id="newAdm">
                        <div class="row-form clearfix">
                            <div class="col-md-12">
                                <label>Fullname:</label>
                                <input type="text" name="name" placeholder="Fullname" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-6">
                                <label>Email:</label>
                                <input type="email" name="email" placeholder="Email" />
                            </div>
                            <div class="col-md-6">
                                <label>Password:</label>
                                <input type="password" name="password" placeholder="New admin password" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-12">
                                <label>Account Type:</label>
                                <select name="type" id="" required="required">
                                    <option value="">Select account type</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="footer tar">
                            <button class="btn btn-default">Add admin</button>
                        </div> 
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>Admins</h1>
                </div>
                <div class="block-fluid">
                    <div class="adminView" style="padding: 10px;"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/admins.js"></script>
<?php include("includes/footer.php");?>