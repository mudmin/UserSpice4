<div class="input-group">
<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
<input class="form-control" id="system-search" name="q" placeholder="Search..." required>
<span class="input-group-btn">
  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
</span>
</div>
</form><br>
<form name='adminUsers' action='<?=$_SERVER['PHP_SELF']?>' method='post'>
<table class='table table-hover table-list-search'>
<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
<tr>
<th>Delete</th><th>Username</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Join Date</th><th>Last Sign In</th>
</tr>
<?php
//Cycle through users
foreach ($userData as $v1) {
?>
<tr>
<td><input type='checkbox' name='delete[<?=$v1->id?>]' id='delete[".$v1->id."]' value='<?=$v1->id?>'></td>
<td><a href='admin_user.php?id=<?=$v1->id?>'><?=$v1->username?></a></td>
<td><?=$v1->email?></td>
<td><?=$v1->fname?></td>
<td><?=$v1->lname?></td>
<td><?=$v1->join_date?></td>
<td><?=$v1->last_login?></td>
</tr>
<?php } ?>

</table>
<input class='btn btn-primary' type='submit' name='Submit' value='Delete' />
</form>
