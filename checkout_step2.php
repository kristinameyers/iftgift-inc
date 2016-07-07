<?php
if(!isset($_SESSION['recipit_id']['New'])) {
	header('location:'.ru.'dashboard'); exit;
}
$get_devdetail = "select cash_amount from ".tbl_delivery." where delivery_id = '".$_SESSION['delivery_id']['New']."'";
$dev_detail = $db->get_row($get_devdetail,ARRAY_A);
$calculate_tax = $dev_detail['cash_amount'] /100 * 4.00;
$cash_amount = $dev_detail['cash_amount'] + $calculate_tax;

$get_sender = "select available_cash,first_name,last_name,email from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'";
$sender_info = $db->get_row($get_sender,ARRAY_A);
$available_cash = $sender_info['available_cash'];

$additional_fund = $cash_amount - $available_cash;
?>	
<div class="mid_contant">
		<ul class="steps">
			<li class="step_a"><a href="#"><span>1.</span> Enter cash gift and recipient info</a><span class="arrow"></span></li>
			<li class="step_b"><span class="arrow arrow_left"></span><a href="#"><span>2.</span> Select your gift suggestions</a><span class="arrow"></span></li>
			<li class="step_a step_c"><span class="arrow arrow_left"></span><a href="#"><span>3.</span> Delivery details</a><span class="arrow"></span></li>
			<li class="step_c step_d active"><span class="arrow arrow_left"></span><a href="#"><span>4.</span> Checkout</a></li>
		</ul>
		<div class="cont_bar">
			<div class="cont_bar_inner cont_bar_inner_b">
				<a href="javascript:;" onclick="cancel_iftgift('<?php echo $_SESSION['delivery_id']['New']; ?>')" class="cancel_btn">CANCEL IFTGIFT</a>
				<form id="payment-form" class="form-horizontal" method="post" action="<?php echo ru;?>process/process_delivery.php">
				<input name="userId" id="userId" value="<?php echo $_SESSION['LOGINDATA']['USERID'];?>" type="hidden">
				<input name="email" id="email" value="<?php echo $sender_info['email'];?>" type="hidden">
				<input name="cash_gift" id="cash_gift" value="<?php echo $dev_detail['cash_amount'];?>" type="hidden">
				<input name="total_cal_cash" id="total_cal_cash" value="<?php echo number_format($cash_amount,'2');?>" type="hidden">
				<input name="calculate_tax" id="calculate_tax" value="<?php echo number_format($calculate_tax,'2');?>" type="hidden">
				<input name="delivery_id" id="delivery_id" value="<?php echo $_SESSION['delivery_id']['New'];?>" type="hidden">
				<input name="SendGift2" id="SendGift2" value="1" type="hidden">
					<div class="box">
						<div class="num_outer">
							<div class="one">1</div>
						</div>
						<h4>Additional Funds Needed to Complete Purchase</h4>
						<div class="flied cash_gft">
							<input type="text" name="total_cash" id="total_cash" placeholder="<?php echo $additional_fund;?>" value="$<?php echo number_format($additional_fund,'2');?>" />
						</div>
					</div>
					<div class="box blue">
						<div class="num_outer">
							<div class="one">2</div>
						</div>
						<h4>Transfer Funds From</h4>
						<?php $payment_setting = mysql_fetch_array(mysql_query("select * from ".tbl_payment_setting.""));
						if($payment_setting['payment_option'] == '1') { ?>
						<div class="form_bar">
							<div class="flied_outer flied_outer_b">
								<div class="sugget_left">
									<div class="terms">
										<div class="squaredFour left">
											<input type="radio" value="bank_account" id="checkout_bank_account" class="checkout_method" name="checkout_method" />
											<label for="checkout_bank_account" class="back_account"></label>
										</div>
										<label class="title">Bank Account</label>
									</div>
									<div class="time_flied" id="back_account_flied" style="display:none">
										<div class="flied">
											<input type="text" id="routing_number" name="routing_number" autocomplete="off" maxlength="9" placeholder="Routing Number" />
											<input type="text" id="account_number" name="account_number" autocomplete="off" maxlength="10" placeholder="Account Number" />
										</div>
										<span id="rout_number" style="color:#a94442;display:none; margin-left:15px; font-size:15px">Enter rounting number.</span>
										<span id="acct_number" style="color:#a94442;display:none; margin-right:310px; float:right; font-size:15px">Enter rounting number.</span>
										<?php /*?><span style="color:#FF0000; font-weight:bold; margin:0 0 0 15px;">Coming Soon</span><?php */?>
									</div>
									<div class="terms">
										<div class="squaredFour left">
											<input type="radio" value="credit_card" id="checkout_credit_card" class="checkout_method" name="checkout_method" />
											<label for="checkout_credit_card" class="credit_card"></label>
										</div>
										<label class="title">Credit Card</label>
										<div class="card_icon">
											<img src="<?php echo ru_resource; ?>images/card_a.jpg" alt="Card Image A" />
											<img src="<?php echo ru_resource; ?>images/card_b.jpg" alt="Card Image B" />
											<img src="<?php echo ru_resource; ?>images/card_c.jpg" alt="Card Image C" />
											<img src="<?php echo ru_resource; ?>images/card_d.jpg" alt="Card Image D" />
										</div>
									</div>
									<div class="time_flied" id="credit_card_flied" style="display:none">
										<div class="flied">
											<div class="field_group">
												<div class="form-group">
													<input type="text" id="cardnumber" name="cardnumber" autocomplete="off" placeholder="Card Number" class="card-number form-control" />
												</div>
												<div class="form-group">
													<input type="text" id="cvv" name="cvv" autocomplete="off" placeholder="3 Digit PIN" maxlength="3" class="card-cvc form-control" />
												</div>
											</div>
											<div class="field_group">
												<div class="form-group">
													<input type="text" id="month" maxlength="2" autocomplete="off" data-stripe="exp-month" placeholder="Month" class="card-expiry-month stripe-sensitive required form-control" />
												</div>
												<div class="form-group">
													<input type="text" name="year" id="year" autocomplete="off" data-stripe="exp-year" placeholder="Year" class="card-expiry-year stripe-sensitive required form-control" />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } else { ?>
							<span style="color:#FF0000; font-weight:bold; margin:0 0 0 35px; float:left">Bank & Credit Card Method Coming Soon</span>
						<?php } ?>
					</div>
					<div class="box blue orang">
						<div class="num_outer">
							<div class="one">3</div>
						</div>
						<h4>Your Billing Address</h4>
						<div class="form_bar form_bar_b">
							<div class="flied_outer cash_traf">
								<div class="flied cash_gft">
									<label>First Name: <span>*</span></label>
									<div class="form-group">
										<input type="text" name="fname" id="fname" maxlength="65" value="<?php echo $_SESSION['biz_gift2']['fname']; ?>" placeholder="First Name" class="fname form-control" />
									</div>
								</div>
								<div class="flied cash_gft">
									<label>Last Name: <span>*</span></label>
									<div class="form-group">
										<input type="text" name="lname" id="lname" maxlength="65" value="<?php echo $_SESSION['biz_gift2']['lname']; ?>" placeholder="Last Name" class="lname form-control" />
									</div>
								</div>
								<div class="flied cash_gft">
									<label>Address 1: <span>*</span></label>
									<div class="form-group">
										<input type="text" name="address1" id="address1" placeholder="Address 1" value="<?php echo $_SESSION['biz_gift2']['address1']; ?>" class="address form-control" />
									</div>
								</div>
								<div class="flied cash_gft">
									<label>Address 2:</label>
									<div class="form_group_b">
										<input type="text" name="address2" id="address2" class="value_flied adrs_fld" value="<?php echo $_SESSION['biz_gift2']['address2']; ?>" placeholder="Address 2">
									</div>
								</div>
								<div class="flied cash_gft">
									<label>City: <span>*</span></label>
									<div class="form-group">
										<input type="text" name="city" id="city" placeholder="City" value="<?php echo $_SESSION['biz_gift2']['city']; ?>" class="city form-control" />
									</div>	
								</div>
								<div class="flied cash_gft">
									<label>State: <span>*</span></label>
									<div class="form-group">
										<div class="select">
											<select name="state" id="state" class="state form-control custom-select">
												<option>Select State</option>
												<?php foreach($StateAbArray as $key => $val) { ?>
												<option value="<?php echo $key;?>" <?php if($_SESSION['biz_gift2']['state'] == $key) echo 'selected="selected"'; ?>><?php echo $val;?></option>
												<?php } ?>	
											</select>
										</div>
									</div>
								</div>
								<div class="flied cash_gft">
									<label>Zip Code: <span>*</span></label>
									<div class="form-group">	
										<input type="text" name="zip" id="zip" value="<?php echo $_SESSION['biz_gift2']['zip']; ?>" placeholder="Postal Code" class="zip form-control" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box_btm"></div>
					<button class="orange cmp" id="credit" type="submit">COMPLETE ORDER</button>
				</form>
				<img src="<?php echo ru_resource; ?>images/jester_o.jpg" alt="Jester Image" class="sleep_jester check_jester" />
			</div>
		</div>
		<div class="overlay" style="display:none"></div>
		<div class="modal" id="modal_payment" style="display:none">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg">Please Select Transfer Fund Method!</div>
		</div>
	</div>
