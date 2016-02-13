<?php
$errors = [];
$successes = [];
echo resultBlock($errors,$successes);
?>

<form name='adminPermission' action='<?=$_SERVER['PHP_SELF']?>?id=<?=$permissionId?>' method='post'>
<table class='table'>
<tr><td>
<h3>Permission Information</h3>
<div id='regbox'>
<p>
<label>ID:</label>
<?=$permissionDetails['id']?>
</p>
<p>
<label>Name:</label>
<input type='text' name='name' value='<?=$permissionDetails['name']?>' />
</p>
<h3>Delete this Level?</h3>
<label>Delete:</label>
<input type='checkbox' name='delete[<?=$permissionDetails['id']?>]' id='delete[<?=$permissionDetails['id']?>]' value='<?=$permissionDetails['id']?>'>
</p>
</div></td><td>
<h3>Permission Membership</h3>
<div id='regbox'>
<p><strong>
Remove Members:</strong>
<?php
//dump($userData);
//dump($permissionUsers);

//Display list of permission levels with access
$perm_users = [];
foreach($permissionUsers as $perm){
  $perm_users[] = $perm->user_id;
  // dump($perm_users);
}
foreach ($userData as $v1):
  if(in_array($v1->id,$perm_users)): ?>
    <br><input type='checkbox' name='removePermission[]' id='removePermission[]' value='<?=$v1->id;?>'> <?=$v1->username;
    endif;
    endforeach;
?>

</p><strong>
<p>Add Members:</strong>
<?php
//List users without permission level
$perm_losers = [];
foreach($permissionUsers as $perm){
  $perm_losers[] = $perm->user_id;
  // dump($perm_users);
}
foreach ($userData as $v1):
  if(!in_array($v1->id,$perm_losers)): ?>
    <br><input type='checkbox' name='addPermission[]' id='addPermission[]' value='<?=$v1->id?>'> <?=$v1->username;
    endif;
    endforeach;
?>

</p>
</div>
</td>
<td>
<h3>Permission Access</h3>
<div id='regbox'>
<p><br><strong>
Public Pages:</strong>
<?php
//List public pages
foreach ($pageData as $v1) {
  if($v1->private != 1){
    echo "<br>".$v1->page;
  }
}
?>
</p>
<p><br><strong>
Remove Access From This Level:</strong>
<?php
//Display list of pages with this access level
$page_ids = [];
foreach($pagePermissions as $pp){
  $page_ids[] = $pp->page_id;
}
foreach ($pageData as $v1):
  if(in_array($v1->id,$page_ids)): ?>
    <br><input type='checkbox' name='removePage[]' id='removePage[]' value='<?=$v1->id;?>'> <?=$v1->page;?>
  <?php endif; ?>
<?php endforeach; ?>
</p>
<p><br><strong>
Add Access To This Level:</strong>
<?php
//Display list of pages with this access level

foreach ($pageData as $v1):
  if(!in_array($v1->id,$page_ids) && $v1->private == 1): ?>
    <br><input type='checkbox' name='addPage[]' id='addPage[]' value='<?=$v1->id;?>'> <?=$v1->page;?>
  <?php endif; ?>
<?php endforeach; ?>

</p>
</div>
</td>
</tr>
</table>

<input type="hidden" name="csrf" value="<?=Token::generate();?>" >

<p>
<label>&nbsp;</label>
<input class='btn btn-primary' type='submit' value='Update Permission' class='submit' />
</p>
</form>
