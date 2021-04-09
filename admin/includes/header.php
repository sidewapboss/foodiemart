<?php include("../includes/database.php");
$url = $_SERVER['REQUEST_URI'];$urls = str_replace("admin/","",$url);
$cur = trim(parse_url($urls, PHP_URL_PATH), '/');
if($cur == "minipass"){
    if(!isset($_SESSION['adminID'])){
        $_SESSION['msg'] = "<div class=\"alert alert-warning\">Invalid request</div>";
        header("location: login");
        exit;
    }else{
        $curs = "Create New Password";
    }
}
if($cur == "login" || $cur == "register"){}else{
    $db->isLoggedAdmin();
}?>
<?php if($cur=="dashboard"){$curs="Dashboard";}elseif($cur=="login"){$curs="Account Login";}elseif($cur=="password"){$curs="Change Password";}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!--[if gt IE 8]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <![endif]-->
    
    <title><?php echo $db->appName();?> | <?php echo $curs;?></title>
        <link rel="shortcut icon" href="<?php echo $db->attachmentLink();?>/img/smurf05.png" type="image/x-icon"/>
    
    <link href="<?php echo $db->attachmentLink();?>/css/stylesheets.css" rel="stylesheet" type="text/css" />  
    <!--[if lt IE 8]>
        <link href="css/ie7.css" rel="stylesheet" type="text/css" />
    <![endif]-->            
    <link rel='stylesheet' type='text/css' href='<?php echo $db->attachmentLink();?>/css/fullcalendar.print.css' media='print' />
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/jquery/jquery-1.10.2.min.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/jquery/jquery-ui-1.10.1.custom.min.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/jquery/jquery-migrate-1.2.1.min.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/jquery/jquery.mousewheel.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/cookie/jquery.cookies.2.2.0.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/bootstrap.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/charts/excanvas.min.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/charts/jquery.flot.js'></script>    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/charts/jquery.flot.stack.js'></script>    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/charts/jquery.flot.pie.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/charts/jquery.flot.resize.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/sparklines/jquery.sparkline.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/fullcalendar/fullcalendar.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/select2/select2.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/uniform/uniform.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/maskedinput/jquery.maskedinput-1.3.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/validation/languages/jquery.validationEngine-en.js' charset='utf-8'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/validation/jquery.validationEngine.js' charset='utf-8'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/animatedprogressbar/animated_progressbar.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/qtip/jquery.qtip-1.0.0-rc3.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/cleditor/jquery.cleditor.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/dataTables/jquery.dataTables.min.js'></script>    
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/pnotify/jquery.pnotify.min.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins/ibutton/jquery.ibutton.min.js'></script>
    
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/cookies.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/actions.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/charts.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/plugins.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/settings.js'></script>
    <script type='text/javascript' src='<?php echo $db->attachmentLink();?>/js/script.js'></script>
</head>
<noscript>
 <style>html{display:none;}</style>
 <meta http-equiv="refresh" content="0;url=../" />
</noscript>
<body>
<div id="mode1" class="overlay none"></div>
<div id="mode2" class="model none"><div class="lds-hourglass"></div><div style="font-weight: bold;color: #FFF;font-size: 18px;font-style: italic;">LOADING...</div></div>