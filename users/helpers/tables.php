<?php //UserSpice Table Generation functions
function tableFromData($data,$opts = []){
  //With this function you can add a class to any of the table elements by assigning to the $opts array
  //options are
  //table, thead, theadrow (for the table heading row), th
  //tbody, tbodyrow, td
  //if you want to specify your own column names for readability, right in the middle of the options array, do this..
  // $opts = array(
  //  'table'=>'table-striped',
  //  'spec'=>['Column 1', 'Column 2', 'Whatever'], //Like this
  // );
  //You can also add additional columns to the table and even use variables inside those columns.
  //Put this in the opts array in this format ...
  // 'add'=>array(
  // 'Column Name'=>"What you want in the column"
  // ),
  //To use a varaible from the database, it must be available. In other words if you use id, your data set needs to have id
  //Put the columnname of the variable you want to use between {}
  // 'add'=>array(
  //     'Variable'=>"<input type='submit' class='btn btn-primary' name='submit' value='submit {id}'>"
  //     ),
  ?>
  <table id="paginate" class="table table-hover table-list-search <?php if(isset($opts['table'])){echo $opts['table'];}?>">
    <thead class="<?php if(isset($opts['thead'])){echo $opts['thead'];}?>">
      <tr class="<?php if(isset($opts['thead'])){echo $opts['thead'];}?>">
        <?php
        //Dealing with Data adding`
        if(isset($opts['add'])){
          if(!is_array($opts['add'])){
            die("The add columns must be an array of column then data");
          }else{
            foreach($opts['add'] as $k=>$str){
              foreach($data as $d){
                $start  = strpos($str, '{');
                  $end    = strpos($str, '}', $start + 1);
                  $length = $end - $start;
                  $result = substr($str, $start + 1, $length - 1);
                  $length = strlen($result);
                  if(isset($d->{$result}) && $length > 0){
                    $begin = strtok($str, '{');
                      $message = $d->{$result};      // Most tables with no data render this as undifined property. Table messages somehow not.
                      $last = substr(strrchr($str, "}"), 1);
                      $full = $begin.$message.$last;
                      $d->$k = $full;
                    }else{
                      $d->$k = $str;
                    }
                  }
                }
              }
            }
            //End of Data Adding
            //Dealing with column skipping
            if(isset($opts['skip'])){
              if(!is_array($opts['skip'])){
                die("The skip columns must be an array");
              }else{
                foreach($opts['skip'] as $s){
                  foreach($data as $d){
                    unset($d->$s);
                  }
                }
              }
            }
            //end of column skipping
            if(!isset($opts['spec'])){ //column names have not been specified
              if ($data != NULL) {
                foreach($data[0] as $k=>$v){
                  //skip ids
                  //get rid of underscores and dashes and uc words
                  $k = str_replace("_", " ", $k);
                  $k = ucwords(str_replace("-", " ", $k));
                  ?>
                  <th class="<?php if(isset($opts['theadrow'])){echo $opts['theadrow'];}?>"><?=$k?></th>
                  <?php
                } }
              }else{
                foreach($opts['spec'] as $k){ ?>
                  <th class="<?php if(isset($opts['theadrow'])){echo $opts['theadrow'];}?>"><?=$k?></th>
                  <?php
                }
              }
              ?>
            </tr>
          </thead>
          <tbody class="<?php if(isset($opts['tbody'])){echo $opts['tbody'];}?>">
            <?php foreach($data as $k=>$v){ ?>
              <tr class="<?php if(isset($opts['tbodyrow'])){echo $opts['tbodyrow'];}?>">
                <?php foreach($v as $value){ ?>
                  <td class="<?php if(isset($opts['tbodyrow'])){echo $opts['tbodyrow'];}?>"><?=$value?></td>
                <?php }  ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <?php
      }
