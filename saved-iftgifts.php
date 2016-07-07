<div class="mid_contant">
	<h2 class="title">Your Saved iftGifts</h2>
	<div class="cont_bar outbox_left outbox_right inbox_right score_a">
		<div class="ift_bar_a ift_bar_c">
			<ul class="unwrp_list lib_remd">
				<li class="title_bar">
					<div class="from">Name</div>
					<div class="from">Date</div>
					<div class="from">Occasion</div>
					<div class="from">Email</div>
					<div class="from">Resume Gift</div>
				</li>
				<?php 		
					$reminder_Qry = "select * from ".tbl_delivery." where userId='".$_SESSION['LOGINDATA']['USERID']."' and draft = '1' order by delivery_id desc";
					$view_reminder = $db->get_results($reminder_Qry,ARRAY_A);
					if($view_reminder) {
					$c = true;
					foreach($view_reminder as $reminder) {								
				?>	
				<li class="record <?php if($c = !$c) { ?>record_bgk<?php } else { } ?>">
					<div class="from"><?php echo ucfirst($reminder['recp_first_name']).' '.ucfirst($reminder['recp_last_name']); ?></div>
					<?php
					$timestamps = strtotime($reminder['dated']);
					$notify_date = date('m/d/Y', $timestamps)
					?>
					<div class="from"><?php echo $notify_date; ?></div>
					<div class="from">
					<?php 
						$getoccss = explode("_",$reminder['occassionid']);
						if($reminder['occassionid'] == 'other_'.$getoccss[1]){
							$occasion_name = $getoccss[1];
						}else{
							$get_occas = $db->get_row("select occasion_name from ".tbl_occasion." where occasionid='".$reminder['occassionid']."' ",ARRAY_A);
							$occasion_name = $get_occas['occasion_name'];
						}
						echo $occasion_name; ?>
					</div>
					<div class="from"><?php echo $reminder['recp_email']; ?></div>
					<div class="from" >
							<div class="resp_btn">
							<a class="orange" href="javascript:;"  onclick="open_gift('<?php echo $reminder['delivery_id'];  ?>')">Open</a>
						</div>
					</div>
				</li>
				<?php } } ?>
				
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
function open_gift(id) {
	var dev_id = id;
	$.ajax({
		url: '<?php echo ru;?>process/process_draft.php?steps='+dev_id,
		type: 'GET', 
		success: function(output) {
			var step = output.split('/');
			if(step[0] == 'step_1'){
				window.location = "<?php echo ru?>step_1";
			} else if(step[0] == 'step_2a'){
				window.location = "<?php echo ru?>step_2a"; 
			} else if(step[0] == 'delivery_detail'){
				window.location = "<?php echo ru?>delivery_detail/"+step[1];
			} else if(step[0] == 'checkout'){
				window.location = "<?php echo ru?>checkout";
			}
		}
	});
}

function save_resumedev(id) {
	var dev_id = id;
	$.ajax({
		url: '<?php echo ru;?>process/process_draft.php?devsteps='+dev_id,
		type: 'GET', 
		success: function(output) {
		//alert(output);
		var step = output.split('/');
			if(step[0] == 'delivery_detail'){
				window.location = "<?php echo ru?>delivery_detail/"+step[1];
			} else if(output == 'checkout'){
				window.location = "<?php echo ru?>checkout";
			}
		}
	});
}
</script>
