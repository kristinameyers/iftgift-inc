<div class="mid_contant">
	<h2 class="title">Withdraw Payment History</h2>
	<div class="cont_bar outbox_left outbox_right inbox_right score_a withdraw_pymt">
	<div class="overlay" style="display:none"></div>
				<div class="modal" id="withdraw_success" style="display:none">
					<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
					<div class="valid_msg">$<span id="cur_bal"></span> will be added back<br />to your cash stash.<br />You have $<span id="new_bal"> </span> remaining.
						<button class="orange" onclick="redirect_func()" type="submit">Continue</button>
					</div>
				</div>
		<div class="ift_bar_a ift_bar_c">
			<ul class="unwrp_list lib_remd">
				<li class="title_bar">
					<div class="from" >Name</div>
					<div class="from" >Email</div>
					<div class="from" >Total Cash</div>
					<div class="from" >Withdraw Status</div>
					<div class="from" >Date/Time</div>
					<div class="from" >Admin Note</div>
					<div class="from" >Action</div>
				</li>
				<?php 		
				$sql = "SELECT w.*,u.userId,u.first_name,u.last_name,u.email FROM gift_cash_withdraw as w, ".tbl_user." as u where u.userId='".$_SESSION['LOGINDATA']['USERID']."' AND u.userId=w.userId order by withdrawID desc";
					$withdraw_cash = $db->get_results($sql,ARRAY_A);
					if($withdraw_cash) {
					$c = true;
					foreach($withdraw_cash as $cash) {								
				?>	
				<li class="record <?php if($c = !$c) { ?>record_bgk<?php } else { } ?>">
					<div class="from" ><?php echo $cash['first_name']." ".$cash['last_name'];?></div>
					<div class="from" ><?php echo $cash['email']; ?></div>
					<div class="from" ><?php echo $cash['netamount'];?></div>
					<div class="from" ><?php echo ucfirst($cash['wstatus']);?></div>
					<div class="from" ><?php echo $cash['dated'];?></div>
					<?php if($cash['note'] !=''){ ?>
					<div class="from" ><?php echo $cash['note'];?></div>
					<?php }else{ ?>
					<div class="from" >...</div>
					<?php } ?>
					<div class="from" >
						<div class="resp_btn">
						<?php if($cash['wstatus']=='pending'){ ?>
							<?php /*?><a class="orange" href="javascript:;"  onclick="cancel_withdraw('<?php echo $cash['withdrawID'];  ?>')">Cancle</a><?php */?>
							<a class="orange" href="javascript:;"  onclick="if(confirm('Are sure you want to Cancle withdraw request')){cancel_withdraw('<?php echo $cash['withdrawID'];  ?>')}else{location.reload();}" >Cancle</a>
						</div>
						<?php }elseif($cash['wstatus']=='approved'){ ?>
						<div class="resp_btn">
							<a class="orange" href="javascript:;" >Approved</a>
						</div>
						<?php }else{ ?>
						<div class="resp_btn">
							<a class="orange" href="javascript:;" >Declined</a>
						</div>
						<?php } ?>
					</div>
				</li>
				<?php } } ?>
				
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
function cancel_withdraw(id) {
	var w_id = id;
	$.ajax({
		type: 'GET', 
		url: '<?php echo ru;?>process/process_draft.php',
		data: 'wid='+w_id,
		success: function(output) { 
		if(output){ 
			var balance =output.split('_');
			$('#cur_bal').text(balance[0]);
			$('#new_bal').text(balance[1]);
			$('.overlay').show();
			$('#withdraw_success').show();
			 window.setTimeout('location.reload()', 7000)
			}
		}
	});
}
function redirect_func() {
	window.location = "<?php echo ru;?>withdraw_payment";
}
</script>