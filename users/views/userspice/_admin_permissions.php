<?php
$errors = [];
$successes = [];
echo resultBlock($errors,$successes);
?>

<form name='adminPermissions' action='<?=$_SERVER['PHP_SELF']?>' method='post'>
  <h2>Create a new permission group</h2>
  <p>
    <label>Permission Name:</label>
    <input type='text' name='name' />
  </p>
<br>
  <h2>Choose a permission group to edit</h2>
  <table class='table table-hover'>
    <tr>
      <th>Delete</th><th>Permission Name</th>
    </tr>

    <?php
    //List each permission level
    foreach ($permissionData as $v1) {
      ?>
      <tr>
        <td><input type='checkbox' name='delete[<?=$permissionData[$count]->id?>]' id='delete[<?=$permissionData[$count]->id?>]' value='<?=$permissionData[$count]->id?>'></td>
        <td><a href='admin_permission.php?id=<?=$permissionData[$count]->id?>'><?=$permissionData[$count]->name?></a></td>
      </tr>
      <?php
      $count++;
    }
    ?>

  </table>


  <input type="hidden" name="csrf" value="<?=Token::generate();?>" >

  <input class='btn btn-primary' type='submit' name='Submit' value='Update' />

</form>
