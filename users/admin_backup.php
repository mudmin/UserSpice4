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

/*
Set longer execution time and larger memory limit to deal with large backup sets
*/
ini_set('max_execution_time', 1356);
ini_set('memory_limit','1024M');

require_once 'init.php';
require_once $abs_us_root.$us_url_root.'users/includes/header.php';
require_once $abs_us_root.$us_url_root.'users/includes/navigation.php';

if (!securePage($_SERVER['PHP_SELF'])){die();}

$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();

$table_view = $db->query("SHOW TABLES");
$tablev = $table_view->results();

$errors = $successes = [];

if(isset($_GET['sc1'])){
	$successes[] = lang('AB_SETSAVED');
}
if(isset($_GET['del'])){
	$successes[] = "deleted backup";
}

//Forms posted
if(!empty($_POST)) {

	if(!empty($_POST['save'])){

		if($settings->backup_dest != $_POST['backup_dest']) {
			$backup_dest = Input::get('backup_dest');
			$fields=array('backup_dest'=>$backup_dest);
			$db->update('settings',1,$fields);
		}
		if($settings->backup_source != $_POST['backup_source']) {
			$backup_source = Input::get('backup_source');
			$fields=array('backup_source'=>$backup_source);
			$db->update('settings',1,$fields);
		}
		if($settings->backup_table != $_POST['backup_table']) {
			$backup_table = Input::get('backup_table');
			$fields=array('backup_table'=>$backup_table);
			$db->update('settings',1,$fields);
		}

		Redirect::to('admin_backup.php?sc1=Settings+saved!');

	}

	if(!empty($_POST['backup'])){

		//Create backup destination folder: $settings->backup_dest
		$backup_dest = $settings->backup_dest;
		$backupTable = $settings->backup_table;

		if($settings->backup_source != "db_table") {
			$backupSource = $settings->backup_source;
		}
		elseif($settings->backup_source == "db_table") {
			$backupSource = $settings->backup_source.'_'.$backupTable;
		}

		$destPath = $abs_us_root.$us_url_root.$backup_dest;

		if(!file_exists($destPath)){

			if (mkdir($destPath)){

				$destPathSuccess = true;
				$successes[] = lang('AB_PATHCREATE');

			}else{

				$destPathSuccess = false;
				$errors[] = lang('AB_PATHERROR');

			}

		}else{
			$successes[] = lang('AB_PATHEXISTED');
		}


		// Generate backup path
		$backupDateTimeString = date("Y-m-d\TH-i-s");
		$backupPath = $abs_us_root.$us_url_root.$backup_dest.'backup_'.$backupSource.'_'.$backupDateTimeString.'/';

		if(!file_exists($backupPath)){

			if (mkdir($backupPath)){

				$backupPathSuccess = true;

			}else{

				$backupPathSuccess = false;

			}
		}

		if($backupPathSuccess) {

			// Since the backup path is just created with a timestamp,
			// no need to check if these subfolders exist or if they are writable
			mkdir($backupPath.'files');
			mkdir($backupPath.'sql');
		}

		// Backup All Project Files and DB
		if($backupPathSuccess && $settings->backup_source == 'everything'){

			// Generate list of files in ABS_TR_ROOT.TR_URL_ROOT including files starting with .
			$backupItems = [];
			$backupItems[] = $abs_us_root.$us_url_root;
			$backupItems[] = $abs_us_root.$us_url_root.'users';
			$backupItems[] = $abs_us_root.$us_url_root.'usersc';

				if(backupObjects($backupItems,$backupPath.'files/')){

				$successes[] = lang('AB_BACKUPSUCCESS');

			}else{

				$errors[] = lang('AB_BACKUPFAIL');

			}

			backupUsTables($backupPath);

			$targetZipFile = backupZip($backupPath,true);

			if($targetZipFile){

				$successes[] = lang('AB_DB_FILES_ZIP');
				$backupZipHash = hash_file('sha1', $targetZipFile);
				$backupZipHashFilename = substr($targetZipFile,0,strlen($targetZipFile)-4).'_SHA1_'.$backupZipHash.'.zip';

				if(rename($targetZipFile,$backupZipHashFilename)){

					$successes[] = lang('AB_FILE_RENAMED').$backupZipHashFilename;

				}else{

					$errors[] = lang('AB_NOT_RENAME');

				}

			}else{

				$errors[] = lang('AB_ERROR_CREATE');

			}

		}

		// Backup Terminus files & all db tables
		if($backupPathSuccess && $settings->backup_source == 'db_us_files'){

			// Generate list of files in ABS_TR_ROOT.TR_URL_ROOT including files starting with .
			$backupItems = [];
			$backupItems[] = $abs_us_root.$us_url_root.'users';
			$backupItems[] = $abs_us_root.$us_url_root.'usersc';

			if(backupObjects($backupItems,$backupPath.'files/')){

				$successes[] = lang('AB_BACKUPSUCCESS');

			}else{

				$errors[] = lang('AB_BACKUPFAIL');

			}

			backupUsTables($backupPath);

			$targetZipFile = backupZip($backupPath,true);

			if($targetZipFile){

				$successes[] = lang('AB_DB_FILES_ZIP');
				$backupZipHash = hash_file('sha1', $targetZipFile);
				$backupZipHashFilename = substr($targetZipFile,0,strlen($targetZipFile)-4).'_SHA1_'.$backupZipHash.'.zip';

				if(rename($targetZipFile,$backupZipHashFilename)){

					$successes[] = lang('AB_FILE_RENAMED').$backupZipHashFilename;

				}else{

					$errors[] = lang('AB_NOT_RENAME');

				}

			}else{

				$errors[] = lang('AB_ERROR_CREATE');

			}

		}

		// Backup all db tables only
		if($backupPathSuccess && $settings->backup_source == 'db_only'){

			backupUsTables($backupPath);

			$targetZipFile = backupZip($backupPath,true);

			if($targetZipFile){

				$successes[] = lang('AB_DB_ZIPPED');
				$backupZipHash = hash_file('sha1', $targetZipFile);
				$backupZipHashFilename = substr($targetZipFile,0,strlen($targetZipFile)-4).'_SHA1_'.$backupZipHash.'.zip';

				if(rename($targetZipFile,$backupZipHashFilename)){

					$successes[] = lang('AB_FILE_RENAMED').$backupZipHashFilename;

				}else{

					$errors[] = lang('AB_NOT_RENAME');

				}

			}else{

				$errors[] = lang('AB_ERROR_CREATE');

			}

		}elseif(!$backupPathSuccess){

			$errors[] = lang('AB_PATHEXIST');

		}else{

			// Unknown state? Do nothing.

		}

		// Backup terminus files only
		if($backupPathSuccess && $settings->backup_source == 'us_files'){

			// Generate list of files in ABS_TR_ROOT.TR_URL_ROOT including files starting with .
			$backupItems = [];
			$backupItems[] = $abs_us_root.$us_url_root.'users';
			$backupItems[] = $abs_us_root.$us_url_root.'usersc';

			if(backupObjects($backupItems,$backupPath.'files/')){

				$successes[] = lang('AB_BACKUPSUCCESS');

			}else{

				$errors[] = lang('AB_BACKUPFAIL');

			}

			$targetZipFile = backupZip($backupPath,true);

			if($targetZipFile){

				$successes[] = lang('AB_T_FILE_ZIP');
				$backupZipHash = hash_file('sha1', $targetZipFile);
				$backupZipHashFilename = substr($targetZipFile,0,strlen($targetZipFile)-4).'_SHA1_'.$backupZipHash.'.zip';

				if(rename($targetZipFile,$backupZipHashFilename)){

					$successes[] = lang('AB_FILE_RENAMED').$backupZipHashFilename;

				}else{

					$errors[] = lang('AB_NOT_RENAME');

				}

			}else{

				$errors[] = lang('AB_ERROR_CREATE');

			}


		}

		// Backup single db table only
		if($backupPathSuccess && $settings->backup_source == 'db_table'){

			backupUsTable($backupPath);

			$targetZipFile = backupZip($backupPath,true);

			if($targetZipFile){

				$successes[] = lang('AB_TABLES_ZIP');
				$backupZipHash = hash_file('sha1', $targetZipFile);
				$backupZipHashFilename = substr($targetZipFile,0,strlen($targetZipFile)-4).'_SHA1_'.$backupZipHash.'.zip';

				if(rename($targetZipFile,$backupZipHashFilename)){

					$successes[] = lang('AB_FILE_RENAMED').$backupZipHashFilename;

				}else{

					$errors[] = lang('AB_NOT_RENAME');

				}

			}else{

				$errors[] = lang('AB_ERROR_CREATE');

			}

		}


	}

	//Delete backup
	if(!empty($_POST['deleteFile'])){

		$deletions = $_POST['delete'];
		foreach($deletions as $delete) {
			if(!unlink($abs_us_root.$us_url_root.$settings->backup_dest.$delete)) {
				$errors[] = lang('AB_BACKUP_NOT');
		    }else{
			    $successes[] = lang('AB_BACKUP_DELETE');
		    }
	    }
	}
}
// Get array of existing backup zip files
$allBackupFiles = glob($abs_us_root.$us_url_root.$settings->backup_dest.'backup*.zip');

