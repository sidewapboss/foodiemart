<?php
    include("../includes/database.php");
    $admins = $db->admins();?>
    <table class="table">
    <tr>
        <th>Fullname</th>
        <th>Email</th>
        <th>Type</th>
        <th>Action</th>
    </tr>
<?php
    foreach((array)$admins as $admin){?>
    <tr>
        <td><?php echo $admin['name'];?></td>
        <td><?php echo $admin['email'];?></td>
        <td><?php echo ucfirst($admin['type']);?></td>
        <td><?php if($admin['status'] == 0){?><button type="button" class="btn btn-primary restrict" id="<?php echo $admin['id'];?>" style="background: #00C;">Restrict</button><?php }else{?><button type="button" class="btn btn-primary release" id="<?php echo $admin['id'];?>">Release</button><?php }?> | <button type="button" class="btn btn-primary delete" id="<?php echo $admin['id'];?>" style="background: #C00 !important;">Delete</button></td>
    </tr>
    <?php }
?>
</table>