<?php if(!in_array($user->data()->id,$master_account)){ Redirect::to($us_url_root.'users/admin.php');} //only allow master accounts to manage plugins! ?>

<?php
include "plugin_info.php";
include $abs_us_root.$us_url_root."usersc/plugins/spice_shaker/assets/style.php";
pluginActive($plugin_name);
$type = '';
$api = "http://userspice.com/bugs/api.php";
if(!empty($_POST['type'])){
  $type = Input::get('type');
  //create a new cURL resource
  $ch = curl_init($api);
    //setup request to send json via POST
  $data = array(
      'key' => $settings->spice_api,
      'type' => $type,
      'call' => 'loadtype'
  );
  $payload = json_encode($data);
    //attach encoded JSON string to the POST fields
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    //set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    //return response instead of outputting
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //execute the POST request
  $result = curl_exec($ch);
    //close cURL resource
  curl_close($ch);

}
 ?>

 <h2>Spice Shaker Auto Installer</h2>
 <div class="content mt-3">
   <div class="row">
     <div class="col-6">
     <div class="form-group">
       <label for="gid">UserSpice API Key (
         <a href="https://userspice.com/developer-api-keys/">Get One Here</a>
         )</label>
       <input type="password" autocomplete="off" class="form-control ajxtxt" data-desc="UserSpice API Key" name="spice_api" id="spice_api" value="<?=$settings->spice_api?>">
     </div>
   </div>
   <div class="col-4">
     <form class="" action="admin.php?view=plugins_config&plugin=spice_shaker" method="post">
       <label for="type">Browse</label>
       <div class="d-flex">
         <select class="form-control" name="type">
            <option value="" disabled <?php if($type ==''){?>selected="Selected"<?php } ?>>--Choose One--</option>
            <option value="plugin" <?php if($type =='plugin'){?>selected="Selected"<?php } ?>>Plugins</option>
            <option value="template" <?php if($type =='template'){?>selected="Selected"<?php } ?>>Templates</option>
            <option value="widget" <?php if($type =='widget'){?>selected="Selected"<?php } ?>>Widgets</option>
            <option value="translation" <?php if($type =='translation'){?>selected="Selected"<?php } ?>>Languages</option>
         </select>
         <input type="submit" name="go" value="Go">
        </div>
 </form>
 </div>
</div>
<?php if(isset($result)){
  $dev = json_decode($result);
  $counter = 0;
  foreach($dev as $d){
  ?>

  <div class="col-md-6 col-lg-4 pb-3">
        <div class="card card-custom bg-white border-white border-0" style="height: 450px">
          <div class="card-custom-img" style="background-image: url(<?php if($d->img != ''){echo $d->img;}else{?>http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg <?php }?>);"></div>
          <div class="card-custom-avatar">
            <?php if($d->icon == ''){
              $src = "http://userspice.com/bugs/usersc/logos/nologo.png";
            }else{
             $src = $d->icon;
            }
            ?>
            <img class="img-fluid" src="<?=$src?>" alt="Avatar" />
          </div>
          <div class="card-body" style="overflow-y: auto">
            <h4 class="card-title"><?=$d->project?> v<?=$d->version." (".$d->status.")";?></h4>
            <p class="card-text"><?=$d->descrip?></p>
          </div>
          <div class="card-footer" style="background: inherit; border-color: inherit;">
            <a href="#" class="btn btn-default install" style="display:none;">Please Wait</a>
            <button type="button" name="button"  class="btn btn-primary installme" data-type="<?=$type?>" data-url="<?=$d->dd?>" data-hash="<?=$d->hash?>" data-counter="<?=$counter?>">Install/Update</button>
            <a href="https://github.com/<?=$d->repo?>/tree/master/src/<?=$d->reserved?>" class="btn btn-outline-primary" target="_blank">View Source</a>
            <a href="#" class="btn btn-success visit" target="_blank" style="display:none" id="<?=$counter?>">Check it Out!</a>
          </div>
        </div>

      </div>
  <?php
  $counter++;
  }
}?>
</div>
<script type="text/javascript">
$( ".installme" ).click(function(event) {
$(".installme").hide();
$(".install").show();
var counter = $(this).attr('data-counter');
  var formData = {
  'type' 			:  $(this).attr('data-type'),
  'url' 			:  $(this).attr('data-url'),
  'hash' 			:  $(this).attr('data-hash'),
};

$.ajax({
  type 		: 'POST',
  url 		: '../usersc/plugins/spice_shaker/assets/downloader.php',
  data 		: formData,
  dataType 	: 'json',
})

.done(function(data) {
if(data.success == true){
  $("#"+counter).css('display','inline');
  $("a").closest(".visit").attr("href",data.url);
  $(".installme").show();
  $(".install").hide();
}else{
  alert(data.error);
  $(".installme").show();
  $(".install").hide();
}

})
});
</script>
