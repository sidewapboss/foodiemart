<?php
    include("../includes/database.php");
    $title = $db->getVar("title");
    $price = $db->getVar("price");
    $discount = $db->getVar("discount");
    $details = $db->getVar("details");
    $img = $_FILES['img'];
    $cat = $db->getVar('category');
    $stock = $db->getVar("stock");
    $feats = $_POST["featName"];
    $feat = $_POST["featValue"];
    $specs = $_POST["specName"];
    $spec = $_POST["specValue"];
    $db->newProduct($title, $price, $discount, $details, $cat, $stock, $img, $feats, $feat, $specs, $spec)
?>