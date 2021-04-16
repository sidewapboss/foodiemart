<?php
    include("../includes/database.php");
    $cats = $db->getCategories();
    foreach((array)$cats as $cat){?>
        <strong><?php echo $cat['title'];?></strong><br />
        <?php $catx = $db->getParentCategory($cat['id']);foreach((array)$catx as $ctx){?>
            &nbsp;&nbsp;&nbsp;&nbsp;&#8594; <?php echo $ctx['title'];?><br />
            <?php $cata = $db->getParentCategory($ctx['id']);foreach((array)$cata as $cti){?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8594; <?php echo $cti['title'];?><br />
                <?php $catb = $db->getParentCategory($cti['id']);foreach((array)$catb as $ctb){?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8594; <?php echo $ctb['title'];?><br />
                    <?php $catc = $db->getParentCategory($ctb['id']);foreach((array)$catc as $ctc){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8594; <?php echo $ctc['title'];?><br />
                        <?php $catd = $db->getParentCategory($ctc['id']);foreach((array)$catd as $ctd){?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8594; <?php echo $ctd['title'];?><br />
                        <?php }?>
                    <?php }?>
                <?php }?>
            <?php }?>
        <?php }
    }
?>