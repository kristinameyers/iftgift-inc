<?php
$delivery_id = $_GET['s'];
$get_dev = $db->get_row("select * from ".tbl_delivery." where delivery_id = '".$delivery_id."'",ARRAY_A);
$occassionid = $get_dev['occassionid'];
$userId = $get_dev['userId'];
$get_user = $db->get_row("select user_image,available_cash from ".tbl_user." where userId = '".$userId."'",ARRAY_A);
$thumb_image_location = ru."media/user_image/".$userId.'/thumb/'.$get_user['user_image'];
if (@getimagesize($thumb_image_location)) {
	$user_image = ru."media/user_image/".$userId.'/thumb/'.$get_user['user_image'];
} else {
	$user_image = ru_resource."images/upload_img_b.jpg";
}
$get_occas = $db->get_row("select occasion_name from ".tbl_occasion." where occasionid = '".$occassionid."'",ARRAY_A);
$getoccss = explode("_",$occassionid);
if($occassionid == 'other_'.$getoccss[1]){
	$occasion_name = $getoccss[1];
}else{
	$occasion_name = $get_occas['occasion_name'];
}
$timestamps = strtotime($get_dev['unlock_date']);
$unlock_date = date('M d, Y', $timestamps);	
$unlock_time = $get_dev['unlock_time'];
$f_date = $unlock_date.' '.$unlock_time;

