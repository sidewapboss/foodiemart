<?php
include("../includes/database.php");
$action = $db->getVar("action");
if($action == "login"){$db->loginAdmin($db->getVar("email"), $db->getVar("password"));}
if($action == "updatePassword"){$db->updatePassword($db->getVar("password"));}
if($action == "updateUser"){$db->updateUser($db->getVar("firstname"), $db->getVar("lastname"), $db->getVar("phone"), $db->getVar("country"), $db->getVar("city"), $db->getVar("telegram"));}
if($action == "logout"){$db->userLogout();}
if($action == "minipass"){$db->miniPass($db->getVar("hash"), $db->getVar("email"));}
if($action == "requestPassword"){$db->forgotPasswordAdmin($db->getVar("email"));}
if($action == "approveRegistration"){$db->approveRegistration($db->getVar("hash"), $db->getVar("email"));}
if($action == "doMail"){$db->doMail();}
if($action == "theft"){$db->postTheft($db->getVar("comment"), $db->getVar("vid"));}
if($action == "updatePass"){$db->updatePass($db->getVar("password"));}
if($action == "submitScore"){$db->submitScore($db->getVar("score"), $db->getVar("course"));}
if($action == "autoPay"){$db->autoPay($db->getVar("parent"), $db->getVar("type"), $db->getVar("duration"), $db->getVar("amount"));}
if($action == "autoPayBot"){$db->autoPayBot($db->getVar("parent"), $db->getVar("type"), $db->getVar("duration"), $db->getVar("amount"), $db->getVar("txid"));}
if($action == "payment"){$db->ePayment($db->getVar("type"));}
if($action == "subReminderBeginners"){$db->subReminderBeginners();}
if($action == "subReminderMastery"){$db->subReminderMastery();}
if($action == "subReminderUniversity"){$db->subReminderUniversity();}
if($action == "subReminderBrainHub"){$db->subReminderBrainHub();}
if($action == "downloadCertificate"){$db->downloadCertificate($db->getVar("style"), $db->getVar("course"));}
if($action == "startPay"){$db->startPay($db->getVar("parent"), $db->getVar("type"), $db->getVar("duration"), $db->getVar("amount"), $db->getVar("method"), $db->getVar("txnid"));}
if($action == "requestWithdrawal"){$db->requestWithdrawal($db->getVar("amount"), $db->getVar("option1"), $db->getVar("option2"));}
if($action == "newAccount"){$db->newAccount($db->getVar("type"), $db->getVar("content"));}
if($action == "continueLogin"){$db->continueLogin($db->getVar("bitrate"), $db->getVar("otp"));}
if($action == "generateCert"){$db->generateCert($db->getVar("style"), $db->getVar("hash"), $db->getVar("ctag"));}
if($action == "getPrivilege"){$db->getPrivileges($db->getVar("id"));}
?>