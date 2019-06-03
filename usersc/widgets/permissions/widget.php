<!-- This is an example widget file.  It will be included on the statistics page of the Dashboard. -->
<div class="row">
<!-- Do any php that needs to happen. You already have access to the db -->
<?php
$permsQ = $db->query("SELECT * FROM permissions");
$permsC = $permsQ->count();
$perms = $permsQ->results();
//build a list of permission Levels for the javascript
$levels = '';
//get a count of users with that level
$userLevels = '';
foreach($perms as $p){
  // Get the name and id of each of the permission levels
  $levels .= "\"".$p->name."(".$p->id.")\",";
  $count = $db->query("SELECT * FROM user_permission_matches WHERE permission_id = ?",array($p->id))->count();
  $userLevels .= $count.",";
}
// to see what's going on here...
$levels = substr($levels,0, -1);
$userLevels = substr($userLevels,0, -1);
// dump($levels);
// dump($userLevels);

?>
<!-- Create a div to hold your widget -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Number of Users with a Permission</h4>
            <!-- id should be unique -->
            <canvas id="permission-chart"></canvas>
        </div>
    </div>
</div>



<!-- Do any php that needs to happen. You already have access to the db -->
<?php
$private = $db->query("SELECT id FROM pages WHERE private = ?",array(1))->count();
$public = $db->query("SELECT id FROM pages WHERE private = ?",array(0))->count();

?>
<!-- Create a div to hold your widget -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Public vs Private Pages </h4>
            <!-- id should be unique -->
            <canvas id="pages-chart"></canvas>
        </div>
    </div>
</div>

</div> <!-- end of widget -->
<!-- Put any javascript here -->
<script type="text/javascript">
$(document).ready(function() {
var ctx = document.getElementById( "pages-chart" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'pie',
        data: {
            datasets: [ {
                data: [ <?=$private?>, <?=$public?> ],
                backgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(123, 0, 255,0.7)"
                                ],
                hoverBackgroundColor: [
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(123, 0, 255,0.7)"
                                ]

                            } ],
            labels: [
                            "private",
                            "public"
                        ]
        },
        options: {
            responsive: true
        }
    } );

var ctx = document.getElementById( "permission-chart" );
  ctx.height = 150;
  var myChart = new Chart( ctx, {
      type: 'bar',
      data: {
          labels: [ <?=$levels?> ],
          datasets: [
              {
                  label: "Permission Level (Permission ID)",
                  data: [ <?=$userLevels?> ],
                  borderColor: "rgba(0, 123, 255, 0.9)",
                  borderWidth: "0",
                  backgroundColor: "rgba(0, 123, 255, 0.5)"
                          }
                      ]
      },
      options: {
          scales: {
              yAxes: [ {
                  ticks: {
                      beginAtZero: true
                  }
                              } ]
          }
      }
  } );
});
</script>