$date = strtotime($f_date);
$remaining = $date - time();
$diffweek = floor($remaining/ 604800);
$days_remaining = floor($remaining / 86400);
$hours_remaining = floor(($remaining % 86400) / 3600);
$min = floor(($remaining % 3600) / 60);
$sec = ($remaining % 60);
?>
<div class="mid_contant">
	<h2 class="title">Unwrap: Pending iftGift</h2>
	<div class="cont_bar">
		<div class="mile_birthday">
			<img src="<?php echo $user_image?>" width="48" height="62" />
			<h3>Your <?php echo $occasion_name;?> iftGift from <?php echo $get_dev['giv_first_name'].' '.$get_dev['giv_last_name'];?></h3>
		</div>
		<div class="cont_bar_inner">
			<div class="unlock_time">
				<h4>Unlocks in:</h4>
				<div class="unlock_time_inner">
					<span id="countdown"></span>
				</div>
				<script type="text/javascript">
					// set the date we're counting down to
					var target_date = new Date("<?php echo $f_date;?>");
					// variables for time units
					var weeks, days, hours, minutes, seconds;
					
					// get tag element
					var countdown = document.getElementById("countdown");
					
					// update the tag with id "countdown" every 1 second
					setInterval(function () {
					
					// find the amount of "seconds" between now and target
					var current_date = new Date().getTime();
					var seconds_left = (target_date - current_date) / 1000;
					
					// do some time calculations
					weeks = parseInt(seconds_left / 604800);
					//secondss_left = seconds_left % 604800;
					
					days = parseInt(seconds_left / 86400);
					seconds_left = seconds_left % 86400;
					 
					hours = parseInt(seconds_left / 3600);
					seconds_left = seconds_left % 3600;
					 
					minutes = parseInt(seconds_left / 60);
					seconds = parseInt(seconds_left % 60);
					 
					// format countdown string + set tag value
					countdown.innerHTML ="<div class='time_bar'><div class='time_bar_inner'>"+weeks+"</div><span>WEEKS</span></div><div class='time_bar'><div class='time_bar_inner'>"+days+"</div><span>DAYS</span></div><div class='time_bar'><div class='time_bar_inner'>"+hours+"</div><span>HOURS</span></div><div class='time_bar'><div class='time_bar_inner'>"+minutes+"</div><span>MINUTES</span></div><div class='time_bar second'><div class='time_bar_inner'>"+seconds+"</div><span>SECONDS</span></div>"
					}, 1000);
					</script>
				<?php
					$timestamps = strtotime($get_dev['unlock_date']);
					$unlock_date = date('l F d, Y', $timestamps);
				?>
				<div class="unlock_day"><?php echo $unlock_date?> @ <?php echo $get_dev['unlock_time']; ?></div>
			</div>
			
			<div class="safe_bar">
				<div class="safe_bar_inner">
					<img src="<?php echo ru_resource; ?>images/icon_i.jpg" alt="Locker Icon" />
					<?php if($get_dev['release_request'] != 1 && $get_dev['release_request_respond'] == '') { ?>
					
					<a href="javascript:;" id="release_request">Release Request</a>
					<?php }?>
				</div>
                <div id="explosion_image" class="explsion_animt" style="display: none;">
					<img src="<?php echo ru_resource;?>images/boom.png" /></div>
				<?php if($get_dev['release_request'] != 1  && $get_dev['release_request_respond'] == '') { ?>
					<img src="<?php echo ru_resource; ?>images/jester_r.jpg" alt="Jester Image" />
				<?php } ?>	
			</div>
			<?php if($get_dev['release_request'] == 1 && $get_dev['release_request_respond'] == '') { ?>
				<img src="<?php echo ru_resource; ?>images/fish_img.jpg" alt="Finish Image" class="finsh_img" />
			<?php } ?>		
			<ul class="gift_box">
				<li><img src="<?php echo ru_resource; ?>images/gift_box_a.jpg" alt="Gift Box A" /></li>
				<li><img src="<?php echo ru_resource; ?>images/gift_box_b.jpg" alt="Gift Box B" /></li>
				<li><img src="<?php echo ru_resource; ?>images/gift_box_c.jpg" alt="Gift Box C" /></li>
				<li><img src="<?php echo ru_resource; ?>images/gift_box_d.jpg" alt="Gift Box D" /></li>
				<li><img src="<?php echo ru_resource; ?>images/gift_box_e.jpg" alt="Gift Box E" /></li>
				<li><img src="<?php echo ru_resource; ?>images/gift_box_f.jpg" alt="Gift Box F" /></li>
			</ul>
			<a href="<?php echo ru; ?>dashboard" class="go_deshbord">Go to Dashboard</a>
		
		</div>
		<div class="modal modal_b modal_c" id="release_request_div" style="display:none">
			<a style="cursor:pointer" onClick="close_div2();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<h3 class="gift_title">iftGift Release Request</h3>
			<div class="cont_bar_inner cont_bar_inner_b gift_idea">
				<p class="gvr_nam">Tell <?php echo $get_dev['giv_first_name'].' '.$get_dev['giv_last_name'];?> why you would like to change the Unwrap Date/Time of this iftGift</p>
				<div class="regs_form regs_form_e">
					<div class="flied">
						<h4>Thank you <span><?php echo ucfirst($get_dev['giv_first_name']).' '.ucfirst($get_dev['giv_last_name']);?>,</span></h4>
						<form id="Releaserequest" method="post">
							<input name="delivery_id" id="delivery_id" value="<?php echo $get_dev['delivery_id']; ?>" type="hidden">
							<input name="giv_email" id="giv_email" value="<?php echo $get_dev['giv_email']; ?>" type="hidden">
							<input name="recp_email" id="recp_email" value="<?php echo $get_dev['recp_email']; ?>" type="hidden">
							<input name="giv_name" id="giv_name" value="<?php echo $get_dev['giv_first_name'].' '.$get_dev['giv_last_name']; ?>" type="hidden">
							<input name="recp_name" id="recp_name" value="<?php echo $get_dev['recp_first_name'].' '.$get_dev['recp_last_name']; ?>" type="hidden">
							<input name="unlock_date" id="unlock_date" value="<?php echo $get_dev['unlock_date']; ?>" type="hidden">
							<input name="unlock_time" id="unlock_time" value="<?php echo $get_dev['unlock_time']; ?>" type="hidden">
							<input name="ReleaseRequest" id="ReleaseRequest" value="1" type="hidden">
							<textarea name="message" placeholder="[Enter Text Here]"></textarea>
						</form>
						<h4><span><?php echo ucfirst($get_dev['recp_first_name']).' '.ucfirst($get_dev['recp_last_name']);?></span></h4>
					</div>
					<a href="javascript:;" id="Releaserequests" class="orange">Send</a>
				</div>
				<img src="<?php echo ru_resource;?>images/jester_al.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" style="margin-top:20px"/>
			</div>
		</div>	
	</div>
</div>
<div class="overlay" style="display:none"></div>
<style>
.explsion_animt{float: left;position: absolute;right: -15px;top: 40px;z-index: 9999;}
.modal.modal_b{top:13%}
</style>
<script type="text/javascript">
$(function () {	
	
	$("#release_request").on('click',function () {
		$("#explosion_image").show('explode', {pieces: 75}, 2000, function(){
			$(".overlay").delay(3000).slideDown("slow");
			$("#release_request_div").delay(3000).show("slow");
		});
	});
	
	$("#Releaserequests").on('click',function () {
		var form = $("#Releaserequest")
		$.ajax({
			url: "<?php echo ru; ?>process/process_releaserequest.php",	
			type: "POST",
			data: form.serialize(),
			success: function (data) {
				if(data == 1) {
					setTimeout(function() { 
						window.location.href = '<?php echo ru; ?>locked/<?php echo $get_dev['delivery_id']; ?>'; 
					}, 500);
				} 
			}
		});		
	});
});

function close_div2()
{
	jQuery(document).ready(function () {
		jQuery(".modal").slideUp("slow");
		jQuery(".overlay").css("display","none");
		$("#explosion_image").delay(2000).hide('explode', {pieces: 75}, 1500);
	});
}
</script>	