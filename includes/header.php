<?php include("includes/database.php");?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:100,300,300i,400,700,900">
    <link rel="stylesheet" href="<?php echo $db->dlink();?>/assets/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo $db->dlink();?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $db->dlink();?>/assets/css/bootstrap-dropdownhover.css">
    <link rel="stylesheet" href="<?php echo $db->dlink();?>/assets/css/style.css" id="main-styles-link">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo $db->dlink();?>/assets/js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="<?php echo $db->dlink();?>/assets/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo $db->dlink();?>/assets/js/holder.min.js"></script>
    <script type="text/javascript" src="<?php echo $db->dlink();?>/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $db->dlink();?>/assets/js/bootstrap-dropdownhover.js"></script>
  </head>
  <body>
    <style>
      .dropdown-inline {
        display: inline-block;
        position: relative;
      }
    </style>
    <header>
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-sm-12 col-sx-12">
          <img src="<?php echo $db->dlink();?>/assets/img/logo_white.png" alt="Foodie Mart Store" style="max-width: 100%;" />
        </div>
        <div class="col-md-1">&nbsp;</div>
        <div class="col-md-1 pull-right">
          <i class="glyphicon glyphicon-shopping-cart cart"></i>
          <span class="cartCount">0</span>
        </div>
        <div class="col-md-1 heads pull-right">
          <a href="<?php echo $db->dlink();?>/login" class="head" title="Login / SignUp"><span class="hidden-xs">Login / SignUp</span><span class="visible-xs"><i class="glyphicon glyphicon-user cart"></i></span></a>
        </div>
        <div class="col-md-6 col-sm-8 col-xs-8">
          <form action="<?php echo $db->dlink();?>/search" method="get">
            <div class="input-group">
              <span class="input-group-btn">
                <!-- Navigation Menu -->
                <div class="dropdown dropdown-inline">
                  <a href="#" class="btn btn-success dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-animations="flipInX flipInY flipInX flipInY"><i class="glyphicon glyphicon-th-list"></i></a>
                  <ul class="dropdown-menu dropdownhover-bottom" role="menu">
                  <?php $cats = $db->getCategories();foreach((array)$cats as $cat){?>
                    <li<?php if($db->catHasChild($cat['id'])>0){echo " class=\"dropdown\"";}?>>
                      <a href="<?php echo $db->dlink();?>/category/<?php echo $cat['slug'];?>"><?php echo $cat['title'];?> <?php if($db->catHasChild($cat['id'])>0){?><span class="caret"></span><?php }?></a>
                      <?php if($db->catHasChild($cat['id'])>0){?>
                        <ul class="dropdown-menu dropdownhover-right">
                        <?php $cata = $db->getParentCategory($cat['id']);foreach((array)$cata as $cta){?>
                          <li<?php if($db->catHasChild($cta['id'])>0){echo " class=\"dropdown\"";}?>>
                            <a href="<?php echo $db->dlink();?>/category/<?php echo $cta['slug'];?>"><?php echo $cta['title'];?> <?php if($db->catHasChild($cta['id'])>0){?><span class="caret"></span><?php }?></a>
                            <?php if($db->catHasChild($cta['id'])>0){?>
                              <ul class="dropdown-menu dropdownhover-right">
                              <?php $catb = $db->getParentCategory($cta['id']);foreach((array)$catb as $ctb){?>
                                <li<?php if($db->catHasChild($ctb['id'])>0){echo " class=\"dropdown\"";}?>>
                                  <a href="<?php echo $db->dlink();?>/category/<?php echo $ctb['slug'];?>"><?php echo $ctb['title'];?> <?php if($db->catHasChild($ctb['id'])>0){?><span class="caret"></span><?php }?></a>
                                  <?php if($db->catHasChild($ctb['id'])>0){?>
                                    <ul class="dropdown-menu dropdownhover-right">
                                    <?php $catc = $db->getParentCategory($ctb['id']);foreach((array)$catc as $ctc){?>
                                      <li<?php if($db->catHasChild($ctc['id'])>0){echo " class=\"dropdown\"";}?>>
                                        <a href="<?php echo $db->dlink();?>/category/<?php echo $ctc['slug'];?>"><?php echo $ctc['title'];?> <?php if($db->catHasChild($ctc['id'])>0){?><span class="caret"></span><?php }?></a>
                                        <?php if($db->catHasChild($ctc['id'])>0){?>
                                          <ul class="dropdown-menu dropdownhover-right">
                                          <?php $catd = $db->getParentCategory($ctc['id']);foreach((array)$catd as $ctd){?>
                                            <li<?php if($db->catHasChild($ctd['id'])>0){echo " class=\"dropdown\"";}?>>
                                              <a href="<?php echo $db->dlink();?>/category/<?php echo $ctd['slug'];?>"><?php echo $ctd['title'];?> <?php if($db->catHasChild($ctd['id'])>0){?><span class="caret"></span><?php }?></a>
                                              <?php if($db->catHasChild($ctd['id'])>0){?>
                                                <ul class="dropdown-menu dropdownhover-right">
                                                  
                                                </ul>
                                              <?php }?>
                                          <?php }?>
                                          </ul>
                                        <?php }?>
                                    <?php }?>
                                    </ul>
                                  <?php }?>
                              <?php }?>
                              </ul>
                            <?php }?>
                          </li>
                        <?php }?>
                        </ul>
                      <?php }?>
                    </li>
                  <?php }?>
                  </ul>
                </div>
                <!--  Navigation Menu Ends  -->
              </span>
              <input type="search" name="s" id="" class="form-control" placeholder="Search for products...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </span>
            </div>
          </form>
        </div>
      </div>
      </div>
    </header>