<!-- This is an example widget file.  It will be included on the statistics page of the Dashboard. -->


<!-- Do any php that needs to happen. You already have access to the db -->
<?php
$date = date("Y-m-d H:i:s");
$logins = '0,';
$c = $db->query("SELECT id FROM logs WHERE logdate < ? AND logdate > ? AND lognote = ?",array(date("Y-m-d H:i:s", strtotime("-52 weeks", strtotime($date))),date("Y-m-d H:i:s", strtotime("-53 weeks", strtotime($date))), "User logged in."))->count();
$logins .= $c.", ";
$c = $db->query("SELECT id FROM logs WHERE logdate < ? AND logdate > ? AND lognote = ?",array(date("Y-m-d H:i:s", strtotime("-2 weeks", strtotime($date))),date("Y-m-d H:i:s", strtotime("-3 weeks", strtotime($date))), "User logged in."))->count();
$logins .= $c.", ";
$c = $db->query("SELECT id FROM logs WHERE logdate < ? AND logdate > ? AND lognote = ?",array(date("Y-m-d H:i:s", strtotime("-1 week", strtotime($date))),date("Y-m-d H:i:s", strtotime("-2 weeks", strtotime($date))), "User logged in."))->count();
$logins .= $c.", ";
//This week
$c = $db->query("SELECT id FROM logs WHERE logdate > ? AND lognote = ?",array(date("Y-m-d H:i:s", strtotime("-1 week", strtotime($date))), "User logged in."))->count();
$logins .= $c.", ";

?>
<!-- Create a div to hold your widget -->
<div class="col-lg-6">
  <div class="card">
    <div class="card-body">
      <h4 class="mb-3">Logins</h4>
      <canvas id="logins-chart"></canvas>
    </div>
  </div>
</div><!-- /# column -->

<!-- Put any javascript here -->
<script type="text/javascript">
$(document).ready(function() {
var ctx = document.getElementById( "logins-chart" );
ctx.height = 150;
var myChart = new Chart( ctx, {
  type: 'line',
  data: {
    labels: [" ","This week Last Year", "2 Weeks Ago", "1 Week Ago", "Last 7 days" ],
    type: 'line',
    defaultFontFamily: 'Montserrat',
    datasets: [ {
      label: "Logins",
      data: [ <?=$logins?> ],
      backgroundColor: 'transparent',
      borderColor: 'rgba(40,167,69,0.75)',
      borderWidth: 3,
      pointStyle: 'circle',
      pointRadius: 5,
      pointBorderColor: 'transparent',
      pointBackgroundColor: 'rgba(40,167,69,0.75)',
    }]
  },
  options: {
    responsive: true,

    tooltips: {
      mode: 'index',
      titleFontSize: 12,
      titleFontColor: '#000',
      bodyFontColor: '#000',
      backgroundColor: '#fff',
      titleFontFamily: 'Montserrat',
      bodyFontFamily: 'Montserrat',
      cornerRadius: 3,
      intersect: false,
    },
    legend: {
      display: false,
      labels: {
        usePointStyle: true,
        fontFamily: 'Montserrat',
      },
    },
    scales: {
      xAxes: [ {
        display: true,
        gridLines: {
          display: false,
          drawBorder: false
        },
        scaleLabel: {
          display: false,
          labelString: 'Time'
        }
      } ],
      yAxes: [ {
        display: true,
        gridLines: {
          display: false,
          drawBorder: false
        },
        scaleLabel: {
          display: true,
          labelString: 'Users'
        }
      } ]
    },
    title: {
      display: false,
      text: 'Normal Legend'
    }
  }
} );
}); //End DocReady
</script>
