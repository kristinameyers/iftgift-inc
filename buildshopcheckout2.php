<?php
$cash_amount = $_SESSION['total']['price'];

$get_sender = "select available_cash,first_name,last_name,email from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'";
$sender_info = $db->get_row($get_sender,ARRAY_A);
$available_cash = $sender_info['available_cash'];

$additional_fund = $cash_amount - $available_cash;
?>	
<div class="mid_contant">
		<ul class="steps">
			<li class="step_a"><a href="#"><span>1.</span> Enter cash gift and recipient info</a><span class="arrow"></span></li>
			<li class="step_b"><span class="arrow arrow_left"></span><a href="#"><span>2.</span> Select your gift suggestions</a><span class="arrow"></span></li>
			<li class="step_c step_d active"><span class="arrow arrow_left"></span><a href="#"><span>3.</span> Delivery details & Checkout</a></li>
		</ul>
		<div class="cont_bar">
			<div class="cont_bar_inner cont_bar_inner_b">
				<a href="javascript:;" onclick="cancel_iftgift('')" class="cancel_btn">CANCEL IFTGIFT</a>
				<form id="payment-form" class="form-horizontal" method="post" action="<?php echo ru;?>process/process_shopcart.php">
				<input name="userId" id="userId" value="<?php echo $_SESSION['LOGINDATA']['USERID'];?>" type="hidden">
				<input name="email" id="email" value="<?php echo $sender_info['email'];?>" type="hidden">
				<input name="cash_gift" id="cash_gift" value="<?php echo $cash_amount;?>" type="hidden">
				<input name="total_cal_cash" id="total_cal_cash" value="<?php echo number_format($cash_amount,'2');?>" type="hidden">
				<input name="shipfname" id="shipfname" value="<?php echo $_SESSION['shipping']['fname'];?>" type="hidden">
				<input name="shiplname" id="shiplname" value="<?php echo $_SESSION['shipping']['lname'];?>" type="hidden">
				<input name="shipaddress" id="shipaddress" value="<?php echo $_SESSION['shipping']['address'];?>" type="hidden">
				<input name="shipcity" id="shipcity" value="<?php echo $_SESSION['shipping']['city']?>" type="hidden">
				<input name="shipstate" id="shipstate" value="<?php echo $_SESSION['shipping']['state']?>" type="hidden">
				<input name="shipzip" id="shipzip" value="<?php echo $_SESSION['shipping']['zip']?>" type="hidden">
				<input name="Shopcheckout2" id="Shopcheckout2" value="1" type="hidden">
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
											<input type="radio" value="None" id="nineteen" name="checkout_method" />
											<label for="nineteen" class="back_account"></label>
										</div>
										<label class="title">Bank Account</label>
									</div>
									<div class="time_flied" id="back_account_flied" style="display:none">
										<?php /*?><div class="flied">
											<input type="text" placeholder="Routing Number" />
											<input type="text" placeholder="Account Number" />
										</div><?php */?>
										<span style="color:#FF0000; font-weight:bold; margin:0 0 0 15px;">Coming Soon</span>
									</div>
									<div class="terms">
										<div class="squaredFour left">
											<input type="radio" value="credit_card" id="twenty" name="checkout_method" />
											<label for="twenty" class="credit_card"></label>
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
									<input type="text" name="address2" id="address2" class="value_flied" value="<?php echo $_SESSION['biz_gift2']['address2']; ?>" placeholder="Address 2">
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
function cancel_iftgift()
{
	$.ajax({
		url: '<?php echo ru;?>process/process_shopcart.php?pId=cart',
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
  		var isChecked = jQuery("input[name=checkout_method]:checked").val();
		if(!isChecked) {
			$('.overlay').show();
            $('#modal_payment').toggle("slow");
		} 
  });
});

</script>	
<style>
.help-block{ float:left; margin:5px 0 0 10px; color:#a94442; position:relative}
/*.form-group{ width:460px; float:left}
.field_group{ float:left}*/
</style>	
<?php
unset($_SESSION['biz_gift_err']);
unset($_SESSION['biz_gift']);
?>