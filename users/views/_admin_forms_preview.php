<div class="col-sm-8">
  <div class="page-header float-right">
    <div class="page-title">
      <ol class="breadcrumb text-right">
        <li><a href="<?=$us_url_root?>users/admin.php">Dashboard</a></li>
        <li>Tools</li>
        <li class="active">Form Builder</li>
      </ol>
    </div>
  </div>
</div>
</div>
</header>
<div class="content mt-3">
  <?php require_once($abs_us_root.$us_url_root.'users/views/_form_manager_menu.php');?>

  <div class="row">
    <div class="col-sm-12">
      <?php
      $toDisplay = Input::get('demo');
      if(is_numeric($toDisplay)){
        displayView($toDisplay,['nosubmit'=>1]);
      }
      ?>
    </div>
  </div>
</div>


    <script>
    $(document).ready(function() {
    });
  </script>
