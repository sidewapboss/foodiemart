<?php include("includes/header.php");?>
<?php include("includes/navigation.php");?>
	<div class="workplace">
		<div class="row">
            <div class="col-md-6">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>New Category</h1>
                </div>
                <div class="block-fluid">
                    <div class="categoryNotification"></div>
                    <form method="post" action="" enctype="multipart/form-data" class="newCategory" id="newCat">
                        <div class="row-form clearfix">
                            <div class="col-md-12">
                                <label>Category Title:</label>
                                <input type="text" name="title" placeholder="Category title" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-6">
                                <label>Parent Category:</label>
                                <select name="parent" class="form-control piker">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Category Picture:</label>
                                <input type="file" name="img" placeholder="Category Image" />
                            </div>
                        </div>
                        <div class="footer tar">
                            <button class="btn btn-default">Create category</button>
                        </div> 
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>Categories</h1>
                </div>
                <div class="block-fluid">
                    <div class="categoriesView" style="padding: 10px;"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/categories.js"></script>
<?php include("includes/footer.php");?>