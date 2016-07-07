<?php if(isset($_SESSION['recipit_id']['New'])) {
$get_delivery = "select * from ".tbl_delivery." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and  delivery_id  = '".$_SESSION['delivery_id']['New']."'";
$dev_rs  = $db->get_row($get_delivery,ARRAY_A);
$delivery_id = $dev_rs['delivery_id'];
$occasionid = $dev_rs['delivery_id'];
$first_name = $dev_rs['recp_first_name'];
$last_name = $dev_rs['recp_last_name'];
$cash_amount = $dev_rs['cash_amount'];
$notify_date = $dev_rs['date'];
$timestamps = strtotime($dev_rs['date']);
$notify_date = date('M d, Y', $timestamps);
$notification_date = $notify_date.'&nbsp;@&nbsp;'.$dev_rs['time'];

$unlock_dates = $dev_rs['unlock_date'];
$timestamp = strtotime($dev_rs['unlock_date']);
$unblock_date = date('M d, Y', $timestamp);
$unlock_time = $unblock_date.'&nbsp;@&nbsp;'.$dev_rs['unlock_time'];


$checkout = "select * from ".tbl_checkout." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and delivery_id = '".$_SESSION['delivery_id']['New']."'";
$checkout_rs  = $db->get_row($checkout,ARRAY_A);
$total_cash = $checkout_rs['total_cash'];

$recipient = "select * from ".tbl_delivery." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and delivery_id = '".$_SESSION['recipit_id']['New']."'";
$recipient_rs  = $db->get_row($recipient,ARRAY_A);
///new code occasion
$getoccss = explode("_",$recipient_rs['occassionid']);
if($recipient_rs['occassionid'] == 'other_'.$getoccss[1]){
	$occasion_name = $getoccss[1];
}else{
$get_occasion = "select * from ".tbl_occasion." where occasionid = '".$recipient_rs['occassionid']."'";
$occs_rs  = $db->get_row($get_occasion,ARRAY_A);
$occasion_name =$occs_rs['occasion_name'];
$occasionid =$occs_rs['occasionid'];
}

} else if(isset($_SESSION['DRAFT']) && isset($_SESSION['delivery_id']['New'])) {
	$get_delivery = "select * from ".tbl_delivery." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and  delivery_id  = '".$_SESSION['delivery_id']['New']."'";
	$dev_rs  = $db->get_row($get_delivery,ARRAY_A);
	$delivery_id = $dev_rs['delivery_id'];
	$occasionid = $dev_rs['delivery_id'];
	$first_name = $dev_rs['recp_first_name'];
	$last_name = $dev_rs['recp_last_name'];
	$cash_amount = $dev_rs['cash_amount'];
	$notify_date = $dev_rs['date'];
	$timestamps = strtotime($dev_rs['date']);
	$notify_date = date('M d, Y', $timestamps);
	$notification_date = $notify_date.'&nbsp;@&nbsp;'.$dev_rs['time'];
	
	$unlock_dates = $dev_rs['unlock_date'];
	$timestamp = strtotime($dev_rs['unlock_date']);
	$unblock_date = date('M d, Y', $timestamp);
	$unlock_time = $unblock_date.'&nbsp;@&nbsp;'.$dev_rs['unlock_time'];
	
	
	$checkout = "select * from ".tbl_checkout." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and delivery_id = '".$_SESSION['delivery_id']['New']."'";
	$checkout_rs  = $db->get_row($checkout,ARRAY_A);
	$total_cash = $checkout_rs['total_cash']; 
	
	$getoccss = explode("_",$dev_rs['occassionid']);
	if($dev_rs['occassionid'] == 'other_'.$getoccss[1]){
		$occasion_name = $getoccss[1];
	}else{
		$get_occasion = "select * from ".tbl_occasion." where occasionid = '".$dev_rs['occassionid']."'";
		$occs_rs  = $db->get_row($get_occasion,ARRAY_A);
		$occasion_name =$occs_rs['occasion_name'];
		$occasionid =$occs_rs['occasionid'];
	}
	
} else if(isset($_SESSION['DRAFT'])) { 
	$delivery_id = $_SESSION['DRAFT']['delivery_id'];
	$occasionid = $_SESSION['DRAFT']['delivery_id'];
	$first_name = $_SESSION['DRAFT']['recp_first_name'];
	$last_name = $_SESSION['DRAFT']['recp_last_name'];
	$cash_amount = $_SESSION['DRAFT']['cash_amount'];
	$notify_date = $_SESSION['DRAFT']['date'];
	$timestamps = strtotime($_SESSION['DRAFT']['date']);
	$notify_date = date('M d, Y', $timestamps);
	$notification_date = $notify_date.'&nbsp;@&nbsp;'.$_SESSION['DRAFT']['time'];
	
	$unlock_dates = $_SESSION['DRAFT']['unlock_date'];
	$timestamp = strtotime($_SESSION['DRAFT']['unlock_date']);
	$unblock_date = date('M d, Y', $timestamp);
	$unlock_time = $unblock_date.'&nbsp;@&nbsp;'.$_SESSION['DRAFT']['unlock_time'];
	
	$checkout = "select * from ".tbl_checkout." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and delivery_id = '".$_SESSION['DRAFT']['delivery_id']."'";
	$checkout_rs  = $db->get_row($checkout,ARRAY_A);
	$total_cash = $checkout_rs['total_cash'];
	$getoccss = explode("_",$_SESSION['DRAFT']['occassionid']);
	if($_SESSION['DRAFT']['occassionid'] == 'other_'.$getoccss[1]){
		$occasion_name = $getoccss[1];
	}else{
		$get_occasion = "select * from ".tbl_occasion." where occasionid = '".$_SESSION['DRAFT']['occassionid']."'";
		$occs_rs  = $db->get_row($get_occasion,ARRAY_A);
		$occasion_name =$occs_rs['occasion_name'];
	}
} 

