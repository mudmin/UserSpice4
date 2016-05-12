<form name='adminUser' action='<?=$_SERVER['PHP_SELF']?>?id=<?=$userId?>' method='post'>
  <table class='table'><tr><td>
    <h3>User Information</h3>
    <div id='regbox'>
      <p>
        <label>User ID:</label>
        <?=$userdetails->id?>
      <p>
        <label>Logins: </label>
        <?=$userdetails->logins?>
      </p>
      </p>
      <p>
        <label>Username:
          <input  class='form-control' type='text' name='username' value='<?=$userdetails->username?>' /></label>
        </p>
      <p>
        <label>First Name:
          <input  class='form-control' type='text' name='fname' value='<?=$userdetails->fname?>' /></label>
        </p>
      <p>
        <label>Last Name:
          <input  class='form-control' type='text' name='lname' value='<?=$userdetails->lname?>' /></label>
        </p>
      <p>
        <label>Email:
          <input class='form-control' type='text' name='email' value='<?=$userdetails->email?>' /></label>
        </p>
        <!-- Will be implemented in a later release -->
        <!-- <label> Account Active?:
            <input type="radio" name="active" value="1" <?php echo ($userdetails->active==1)?'checked':''; ?> size="25">Yes</input></label>
            <input type="radio" name="active" value="0" <?php echo ($userdetails->active==0)?'checked':''; ?> size="25">No</input></label> -->
          <p>
          </div>
        </td>
        <td>
          <h3>Permission Membership</h3>
          <div id='regbox'>
            <p><strong>Remove a Permission from this User:</strong>
              <?php
              //NEW List of permission levels user is apart of
              //dump($userPermission);
              $perm_ids = [];
              foreach($userPermission as $perm){
                $perm_ids[] = $perm->permission_id;
                //dump($perm_ids);
              }
              //dump($permissionData);
              foreach ($permissionData as $v1):
                if(in_array($v1->id,$perm_ids)): ?>
                  <br><input type='checkbox' name='removePermission[]' id='removePermission[]' value='<?=$v1->id;?>'> <?=$v1->name;?>
                <?php endif; ?>
              <?php endforeach; ?>


            </p><p><strong>Add a Permission for this User:</strong>
              <?php
              foreach ($permissionData as $v1):
                if(!in_array($v1->id,$perm_ids)): ?>
                  <br><input type='checkbox' name='addPermission[]' id='addPermission[]' value='<?=$v1->id;?>'> <?=$v1->name;?>
                <?php endif; ?>
              <?php endforeach; ?>
              <br><br>
              <label> Block this user?:
                          <select name="active">
                            <option <?php if ($userdetails->permissions==1){echo "selected='selected'";} ?> value="1">No</option>
                            <option <?php if ($userdetails->permissions==0){echo "selected='selected'";} ?>value="0">Yes</option>
                          </select>



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
