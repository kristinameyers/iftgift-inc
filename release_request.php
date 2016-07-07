<?php
$userId = explode('_',base64_decode($_GET['s']));

$get_dev = $db->get_row("select * from ".tbl_delivery." where delivery_id = '".$userId[1]."'",ARRAY_A);
$timestamps = strtotime($get_dev['unlock_date']);
$unlock_date = date('l M d Y', $timestamps);

$get_userInfo = $db->get_row("select * from ".tbl_user." where userId = '".$userId[0]."'",ARRAY_A);
if($get_dev['userId'] != $_SESSION['LOGINDATA']['USERID']){ 
		session_unset($_SESSION['LOGINDATA']['USERID']);
		header("location:".ru."login/".$s);exit;
}		
?>
<link rel="stylesheet" href="<?php echo ru_resource?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ru_resource?>js/time_picker/timepicker.css" type="text/css" />
<script src="<?php echo ru_resource?>js/datepicker/jquery-ui.js"></script>
<script src="<?php echo ru_resource?>js/time_picker/jquery.ui.timepicker.js?v=0.3.3"></script>
<script type="text/javascript" src="<?php echo ru_resource?>js/time_picker/jquery.ui.core.min.js"></script>
<div class="mid_contant">
		<h2 class="title">Release Request: Respond to Your Recipient</h2>
		<div class="cont_bar cont_bar_b">
			<div class="cont_bar_inner">
				<h4 class="unwrap_date">What would you like to do about the <span><?php echo $unlock_date .'&nbsp;+&nbsp;'. $get_dev['unlock_time']; ?> UNWRAP date/time</span> of <span><?php echo ucfirst($get_userInfo['first_name']).'&acute;s';?></span> iftGift? (check one)</h4>
				<div class="unwrap_step">
					<div class="unwrap_step_inner">
						<h2>Release</h2>
						<div class="item_check">
							<div class="squaredFour">
								<input type="radio" value="None" id="thirteen" name="open_immediately" class="open_immediately" />
								<label for="thirteen"></label>
							</div>
							<label class="title">Unlock Their iftGift Immediately</label>
						</div>
						<img src="<?php echo ru_resource;?>images/jester_an.jpg" alt="Jester Image" />
					</div>
					<div class="unwrap_step_inner revise">
						<h2>Revise</h2>
						<div class="item_check">
							<div class="squaredFour">
								<input type="radio" value="None" id="forteen" name="change_release" class="change_release" />
								<label for="forteen"></label>
							</div>
							<label class="title">Change Release Date/Time</label>
						</div>
						<img src="<?php echo ru_resource;?>images/jester_ao.jpg" alt="Jester Image" />
					</div>
					<div class="unwrap_step_inner">
						<h2>Reinstate</h2>
						<div class="item_check">
							<div class="squaredFour">
								<input type="radio" value="None" id="fifteen" name="keep_release" class="keep_release" />
								<label for="fifteen"></label>
							</div>
							<label class="title">Keep Release Date/Time As Is</label>
						</div>
						<img src="<?php echo ru_resource;?>images/jester_ap.jpg" alt="Jester Image" />
					</div>
				</div>
				<div class="regs_form regs_form_b regs_form_b regs_form_f">
					<div style="display:none;" id="open_immediately">
				<form id="Openimmediately" action="<?php echo ru; ?>process/process_releaserequest.php" method="post" data-ajax="false">
				<input name="delivery_id" id="delivery_id" value="<?php echo $userId[1]; ?>" type="hidden">
				<input name="giv_email" id="giv_email" value="<?php echo $get_dev['giv_email']; ?>" type="hidden">
				<input name="recp_email" id="recp_email" value="<?php echo $get_dev['recp_email']; ?>" type="hidden">
				<input name="giv_name" id="giv_name" value="<?php echo $get_dev['giv_first_name']; ?>" type="hidden">
				<input name="recp_name" id="recp_name" value="<?php echo $get_dev['recp_first_name']; ?>" type="hidden">
				<div class="flied">
				<textarea name="messages" placeholder="Send a message (Optional)"></textarea>
				<input type="submit" name="open_immediately" id="open_immediately" class="orange" value="Confirm" />
				</div>
				</form>
				</div>
				<div style="display:none;" id="change_release">
					<h4 class="unwrap_date">Select new <span>UNWRAP</span> date and time</h4>
					<form id="changerelease" action="<?php echo ru; ?>process/process_releaserequest.php" method="post">
					<input name="delivery_id" id="delivery_id" value="<?php echo $userId[1]; ?>" type="hidden">
					<input name="giv_email" id="giv_email" value="<?php echo $get_dev['giv_email']; ?>" type="hidden">
					<input name="recp_email" id="recp_email" value="<?php echo $get_dev['recp_email']; ?>" type="hidden">
					<input name="giv_name" id="giv_name" value="<?php echo $get_dev['giv_first_name']; ?>" type="hidden">
					<input name="recp_name" id="recp_name" value="<?php echo $get_dev['recp_first_name']; ?>" type="hidden">
						<div class="flied">
							<img src="<?php echo ru_resource;?>images/date_icon_b.jpg" alt="Calender Icon" />
							<input type="text" id="datepickers" name="dated" placeholder="mm / dd / yy" />
							<span>@</span>
							<input type="text" id="timepicker" name="time" placeholder="00:00 PM" class="time" />
						</div>
						<div class="flied">
							<textarea name="message" placeholder="Send a message (Optional)"></textarea>
							<input type="submit" name="change_release" id="change_release" value="Confirm" class="orange">
						</div>
					</form>
				</div>	
				<div style="display:none;" id="keep_release">
				<form id="keeprelease" action="<?php echo ru; ?>process/process_releaserequest.php" method="post" data-ajax="false">
				<input name="delivery_id" id="delivery_id" value="<?php echo $userId[1]; ?>" type="hidden">
				<input name="giv_email" id="giv_email" value="<?php echo $get_dev['giv_email']; ?>" type="hidden">
				<input name="recp_email" id="recp_email" value="<?php echo $get_dev['recp_email']; ?>" type="hidden">
				<input name="giv_name" id="giv_name" value="<?php echo $get_dev['giv_first_name']; ?>" type="hidden">
				<input name="recp_name" id="recp_name" value="<?php echo $get_dev['recp_first_name']; ?>" type="hidden">
				<div class="flied">
				<textarea name="message" placeholder="Send a message (Optional)"></textarea>
				<input type="submit" name="keep_release" id="keep_release" class="orange" value="Confirm" />
				</div>
				</form>
				</div>
				</div>
			</div>
		</div>
	</div>
<script language="javascript">
$(document).ready(function () {
	$(".open_immediately").on('click', function () {
	if ($(this).is(":checked")) {
		$('.change_release').attr('checked', false);
		$('.keep_release').attr('checked', false);
		$("#open_immediately").slideDown("slow");
		$("#change_release").slideUp("slow");
		$("#keep_release").slideUp("slow");
	}
	});
	
	$(".change_release").on('click', function () {
    if ($(this).is(":checked")) {
        $('.open_immediately').attr('checked', false);
		$('.keep_release').attr('checked', false);
		$("#change_release").slideDown("slow");
		$("#open_immediately").slideUp("slow");
		$("#keep_release").slideUp("slow");
    }
	});
	
	$(".keep_release").on('click', function () {
    if ($(this).is(":checked")) {
       	$('.open_immediately').attr('checked', false);
		$('.change_release').attr('checked', false);
		$("#open_immediately").slideUp("slow");
		$("#change_release").slideUp("slow");
		$("#keep_release").slideDown("slow");
    }
	});
	
	$(function() {
		$( "#datepickers" ).datepicker({ dateFormat: 'mm/dd/yy', minDate: 0 });
	});

	$('#timepicker').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true
  });
});	
		
</script>		