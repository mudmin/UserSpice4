<?php
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
  $toDelete = Input::get('deleteThisForm');
  deleteForm($toDelete);
}
?>
<div class="row">
  <div class="col-xs-12">
    <h1>Forms Manager
      <a href="admin_forms.php" class="show-tooltip" title="Form manager home"><i class="glyphicon glyphicon-home"></i></a>
      <a href="#" data-toggle="modal" data-target="#newForm" class="show-tooltip" title="Create new form"><i class="glyphicon glyphicon-plus"></i></a>
      <a href="#" data-toggle="modal" data-target="#duplicate" class="show-tooltip" title="Duplicate an existing form"><i class="glyphicon glyphicon-duplicate"></i></a>
      <a href="#" data-toggle="modal" data-target="#fromDB" class="show-tooltip" title="Create form from existing db table"><i class="glyphicon glyphicon-tasks"></i></a>
      <a href="admin_form_views.php" class="show-tooltip" title="Manage form views"><i class="glyphicon glyphicon-sunglasses"></i></a>
      <a href="#" data-toggle="modal" data-target="#deleteForm" class="show-tooltip" title="Delete a form"><i class="glyphicon glyphicon-remove"></i></a>
      <a href="https://userspice.com/using-the-form-manager/" class="show-tooltip" title="Help with forms"><i class="glyphicon glyphicon-question-sign"></i></a>
    </h1>
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
          <form class="inline-form" action="" method="POST" id="newFormForm">
            <input size="50" type="text" name="name" value="" class="form-control" placeholder="Lowercase letters, no symbols/numbers except _"><br />
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
          <form class="inline-form" action="" method="POST" id="newFormFromDB">
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
          <form class="inline-form" action="" method="POST" id="duplicate">
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
    <?php $forms = $db->query("SELECT * FROM us_forms")->results();?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deletee an existing form</h4>
      </div>
      <div class="modal-body">
        <p>Please choose a form to delete:</p>
        <div class="form-group">
          <form class="inline-form" action="" method="POST" id="deleteForm" required>
            <select class="form-control" name="deleteThisForm">
              <option disabled selected="selected">--choose a form--</option>
              <?php foreach($forms as $f){ ?>
                <option value="<?=$f->form?>"><?=$f->form?></option>
              <?php } ?>
            </select>
            <br />
            <strong>This action <font color="red">cannot</font> be undone!<br>
            <br />
            <div class="btn-group pull-right"><input class='btn btn-danger' type='submit' name="delete" value='Yes, Delete the Form!' class='submit' /></div><br />
          </form>
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
