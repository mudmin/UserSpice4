<table class='table table-hover table-list-search'>
<tr>
<th>Username</th><th>First Name</th>
</tr>
<?php
//Cycle through users
foreach ($users as $v1) {
?>
<tr>
  <td><a href='profile.php?id=<?=$v1->id?>'>
    <?=ucfirst($v1->username)?></a></td>
<td><?=$v1->fname?></td>

</tr>
<?php } ?>
</table>
