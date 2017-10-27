<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?php require_once 'init.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/header.php'; ?>
<?php require_once $abs_us_root.$us_url_root.'users/includes/navigation.php'; ?>

<?php if (!securePage($_SERVER['PHP_SELF'])){die();} ?>

<?php
$get_info_id = $user->data()->id;
$userdetails = fetchUserDetails(NULL, NULL, $get_info_id);
//Errors Successes
$errors = [];
$successes = [];
 //Forms posted
if(!empty($_POST)) {
	$post_user_id = Input::get('post_user_id');
	$post_type = Input::get('post_type');
		if(!empty($post_user_id)) {
			Redirect::to('admin_logs.php?user_id='.$post_user_id);
		}
		elseif(!empty($post_type)) {
			Redirect::to('admin_logs.php?type='.$post_type);
		}
		else {
		Redirect::to('admin_logs.php'); }
	}

$user_id = Input::get('user_id');
$type = Input::get('type');
if(!empty($user_id)) {
	$countQ = $db->query("SELECT * FROM logs WHERE user_id = ?",array($user_id));
	$other = "&user_id=$user_id";
}
elseif(!empty($type)) {
	$countQ = $db->query("SELECT * FROM logs WHERE logtype = ?",array($type));
	$other = "&type=$type";
}
else {
	$countQ = $db->query("SELECT * FROM logs WHERE logtype NOT IN (SELECT name FROM logs_exempt)");
	$other = "";
}
//Query/Result Grab
$countCount = $countQ->count();
$total_pages = $countCount;
$adjacents = 3;
$limit = 25;
if(isset($_REQUEST['page']))
	{
		$page = $_REQUEST['page'];
	}
if (empty($_REQUEST['page']))
	{
		$page = '0';
	}
if($page)
	$start = ($page - 1) * $limit;
else
	$start = 0;
if ($page == 0) $page = 1;
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages/$limit);
$lpm1 = $lastpage - 1;
$pagination = "";
if($lastpage > 1)
	{
			$pagination .= "<center><center><table><tr><td><table class='table table-bordered'><tr>";
			//previous button
			if ($page > 1)
				$pagination.= "<td><a href=\"?page=$prev$other\">&laquo; previous</a></td>";
			else
				$pagination.= "<td><span class=\"disabled\">&laquo; previous</span></td>";

			//pages
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<td><span class=\"current\">$counter</span></td>";
					else
						$pagination.= "<td><a href=\"?page=$counter$other\">$counter</a></td>";
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<td><span class=\"current\">$counter</span></td>";
						else
							$pagination.= "<td><a href=\"?page=$counter$other\">$counter</a></td>";
					}
					$pagination .= "<td><span class=\"elipses\">...</span></td>";
					$pagination.= "<td><a href=\"?page=$lpm1$other\">$lpm1</a></td>";
					$pagination.= "<td><a href=\"?page=$lastpage$other\">$lastpage</a></td>";
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<td><a href=\"?page=1\">1</a></td>";
					$pagination.= "<td><a href=\"?page=2\">2</a></td>";
					$pagination .= "<td><span class=\"elipses\">...</span></td>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<td><span class=\"current\">$counter</span></td>";
						else
							$pagination.= "<td><a href=\"?page=$counter$other\">$counter</a></td>";
					}
					$pagination .= "<td><span class=\"elipses\">...</span></td>";
					$pagination.= "<td><a href=\"?page=$lpm1$other\">$lpm1</a></td>";
					$pagination.= "<td><a href=\"?page=$lastpage$other\">$lastpage</a></td>";
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<td><a href=\"?page=1$other\">1</a></td>";
					$pagination.= "<td><a href=\"?page=2$other\">2</a></td>";
					$pagination .= "<td><span class=\"elipses\">...</span></td>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<td><span class=\"current\">$counter</span></td>";
						else
							$pagination.= "<td><a href=\"?page=$counter$other\">$counter</a></td>";
					}
				}
			}

			//next button
			if ($page < $counter - 1)
				$pagination.= "<td><a href=\"?page=$next$other\">next &raquo;</a></td>";
			else
				$pagination.= "<td><span class=\"disabled\">next &raquo;</span></td>";
			$pagination.= "</center></tr></table></td></tr></table></center>\n";
		}
if(!empty($user_id)) {
		$fuQ = $db->query("SELECT * FROM logs WHERE user_id = ? ORDER BY logdate DESC, id DESC LIMIT $start,$limit",array($user_id));
}
elseif(!empty($type)) {
	$fuQ = $db->query("SELECT * FROM logs WHERE logtype = ? ORDER BY logdate DESC, id DESC LIMIT $start,$limit",array($type));
}
else {
		$fuQ = $db->query("SELECT * FROM logs WHERE logtype NOT IN (SELECT name FROM logs_exempt) ORDER BY logdate DESC, id DESC LIMIT $start,$limit");
}
$fuCount = $fuQ->count();
 ?>
