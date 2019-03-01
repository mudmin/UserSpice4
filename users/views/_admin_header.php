
<!-- Header-->
<header id="header" class="header">

  <?php
  require_once $abs_us_root.$us_url_root.'users/includes/template/header3_must_include.php';
  if(isset($_GET['err'])){
      $err=Input::get('err');
  		err($err);
  	}

  	if(isset($_GET['msg'])){
      $msg=Input::get('msg');
  		bold($msg);
  	}
      ?>

  <div class="header-menu">
    <div class="col-sm-4">
      <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-hand-o-left"></i></a>
      <div class="page-header float-left">
        <div class="page-title">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div>
