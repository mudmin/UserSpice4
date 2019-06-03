<?php
//Please don't load code on the footer of every page if you don't need it on the footer of every page.
//bold("<br>Performance Checker Footer Loaded");
$pluginQueryCounter = $db->getQueryCount();
?>
<script type="text/javascript">
window.onload = function () {
	var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart;
  var pluginQueryCounter = "<?=$pluginQueryCounter?>";
  console.log('Page load time is '+ loadTime);

  $("#pluginPerformanceChecker").html(loadTime+" ms, "+pluginQueryCounter+" db queries");
}
</script>