$allBackupFilesSize = [];

foreach($allBackupFiles as $backupFile){
	$allBackupFilesSize[] = size($backupFile);
}

$pagename = lang('AB_PAGENAME');
?>
<div id="page-wrapper">

  <div class="container">

    <!-- Page Heading -->
    <div class="row">


        <!-- Main Center Column -->
        <div class="col-xs-12">
          <!-- Content Goes Here. Class width can be adjusted -->

			<h2>Page Permissions </h2>
			<?php resultBlock($errors,$successes); ?>


			<form class="form-horizontal form-label-left" action="<?=$_SERVER['PHP_SELF']?>" name="backup" method="POST">

				<!-- backup_dest Option -->
				<div class="form-group">
					<label for="backup_dest" class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top: 10px;">
						<?=lang('AB_BACKUP_DEST');?>
					</label>

					<div class="col-md-5 col-sm-5 col-xs-12" style="margin-top: 10px;">
						<input class="form-control" type="text" name="backup_dest" id="backup_dest" placeholder="Backup Destination" value="<?=$settings->backup_dest?>">
						<span class="text-danger"><?=lang('AB_BACKUP_DEST');?></span>
					</div>

				</div>



				<!-- backup_source Option -->
				<div class="form-group">

					<label for="backup_source" class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top: 10px;">
						<?=lang('AB_BACKUP_SOURCE');?>
					</label>

					<div class="col-md-5 col-sm-5 col-xs-12" style="margin-top: 10px;">

						<select id="backup_source" class="form-control" name="backup_source">

							<option value="everything" <?php if($settings->backup_source =='everything') ;?>><?=lang('AB_DB_ALL_FILES');?></option>

							<option value="db_us_files" <?php if($settings->backup_source =='db_us_files') echo 'selected="selected"' ;?>><?=lang('AB_DB_TM_FILES');?></option>

							<option value="db_only" <?php if($settings->backup_source =='db_only') echo 'selected="selected"';?>><?=lang('AB_DB_FILES');?></option>

							<option value="us_files" <?php if($settings->backup_source =='us_files') echo 'selected="selected"';?>><?=lang('AB_TM_FILES');?></option>

							<option value="db_table" <?php if($settings->backup_source =='db_table') echo 'selected="selected"';?>><?=lang('AB_SINGLE_TBL');?></option>

						</select>

					</div>

				</div>

				<?php if($settings->backup_source =='db_table') { ?>



					<div class="form-group">
						<label for="backup_source" class="control-label col-md-3 col-sm-3 col-xs-12" style="margin-top: 10px;">
							<?=lang('AB_SELECT_TBL');?>
						</label>

						<div class="col-md-5 col-sm-5 col-xs-12" style="margin-top: 10px;">
							<select id="backup_table" class="form-control" name="backup_table">

								<?php foreach($tablev as $v) { ?>
								<option value="<?=end($v);?>" <?php if($settings->backup_table == end($v)) echo 'selected="selected"';?>><?=end($v);?></option>
								<?php } ?>

							</select>
						</div>

					</div>

				<?php } ?>



				<div class="control-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12"><?=lang('AB_DB_TBLS');?></label>

                    <div class="col-md-9 col-sm-9 col-xs-12">

                    	<input id="tags_1" type="text" class="tags form-control" value="tables" data-tagsinput-init="true" style="display: none;">

                        <div id="tags_1_tagsinput" class="tagsinput" style="width: auto; min-height: 100px; height: 100px;">
                        <?php foreach($tablev as $v) { ?>

                        	<span class="tag"><?=end($v);?>&nbsp;&nbsp;</span>

                        <?php } ?>

                        </div>

                    </div>

                </div>

                <div class="clearfix"></div>

				<div class="ln_solid"></div>

				<button class='btn btn-success' type='submit' name="save" value='Save Settings' onclick="window.location='<?=$_SERVER['PHP_SELF']; ?>';"><i class="fa fa-database"></i><?=lang('AB_SAVE_SETTINGS');?></button>

				<button class='btn btn-success' type='submit' name="backup" value='Backup' onclick="window.location='<?=$_SERVER['PHP_SELF']; ?>';"><i class="fa fa-database"></i><?=lang('AB_BACKUP_BTN');?></button>

			</form>


      </div><!--/.col-*-->

    </div><!--/.row-->


     <!-- Existing Backups -->
     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">


            <h2><?=lang('AB_EXIST_BACKUP');?><span class="badge bg-green" style="color: white;"><?=sizeof($allBackupFiles)?></span></h2>



	          	<div class="col-md-12 col-sm-12 col-xs-12">

		          	<form name="delete" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

					<table class='table table-responsive table-striped' cellspacing="0" width="100%" >

						<thead>
							<tr class="headings">
								<th>
									<input type="checkbox" class="flat" name="select-all" id="check-all" style="width: 10px!important;"/>
								</th><!-- select all boxes -->
								<th class="column-title" style="width: 150px;"><?=lang('AB_DATE');?></th>
								<th class="column-title" style="width: 600px;"><?=lang('AB_BACKUP_FILE');?></th>
								<th class="column-title" style="width: 100px;"><?=lang('AB_FILE_SIZE');?></th>
								<th class="column-title text-center" style="width: 10%;"><?=lang('AB_ACTIONS');?></th>

							</tr>
						</thead>

						<tbody>
							<?php
							$i=0;
							foreach($allBackupFiles as $backupFile){
								$objectName=explode('/',$backupFile);
								$filename=end($objectName);
								$fileDate=date("F d Y H:i:s.",filemtime($backupFile));
							?>
							<tr>
								<td class="a-center ">
									<input type='checkbox' class="flat" name='delete[<?=$filename?>]' value='<?=$filename?>' style="width: 10px!important;"/>
								</td>
								<td class=" " style="width: 150px;"><?=$fileDate?></td>
								<td class=" " style="width: 600px;"><?=$filename?></td>
								<td class=" " style="width: 100px;"><?=$allBackupFilesSize[$i]?></td>

								<td class="text-center last" style="width: 10%;">
									<a class="label label-success bg-green" href="<?=$us_url_root.$settings->backup_dest.$filename?>"><i class="fa fa-download"></i></a>
								</td>

							</tr>

							<?php $i++;} ?>
						</tbody>

					</table>

					<br><br>

					<div class="clearfix"></div>

					<div class="ln_solid"></div>

					<button class="btn btn-danger" onclick="window.location='<?=$us_url_root?>users/admin_backup.php';" type="submit" name="deleteFile" value="delete"><i class="fa fa-trash"></i><?=lang('AB_DELETE_B');?></button>

					</form>

				</div>


      </div><!--/.col-*-->

    </div><!--/.row-->




        </div>
    </div>
	</div>
</div>

<?php require_once $abs_us_root.$us_url_root.'users/includes/page_footer.php';?>


<?php require_once $abs_us_root.$us_url_root.'users/includes/html_footer.php';?>
