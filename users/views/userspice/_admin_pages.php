<div id='main'>
  <table class='table table-hover'>
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
