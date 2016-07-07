<?php 
if(isset($s)){
	$userId = explode('_',base64_decode($s));
	if($userId[0] != $_SESSION['LOGINDATA']['USERID']){ 
		session_unset($_SESSION['LOGINDATA']['USERID']);
		header("location:".ru."login/".$s);exit;
	 }
} 
unset($_SESSION['DRAFT']);
unset($_SESSION['cart']);
$userId = $_SESSION['LOGINDATA']['USERID'];
$get_user = $db->get_row("select * from ".tbl_user." where userId = '".$userId."'",ARRAY_A);
$email = $get_user['email'];
$party_mode = $get_user['party_mode']; 
$get_delivery = $db->get_row("select count(recp_email) as cnt from ".tbl_delivery." where recp_email = '".$email."' and deliverd_status = 'deliverd' and (unlock_status = '1' or open_status = '2') GROUP BY recp_email HAVING Count( recp_email )",ARRAY_A);

$delveryQry = $db->get_results("select * from ".tbl_delivery." where recp_email = '".$email."' and deliverd_status = 'deliverd' and unlock_status = '1' order by delivery_id desc",ARRAY_A);
?>
<script type="text/javascript">
	$(document).ready(function () {
		$('#toggle-view li').click(function () {
			var text = $(this).children('div.slide_div');
			if (text.is(':hidden')) {
				text.slideDown('slow');
				$(this).children('.hide_div').html('<img src="<?php echo ru_resource;?>images/nagative_sign.png" />');		
			} else {
				text.slideUp('slow');
				$(this).children('.hide_div').html('<img src="<?php echo ru_resource;?>images/plus_sign.png" />');		
			}
		});
	});
