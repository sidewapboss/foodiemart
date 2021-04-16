<?php include("includes/header.php");?>
<?php include("includes/navigation.php");?>
	<div class="workplace">
		<div class="row">
            <div class="col-md-12">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>New Product</h1>
                </div>
                <div class="block-fluid">
                    <div class="productNotification"></div>
                    <form method="post" action="" enctype="multipart/form-data" class="newProduct" id="newProd">
                        <div class="row-form clearfix">
                            <div class="col-md-8">
                                <label>Product Title:</label>
                                <input type="text" name="title" class="productTitle" placeholder="Product title" />
                            </div>
                            <div class="col-md-2">
                                <label>Product Price:</label>
                                <input type="number" name="price" class="productPrice" placeholder="Product price" />
                            </div>
                            <div class="col-md-2">
                                <label>Discount:</label>
                                <input type="number" name="discount" class="productPriceDiscount" placeholder="Price Discount" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-6">
                                <label>Product Category:</label>
                                <select name="category" class="form-control piker"></select>
                            </div>
                            <div class="col-md-6">
                                <label>Stock Amount:</label>
                                <input type="number" name="stock" class="stockNumber" placeholder="Number of stock available" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-10">
                                <label>Product Details:</label>
                                <textarea name="details" class="productTitle" placeholder="Product details"></textarea>
                            </div>
                            <div class="col-md-2">
                                <label>Product Images:</label>
                                <input type="file" name="img[]" multiple class="pImages" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-6">
                                <label>Key features:</label>
                                <div class="col-md-11">
                                    <div class="feats"></div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary newFeat"><i class="glyphicon glyphicon-plus"></i></button>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                            <div class="col-md-6">
                                <label>Specifications:</label>
                                <div class="col-md-11">
                                    <div class="specs"></div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary newSpec"><i class="glyphicon glyphicon-plus"></i></button>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                        <input type="hidden" class="validx" value="0" />
                        <div class="footer tar">
                            <button class="btn btn-default">Upload</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/newProduct.js"></script>
    <style>
        div.uploader{
            max-width: 100%;
            height: 80px;
        }
    </style>
<?php include("includes/footer.php");?>