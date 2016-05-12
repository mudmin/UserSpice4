 <hr />
 <div class="alluinfo">&nbsp;</div>
<form name="adminUsers" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
 <div class="allutable table-responsive">
	<table class='table table-hover table-list-search'>
	<thead>
	<tr>
		<th>Delete</th><th>Username</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Join Date</th><th>Last Sign In</th><th>Logins</th>
	 </tr>
	</thead>
 <tbody>
	<?php
	//Cycle through users
	foreach ($userData as $v1) {
			?>
	<tr>
	<td><div class="form-group"><input type="checkbox" name="delete[<?=$v1->id?>]" value="<?=$v1->id?>" /></div></td>
	<td><a href='admin_user.php?id=<?=$v1->id?>'><?=$v1->username?></a></td>
	<td><?=$v1->email?></td>
	<td><?=$v1->fname?></td>
	<td><?=$v1->lname?></td>
	<td><?=$v1->join_date?></td>
	<td><?=$v1->last_login?></td>
	<td><?=$v1->logins?></td>
	</tr>
			<?php } ?>

  </tbody>
</table>
</div>

	<input type="hidden" name="csrf" value="<?=Token::generate();?>" >
<input class='btn btn-primary' type='submit' name='Submit' value='Delete' />
</form>
