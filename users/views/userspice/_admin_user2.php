
        <h3>Permission Membership</h3>
         <div class="panel panel-danger">
		 	 <div class="panel-heading">Remove a Permission from this User:</div>
			 <div class="panel-body">
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
					  <input type='checkbox' name='removePermission[]' id='removePermission[]' value='<?=$v1->id;?>'> <?=$v1->name;?>
					<?php endif; ?>
				  <?php endforeach; ?>
			</div>
          </div>

         <div class="panel panel-success">
		 	 <div class="panel-heading">Add a Permission for this User:</div>
			 <div class="panel-body">
				  <?php
				  foreach ($permissionData as $v1):
					if(!in_array($v1->id,$perm_ids)): ?>
					  <input type='checkbox' name='addPermission[]' id='addPermission[]' value='<?=$v1->id;?>'> <?=$v1->name;?>
					<?php endif; ?>
				  <?php endforeach; ?>
				</div>
          </div>

          <!-- Will be implemented in a later release -->
          <label> Block this user?:
            <select name="active">
              <option <?php if ($userdetails->permissions==1){echo "selected='selected'";} ?> value="1">No</option>
              <option <?php if ($userdetails->permissions==0){echo "selected='selected'";} ?>value="0">Yes</option>
            </select>
