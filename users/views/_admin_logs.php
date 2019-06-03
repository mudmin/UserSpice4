<div class="col-sm-8">
  <div class="page-header float-right">
    <div class="page-title">
      <ol class="breadcrumb text-right">
        <li><a href="<?=$us_url_root?>users/admin.php">Dashboard</a></li>
        <li>Tools</li>
        <li class="active">System Logs</li>
      </ol>
    </div>
  </div>
</div>
</div>
</header>
<?php
$errors = [];
$successes = [];
?>
<style>
tfoot input {
  width: 100%;
  box-sizing: border-box;
}
</style>
<div class="content mt-3">
  <h2>System Logs</h2>
  <!-- <a href='admin.php?view=logsman'>Go to Logs Manager</a> -->
  <?php resultBlock($errors, $successes);
  $search = Input::get('search');
  ?>
  <hr>
  <table id="paginate" class='table table-hover table-striped table-list-search display'>
    <thead>
      <th>log id</th>
      <th>ip</th>
      <th >user_id</th>
      <th>fname</th>
      <th>lname</th>
      <th>logdate</th>
      <th>logtype</th>
      <th>lognote</th>
    </thead>
    <tfoot>
      <th>log id</th>
      <th>user_id</th>
      <th>fname</th>
      <th>lname</th>
      <th>logdate</th>
      <th>logtype</th>
      <th>lognote</th>
    </tfoot>
  </table>
  </div>

<script type="text/javascript" src="js/pagination/datatables.min.js"></script>
<script>
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
var columns_short = [
  {"db": "logs.id as logsid", "dt": 0, "field": "logsid"},
  {"db": "ip", "dt": 1, "field": "ip"},
  {"db": "user_id", "dt": 2, "field": "user_id"},
  {"db": "users.fname as fname", "dt": 3, "field": "fname"},
  {"db": "users.lname as lname", "dt": 4, "field": "lname"},
  {"db": "logdate", "dt": 5, "field": "logdate"},
  {"db": "logtype", "dt": 6, "field": "logtype"},
  {"db": "lognote", "dt": 7, "field": "lognote"}
];
$(document).ready(function () {
 var search = "<?=$search?>";
  // Setup - add a text input to each footer cell
  $('#paginate tfoot th').each(function () {
    var title = $(this).text();
    // $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    $(this).html('<input type="text" placeholder="" />');
  });

  // DataTable
  var table = $('#paginate').DataTable({
    "pageLength": 10,
    "stateSave": true,
    "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
    "aaSorting": [],
    "serverSide": true,
    "processing": true,
    "scrollX": true,
    "stateSave": true,
    "order": [ 0, 'desc' ],
    "ajax": {
      "url": "loader.php",
      "type": "POST",
      //specify the table, primary key and "extra": page here.
      "data": {
        "table": "logs",
        "primary_key": "user_id",
        "extra": "admin_logs",
        "columns": columns_short},
      }
    });

    // Apply the search
    table.columns().every(function () {
      if(search != ''){
        $('#paginate').DataTable().search(search, false, false).draw();
      }
      var that = this;
      //this makes it so that the search only fires when enter(13) or backspace(8) are pressed.
      $('input', this.footer()).on( 'keyup', function (ev) {
        if (ev.keyCode === 13 || ev.keyCode === 8) {
          that
          .search(this.value)
          .draw();
        }
      });
    });
  });

</script>
