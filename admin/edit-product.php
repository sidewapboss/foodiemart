<?php include("includes/header.php");?>
<?php include("includes/navigation.php");$item = $db->getProduct($db->getVar("code"));?>
	<div class="workplace">
		<div class="row">
            <div class="col-md-12">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>Edit Product</h1>
                </div>
                <div class="block-fluid">
                    <div class="productNotification"></div>
                    <form method="post" action="" enctype="multipart/form-data" class="editProduct" id="editProd">
                        <div class="row-form clearfix">
                            <div class="col-md-8">
                                <label>Product Title:</label>
                                <input type="text" name="title" class="productTitle" placeholder="Product title" value="<?php echo $item["title"];?>" />
                                <input type="text" name="deleteImg" class="deleteImg" style="display:none;" />
                                <input type="text" name="deletesp" class="deletesp" style="display:none;" />
                                <input type="text" name="deleteft" class="deleteft" style="display:none;" />
                                <input type="text" name="product_code" value="<?php echo $db->getVar("code");?>" style="display:none;" />
                                <input type="hidden" class="ctxx" value="<?php echo $item["category"];?>">
                            </div>
                            <div class="col-md-2">
                                <label>Product Price:</label>
                                <input type="number" value="<?php echo $item["price"];?>" name="price" class="productPrice" placeholder="Product price" />
                            </div>
                            <div class="col-md-2">
                                <label>Discount:</label>
                                <input type="number" name="discount" value="<?php echo $item["discount"];?>" class="productPriceDiscount" placeholder="Price Discount" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-6">
                                <label>Product Category:</label>
                                <select name="category" class="form-control piker"></select>
                            </div>
                            <div class="col-md-6">
                                <label>Stock Amount:</label>
                                <input type="number" name="stock" value="<?php echo $item["stock"];?>" class="stockNumber" placeholder="Number of stock available" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-10">
                                <label>Product Details:</label>
                                <textarea name="details" class="productTitle" placeholder="Product details"><?php echo $item["details"];?></textarea>
                            </div>
                            <div class="col-md-2">
                                <label>Product Images:</label>
                                <input type="file" name="img[]" multiple class="pImages" />
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-12">
                                <?php $i=0; $imgs = $db->getImages($item["product_code"]);foreach((array)$imgs as $img){?>
                                    <div class="col-md-2 del<?php echo $img["id"];?>">
                                        <div class="image" id="img<?php echo $img["id"];?>">
                                        <button type="button" class="delete-image-btn hide img<?php echo $img["id"];?>" id="del<?php echo $img["id"];?>">X</button>
                                            <img src="<?php echo $img['imgurl'];?>" style="width: 150px;padding:10px;" />
                                        </div>
                                    </div>
                                    <?php $i++; if($i == 6){?><div style="clear: both;"></div><?php }?>
                                <?php }?>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                        <div class="row-form clearfix">
                            <div class="col-md-6">
                                <label>Key features:</label>
                                <div class="col-md-11">
                                    <?php $feats = $db->getFeatures($item["product_code"]);foreach((array)$feats as $feat){?>
                                    <div class="valid0000000<?php echo $feat['id'];?>">
                                        <div class="input-group">
                                            <input type="text" placeholder="Title" value="<?php echo $feat['title'];?>" disabled>
                                            <span class="input-group-addon">-</span>
                                            <input type="text" value="<?php echo $feat['value'];?>" disabled>
                                            <span class="input-group-btn removeFeatx">
                                                <button class="btn btn-primary" type="button" id="valid0000000<?php echo $feat['id'];?>">X</button>
                                            </span>
                                        </div>
                                    </div>
                                    <?php }?>
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
                                <?php $specs = $db->getSpecs($item["product_code"]);foreach((array)$specs as $spec){?>
                                    <div class="valid00000000<?php echo $spec['id'];?>">
                                        <div class="input-group">
                                            <input type="text" placeholder="Title" value="<?php echo $spec['title'];?>" disabled>
                                            <span class="input-group-addon">-</span>
                                            <input type="text" value="<?php echo $spec['value'];?>" disabled>
                                            <span class="input-group-btn removeSpecx">
                                                <button class="btn btn-primary" type="button" id="valid00000000<?php echo $spec['id'];?>">X</button>
                                            </span>
                                        </div>
                                    </div>
                                    <?php }?>
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
                            <button class="btn btn-default">Update</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/editProduct.js"></script>
    <style>
        div.uploader{
            max-width: 100%;
            height: 80px;
        }
        .image{
            position: relative;
        }
        .image .delete-image-btn{
            position: absolute;
            top: 0;
            right: 0;
            z-index: 1;
            background: transparent;
            border: none;
            color: red;
        }
    </style>
<?php include("includes/footer.php");?>