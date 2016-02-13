<div class="input-group col-sm-10">
<!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
<input class="form-control" id="system-search" name="q" placeholder="Search Pages..." required>
<span class="input-group-btn">
  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
</span>
</div>
</form><br>
<div id='main'>
  <table class='table table-hover table-list-search'>
    <th>Id</th><th>Page</th><th>Access</th>

    <?php
    //Display list of pages
    foreach ($dbpages as $page){
      ?>
      <tr>
        <td>
          <?=$dbpages[$count]->id?>
        </td>
        <td>
          <a href ='admin_page.php?id=<?=$dbpages[$count]->id?>'><?=$dbpages[$count]->page?></a>
        </td>
        <td>
          <?php
          //Show public/private setting of page
          if($dbpages[$count]->private == 0){
            echo "Public";
          }
          else {
            echo "Private";
          }
          ?>
        </td>
      </tr>
      <?php
      $count++;
    }
?>
