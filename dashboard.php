<?php	
error_reporting(0);
unset($_SESSION['cart']);
$userId = $_SESSION['LOGINDATA']['USERID'];
unset($_SESSION['DRAFT']);
$get_user = $db->get_row("select * from ".tbl_user." where userId = '".$userId."'",ARRAY_A);
$email = $get_user['email']; 
$get_delivery = $db->get_row("select count(recp_email) as cnt from ".tbl_delivery." where recp_email = '".$email."' and deliverd_status = 'deliverd' and (unlock_status = '1' or open_status = '2') GROUP BY recp_email HAVING Count( recp_email )",ARRAY_A);
//echo $_COOKIE['USERID']; 
?>
<script>
		$(document).ready(function(){
		 $("#reward").click(function(){
			$("#reward_ad").slideToggle();
		  });
		  $("#pb").click(function(){
			$("#public").slideToggle('slow');
		  });
		  $("#pr").click(function(){
			$("#personal").slideToggle('slow');
		  });
		});
	</script>
	<div class="mid_contant">
		<h2 class="title">Your Dashboard</h2>
		<?php include_once("common/dashboard_left.php");?>
		<div id="result_friends"></div>
		<div class="dash_left dash_right">
			<div class="unwrap">
				<h1>UNWRAP</h1>
				<div class="count_box">
					<h5>You Have <input type="text" value="<?php  if($get_delivery > 0 ) { echo $get_delivery['cnt']; } else { echo '0';} ?>" /> Active iftGifts</h5>
				</div>
				<img src="<?php echo ru_resource; ?>images/jester_f.jpg" alt="Jester Image" />
				<h5 class="message">No more unhappy returns!</h5>
				<a href="<?php echo ru;?>gift_collect" <?php  if($get_delivery > 0 ) { ?>style="background:#cc66cc"<?php } ?>>Unwrap an iftGift</a>
			</div>
			<div class="unwrap send">
				<h1>SEND</h1>
				<div class="count_box">
					<h5>Cash Along With Personal Gift Suggestions</h5>
				</div>
				<img src="<?php echo ru_resource; ?>images/jester_g.jpg" alt="Jester Image" />
				<h5 class="message">No more shop &lsquo;til you drop!</h5>
				<a href="<?php echo ru;?>step_1">Send an iftGift</a>
			</div>
			<?php
				$countdraft = mysql_fetch_array(mysql_query("select count(delivery_id) as count_draft from ".tbl_delivery." where userId = '".$userId."' and draft = '1'")); 
				
				$total_count = $countdraft['count_draft'];
			?>
			<a href="<?php echo ru;?>saved-iftgifts" class="ift_prog"><?php echo $total_count; ?> iftGift<?php if($total_count > 1) {?>s<?php } ?> in Progress  <img src="<?php echo ru_resource; ?>images/downarrow4.png" alt="Down Arrow"  class="reward" /></a>
			<a href="<?php echo ru;?>withdraw_payment" class="ift_prog2">Your Withdraw Payments   <img src="<?php echo ru_resource; ?>images/downarrow4.png" alt="Down Arrow"  class="" /></a>
			<?php /*?><div class="unwrap build">
				<div class="build_inner">
					<img src="<?php echo ru_resource; ?>images/gift_icon.jpg" alt="BUILD A REGiftRY Icon" />
					<a href="#">BUILD A REGiftRY</a>
				</div>
			</div><?php */?>
			<div class="unwrap build remnd">
				<?php	
					$curr_date = date('Y-m-d');
					$reminder_Qrys = "select * from ".tbl_reminder." where userId = '".$_SESSION['LOGINDATA']['USERID']."'";
					$view_reminders = $db->get_results($reminder_Qrys,ARRAY_A);
					$i = 0;
							foreach($view_reminders as $val){
							if($curr_date < $val['dated']) {
										$personals[]=array($val['event_name'].'/'.$val['remind_me'].'/'.$val['dated']);
								}
							}
								 $per = $personals;
								asort($per);
							
				?>
				<div class="remd_list remd_list_b">
					<div class="reward_bar1" >
						<span>Your Personal Reminders <img src="<?php echo ru_resource; ?>images/downarrow3.png" alt="Down Arrow"  class="reward" id="pr" /></span>	
					</div>
					<ul class="reward_ads"style="display:block" id="personal">
						<?php /*?><h4>Your Personal Reminders <a href="<?php echo ru;?>personal_reminder">+ Create New Reminders</a></h4><?php */?>
						<?php
						foreach ($per as $key => $val) {	
								foreach($val as $k) {
									$p = explode('/',$k);
									if($i <= 6) { 
						?>	
						<li>
						<img src="<?php echo ru_resource; ?>images/cross_icon.jpg" alt="Cross icon" class="croos" style="cursor:pointer" onclick="del_reminder('<?php echo $reminders['reminder_id']; ?>');" />
						<span><?php echo $p[0]; ?>&nbsp;<?php //echo $reminders['event_name']; ?></span>
						<?php
						
						$timestamps = strtotime($p[2]);
						$notify_date = date('M. d. Y', $timestamps);
						?>
						<?php if ($p[1] > 0){?>
						<span class="date"><?php echo $p[1].' '.$notify_date; ?></span>
						<a href="<?php echo ru;?>step_1">Send an iftGift</a>
						<?php } else { 
							$timestamps = strtotime($p[2]);
							$notify_date1 = date('F d, Y', $timestamps);
						?>
							
							<span class="date"><?php echo $notify_date1; ?></span>
						<a href="<?php echo ru;?>step_1">Send an iftGift</a>
						</li>
						
						<?php }	} 
								  $i++; 
								} 
							} ?>
						</ul>
				</div>
				<?php #} ?>	
				<div class="remd_list remd_list_b">
					<div class="reward_bar1" >
						<span>Your Public Reminders <img src="<?php echo ru_resource; ?>images/downarrow3.png" alt="Down Arrow" class="reward" id="pb" /></span>	
					</div>
					<ul class="reward_ads" style="display:block" id="public">
						<?php
						$current_date = date('Y-m-d');
						$rs_events = $db->get_results("select pr_name,pr_date,pr_edate from gift_public_reminder  ",ARRAY_A);
							$i = 0;
							foreach($rs_events as $val){
							if($current_date < $val['pr_date']) {
										$dates[]=array($val['pr_date'].'/'.$val['pr_name'].'/'.$val['pr_edate']);
								}
							}
								$fruits = $dates;
								asort($fruits);
							foreach ($fruits as $key => $val) {	
								foreach($val as $k) {
									$t = explode('/',$k);
									if($i <= 5) { ?>
							<li>
								<img src="<?php echo ru_resource; ?>images/cross_icon.jpg" alt="Cross icon" class="croos" />
								<span><?php echo $t[1]; ?></span>
								<?php if($t[2] > 0) {
									$timestamps = strtotime($t[0]);
									$events_date = date('M d', $timestamps);
									$timestamps1 = strtotime($t[2]);
									$events_date1 = date('M d, Y', $timestamps1);
									
								?>
								<span class="date"><?php echo $events_date.' - '.$events_date1;?></span>
								<a href="<?php echo ru;?>step_1">Send an iftGift</a>
								<?php } else { ?>
								<?php 
									$timestamps = strtotime($t[0]);
									$events_date = date('F d, Y', $timestamps);	
								?>
								<span class="date"><?php echo $events_date;?></span>
								<a href="<?php echo ru;?>step_1">Send an iftGift</a>
							</li>
							<?php }	} 
								  $i++; 
								} 
							} 
						?>
						</ul>
					</div>
			</div>
		</div>
		<div class="reward_bar" >
			<span>Retailer Rewards <img src="<?php echo ru_resource; ?>images/downarrow2.png" alt="Down Arrow" class="reward" id="reward" /></span>	
		</div>
		<ul class="reward_ads" style="display:none" id="reward_ad">
			<li><img src="<?php echo ru_resource; ?>images/reward_img_a.jpg" alt="Rewards Image" /><div class="reward_ads_upper"><h4><span>$15</span> OFF <span>&raquo;</span> <span>50</span> POINTS</h4> <a href="#">Redeem Points 1</a></div></li>
			<li><img src="<?php echo ru_resource; ?>images/reward_img_b.jpg" alt="Rewards Image" /><div class="reward_ads_upper"><h4><span>$10</span> OFF <span>&raquo;</span> <span>15</span> POINTS</h4> <a href="#">Redeem Points 2</a></div></li>
			<li><img src="<?php echo ru_resource; ?>images/reward_img_c.jpg" alt="Rewards Image" /><div class="reward_ads_upper"><h4><span>$35</span> OFF <span>&raquo;</span> <span>75</span> POINTS</h4> <a href="#">Redeem Points 3</a></div></li>
			<li class="last"><img src="<?php echo ru_resource; ?>images/reward_img_d.jpg" alt="Rewards Image" /><div class="reward_ads_upper"><h4><span>$25</span> OFF <span>&raquo;</span> <span>225</span> POINTS</h4> <a href="#">Redeem Points 4</a></div></li>
		</ul>
	</div>
<script>
function del_reminder(id)
{
	var dId = id;
	$.ajax({
	url: '<?php echo ru;?>process/process_reminder.php?dId='+dId,
	type: 'get', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>dashboard";
	}
	}
	});
}
</script>	
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	appId      : '341516796048593',
	channelUrl : '//WWW.zs-dev.COM/iftgift', 
	status     : true, 
	cookie     : true, 
	xfbml      : true  
	});
};
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));

function FBLogin(){
	FB.login(function(response){
		if(response.authResponse){
			window.location.href = "<?php echo ru;?>process/process_friends.php?action=fblogin";
		}
	}, {scope: 'email,user_likes,user_friends,read_friendlists,manage_friendlists,publish_actions'});
}
function createreminder() {
	window.location = "<?php echo ru;?>personal_reminder";
}
</script>