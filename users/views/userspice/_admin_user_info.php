<form class="form-inline" name='adminUser' action='<?=$_SERVER['PHP_SELF']?>?id=<?=$userId?>' method='post'>
   <h3>User Information</h3>
  <div class="panel panel-default">
		 	 <div class="panel-heading">User ID: <?=$userdetails->id?></div>
			 <div class="panel-body">
				   <p>
						<label>Logins: </label>
						<?=$userdetails->logins?>
					  </p>
					  </p>
					  <p>
						<label>Username:
						  <input  class='form-control' type='text' name='username' value='<?=$userdetails->username?>' /></label>
						<label>Email:
						  <input class='form-control' type='text' name='email' value='<?=$userdetails->email?>' /></label>
						</p>
					  <p>
						<label>First Name:
						  <input  class='form-control' type='text' name='fname' value='<?=$userdetails->fname?>' /></label>
			
						<label>Last Name:
						  <input  class='form-control' type='text' name='lname' value='<?=$userdetails->lname?>' /></label>
						</p>

						<!-- Will be implemented in a later release -->
						<!-- <label> Account Active?:
							<input type="radio" name="active" value="1" <?php echo ($userdetails->active==1)?'checked':''; ?> size="25">Yes</input></label>
							<input type="radio" name="active" value="0" <?php echo ($userdetails->active==0)?'checked':''; ?> size="25">No</input></label> -->
						  <p>
			 </div>
          </div>
		  
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
		  
	         <div class="panel panel-success">
			 <div class="panel-body">
    <input type="hidden" name="csrf" value="<?=Token::generate();?>" >
 
      <label>&nbsp;</label>
      <input class='btn btn-primary' type='submit' value='Update' class='submit' />
				</div>
          </div>	  


</form>
