<?php
    include("../includes/database.php");
    $img = $_FILES['img'];
    $cat = $db->getVar('parent');
    $title = $db->getVar('title');
    $db->newCategory($title, $cat, $img);
?>