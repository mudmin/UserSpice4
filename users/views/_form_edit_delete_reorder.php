<br><h2>Delete and Reorder</h2>
<?php   $q = $db->query("SELECT id, ord, form_descrip, validation FROM $name ORDER BY ord");
$c = $q->count();
if($c > 0){
  $r = $q->results(); ?>
  <table class="table table-striped">
    Deleting a field does not delete form data
    <thead>
      <tr>
        <th>Order</th><th>Description</th><th>Validation</th><th>Edit</th><th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($r as $f){ ?>
        <tr>
          <td><?=$f->ord?></td>
          <td><?=$f->form_descrip?></td>
          <td><?php if($f->validation != ''  && $f->validation !='[]'){echo "<font color='green'>Yes</font>";}else{echo "<font color='red'>No</font>";}?></td>
          <td>
            <form class="" action="" method="post">
              <input type="hidden" name="field" value="<?=$f->id?>">
              <input type="submit" name="edit_field" value="Edit">
            </form>
          </td>
          <td>
            <form class="" action="" method="post">
              <input type="hidden" name="delete" value="<?=$f->id?>">
              <input type="submit" name="delete_field" value="Delete">
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php
}else{
  echo "Form not found.<br>";
}
?>
