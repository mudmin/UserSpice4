<?php
$valCount = 1;
$opt = $db->query('SELECT * FROM us_form_validation')->results();?>
<div class="form-group">
  <label for="">Choose your validation options</label>
  <table class="table">
    <thead>
      <tr>
        <th>Validation Option</th><th>Value</th><th>Add</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <select class="form-control" name="validation" id="validation">
            <option value=""></option>
            <?php
            foreach($opt as $o){ ?>
              <option value="<?=$o->value?>"  data-valID="<?=$o->id?>" data-field="<?=$o->params?>"><?=$o->description?></option>
            <?php }
            ?>
          </select>
        </td>
        <td>
          <input type="number" name="value" value="" class="form-control" id="numberInput" placeholder="Enter a number">
          <input type="text" name="value" value="true" class="form-control" id="trueInput" readonly>
          <input type="text" name="value" value="" class="form-control" id="textInput" placeholder="Enter a value">
        </td>
        <td><input id="addVal" type="button" class="form-control" value="Add" name="task[]" value="<?=$o->id?>" data-id="<?=$o->id?>" onclick="updateValidation(event);"></td>
      </tr>
    </tbody>
  </table>
</div>
<script>

function updateValidation(evt){
  var valID = $("#validation").find(':selected').attr('data-valID');
  var formData = {
    validation:$("#validation").val(),
    trueInput:$("#trueInput").val(),
    numberInput:$("#numberInput").val(),
    textInput:$("#textInput").val(),
    row:"<?=$f->id?>",
    formname:"<?=$name?>",
    valID:valID,
    task_id:evt.target.dataset.id,
    checked:evt.target.checked
  };

  jQuery.ajax({
    url:"parsers/form_validation.php",
    method:"POST",
    data:formData,
    success: updateValidationSuccess
  });
}

function updateValidationSuccess(resp){
  var r = JSON.parse(resp);
  if(r.success){
    //It shall forever be known that Jamezs made this row addition work
    //with jquery when mudmin screwed it up. Thanks Jamezs!

    var newRow = $("<tr>");
    var cols = "";
    cols += '<td>' + r.option + '</td>';
    cols += '<td>' + r.value + '</td>';
    cols += '<td>Delete</td>';
    newRow.append(cols);
    $("#valTable").append(newRow);
  };
}
</script>

<script>
$(document).ready(function () {
  toggleFields();
  // this will call our toggleFields function every time the selection value of our other field changes
  $("#validation").change(function () {
    toggleFields();
  });

});
// this toggles the visibility of other server
function defaultHide(){
  $("#addVal").hide();
  $("#numberInput").hide();
  $("#trueInput").hide();
  $("#textInput").hide();
}
function toggleFields() {
  defaultHide();
  if ($("#validation").val() === ""){
    defaultHide();

  }else{
    var dataField = $("#validation").find(':selected').attr('data-field');
    if(dataField === "number"){
      $("#numberInput").show();
      $("#numberInput").prop('required',true);
      $("#trueInput").prop('required',false);
      $("#textInput").prop('required',false);
      $("#addVal").show();
    }
    if(dataField === "true"){
      $("#trueInput").show();
      $("#numberInput").prop('required',false);
      $("#trueInput").prop('required',true);
      $("#textInput").prop('required',false);
      $("#addVal").show();
    }

    if(dataField === "text"){
      $("#textInput").show();
      $("#numberInput").prop('required',false);
      $("#trueInput").prop('required',false);
      $("#textInput").prop('required',true);
      $("#addVal").show();
    }

  }
}
</script>