<script type="text/javascript">
/************************Function For Edit Cancel IftGift*********************************/
function cancel_iftgift(dId)
{
	var delivery = dId;
	$.ajax({
		url: '<?php echo ru;?>process/process_delivery.php?devId='+delivery,
		type: 'get', 
		success: function(output) {
			if(output == 'Success') {
				window.location = "<?php echo ru?>dashboard";
			}
		}
	});
}	

$(document).ready(function(){
 
  $(".back_account").click(function(){
		$("#back_account_flied").show('slow');
		$("#credit_card_flied").hide('slow');
  });
  
  $(".credit_card").click(function(){
	$("#credit_card_flied").show('slow');
	$("#back_account_flied").hide('slow');
  });
  
  $("#credit").click(function () {
  		var isChecked = $('.checkout_method').is(':checked');
		if(!isChecked) {
			$('.overlay').show();
            $('#modal_payment').toggle("slow");
		} else {
			var isval = $('.checkout_method:checked').val();
			if(isval == 'bank_account') {
				var routing_number = $('input[name=routing_number]');
				var account_number = $('input[name=account_number]');
				if (routing_number.val()=='') {
					$('#rout_number').show();
				}
				if (account_number.val()=='') {
					$('#acct_number').show();
				}
				document.getElementById("payment-form").submit();
			} //else if(isval == 'credit_card') {
				//document.getElementById("payment-form").submit();
			//}
		}
  });
});

</script>
<script type="text/javascript" src="http://digitalbush.com/wp-content/uploads/2013/01/jquery.maskedinput-1.3.1.min_.js"></script>											
<script>
jQuery(function($) {
  $("#routing_number").mask("999-999-999");
  $("#account_number").mask("99-9999-9999");
});
</script>		
<style>
.help-block{ float:left; margin:5px 0 0 10px; color:#a94442; position:relative}
</style>	
<?php
unset($_SESSION['biz_gift_err']);
unset($_SESSION['biz_gift']);
?>