</script>
<div class="mid_contant">
	<h2 class="title">Unwrap: Your iftGifts</h2>
	<div class="cont_bar">
		<div class="cont_bar_inner cont_bar_inner_c">
			<div class="unwrp unwrp_b">
				<h1>UNWRAP</h1>
				<div class="count_box count_box_b">
					<h5>You have <input type="text" value="<?php  if($get_delivery > 0 ) { echo $get_delivery['cnt']; } else { echo '0';} ?>" /> active gifts</h5>
				</div>
			</div>
			<script type="text/javascript">
				$('.on_off a').on('click', function() {
					var id = $(this).attr('id');
					var uid = '<?php echo $_SESSION['LOGINDATA']['USERID']; ?>';
					$.ajax({
					url: '<?php echo ru;?>process/process_mode.php',
					type: 'POST', 
					data: {mode:id,userid:uid} ,
					success: function(output) {
						if(output == 'on')
						{
							$('#on').addClass('active');
							$('#off').removeClass('active');
						} else {
							$('#off').addClass('active');
							$('#on').removeClass('active');
						}
					}
					})
				});
				</script>
			<ul class="unwrp_list unwrp_chg">
				<li class="unwrap_top">
					<div class="close">&nbsp;</div>
					<div class="from">From</div>
					<div class="occas" id="uwrapped">Unwrapped</div>
					<div class="from">Occasion</div>
					<div class="occas" id="staus">Status</div>
					<div class="hide_div">&nbsp;</div>
				</li>
			</ul>
			<ul class="unwrp_list unwrp_chg" >
				<?php 
					if($delveryQry) {
						foreach($delveryQry as $unlock) { 
				?>
					<li class="record">
						<div class="close orag">&nbsp;</div>
						<div class="from orag"><?php echo ucfirst($unlock['giv_first_name']).'&nbsp;'.ucfirst($unlock['giv_last_name']); ?></div>
						<?php
							$getoccss = explode("_",$unlock['occassionid']);
							if($unlock['occassionid'] == 'other_'.$getoccss[1]){
								$occasion_name = $getoccss[1];
							}else{
								$view_occs = $db->get_row("select * from ".tbl_occasion." where occasionid = '".$unlock['occassionid']."'",ARRAY_A);
								$occasion_name = $view_occs['occasion_name'];
							}
						?>
						<div class="from orag" id="uwrapped">&nbsp;</div>
						<div class="occas orag"><?php echo $occasion_name;?></div>
						<div class="occas orag" id="staus">Pending</div>
						<div class="hide_div uwrap_btn" onclick="unlock_gift('<?php echo $unlock['delivery_id'];  ?>')">
							<div class="view_bar">
								<span>View</span>
								<img src="<?php echo ru_resource; ?>images/arrow_m.png" alt="Next Arrow" />
							</div>
						</div>
					</li>
				<?php } } ?>
			</ul> 
			<ul class="unwrp_list unwrp_chg">
				<?php
					$delveryOpn = $db->get_results("select * from ".tbl_delivery." where recp_email = '".$email."' and open_status = '2' order by delivery_id desc",ARRAY_A);
					if($delveryOpn) {
						foreach($delveryOpn as $open) { 
				?>
					<li class="record">
						<div class="close purp">&nbsp;</div>
						<div class="from purp"><?php echo ucfirst($open['giv_first_name']).'&nbsp;'.ucfirst($open['giv_last_name']); ?></div>
						<?php
							$getoccss = explode("_",$open['occassionid']);
							if($open['occassionid'] == 'other_'.$getoccss[1]){
								$occasion_name = $getoccss[1];
							}else{
								$view_occs = $db->get_row("select * from ".tbl_occasion." where occasionid = '".$open['occassionid']."'",ARRAY_A);
								$occasion_name = $view_occs['occasion_name'];
							}	
						?>
						<div class="from purp" id="uwrapped">&nbsp;</div>
						<div class="occas purp"><?php echo $occasion_name;?></div>
						<div class="from purp" id="staus">Unlocked</div>
						<div class="hide_div uwrap_btn open_btn"  onclick="open_gift('<?php echo $open['delivery_id'];  ?>')">
							<div class="view_bar">
								<span>Open</span>
								<img src="<?php echo ru_resource; ?>images/arrow_m.png" alt="Next Arrow" />
							</div>
						</div>
					</li>
				<?php } } ?>
			</ul>
			<ul class="unwrp_list unwrp_chg" id="toggle-view">
				<?php	
					$delveryUnwrp = $db->get_results("select * from ".tbl_delivery." where recp_email = '".$email."' and unwrap_status = '3' order by delivery_id desc",ARRAY_A);
					if($delveryUnwrp) {
						foreach($delveryUnwrp as $unwrap) { 
				?>
					<li class="record">
						<div class="close">
							<img src="<?php echo ru_resource; ?>images/cross_sign.png" alt="Closed Icon" onclick="del_unwrap('<?php echo $unwrap['delivery_id']; ?>');"/>
						</div>
						<div class="from gry"><?php echo ucfirst($unwrap['giv_first_name']).'&nbsp;'.ucfirst($unwrap['giv_last_name']); ?></div>
						<?php
							$getoccss = explode("_",$unwrap['occassionid']);
							if($unwrap['occassionid'] == 'other_'.$getoccss[1]){
								$occasion_name = $getoccss[1];
							}else{
								$view_occs = $db->get_row("select * from ".tbl_occasion." where occasionid = '".$unwrap['occassionid']."'",ARRAY_A);
								$occasion_name =$view_occs['occasion_name'];
							}
						?>
						<?php  $unwraped_date = explode('_',$unwrap['unwrap_date']);?>
						<div class="from gry" id="uwrapped"><?php echo $unwraped_date[0];?></div>
						<div class="occas gry"><?php echo $occasion_name;?></div>
						<div class="from gry" id="staus">Unwrapped</div>
						<div class="hide_div"><img src="<?php echo ru_resource; ?>images/plus_sign.png" alt="Plus Icon" /></div>
						<div class="slide_div" style="display:none">
							<div class="slide_div_inner">
								<div class="close">&nbsp;</div>
								<?php $timestamps = strtotime($unwrap['date']);?>
								<div class="occas"><span>Notification: </span><?php echo $notify_date = date('m/d/y', $timestamps);?>&nbsp;@&nbsp;<?php echo $unwrap['time'];?></div>
								<div class="hide_div">&nbsp;</div>
							</div>
							<div class="slide_div_inner slide_div_inner_b">
								<div class="close">&nbsp;</div>
								<?php $timestamps = strtotime($unwrap['unlock_date']);?>
								<div class="occas"><span>Unlock: </span><?php echo $unlock_date = date('m/d/y', $timestamps);?>&nbsp;@&nbsp;<?php echo $unwrap['unlock_time'];?></div>
								<div class="hide_div">&nbsp;</div>
							</div>
							<div class="slide_div_inner">
								<div class="close">&nbsp;</div>
								<?php  $unwraped_date = explode('_',$unwrap['unwrap_date']);?>
								<div class="occas"><span>Unwrap: </span><?php echo $unwraped_date[0]; if($unwrap['unwrap_date'] != '') { ?>&nbsp;@&nbsp<?php } echo $unwraped_date[1];?> </div>
								<div class="hide_div">&nbsp;</div>
							</div>
							<div class="slide_div_inner slide_div_inner_b">
								<div class="from view unrp_btns"><a href="javascript:;" onclick="unwrapped_gift('<?php echo $unwrap['delivery_id'];  ?>')" class="unwraped">Unwrapped</a></div>
								<?php if($unwrap['thank_mail'] == 0) { ?>
									<div class="from reqt unrp_btns"><a href="javascript:;" class="unwraped" onclick="thankyou('<?php echo $unwrap['delivery_id'] ?>')">Send Thank You</a></div>
								<?php } ?>
							</div>
						</div>
					</li>
					<div class="modal modal_b modal_c" id="thankyou_div_<?php echo $unwrap['delivery_id']; ?>" style="display:none">
						<a style="cursor:pointer" onClick="close_div2();">
							<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
						</a>
						<div class="mid_contant thankyou">
							<div class="cont_bar_inner cont_bar_inner_d">
								<h4 class="snd">iftGift eCard</h4>
								<img src="<?php echo ru_resource;?>images/jester_ar.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
								<div class="regs_form send_ques send_tansk" style="margin:0">
									<form id="sndEmail" action="<?php echo ru; ?>process/process_thankmail.php" method="post">
										<div class="flied fill">
											<input name="delivery_id" id="delivery_id" value="<?php echo $unwrap['delivery_id']; ?>" type="hidden">
											<input name="giv_email" id="giv_email" value="<?php echo $unwrap['giv_email']; ?>" type="hidden">
											<input name="recp_email" id="recp_email" value="<?php echo $unwrap['recp_email']; ?>" type="hidden">
											<input name="giv_name" id="giv_name" value="<?php echo $unwrap['giv_first_name']; ?>" type="hidden">
											<input name="recp_name" id="recp_name" value="<?php echo $unwrap['recp_first_name']; ?>" type="hidden">
											<input type="text" name="subject" id="subject" placeholder="So recipient sees in the email subject line that it&acute;s you and not SPAM" />
											<textarea name="message" placeholder="[Enter Your Text Here]"></textarea>
											<input type="submit" name="ThankMail" id="ThankMail" value="Send">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				<?php } } ?>
				<div class="unwrp_right unwrp_right_b">
					<label>Party Mode!</label>
					<div class="on_off">
						<a href="javascript:;" id="off" class="off <?php if($party_mode == 'off' || $party_mode == '') { ?>active<?php } ?>">OFF</a>
						<a href="javascript:;" id="on" class="on <?php if($party_mode == 'on') { ?>active<?php } ?>">ON</a>
					</div>
					<p>OFF reveals cash amount. <br/>ON hides cash amount, <br/>but displays your iftGifts.</p>
				</div>
				<p class="info">After 30 days, all unwrapped iftGifts are automatically transferred to your <a href="<?php echo ru; ?>inbox">In.Box Archive</a><br>To transfer manually click <a href="#"><img src="<?php echo ru_resource; ?>images/close.png" alt="Closed Icon" /></a> </p>
			</ul>
		</div>
	</div>
