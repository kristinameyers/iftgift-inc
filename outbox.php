<?php
$userId = $_SESSION['LOGINDATA']['USERID'];
$get_user = $db->get_row("select * from ".tbl_user." where userId = '".$userId."'",ARRAY_A);
$email = $get_user['email'];
?>
<div class="mid_contant">
		<h2 class="title">Out.Box: iftGifts You&rsquo;ve Sent</h2>
		<?php include("common/controls_leftmenu.php");?>
		<div class="cont_bar outbox_left outbox_right">
			<div class="drop_menu">
				<h4>Archive</h4>
			</div>
			<ul class="unwrp_list">
				<li class="title_bar">
				<?php
					if (isset($_SESSION['sort'])) {
						$by = "ORDER BY ".$_SESSION['sort']['by'];
						$ad = $_SESSION['sort']['ad'];
					} else {
						$by = "ORDER BY unlock_date desc";
					}
					//echo $test="select * from ".tbl_delivery." where userId = '".$userId."' and deliverd_status = 'deliverd' {$by} {$ad}";
					$delveryOpn = $db->get_results("select * from ".tbl_delivery." where userId = '".$userId."' and deliverd_status = 'deliverd' {$by} {$ad}",ARRAY_A);
					if($delveryOpn) {
					$c = true;
					?>
					<div class="from">Recipient <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="recp_first_name" class="sort<?php echo $by == 'recp_first_name' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="occas">Amount <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="cash_amount" class="sort<?php echo $by == 'cash_amount' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="notft">Occasion <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="occassionid" class="sort<?php echo $by == 'occassionid' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="unlock">Created <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="dated" class="sort<?php echo $by == 'dated' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="unwrapd">Notify <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="date" class="sort<?php echo $by == 'date' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="reqt">Unlock <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="unlock_date" class="sort<?php echo $by == 'unlock_date' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="view">Unwrap <img src="<?php echo ru_resource; ?>images/arrow_i.png" alt="Down Arrow" id="unwrap_date" class="sort<?php echo $by == 'unwrap_date' ? ' '.strtolower($ad) : null; ?>" /></div>
					<div class="view remd">Set Reminder</div>
					<div class="resp_btn">&nbsp;</div>
				</li>
				<?php
					foreach($delveryOpn as $open) { 
				?>
				<li class="record <?php if($c = !$c) { ?>record_bgk<?php } else { } ?>">
					<div class="from"><img src="<?php echo ru_resource; ?>images/resp_img.png" alt="Recipient Image" /><span><?php echo ucfirst($open['recp_first_name']); ?></span></div>
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
					<div class="notft"><?php echo $occasion_name;//$view_occs['occasion_name'];?></div>
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
					<div class="view"><?php if($open['unwrap_date'] != '0000-00-00 00:00:00') { echo $uchild1;?><br/><?php echo $uchild2; }?></div>
					<div class="view remd"><img src="<?php echo ru_resource; ?>images/remd_icon.png" alt="Reminder Icon" onclick="goto_remind();" /></div>
					<div class="resp_btn">
						<a href="<?php echo ru; ?>unwrapped/<?php echo $open['delivery_id']?>" class="orange">View</a>
						<!--<h5>Release Requested: <span>Reinstate</span></h5>-->
						<?php if($open['release_request'] == '1') { ?>
						<a href="<?php echo ru; ?>release_request/<?php echo $open['userId'].'/'.$open['delivery_id']; ?>" class="orange blue">Respond to Release Request</a>
						<?php } ?>
					</div>
				</li>
				<?php } } ?>
				
			</ul>
		</div>
	</div>
<?php 
unset($_SESSION['sort_by']);
unset($_SESSION['sort']);
?>		
<script type="text/javascript">
$(function () {
	$("input#squaredFour").prop("disabled", true);
})

function goto_remind()
{
	window.location = '<?php echo ru;?>personal_reminder';
}
</script>	