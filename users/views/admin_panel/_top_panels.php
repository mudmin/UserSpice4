<div class="row">

  
  <div class="col-xs-6 col-md-3">
  		<div class="panel panel-success">
		  <div class="panel-heading">
		  Users
		  </div>
		  
		  <div class="panel-body text-center">
			  <?php echo  "<div class='huge'> <i class='fa fa-user fa-1x'></i> {$user_count}</div>"; ?>
		  </div>
		  
		  <div class="panel-footer">
			  <span class="pull-left"><a href="admin_users.php">Manage Them</a></span>
			  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  <div class="clearfix"></div>
			</div>
		</div>
	
  </div>

    <div class="col-xs-6 col-md-3">
  
  
  		<div class="panel panel-warning">
		  <div class="panel-heading">
		  Permission Levels 
		  </div>
		  
		  <div class="panel-body text-center">
			  <?php echo  "<div class='huge'> <i class='fa fa-lock fa-1x'></i> {$level_count}</div>"; ?>
		  </div>
		  
		  <div class="panel-footer">
			  <span class="pull-left"><a href="admin_permissions.php">Manage Them </a></span>
			  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  <div class="clearfix"></div>
			</div>
		</div>
  
  </div>
  
  <div class="col-xs-6 col-md-3">
		<div class="panel panel-default">
		  <div class="panel-heading">
		  Pages <a class="text-muted" href="#" data-toggle="popover" title="UserSpice Pages" data-placement="bottom" data-content="Each page can be configured with security settings and user permissions. Take the time to ensure all your pages are correctly configured." ><i class="fa fa-info-circle"></i></a>
		  </div>
		  
		  <div class="panel-body  text-center">
			  <?php echo  "<div class='huge '> <i class='fa fa-file-text fa-1x'></i> {$page_count}</div>"; ?>
		  </div>
		  
		  <div class="panel-footer">
			  <span class="pull-left"><a href="admin_pages.php">Manage Them</a></span>
			  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  <div class="clearfix"></div>
			</div>
		</div>
	</div>
  

  
  <div class="col-xs-6 col-md-3">
  
    		<div class="panel panel-default">
		  <div class="panel-heading">
		  Email Settings
		  </div>
		  
		  <div class="panel-body text-center">
			  <?php echo  "<div class='huge'> <i class='fa fa-paper-plane fa-1x'></i> 9</div>"; ?>
		  </div>
		  
		  <div class="panel-footer">

		   <?php if($user->data()->id==1){ ?>
        
            <span class='pull-left'><a href='email_settings.php'>Manage Them</a></span>
              <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
              <div class='clearfix'></div>
 
          <?php }else{ ?>

              <span class='pull-left'>Restricted Area</span>
                <span class='pull-right'><i class='fa fa-arrow-circle-right'></i></span>
                <div class='clearfix'></div>

              <?php } ?>	
		  
		  
			</div>
		</div>
  
  


    </div>
    
</div>
<!-- /.row -->