?>	
<div class="mid_contant">
		<h2 class="title">Send: iftGift Confirmation</h2>
		<div class="cont_bar">
			<h3>Thank You! Your order has been placed</h3>
			<div class="cont_bar_inner confim">
				<p class="confirm">You will receive an email confirmation shortly. <a href="javascript:;" onclick="printArea();">Print order details</a></p>
					<div id="print_area">
						<div class="regs_form regs_form_d">
						<?php if(isset($_SESSION['recipit_id']['New']) || isset($_SESSION['DRAFT'])) { ?>
						<div class="flied">
							<label>iftGift Recipient:</label>
						<input type="text" placeholder="<?php echo $first_name; ?>" value="<?php echo ucfirst($first_name.' '.$last_name); ?>" id="first_name"/>
						</div>
						<div class="flied">
							<label>Celebrant&rsquo;s Name:</label>
							<input type="text" placeholder="<?php echo $occasion_name;?>" value="<?php echo $occasion_name;?>"  id="occasion_name" />
							<input type="hidden" placeholder="<?php echo $occasionid;?>" value="<?php echo $occasionid;?>"  id="occasionid"/>
							<input type="hidden" placeholder="<?php echo $delivery_id;?>" value="<?php echo $delivery_id;?>"  id="delivery_id"/>
						</div>
						<div class="flied">
							<label>Notification email date and time:</label>
							<input type="text" placeholder="<?php echo $notify_date; ?>" value="<?php echo $notification_date;  ?>" />
						</div>
						<div class="flied">
							<label>Unlock date and time:</label>
							<input type="text" placeholder="<?php echo $unlock_date; ?>" value="<?php echo $unlock_time; ?>" />
						</div>
						<div class="flied">
							<label>Total cash gift sent:</label>
							<input type="text" placeholder="$<?php echo $cash_amount; ?>" value="$<?php echo $cash_amount; ?>"  id="cash_amount"/>
						</div>
						<div class="flied">
							<label>Total cost:</label>
							<input type="text" placeholder="$<?php echo $total_cash; ?>" value="$<?php echo $total_cash; ?>" />
						</div>
						<?php } else { ?>
						<div class="flied">
							<label>Total cost:</label>
							<input type="text" placeholder="<?php echo $_SESSION['total']['price']; ?>" value="<?php echo $_SESSION['total']['price']; ?>" />
						</div>
						<?php } ?>
					</div>
					</div>
					<img src="<?php echo ru_resource;?>images/jester_p.jpg" alt="Jester Image" class="conf_jester conf_jester_b" />
					<?php if(isset($_SESSION['recipit_id']['New']) || isset($_SESSION['DRAFT'])) { ?>
					<div class="next_btn">
						<p class="confirm next">What do you want to do next?</p>
						<a href="<?php echo ru; ?>step_1" class="blue">Send an iftGift</a>
			 <?php /*?><a href="<?php echo ru; ?>step_1" class="blue green green_b" id="copygift">Copy this iftGift<span>(For a New Recipient)</span></a><?php */?>
						<a href="javascript:;" class="blue green green_b" onclick="copygift()">Copy this iftGift<span>(For a New Recipient)</span></a>
						<a href="<?php echo ru; ?>dashboard" class="orange">Dashboard</a>
						<a href="<?php echo ru; ?>questionsadd" class="pink">Answer Questions</a>
					</div>
					<?php } else {?> 
					<div class="next_btn next_btn_b">
						<p class="confirm next">What do you want to do next?</p>
						<a href="javascript:;" class="blue green">Send a Thank You</a>
						<a href="<?php echo ru; ?>step_1" class="blue">Send an iftGift</a>
						<a href="<?php echo ru; ?>dashboard" class="orange">Dashboard</a>
						<a href="<?php echo ru; ?>questionsadd" class="pink">Answer Questions</a>
					</div>
					<?php }?>
			</div>
		</div>
	</div>
<script type="text/javascript" src="<?php echo ru_resource; ?>js/printarea.js"></script>
<script language="javascript" type="text/javascript" >	
function printArea(){
	jQuery("#print_area").printArea();
}

function copygift(){
	  var occasion_name = encodeURIComponent(document.getElementById('occasion_name').value);
	  var occasionid = document.getElementById('occasionid').value;
	  var delivery_id = document.getElementById('delivery_id').value;
	 
	   var myData ="&del_id="+delivery_id+"&occasion="+occasion_name+"&occas="+occasionid;
		$.ajax({
			url: '<?php echo ru;?>process/process_draft.php',
			type: "POST",
			data:myData,
			success:function(output) {
				if(output){
					window.location='<?php echo ru ;?>step_1';
				}	
			}
		});
}
</script>
<?php 
unset($_SESSION['delivery_id']['New']);
unset($_SESSION['recipit_id']['New']);
unset($_SESSION['cart']);  
unset($_SESSION['total']['price']);
unset($_SESSION['DRAFT']);
?>