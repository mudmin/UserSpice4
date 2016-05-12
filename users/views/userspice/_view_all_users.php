<hr />
 <div class="allutable table-responsive">
<table class='table table-hover table-list-search'>
<thead>
<tr>
  <th><div class="alluinfo">&nbsp;</div></th>
  <th>Username</th>
 </tr>
</thead>
 <tbody>
<?php
//Cycle through users
foreach ($users as $v1) {

	$ususername = ucfirst($v1->username);
	$ususerbio = ucfirst($v1->bio);
	$grav = get_gravatar(strtolower(trim($v1->email)));
	$useravatar = '<img src="'.$grav.'" class="img-responsive img-thumbnail" alt="'.$ususername.'">';

?>

	<tr>
		<td>
			<a href="profile.php?id=<?=$v1->id?>"><?php echo $useravatar;?></a>
		</td>
  
		  <td>
			<h4><a href="profile.php?id=<?=$v1->id?>"><?=$ususername?>  </a></h4>
			<p><?=$ususerbio?></p>
		</td>

	</tr>
<?php } ?>
  </tbody>
</table>
	  </div>	