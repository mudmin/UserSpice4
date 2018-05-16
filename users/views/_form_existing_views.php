<h2>Your Form Views</h2>
<?php
$previewsQ = $db->query("SELECT * FROM us_form_views ORDER BY form_name ASC");
$previewsC = $previewsQ->count();
if($previewsC > 0){
  $previews = $previewsQ->results();
  ?>
  <table id="views" class='table table-hover table-list-search'>
    <thead>
      <tr>
        <th>Form</th>
        <th>View</th>
        <th>Shortcode</th>
        <th>Preview</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach($previews as $v){ ?>
        <tr>
          <td><?=$v->form_name?></td>
          <td><?=$v->view_name?></td>
          <td>displayView(<?=$v->id?>);</td>
          <td><a class="btn btn-default" href="admin_form_views.php?demo=<?=$v->id?>">Preview</a></td>
          <td>
            <form class="" action="" method="post">
              <input type="hidden" name="delete_view" value="<?=$v->id?>">
              <input type="submit" name="submit" value="Delete" class="btn btn-danger">
            </form>
          </td>
        </tr>
    </tbody>
  <?php } ?>
  </table>
  <?php
}else{
  echo "You have not created any views.";
}
