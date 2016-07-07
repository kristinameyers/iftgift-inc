<?php
if(isset($_GET['s'])) {
 $reminder_id = $_GET['s'];
 $reminders = "select * from ".tbl_reminder." where reminder_id = '".$reminder_id."'";
 $reminds = mysql_query($reminders) or die (mysql_error());
	if ( mysql_num_rows($reminds) ==0 ){
		
		header('location:'.ru.'reminder');
		exit;
	}
	
	if ( !isset ($_SESSION['biz_rem']) or ($_SESSION['biz_rem']['reminder_id'] != $reminder_id ) )
	{
		$reminder_row = mysql_fetch_array($reminds);
		$_SESSION['biz_rem'] =$reminder_row;
	}
} 
?>
<div class="mid_contant">
		<h2 class="title">Control: Your iftScore Board</h2>
		<?php include("common/controls_leftmenu.php");?>
		<div class="cont_bar outbox_left outbox_right inbox_right">
			<div class="ift_bar_a ift_bar_c score">
				<div class="drop_menu">
					<h4>Create a Reminder</h4>
				</div>
				<div class="ift_bar_btm prns_remd remd_left">
					<div class="score_left">
						<form id="reminderSub" method="post" action="<?php echo ru;?>process/process_reminder.php">
						<input type="hidden" name="userId" value="<?php echo $_SESSION['LOGINDATA']['USERID'];?>" />
						<?php if($_GET['s']) { ?>
						<input type="hidden" name="reminder_id" value="<?php echo $reminder_id;?>" />
						<input type="hidden" name="editReminder" value="editReminder" />
						<?php } else {?>
						<input type="hidden" name="reminder" value="reminder" />
						<?php } ?>
						<div class="flied">
							<label>Name Your Event...</label>
							<input type="text" name="event_name" id="event_name" placeholder="Event" value="<?php echo $_SESSION['biz_rem']['event_name']?>" />
						</div>
						<div class="flied ory">
							<h5>OR</h5>
						</div>
						<div class="flied">
							<label>...Pick From Holidays</label>
							<div class="select">
								<?php
									$date = date('Y');
									$json_response = file_get_contents("http://holidayapi.com/v1/holidays?country=US&year=".$date);
									$obj = json_decode($json_response);
								?>
								<select name="event_select" id="event_select" class="custom-select">
									<option value="holidays">Holidays</option>
									<?php 
										foreach($obj->holidays as $val) {
									?>
									<option value="<?php echo $val[0]->name.'/'.$val[0]->date; ?>" <?php if($_SESSION['biz_rem']['event_select'] == $val[0]->name.'/'.$val[0]->date) echo 'selected="selected"';?>><?php echo $val[0]->name; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<?php if($_SESSION['biz_rem_err']['event_name']) { ?>
							<div class="modals" id="modal_pass">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rem_err']['event_name'];?></div>
							</div>
						<?php } ?>	
						<div class="flied celbr">
							<input type="text" name="celebrant" id="celebrant" placeholder="Celebrant(s)" value="<?php echo $_SESSION['biz_rem']['celebrant']?>">
						</div>
						<?php if($_SESSION['biz_rem_err']['celebrant']) { ?>
							<div class="modals" id="modal_pass">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rem_err']['celebrant'];?></div>
							</div>
						<?php } ?>	
						<div class="remd_date">
							<div class="flied">
								<input type="text" name="dated" type="text" id="datepickers" value="<?php echo $_SESSION['biz_rem']['dated']?>" placeholder="dd/mm/yy" class="remd_month" >
							</div>
							<?php if($_SESSION['biz_rem_err']['dated']) { ?>
							<div class="modals" id="model_gender">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rem_err']['dated'];?></div>
							</div>
						<?php } ?>
							<div class="annualy">
								<div class="item_check">
									<div class="squaredFour">
										<input type="checkbox" name="one_time" id="one_time" class="example1" value="One Time" <?php if($_SESSION['biz_rem']['one_time'] == 'Annualy') {  } else { ?> checked="checked" <?php } ?>>
										<label for="one_time"></label>
									</div>
									<label class="title">One-Time</label>
								</div>
								<div class="item_check">
									<div class="squaredFour">
										<input type="checkbox" name="one_time" id="annualy"  class="example2" value="Annualy" <?php if($_SESSION['biz_rem']['one_time'] == 'Annualy') echo 'checked="checked"'; ?>>
										<label for="annualy"></label>
									</div>
									<label class="title">Annualy</label>
								</div>
							</div>
							<div class="flied remd_me">
								<label>Remind Me At:</label>
								<input type="text" name="remind_me" id="timepicker" value="<?php echo $_SESSION['biz_rem']['remind_me']?>" placeholder="Time">
							</div>
							<div class="annualy send_remd">
								<label class="remd_title">Start Sending Reminders:</label>
								<div class="item_check">
									<div class="squaredFour">
										<input type="checkbox" name="month" id="month" class="month" value="1 Month" <?php if($_SESSION['biz_rem']['month'] == '1 Month') echo 'checked="checked"'; ?>>
										<label for="month"></label>
									</div>
									<label class="title">1 Month</label>
								</div>
								<div class="item_check">
									<div class="squaredFour">
										<input type="checkbox" name="weeks" id="weeks" class="weeks" value="2 Week" <?php if($_SESSION['biz_rem']['weeks'] == '2 Week') echo 'checked="checked"'; ?>>
										<label for="weeks"></label>
									</div>
									<label class="title">2 Week</label>
								</div>
								<div class="item_check">
									<div class="squaredFour">
										<input type="checkbox" name="week" id="week" class="week" value="1 Week" <?php if($_SESSION['biz_rem']['week'] == '1 Week') echo 'checked="checked"'; ?>>
										<label for="week"></label>
									</div>
									<label class="title">1 Week</label>
								</div>
								<div class="item_check">
									<div class="squaredFour">
										<input type="checkbox" name="days" id="days" class="days" value="3 Days" <?php if($_SESSION['biz_rem']['days'] == '3 Days') echo 'checked="checked"'; ?>>
										<label for="days"></label>
									</div>
									<label class="title">3 Days</label>
								</div>
								<div class="item_check">
									<div class="squaredFour">
										<input type="checkbox" name="day" id="day" class="day" value="1 Day" <?php if($_SESSION['biz_rem']['day'] == '1 Day') echo 'checked="checked"'; ?>>
										<label for="day"></label>
									</div>
									<label class="title">1 Day</label>
								</div>
							</div>
						</div>
						<p class="remd_send">To send reminders to other click <img src="<?php echo ru_resource;?>images/messg_icon_b.jpg" alt="Message Icon" /> below</p>
						<input type="button" onclick="reminder_process()" name="reminder" value="Save Reminder" class="save_remd">
						</form>
					</div>
					<img src="<?php echo ru_resource;?>images/jester_aq.jpg" alt="Jester Image" />
				</div>
			</div>
			<div class="ift_bar_a ift_bar_c score">
				<div class="drop_menu">
					<h4>Saved Personal Reminders</h4>
				</div>
				<ul class="unwrp_list lib_remd">
					<li class="title_bar">
						<div class="from">Event</div>
						<div class="occas">Date</div>
						<div class="notft">Celebrant</div>
						<div class="unlock">One-Time</div>
						<div class="unwrapd">Annual</div>
						<div class="reqt">&nbsp;</div>
						<div class="view">&nbsp;</div>
						<div class="resp_btn">&nbsp;</div>
					</li>
					<?php
						$reminder_Qry = "select * from ".tbl_reminder." where userId = '".$_SESSION['LOGINDATA']['USERID']."'";
						$view_reminder = $db->get_results($reminder_Qry,ARRAY_A);
						if($view_reminder) {
						$c = true;
						foreach($view_reminder as $reminder) {
					?>	
					<li class="record <?php if($c = !$c) { ?>record_bgk<?php } else { } ?>">
						<a class="close_icon" href="javascript:;" onclick="del_reminder('<?php echo $reminder['reminder_id']; ?>');"><img alt="Closed Icon" src="<?php echo ru_resource;?>images/close.png"></a>
						<div class="from"><?php echo $reminder['event_name']; ?></div>
						<?php
						$timestamps = strtotime($reminder['dated']);
						$notify_date = date('m/d/Y', $timestamps)
						?>
						<div class="occas"><?php echo $notify_date; ?></div>
						<div class="notft"><?php echo $reminder['celebrant']; ?></div>
						<div class="unlock">
							<div class="terms">
								<div class="squaredFour">
									<input type="checkbox" value="<?php echo $reminder['one_time']; ?>" <?php if($reminder['one_time'] == 'One Time') echo 'checked="checked"'; ?> id="squaredFour" name="check">
									<label for="squaredFour"></label>
								</div>
							</div>
						</div>
						<div class="unwrapd">
							<div class="terms">
								<div class="squaredFour">
									<input type="checkbox" value="<?php echo $reminder['one_time']; ?>" <?php if($reminder['one_time'] == 'Annualy') echo 'checked="checked"'; ?> id="squaredFour" name="check">
									<label for="squaredFour"></label>
								</div>
							</div>
						</div>
						<div class="reqt"><a class="pink" href="<?php echo ru;?>personal_reminder/<?php echo $reminder['reminder_id'];?>">Edit Reminder</a></div>
						<div class="view"><a class="pink" href="<?php echo ru;?>step_1">Send an iftGift</a></div>
						<div class="resp_btn"><img src="<?php echo ru_resource;?>images/email_icon.png" alt="Email Icon" /></div>
					</li>
					<?php /*?><li class="record record_bgk">
						<a class="close_icon" href="#"><img alt="Closed Icon" src="<?php echo ru_resource;?>images/close.png"></a>
						<div class="from">Valentine’s Day</div>
						<div class="occas">02/14/13</div>
						<div class="notft">Jane Doe Long Name</div>
						<div class="unlock">
							<div class="terms">
								<div class="squaredFour">
									<input type="checkbox" value="None" id="squaredFour" name="check">
									<label for="squaredFour"></label>
								</div>
							</div>
						</div>
						<div class="unwrapd">
							<div class="terms">
								<div class="squaredFour">
									<input type="checkbox" value="None" id="squaredFour" name="check">
									<label for="squaredFour"></label>
								</div>
							</div>
						</div>
						<div class="reqt"><a class="pink" href="#">Edit Reminder</a></div>
						<div class="view"><a class="pink" href="#">Send an iftGift</a></div>
						<div class="resp_btn"><img src="<?php echo ru_resource;?>images/email_icon.png" alt="Email Icon" /></div>
					</li><?php */?>
					<?php } } ?>
				</ul>
			</div>
		</div>
		<?php if($_SESSION['biz_rem_err']) { ?>
	<div class="overlay"></div>
	<?php } ?>
	</div>
<style>
	.hightlight{border:1px solid #ea4e18 !important}
	/* overlay styles, all needed */
	.overlay{position:fixed; top:0; left:0; height:100%; width:100%; background:url(resource/images/overlay_bg.png); z-index:9999999}
	/* just some content with arbitrary styles for explanation purposes */
	.modals{width:auto; max-width:510px; padding:20px; height:auto; background:#fafbfc; position:fixed; top:50%; left:50%; margin-top:-110px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc); text-align:center; z-index: 99999999}
	.modals img{float:left !important; margin:0}
	.valid_msg{font-size:18px; color:#3b3e3c; font-family: 'open_sansbold'; float:left; margin:-18px 0 0 136px}
	.valid_msg span{color:#ea4e18}
	.modals a{float:right;}
	.modals a img{ margin:-38px -38px 0 0 !important}
  </style>	
<link rel="stylesheet" href="<?php echo ru_resource?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ru_resource?>js/time_picker/timepicker.css" type="text/css" />
<script src="<?php echo ru_resource?>js/datepicker/jquery-ui.js"></script>
<script src="<?php echo ru_resource?>js/time_picker/jquery.ui.timepicker.js?v=0.3.3"></script>
<script type="text/javascript" src="<?php echo ru_resource?>js/time_picker/jquery.ui.core.min.js"></script>
<script type="text/javascript">
$(function() {
	$(".example1").on('click', function () {
		if ($(this).is(":checked")) {
			$(".example2").attr("checked", false);
		}
	});
	
	$(".example2").on('click', function () {
    	if ($(this).is(":checked")) {
        	$(".example1").attr("checked", false);
    	}
	});
	
	$('.month').click(function(event) {  
		if(this.checked) { 
			$('.weeks').attr("checked", true);
			$('.week').attr("checked", true);
			$('.days').attr("checked", true);
			$('.day').attr("checked", true);
		}
	});
	
	$('.weeks').click(function(event) {  
		if(this.checked) { 
			$('.week').attr("checked", true);
			$('.days').attr("checked", true);
			$('.day').attr("checked", true);
		}
	});

	$('.week').click(function(event) {  
		if(this.checked) { 
			$('.days').attr("checked", true);
			$('.day').attr("checked", true);       
		}
	});

	$('.days').click(function(event) {  
		if(this.checked) { 
			$('.day').attr("checked", true);            
		}
	});
	
	$( "#datepickers" ).datepicker({ dateFormat: 'yy-mm-dd' });
	
	$('#timepicker').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true
  });
  
  $('#event_select').change(function () {
		var txt = $(this).val();
		 var myArray = txt.split('/');
		 //alert(myArray);
		 if(myArray == 'holidays') { 
		 $("input[name='event_name']").val('');
		 $("input[name='dated']").val('');
		 } else {
		$("input[name='event_name']").val(myArray[0]);
		$("input[name='dated']").val(myArray[1]);
		}
	});
});

function reminder_process(){
	document.getElementById("reminderSub").submit();
}

function close_div()
{
	jQuery(document).ready(function () {
	jQuery(".modals").slideUp("slow");
	jQuery(".overlay").css("display","none");
	});
}

$(function () {
	$("input#squaredFour").prop("disabled", true);
})

function del_reminder(id)
{
	var dId = id;
	$.ajax({
	url: '<?php echo ru;?>process/process_reminder.php?dId='+dId,
	type: 'get', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>personal_reminder";
	}
	}
	});
}
</script>	
<?php unset($_SESSION['biz_rem_err']);
	  unset($_SESSION['biz_rem']);
?>