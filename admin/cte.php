<?php
    include("../includes/database.php");
    $ctxi = $db->getVar("id");
    echo '<option value="0">None</option>';
    $cats = $db->getCategories();
    foreach((array)$cats as $cat){?>
        <option value="<?php echo $cat['id'];?>" <?php if($cat['id'] == $ctxi){echo "selected";}?>><?php echo $cat['title'];?></option>
        <?php $catx = $db->getParentCategory($cat['id']);foreach((array)$catx as $ctx){?>
        <optgroup label="<?php echo $cat['title'];?>">
            <option value="<?php echo $ctx['id'];?>" <?php if($ctx['id'] == $ctxi){echo "selected";}?>><?php echo $ctx['title'];?></option>
            <?php $cata = $db->getParentCategory($ctx['id']);foreach((array)$cata as $cti){?>
            <optgroup label="<?php echo $ctx['title'];?>">
                <option value="<?php echo $cti['id'];?>" <?php if($cta['id'] == $ctxi){echo "selected";}?>><?php echo $cti['title'];?></option>
                <?php $catb = $db->getParentCategory($cti['id']);foreach((array)$catb as $ctb){?>
                <optgroup label="<?php echo $cti['title'];?>">
                    <option value="<?php echo $ctb['id'];?>" <?php if($ctb['id'] == $ctxi){echo "selected";}?>><?php echo $ctb['title'];?></option>
                    <?php $catc = $db->getParentCategory($ctb['id']);foreach((array)$catc as $ctc){?>
                    <optgroup label="<?php echo $ctb['title'];?>">
                        <option value="<?php echo $ctc['id'];?>" <?php if($ctc['id'] == $ctxi){echo "selected";}?>><?php echo $ctc['title'];?></option>
                        <?php $catd = $db->getParentCategory($ctc['id']);foreach((array)$catd as $ctd){?>
                        <optgroup label="<?php echo $ctc['title'];?>">
                            <option value="<?php echo $ctd['id'];?>" <?php if($ctd['id'] == $ctxi){echo "selected";}?>><?php echo $ctd['title'];?></option>
                        </optgroup>
                        <?php }?>
                    </optgroup>
                    <?php }?>
                </optgroup>
                <?php }?>
            </optgroup>
            <?php }?>
        </optgroup>
        <?php }
    }
?>