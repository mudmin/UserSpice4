<?php
$formsQ = $db->query('SELECT * FROM us_forms ORDER BY form');
$formsC = $formsQ->count();
if($formsC > 0){
	$forms = $formsQ->results();
}
?>
<h2>Your Forms</h2>
<table id="forms" class='table table-hover table-list-search'>
	<thead>
		<th>Form Name</th><th>Shortcode</th><th>Manage</th>
	</thead>
	<tbody>
		<?php
		if($formsC > 0){
		foreach($forms as $f){?>
			<tr>
				<td><?=$f->form?></td>
				<td>displayForm('<?=$f->form?>');</td>
				<td><a href="edit_form.php?edit=<?=$f->id?>" class="btn btn-primary">Edit</a></td>
			</tr>
		<?php }} ?>
	</tbody>
</table>
