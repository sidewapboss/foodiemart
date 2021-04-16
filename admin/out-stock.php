<?php include("includes/header.php");?>
<?php include("includes/navigation.php");?>
	<div class="workplace">
		<div class="row">
            <div class="col-md-12">
                <div class="head clearfix">
                    <div class="isw-graph"></div>
                    <h1>Products In Stock</h1>
                </div>
                <div class="block-fluid">
                <table class="table">
		        	<tr>
	        			<th>Title</th>
	        			<th>Product Code</th>
	        			<th>Overview</th>
	        			<th>Stock</th>
	        			<th>Date uploaded</th>
	        			<th>Action</th>
	        		</tr>
                    <?php
                        $page = (int) (!isset($_REQUEST["page"]) ? 1 : $_REQUEST["page"]);
                        if($page == ""){
                            $page = 1;
                        }
                        $tlink = "in-stock";
                        $tbname = "products WHERE status =1 ORDER BY id DESC";
                        $url = $db->dlink();
                        $startpoint = ($page * $limit) - $limit;
                        $limit = 50;
                        $items = $db->outStock($page, $limit);
                        foreach((array)$items as $item){
                    ?>
                        <tr id="<?php echo $item['product_code'];?>">
                            <td><?php echo $item['title'];?></td>
                            <td><?php echo $item['product_code'];?></td>
                            <td><?php echo $item['details'];?></td>
                            <td><?php echo $item['stock'];?></td>
                            <td><?php echo $item['uploaded'];?></td>
                            <td><a href="edit-product?code=<?php echo $item['product_code'];?>&plr=<?php echo $item['id'];?>">Edit</a> &bull; <a data-code="<?php echo $item['product_code'];?>" style="color:#FF000;font-weight: bold;cursor:pointer;" class="deleteProduct">Delete</a></td>
                        </tr>
                    <?php }?>
                    </table>
                    <div class="gradient-wrapper">
                        <ul class="cp-pagination">
                            <?php echo $db->pagingx($tlink,$page,$limit,$url,$tbname)?>
                        </ul>
                    </div>
                    <div class="footer tar">
                        <div style="text-align: center;font-style: italic;"><?php if(count((array)$items) == 0){echo "No Items Found";}?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/products.js"></script>
<?php include("includes/footer.php");?>