</div>
<div class="overlay" style="display:none"></div>
<style>
.element .hightlight{border:2px solid #ea4e18}
.thankyou{width:100%; max-width:100%}
</style>	
<script type="text/javascript">
function thankyou(devID) {
	$(".overlay").show();
	$("#thankyou_div_"+devID).show("slow");
}

function close_div2()
{
	jQuery(".modal").slideUp("slow");
	jQuery(".overlay").css("display","none");
}

function del_unwrap(id)
{
	var dId = id;
	$.ajax({
	url: '<?php echo ru;?>process/process_unwrap.php?dId='+dId,
	type: 'get', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>gift_collect";
	}
	}
	});
}

function del_open(id)
{
	var dId = id;
	$.ajax({
	url: '<?php echo ru;?>process/process_unwrap.php?opendel='+dId,
	type: 'get', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>gift_collect";
	}
	}
	});
}


function open_gift(id) {
	var dev_id = id;
	var d=new Date();
	var dat=d.getDate();
	var mon=d.getMonth()+1;
	var year=d.getFullYear();
	var todayDate = mon+"/"+dat+"/"+year;
	
	var date=new Date();
	var hours = date.getHours();
	var ampm = hours >= 12 ? 'PM' : 'AM'; 
	var minutes = date.getMinutes();
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	hours = hours < 10 ? '0'+hours : hours;
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var time_dev = todayDate+'_'+hours+':'+minutes+' '+ampm;
	$.ajax({
	url: '<?php echo ru;?>process/process_unwrap.php?open='+dev_id+'&time_dev='+time_dev,
	type: 'GET', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>open/"+id;
	}
	}
	});
}

function unwrapped_gift(id) {
	var dev_id = id;
	var d=new Date();
	var dat=d.getDate();
	var mon=d.getMonth()+1;
	var year=d.getFullYear();
	var todayDate = mon+"/"+dat+"/"+year;
	
	var date=new Date();
	var hours = date.getHours();
	var ampm = hours >= 12 ? 'PM' : 'AM'; 
	var minutes = date.getMinutes();
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	hours = hours < 10 ? '0'+hours : hours;
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var time_dev = todayDate+'_'+hours+':'+minutes+' '+ampm;
	$.ajax({
	url: '<?php echo ru;?>process/process_unwrap.php?open='+dev_id+'&time_dev='+time_dev,
	type: 'GET', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>unwrapped/"+id;
	}
	}
	});
}
function unlock_gift(id){
	window.location='<?php echo ru; ?>locked/'+id;
}
</script>	