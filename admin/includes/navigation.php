
    <div class="wrapper green"> 
            <?php $user = $db->admin($_SESSION['adminID']);?>
        <div class="header">
            <a class="logo" href="<?php echo $db->dlink();?>/admin/dashboard" style="font-size: 24px;color: #FFF;padding-left: 10px;"><?php echo $db->appName();?></a>
            <ul class="header_menu">
                <li class="list_icon"><a href="#">&nbsp;</a></li>
            </ul>   
        </div>

        <div class="menu">                

            <div class="breadLine">            
                <div class="arrow"></div>
                <div class="adminControl active">
                    Hi, <?php echo $user['name'];?>
                </div>
            </div>
            <ul class="navigation">            
                <li class="<?php if($cur=="dashboard"){?>active<?php }?>">
                    <a href="<?php echo $db->dlink();?>/admin/dashboard">
                        <span class="isw-grid"></span><span class="text">Dashboard</span>
                    </a>
                <li class="openable <?php if($cur=="new-product" || $cur == "products" || $cur == "in-stock" || $cur == "out-stock" || $cur == "categories"){?>active<?php }?>">
                    <a href="#">
                        <span class="isw-folder"></span><span class="text">Product Management</span>
                    </a>
                    <ul>
                        <li class="<?php if($cur=="new-product"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/new-product"><span class="glyphicon glyphicon-edit"></span><span class="text">New Product</span></a></li>
                        <li class="<?php if($cur=="products"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/products"><span class="glyphicon glyphicon-edit"></span><span class="text">Products</span></a></li>
                        <li class="<?php if($cur=="in-stock"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/in-stock"><span class="glyphicon glyphicon-edit"></span><span class="text">In Stock</span></a></li>
                        <li class="<?php if($cur=="out-stock"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/out-stock"><span class="glyphicon glyphicon-edit"></span><span class="text">Out Of Stock</span></a></li>
                        <li class="<?php if($cur=="categories"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/categories"><span class="glyphicon glyphicon-edit"></span><span class="text">Categories</span></a></li>
                    </ul>
                </li>
                <li class="openable <?php if($cur=="orders" || $cur == "pending" || $cur == "shipped" || $cur == "failed"){?>active<?php }?>">
                    <a href="#">
                        <span class="isw-folder"></span><span class="text">Product Management</span>
                    </a>
                    <ul>
                        <li class="<?php if($cur=="orders"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/new-product"><span class="glyphicon glyphicon-edit"></span><span class="text">New Product</span></a></li>
                        <li class="<?php if($cur=="pending"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/products"><span class="glyphicon glyphicon-edit"></span><span class="text">Products</span></a></li>
                        <li class="<?php if($cur=="shipped"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/in-stock"><span class="glyphicon glyphicon-edit"></span><span class="text">In Stock</span></a></li>
                        <li class="<?php if($cur=="failed"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/admin/out-stock"><span class="glyphicon glyphicon-edit"></span><span class="text">Out Of Stock</span></a></li>
                    </ul>
                </li>
                <li class="openable <?php if($cur=="settings"){?>active<?php }?>">
                    <a href="#">
                        <span class="isw-cancel"></span><span class="text">Account Settings</span>                    
                    </a>
                    <ul>
                        <li class="<?php if($cur=="settings"){?>active<?php }?>"><a href="<?php echo $db->dlink();?>/users/settings"><span class="glyphicon glyphicon-edit"></span><span class="text">My Account</span></a></li>
                        <li><a href="<?php echo $db->dlink();?>/admin/mint?action=logout"><span class="glyphicon glyphicon-warning-sign"></span><span class="text">Logout</span></a></li>
                    </ul>
                </li>                       
            </ul>

            <div class="dr"><span></span></div>

        </div>

        <div class="content">
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#"><?php echo $db->appName();?></a> <span class="divider">></span></li>                
                    <li class="active"><?php echo $curs;?></li>
                </ul>
            </div>
            <div style="height: 10px;"></div>
            <?php $db->notification();?>