<div id="page-wrapper">
<div class="container">
<div class="well">
<?=resultBlock($errors,$successes);?>
<div class="row">
	<center>
		<h1>
            System Logs
            <a href="#" data-toggle="modal" data-target="#userfilter" class="show-tooltip" title="Filter by User"><i class="glyphicon glyphicon-user"></i></a>
            <a href="#" data-toggle="modal" data-target="#datafilter" class="show-tooltip" title="Filter by Type"><i class="glyphicon glyphicon-book"></i></a>
            <?php if(!empty($user_id) || !empty($type)) {?><a href="admin_logs.php" class="show-tooltip" title="Reset Filter"><i class="glyphicon glyphicon-refresh"></i></a><?php } ?>
            <a href="admin_logs_manager.php" class="show-tooltip" title="Logs Manager"><i class="glyphicon glyphicon-cog"></i></a>
        </h1>
		<table class='table table-bordered'>
					<tr>
						<th><center>Log Entires</center></th>
					</tr>
					<tr>
							<td>
								<?php echo $pagination; ?>
								<center>
								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<tr>
											<th width="25%"><center>Log Date</center></th>
											<th width="20%"><center>Log Type</center></th>
											<th width="55%"><center>Log Note</center></th>
										</tr>
								<?php
								if($fuCount > 0)
								{
									foreach ($fuQ->results() as $row){?>
									<?php $timestamp=date("Y-m-d h:i A", strtotime($row->logdate)); ?>
										 <tr>
												<td><center><?=$row->id?>. <?=$timestamp;?></center></td>
												<td><center><?=$row->logtype?> (<?=echousername($row->user_id);?>)</center></td>
												<td><center><?=$row->lognote;?></center></td>
										</tr>
												<?php  }
											 }
											else
											 { ?>
												 <tr><td colspan='3'><center>No Logs</center></td></tr>
											 <?php }
											 ?>
											 </table>
											</div>
								<?php echo $pagination; ?>
								</center>
							</td>
					</tr>
		</table>
	</center>
</div>
</div>

</div> <!-- /container -->

<!-- Modal -->
<div id="userfilter" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User Filter</h4>
      </div>
      <div class="modal-body">
        <p>Please select the user:</p>
		<div class="form-group">
		<form class="inline-form" action="" method="POST" id="userForm">
		<select name="post_user_id" id="combobox" class="form-control combobox">
		<option readonly></option>
		<?php $userData = fetchAllUsers(); //Fetch information for all users
		foreach($userData as $v1) {?>
		<option value="<?=$v1->id;?>"><?=$v1->id;?>. (<?=$v1->username;?>) <?=$v1->fname;?> <?=$v1->lname;?></option>
		<?php } ?>
		</select><br />
		<div class="btn-group pull-right"><input class='btn btn-primary' type='submit' value='Filter' class='submit' /></div><br />
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
<div id="datafilter" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Type Filter</h4>
      </div>
      <div class="modal-body">
        <p>Please select the type:</p>
		<div class="form-group">
		<form class="inline-form" action="" method="POST" id="dataForm">
		<select name="post_type" class="form-control combobox">
		<option readonly></option>
		<?php
		$typeQuery = $db->query("SELECT logtype FROM logs GROUP BY logtype");
		$typeCount = $typeQuery->count();
		if($typeCount > 0) {
			foreach ($typeQuery->results() as $results) {?>
			<option value="<?=$results->logtype?>"><?=$results->logtype?></option>
		<?php } } else {?>
		<option readonly>No Options Found</option>
		<?php } ?>
		</select><br />
		<div class="btn-group pull-right"><input class='btn btn-primary' type='submit' value='Filter' class='submit' /></div><br />
		</form>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div> <!-- /#page-wrapper -->

<!-- footers -->
<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php'; // the final html footer copyright row + the external js calls ?>

<!-- Place any per-page javascript here -->
<script src="js/jwerty.js"></script>
<script src="js/combobox.js"></script>
<script>
$(document).ready(function(){
    $('.show-tooltip').tooltip();

    $('.combobox').combobox();

    jwerty.key('ctrl+f1', function () {
        $('.modal').modal('hide');
        $('#userfilter').modal();
    });
    jwerty.key('ctrl+f2', function () {
        $('.modal').modal('hide');
        $('#datafilter').modal();
    });
    jwerty.key('esc', function () {
        $('.modal').modal('hide');
    });
    $('.modal').on('shown.bs.modal', function() {
        $('#combobox').focus();
    });
});
</script>

<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php'; // currently just the closing /body and /html ?>
