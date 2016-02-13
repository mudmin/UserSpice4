<h2>Set the Permissions of a Specific Page </h2>
      <?php resultBlock($errors,$successes); ?>

      <form name='adminPage' action='<?=$_SERVER['PHP_SELF'];?>?id=<?=$pageId;?>' method='post'>
      <input type='hidden' name='process' value='1'>
      <table class='table table-responsive'>
          <tr><td>
          <h3>Page Information</h3>
          <div class='regbox'>
            <p>
              <label>ID:</label>
              <?= $pageDetails->id; ?>
            </p>
            <p>
              <label>Name:</label>
              <?= $pageDetails->page; ?>
            </p>
            <h3>Public or Private?</h3>
            <p>
              <label>Private:</label>

              <?php
              //Display private checkbox
              $checked = ($pageDetails->private == 1)? ' checked' : ''; ?>
                <input type='checkbox' name='private' id='private' value='Yes'<?=$checked;?>>
            </p>
          </div>
          </td><td>
          <h3>Page Access</h3>
          <div class='regbox'>
          <p><strong>
            Remove Access:
          </strong>

            <?php
            //Display list of permission levels with access
            $perm_ids = [];
            foreach($pagePermissions as $perm){
              $perm_ids[] = $perm->permission_id;
            }
            foreach ($permissionData as $v1):
              if(in_array($v1->id,$perm_ids)): ?>
                <br><input type='checkbox' name='removePermission[]' id='removePermission[]' value='<?=$v1->id;?>'> <?=$v1->name;?>
              <?php endif; ?>
            <?php endforeach; ?>

          </p>
          <p><strong>Add Access:</strong>

          <?php
          //Display list of permission levels without access
          foreach ($permissionData as $v1):
            if(!in_array($v1->id,$perm_ids)): ?>
              <br><input type='checkbox' name='addPermission[]' id='addPermission[]' value='<?=$v1->id;?>'> <?=$v1->name;?>
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
  <input class='btn btn-primary' type='submit' value='Update' class='submit' />
</p>
</form>
