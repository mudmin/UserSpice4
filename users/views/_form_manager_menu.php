<?php
if(!in_array($user->data()->id,$master_account)){
  Redirect::to($us_url_root.'users/admin.php?err=You+do+not+have+permission');
}
//Errors Successes
$errors = [];
$successes = [];

if(!empty($_POST['create_form'])){
  $name = Input::get('name');
  createForm($name);
}
if(!empty($_POST['create_form_from_db'])){
  $dbTable = Input::get('dbTable');
  buildFormFromTable($dbTable);
}

if(!empty($_POST['duplicate'])){
  $old = Input::get('old');
  $new = Input::get('new');
  duplicateForm($new,$old);
}

if(!empty($_POST['deleteThisForm'])){
  require_once $abs_us_root.$us_url_root.'users/helpers/dbtables.php';
  $toDelete = Input::get('deleteThisForm');
  $deleteTable = Input::get('deleteTable');
  if($deleteTable != ''){
    //user is requesting to delete both the form and the data table
    //check if table is protected
    if(in_array($toDelete,$tables)){
      //table protected, only delete form
      deleteForm($toDelete);
      $msg = "The data table you tried to delete is protected, but the form itself was deleted";
    }else{
      //unprotected table, deelete both db and form
      deleteForm($toDelete,['deleteTable'=>'YES']);
      $msg = "Form and data successfully deleted";
    }
  }else{
    //user only requested to delete the form
    deleteForm($toDelete);
    $msg = "Form successfully deleted";
  }
  Redirect::to($us_url_root.'users/admin.php?view=forms&err='.$msg);
}
?>
<div class="row">
  <div class="col-12">
    <h2>Forms Manager
      <a href="admin.php?view=forms" class="show-tooltip" title="Form manager home"><i class="fa fa-home"></i></a>
      <a href="#" data-toggle="modal" data-target="#newForm" class="show-tooltip" title="Create new form"><i class="fa fa-plus"></i></a>
      <a href="#" data-toggle="modal" data-target="#duplicate" class="show-tooltip" title="Duplicate an existing form"><i class="fa fa-clone"></i></a>
      <a href="#" data-toggle="modal" data-target="#fromDB" class="show-tooltip" title="Create form from existing db table"><i class="fa fa-tasks"></i></a>
      <a href="admin.php?view=forms_views" class="show-tooltip" title="Manage form views"><i class="fa fa-eye"></i></a>
      <a href="#" data-toggle="modal" data-target="#deleteForm" class="show-tooltip" title="Delete a form"><i class="fa fa-times-circle"></i></a>
      <a href="#" onclick=" window.open('https://userspice.com/using-the-form-manager/','_blank')" class="show-tooltip" title="Help with forms"><i class="fa fa-question-circle"></i></a>
    </h2>
    Please note: While the forms are designed to be filled out by the end user, the forms manager is not designed to be accessable to the public. Please keep it as master account only.
    <?=resultBlock($errors,$successes);?>
    <hr>
  </div>
</div>


<!-- Modal -->
<div id="newForm" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create a New Form</h4>
      </div>
      <div class="modal-body">
        <p>Please give the new form a name:</p>
        <div class="form-group">
          <form autocomplete="off" class="inline-form" action="" method="POST" id="newFormForm">
            <input size="50" type="text" name="name" value="" class="form-control" placeholder="Lowercase letters and numbers only"><br />
            <div class="btn-group pull-right"><input class='btn btn-primary' type='submit' name="create_form" value='Create Form' class='submit' /></div><br />
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="fromDB" class="modal" role="dialog">
  <div class="modal-dialog">
    <?php $tables = getValidTables();?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create a form from an existing DB table</h4>
      </div>
      <div class="modal-body">
        <p>Please choose an existing table:</p>
        <div class="form-group">
          <form autocomplete="off" class="inline-form" action="" method="POST" id="newFormFromDB">
            <select class="form-control" name="dbTable">
              <?php foreach($tables as $t){ ?>
                <option value="<?=$t?>"><?=$t?></option>
              <?php } ?>
            </select>
            <br />
            <div class="btn-group pull-right"><input class='btn btn-primary' type='submit' name="create_form_from_db" value='Create Form' class='submit' /></div><br />
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="duplicate" class="modal" role="dialog">
  <div class="modal-dialog">
    <?php $forms = $db->query("SELECT * FROM us_forms")->results();?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Duplicate an existing form</h4>
      </div>
      <div class="modal-body">
        <p>Please choose a form to duplicate:</p>
        <div class="form-group">
          <form autocomplete="off" class="inline-form" action="" method="POST" id="duplicate">
            <select class="form-control" name="old">
              <?php foreach($forms as $f){ ?>
                <option value="<?=$f->form?>"><?=$f->form?></option>
              <?php } ?>
            </select>
            <br />
            New Form Name
            <input type="text" class="form-control" name="new" value="" placeholder="lowercase only, no symbols" required>
            <br />
            <div class="btn-group pull-right"><input class='btn btn-primary' type='submit' name="duplicate" value='Duplicate Form' class='submit' /></div><br />
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->

<div id="deleteForm" class="modal" role="dialog">
  <div class="modal-dialog">
    <?php
    require_once $abs_us_root.$us_url_root.'users/helpers/dbtables.php';
    $forms = $db->query("SELECT * FROM us_forms")->results();
    $warnings = 0;
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete an existing form</h4>
      </div>
      <div class="modal-body">
        <p>Please choose a form to delete:</p>
        <div class="form-group">
          <form autocomplete="off" class="inline-form" action="" method="POST" id="deleteForm" required>
            <select class="form-control" name="deleteThisForm">
              <option disabled selected="selected">--choose a form--</option>
              <?php foreach($forms as $f){ ?>
                <option value="<?=$f->form?>"><?=$f->form?>
                  <?php
                  if(in_array($f->form,$tables)){
                    $warnings = $warnings + 1;
                    echo "***";
                  }
                  ?>

                </option>
              <?php } ?>
            </select>
            <br />
            <strong>This action <font color="red">cannot</font> be undone!<br>
              <br />
              <div class="btn-group pull-left"><input class='btn btn-danger' type='submit' name="deleteTable" value='Delete the Form AND related DB Table' class='submit' /></div>
              <div class="btn-group pull-right"><input class='btn btn-success' type='submit' name="delete" value='Delete the Form!' class='submit' /></div><br />
            </form><br>
            <?php
            if($warnings > 0){ ?>
              *** Forms with *** after the name were created from UserSpice default database tables. Therefore, although you can delete the form itself, you cannot delete both the form and the data.
            <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <script src="../users/js/jwerty.js"></script>
  <script src="../users/js/combobox.js"></script>
  <script>
  $(document).ready(function() {
    $('.show-tooltip').tooltip();

    $('.combobox').combobox();

    jwerty.key('ctrl+f1', function () {
      $('.modal').modal('hide');
      $('#newForm').modal();
    });
    jwerty.key('ctrl+f2', function () {
      $('.modal').modal('hide');
      $('#fromDB').modal();
    });

    jwerty.key('esc', function () {
      $('.modal').modal('hide');
    });
    $('.modal').on('shown.bs.modal', function() {
      $('#combobox').focus();
    });
  });
</script>
