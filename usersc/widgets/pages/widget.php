<!-- This is an example widget file.  It will be included on the statistics page of the Dashboard. -->


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
  });
</script>
