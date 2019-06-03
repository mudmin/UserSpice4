<?php
//this is customized for the form processor, but you can set your own options below
//See http://trentrichardson.com/examples/timepicker/ for documentation
?>
<script>
    $('#<?=$o->col?>').datetimepicker({
      dateFormat: "yy-mm-dd",
      stepMinute: 15,
      showSecond: 0,
    });
</script>
