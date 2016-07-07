<?php
$userId = $_SESSION['LOGINDATA']['USERID'];
$get_user = $db->get_row("select * from ".tbl_user." where userId = '".$userId."'",ARRAY_A);
$email = $get_user['email'];
?>

<div class="mid_contant">
		<h2 class="title">In.Box: iftGifts You&rsquo;ve Received</h2>
		<?php include("common/controls_leftmenu.php");?>
		<div class="cont_bar outbox_left outbox_right inbox_right">
			<div class="drop_menu">
				<h4>Archive</h4>
			</div>
			<ul class="unwrp_list">
				<li class="title_bar">
				<?php
					if (isset($_SESSION['sort'])) {
						$by = "ORDER BY  ".$_SESSION['sort']['by'];
						$ad = $_SESSION['sort']['ad'];
					} else {
						$by = "ORDER BY unlock_date desc";
					}
					$delveryOpn = $db->get_results("select * from ".tbl_delivery." where recp_email = '".$email."' and inbox = '1' {$by} {$ad}",ARRAY_A);
					if($delveryOpn) {
					$c = true;
					?>
					<div class="from">Sender<img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="giv_first_name" class="sort<?php echo $by == 'giv_first_name' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="occas">Amount <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="cash_amount" class="sort<?php echo $by == 'cash_amount' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="notft">Occasion <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="occassionid" class="sort<?php echo $by == 'occassionid' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="unlock">Created <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="dated" class="sort<?php echo $by == 'dated' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="unwrapd">Notified <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="date" class="sort<?php echo $by == 'date' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="reqt">Unlocked <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="unlock_date" class="sort<?php echo $by == 'unlock_date' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="view remd">Unwrapped <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="unwrap_date" class="sort<?php echo $by == 'unwrap_date' ? ' '.strtolower($ad) : null; ?>"  /></div>
					<div class="resp_btn">&nbsp;</div>
				</li>
				<?php
					foreach($delveryOpn as $open) { 
				?>
				<li class="record <?php if($c = !$c) { ?>record_bgk<?php } else { } ?>">
					<div class="from"><img src="<?php echo ru_resource; ?>images/resp_img.png" alt="Recipient Image" /><span><?php echo ucfirst($open['giv_first_name']); ?></span></div>
					<div class="occas">$<?php echo $open['cash_amount']; ?></div>
					<?php
					$getoccss = explode("_",$open['occassionid']);
						if($open['occassionid'] == 'other_'.$getoccss[1]){
							 $occasion_name = $getoccss[1];
						}else{
					$view_occs = $db->get_row("select * from ".tbl_occasion." where occasionid = '".$open['occassionid']."'",ARRAY_A);
							$occasion_name = $view_occs['occasion_name'];
					}
					?>
					<div class="notft"><?php echo $occasion_name;?></div>
					<div class="unlock">
						<div class="terms">
							<div class="squaredFour">
								<input type="checkbox" name="check" checked="checked" id="squaredFour" value="None">
								<label for="squaredFour"></label>
							</div>
						</div>
						<?php $created_timestamp = strtotime($open['dated']);
							  $child1 = date('m/d/Y', $created_timestamp); 
							  $child2 = date('h:i A', $created_timestamp);?>
						<span><?php echo $child1;?><br/><?php echo $child2;?></span>
					</div>
					<div class="unwrapd">
						<div class="terms">
							<div class="squaredFour">
								<input type="checkbox" name="check" checked="checked" id="squaredFour" value="None">
								<label for="squaredFour"></label>
							</div>
						</div>
						<?php $timestamps = strtotime($open['date']);?>
						<span><?php echo $notify_date = date('m/d/y', $timestamps);?><br/><?php echo $open['time'];?></span>
					</div>
					<?php $unlock_timestamps = strtotime($open['unlock_date']);
						  $cdate = date('Y/m/d');?>
					<div <?php if($cdate >= date('Y/m/d', $unlock_timestamps)) { ?>class="view"<?php } else { ?>class="reqt"<?php } ?>><?php echo $notify_date = date('m/d/y', $unlock_timestamps);?><br/><?php echo $open['unlock_time'];?></div>
					<?php 
					if($open['unwrap_date'] != '0000-00-00 00:00:00') { 
						  $ucreated_timestamp = explode('_',$open['unwrap_date']);
						  $uchild1 = $ucreated_timestamp[0]; 
						  $uchild2 = $ucreated_timestamp[1]; } ?>
					<div class="view remd"><?php if($open['unwrap_date'] != '0000-00-00 00:00:00') { echo $uchild1;?><br/><?php echo $uchild2; }?></div>
					<div class="resp_btn">
						<a href="<?php echo ru; ?>unwrapped/<?php echo $open['delivery_id'] ?>" class="orange unwraped">Unwrapped</a>
						<a href="<?php echo ru; ?>step_1" class="orange blue">Send an iftGift</a>
						<?php if($open['thank_mail'] == '0') {?>
						<a href="javascript:;" onclick="thankyou('<?php echo $open['delivery_id'] ?>')" class="orange">Thank You Due</a>
						<?php } ?>
					</div>
				</li>
				<div class="modals" id="thankyou_div_<?php echo $open['delivery_id']; ?>" style="display:none">
					<a style="cursor:pointer" onClick="close_div2();">
						<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
					</a>
					<div class="mid_contant thankyou">
						<div class="cont_bar_inner cont_bar_inner_d">
							<h4 class="snd">iftGift eCard</h4>
							<img src="<?php echo ru_resource;?>images/jester_ar.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
							<div class="regs_form send_ques" style="margin:0">
								<form id="sndEmail" action="<?php echo ru; ?>process/process_thankmail.php" method="post">
									<div class="flied fill">
									<input name="delivery_id" id="delivery_id" value="<?php echo $open['delivery_id']; ?>" type="hidden">
									<input name="giv_email" id="giv_email" value="<?php echo $open['giv_email']; ?>" type="hidden">
									<input name="recp_email" id="recp_email" value="<?php echo $open['recp_email']; ?>" type="hidden">
									<input name="giv_name" id="giv_name" value="<?php echo $open['giv_first_name']; ?>" type="hidden">
									<input name="recp_name" id="recp_name" value="<?php echo $open['recp_first_name']; ?>" type="hidden">
									<input type="text" name="subject" id="subject" placeholder="So recipient sees in the email subject line that it&rsquo;s you and not SPAM" />
									<textarea name="message" placeholder="[Enter Your Text Here]"></textarea>
									<input type="submit" name="ThankMail" id="ThankMail" value="Send">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } } ?>
			</ul>
		</div>
	</div>
	<div class="overlay" style="display:none"></div>
<?php 
unset($_SESSION['sort_by']);
unset($_SESSION['sort']);
?>	
<style>
/* just some content with arbitrary styles for explanation purposes */
.modals{width:auto; height:auto; padding:0 0 10px; position:fixed; top:30%; left:44%; background-color:#fff; margin-top:-180px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc);z-index:99999999}
.cont_bar h3{-moz-border-radius:12px 12px 0 0; -webkit-border-radius:12px 12px 0 0; border-radius:12px 12px 0 0}
.modals img{float:left; margin:0}
.modals a{float:right}
.modals a img{margin:-16px -16px 0 0}
</style>	
<script type="text/javascript">
$(function () {
	$("input#squaredFour").prop("disabled", true);
})

function thankyou(devID) {
	$(".overlay").show();
	$("#thankyou_div_"+devID).show("slow");
}

function close_div2()
{
	jQuery(".modals").slideUp("slow");
	jQuery(".overlay").css("display","none");
}
</script>	