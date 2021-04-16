<?php
include("../includes/database.php");
$action = $db->getVar("action");
if($action == "login"){$db->loginAdmin($db->getVar("email"), $db->getVar("password"));}
if($action == "updatePassword"){$db->updatePassword($db->getVar("password"));}
if($action == "deleteProduct"){$db->deleteProduct($db->getVar("code"));}
if($action == "logout"){$db->adminLogout();}
if($action == "minipass"){$db->miniPass($db->getVar("hash"), $db->getVar("email"));}
if($action == "requestPassword"){$db->forgotPasswordAdmin($db->getVar("email"));}
if($action == "restrict"){$db->restrictAdmin($db->getVar("id"));}
if($action == "release"){$db->releaseAdmin($db->getVar("id"));}
if($action == "deleteAdmin"){$db->deleteAdmin($db->getVar("id"));}
if($action == "newAdmin"){$db->newAdmin($db->getVar("name"), $db->getVar("email"), $db->getVar("password"), $db->getVar("type"));}
if($action == "settings"){$db->updateAdmin($db->getVar("name"), $db->getVar("password"), $db->getVar("id"));}
?>