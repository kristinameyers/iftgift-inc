<?php
if(!isset($_SESSION['delivery_id']['New']) && !isset($_SESSION['DRAFT'])) {
	header('location:'.ru.'dashboard'); exit;
}

if(isset($_SESSION['delivery_id']['New'])) { 
	$get_devdetail = "select cash_amount from ".tbl_delivery." where delivery_id = '".$_SESSION['delivery_id']['New']."'";
	$dev_detail = $db->get_row($get_devdetail,ARRAY_A);
	$giftid = $_SESSION['delivery_id']['New'];
	$cash = $dev_detail['cash_amount'];
	$calculate_tax = $dev_detail['cash_amount'] /100 * 4.00;
	$add_fee = $dev_detail['cash_amount'] + $calculate_tax;
} else if(isset($_SESSION['DRAFT'])) {
	$get_devdetail = "select cash_amount from ".tbl_delivery." where delivery_id = '".$_SESSION['DRAFT']['delivery_id']."'";
	$dev_detail = $db->get_row($get_devdetail,ARRAY_A);
	$giftid = $_SESSION['DRAFT']['delivery_id'];
	$cash = $dev_detail['cash_amount'];
	$calculate_tax = $dev_detail['cash_amount'] /100 * 4.00;
	$add_fee = $dev_detail['cash_amount'] + $calculate_tax;
}
$get_sender = "select first_name,last_name,email from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'";
$sender_info = $db->get_row($get_sender,ARRAY_A);
?>	
<?php $payment_setting = mysql_fetch_array(mysql_query("select * from ".tbl_payment_setting.""));?>	
<div class="mid_contant">
		<ul class="steps">
			<li class="step_a"><a href="<?php echo ru; ?>step_1"><span>1.</span> Enter cash gift and recipient info</a><span class="arrow"></span></li>
			<li class="step_b"><span class="arrow arrow_left"></span><a href="<?php echo ru; ?>step_2a"><span>2.</span> Select your gift suggestions</a><span class="arrow"></span></li>
			<li class="step_a step_c"><span class="arrow arrow_left"></span><a href="<?php echo ru; ?>delivery_detail"><span>3.</span> Delivery details</a><span class="arrow"></span></li>
			<li class="step_c step_d active"><span class="arrow arrow_left"></span><a href="<?php echo ru; ?>checkout"><span>4.</span> Checkout</a></li>
		</ul>
		<div class="cont_bar">
			<div class="cont_bar_inner cont_bar_inner_b">
				<a href="javascript:;" onclick="cancel_iftgift('<?php echo $giftid; ?>')" class="cancel_btn">CANCEL IFTGIFT</a>
				<?php if(isset($_SESSION['delivery_id']['New'])) {?>
				<form id="payment-form" class="form-horizontal" method="post" action="<?php echo ru;?>process/process_delivery.php">
				<input name="SendGift" id="SendGift" value="1" type="hidden">
				<?php } else if(isset($_SESSION['DRAFT'])){?>	
				<form id="payment-form" class="form-horizontal" method="post" action="<?php echo ru;?>process/process_delivery.php">
				<input name="SendGift" id="SendGift" value="1" type="hidden">
				<?php } ?>	
				<input name="userId" id="userId" value="<?php echo $_SESSION['LOGINDATA']['USERID'];?>" type="hidden">
				<input name="email" id="email" value="<?php echo $sender_info['email'];?>" type="hidden">
				<input name="delivery_id" id="delivery_id" value="<?php echo $giftid;?>" type="hidden">
				
					<div class="box">
						<div class="num_outer">
							<div class="one">1</div>
						</div>
						<h4>Total Purchase</h4>
						<div class="form_bar" onclick="edit_amount('<?php echo $giftid; ?>');">
								
							<div class="flied_outer cash_traf" id="default_cash">
								<div class="flied cash_gft">
									<label>Cash Gift:</label>
									<input type="text" placeholder="$150.00" name="cash_gift" class="value_flied" id="cash_amount" value="$<?php echo $cash;?>" />
									<input type="button" onclick="edit_amount('<?php echo $giftid ?>')" value="Edit Amount" />
								</div><!--text field hide-->
								<?php /*?><div class="flied cash_gft">
									<label>Cash Transfer Fee <span>(4%)</span>:</label>
									<input type="text" name="calculate_tax" id="calculate_tax" placeholder="$<?php echo number_format($calculate_tax,'2');?>" value="$<?php echo number_format($calculate_tax,'2');?>" class="value_flied" />
								</div><?php */?>
								<div class="flied cash_gft">
									<label>Total:</label>
									<!--old price with tax-->
									<?php /*?><input type="text" name="total_cash" id="total_cash" placeholder="$<?php echo number_format($add_fee,'2');?>" value="$<?php echo number_format($add_fee,'2');?>" class="value_flied" /><?php */?>
									<input type="text" name="total_cash" id="total_cash" placeholder="$<?php echo number_format($cash,'2');?>" value="$<?php echo number_format($cash,'2');?>" class="value_flied" />
								</div>
							</div>																		
						</div>
					</div>
					<div class="box blue">
						<div class="num_outer">
							<div class="one">2</div>
						</div>
						<h4>Transfer Funds From</h4>
						<?php
						$get_blance = "select available_cash from ".tbl_user." where userid = '".$_SESSION['LOGINDATA']['USERID']."'";
						$view_blance = $db->get_row($get_blance,ARRAY_A);?>
						<div class="form_bar">
							<div class="flied_outer flied_outer_b">
								<div class="sugget_left">
									<?php /*?><div class="terms">
										<div class="terms_inner_b">
											<div class="squaredFour left">
												<input type="radio" value="cash_stash" id="fifteen" class="cash_price" name="checkout_method" />
												<label for="fifteen"></label>
											</div>
											<label class="title"><span class="i">Cash</span><span class="f">^</span><span class="t">Stash</span>: <span class="cash_price">$<?php echo $view_blance['available_cash'];?></span> Balance</label>
										</div>
									</div>
									<div class="terms">
										<div class="terms_inner_b">
											<div class="squaredFour left">
												<input type="radio" value="bank_account" id="nineteen" name="checkout_method" />
												<label for="nineteen" class="back_account"></label>
											</div>
											<label class="title">Bank Account</label>
										</div>
									</div>
									<div class="time_flied" id="back_account_flied" style="display:none">
										<div class="flied">
											<?php if($payment_setting['payment_option'] == '1') { ?>
												<input type="text" placeholder="Routing Number" />
												<input type="text" placeholder="Account Number" />
											<?php } else { ?>	
												<span class="coming_msg coming_msg_b">Coming Soon</span>
											<?php } ?>	
										</div>
									</div><?php */?>
									
									<?php /*?><?php
									if($payment_setting['payment_option'] == '1') {
									$get_card = $db->get_results("select card_number,memberID from ".tbl_member_card." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A); 
									if($get_card) {
									foreach($get_card as $card) {
									$card_num = decrypt($card['card_number']);
									$last_four_digits = substr("$card_num", -4);
									$masked = "xxxx-xxxx-xxxx-".$last_four_digits;
									?>
									
                                    <div class="terms">
										<div class="terms_inner_b">
											<div class="squaredFour left">
												<input type="radio" value="<?php echo $card['memberID']; ?>" id="<?php echo $card['memberID']; ?>" class="ext_credit_cards" name="checkout_method" />
												<label for="<?php echo $card['memberID']; ?>" class="credit_card"></label>
											</div>
											<label class="title">Use Credit Card <?php  echo $masked; ?></label>
										</div>
									</div>
                                    
									<?php } } }?><?php */?>
									
									<div class="terms">
										<div class="terms_inner_b">
											<div class="squaredFour left">
												<?php /*?><input type="radio" value="credit_card" <?php if($_SESSION['biz_gift']['checkout_method'] == 'credit_card') echo 'checked="checked"'; ?> id="twenty" class="credit_cards" name="checkout_method" /><?php */?>
										<input type="radio" value="credit_card"  checked="checked" id="twenty" class="credit_cards" name="checkout_method" />
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
									</div>
									<?php
										if($_SESSION['stripe_error']){
									?>
									<strong><span style="color:#FF0000;margin-left: 35px;"><?php echo $_SESSION['stripe_error']; ?></span></strong>
									<?php } ?>
									<?php if($payment_setting['payment_option'] == '1') { ?>
									<div class="time_flied" id="credit_card_flied">
											<div class="flied">
											<div class="field_group">
												<div class="form-group">
													<div id="test">
														<input type="text" id="cardnumber" name="cardnumber" autocomplete="off" placeholder="Card Number" class="card-number form-control" />
													</div>
													<div id="test1" <?php if($_SESSION['stripe_error']){?>style="display:none"<?php } ?>>
														<input type="hidden" id="cardnumbers" maxlength="19" autocomplete="off" placeholder="Card Numbersssssss">
													</div>
												</div>
												<div class="form-group">
													<input type="text" id="cvv" name="cvv" autocomplete="off" placeholder="3 Digit PIN" maxlength="3" class="card-cvc form-control" />
												</div>
											</div>
											<div class="field_group">
												<div class="form-group">
													<input type="text" id="month" name="month" maxlength="2" autocomplete="off" data-stripe="exp-month" placeholder="Month" class="card-expiry-month stripe-sensitive required form-control" />
												</div>
												<div class="form-group">
													<input type="text" name="year" id="year" autocomplete="off" data-stripe="exp-year" placeholder="Year" class="card-expiry-year stripe-sensitive required form-control" />
												</div>
											</div>
											<h4>Your Billing Address</h4>
											<div class="field_group">
												<div class="form-group">
													<input type="text" name="fname" id="fname" maxlength="65" value="<?php echo $_SESSION['biz_gift']['fname']; ?>" placeholder="First Name" class="fname form-control" />
												</div>
												<div class="form-group">
													<input type="text" name="lname" id="lname" maxlength="65" value="<?php echo $_SESSION['biz_gift']['lname']; ?>" placeholder="Last Name" class="lname form-control" />
												</div>
											</div>
											<div class="field_group">
												<div class="form-group">
													<input type="text" name="address1" id="address1" placeholder="Address 1" value="<?php echo $_SESSION['biz_gift']['address1']; ?>" class="address form-control" />
												</div>
												<div class="form-group">
													<input type="text" name="address2" id="address2" placeholder="Address 2" value="<?php echo $_SESSION['biz_gift']['address2']; ?>" class="address2 form-control" />
												</div>
											</div>
											<div class="form-group">
												<input type="text" name="city" id="city" placeholder="City" value="<?php echo $_SESSION['biz_gift']['city']; ?>" class="city form-control" />
											</div>	
											<h4>State</h4>
											<div class="field_group">
												<div class="form-group">
													<div class="select">
														<select name="state" id="state" class="state form-control custom-select">
															<option>Select State</option>
															<?php foreach($StateAbArray as $key => $val) { ?>
															<option value="<?php echo $key;?>" <?php if($_SESSION['biz_gift']['state'] == $key) echo 'selected="selected"'; ?>><?php echo $val;?></option>
														<?php } ?>	
														</select>
													</div>
												</div>	
												<div class="form-group">	
													<input type="text" name="zip" id="zip" value="<?php echo $_SESSION['biz_gift']['zip']; ?>" placeholder="Postal Code" class="zip form-control" />
												</div>
											</div>
										</div>
									</div>
									<?php } else { ?>	
										<span id="credit_card_flied" style="display:none" class="coming_msg">Coming Soon</span>
									<?php } ?>	
								</div>
							</div>
						</div>
					</div>
					<div class="box_btm"></div>
					<div class="deliv_btn">
					
					<button class="orange" id="credit" type="submit" style="display:none; width:369px">COMPLETE ORDER</button>
					<?php if(isset($_SESSION['delivery_id']['New'])) {?>
						<input type="submit" id="checkout" value="COMPLETE ORDER" class="orange" />
						<input type="submit" name="SaveGift" id="seve_res" value="Save & Resume Later" class="orange save_resume" />
					<?php } else if(isset($_SESSION['DRAFT'])) { ?>
						<input type="submit" name="SendGift" id="checkout" value="COMPLETE ORDER" class="orange" />
						<input type="submit" name="SaveGift" id="seve_res" value="Save & Resume Later" class="orange save_resume" />
					<?php } ?>	
					</div>
					<?php /*?><input type="submit" id="credit" style="display:none" value="COMPLETE ORDER123" class="orange" /><?php */?>
				</form>
				<img src="<?php echo ru_resource; ?>images/jester_n.jpg" alt="Jester Image" class="sleep_jester sleep_jester_b" />
			</div>
		</div>
		
		<?php if($_SESSION['biz_gift_err']['checkout_method']) { ?>
			<div class="overlay"></div>
			<div class="modal" id="modal_payment">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg"><?php echo $_SESSION['biz_gift_err']['checkout_method'];?></div>
		</div>
		<?php } else { ?>
		<div class="overlay" style="display:none"></div>
		<div class="modal" id="modal_payment" style="display:none">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg">Please Select Transfer Fund Method!
			</div>
		</div>
		<?php } ?>
	</div>
<script type="text/javascript">
/************************Function For Edit Cash Amount*********************************/
function edit_amount(dId) {
	var devId = dId;
	var cash = $("#cash_amount").val();
	myData = "did="+devId+"&cash="+cash+"&edit_cash=1";
	$.ajax({
		url:"<?php echo ru; ?>process/process_delivery.php",
		type:"POST",
		data:myData,
		success:function(response) {
				var array = response.split("=");
				cash_amount = array[0];
				calculate_tax = array[1];
				total_cash = array[2];
				document.getElementById('cash_amount').value=cash_amount;
				document.getElementById('calculate_tax').value=calculate_tax;
				document.getElementById('total_cash').value=total_cash;
				$('#cash_amount').css('border','solid 1px red');
		}
	});
}

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
  $(".cash_price").click(function(){
  	$("#credit").hide();
	$("#checkout").show();
	$("#back_account_flied").hide('slow');
	$("#credit_card_flied").hide('slow');
  });
  
  $(".back_account").click(function(){
	$("#back_account_flied").show('slow');
	$("#credit_card_flied").hide('slow');
  });
  
  /*$(".credit_card").click(function(){
	$("#credit_card_flied").show('slow');
	$("#back_account_flied").hide('slow');
  });*/
  
  $("#checkout").click(function () {
  		var isChecked = jQuery("input[name=checkout_method]:checked").val();
		if(!isChecked) {
			$('.overlay').show();
            $('#modal_payment').toggle("slow");
		} else {
			document.getElementById("payment-form").submit();
		}
  });
  
  $("#seve_res").click(function () {
  		$("#SendGift").attr("name","SaveGift");
  		document.getElementById("payment-form").submit();
  });
});

</script>
<?php if($payment_setting['payment_option'] == '1') { ?>
<script>
$(function () {
  $(".credit_cards,.ext_credit_cards").click(function () {
  	var isChecked = this.value;
	if(isChecked == 'credit_card')
	{
		document.getElementById('cardnumber').value='';
		document.getElementById('cvv').value='';
		document.getElementById('month').value='';
		document.getElementById('year').value='';
		document.getElementById('fname').value='';
		document.getElementById('lname').value='';
		document.getElementById('address1').value='';
		document.getElementById('address2').value='';
		document.getElementById('state').value='';
		document.getElementById('city').value='';
		document.getElementById('zip').value='';
		$("#credit_card_flied").show('slow');
		$("#back_account_flied").hide('slow');
		$('#test').show();
		$('#test1').hide();
  		$("#credit").show();
		$("#checkout").hide();
	} else {
			
				$.ajax({
					url : "<?php echo ru;?>process/get_checkoutcreditcard.php?card_id="+isChecked,
					type: "GET",
					dataType:'html',
					success:function(response)
					{
						var array = response.split("=");
							masked=array[0];
							last_four_digits = masked.substr(12,4);
							card_number = "xxxx-xxxx-xxxx-"+last_four_digits;
							pin=array[1];
							exp_month=array[2];
							exp_year=array[3];
							card_type=array[4];
							first_name=array[5];
							last_name=array[6];
							address1=array[7];
							address2=array[8];
							state=array[9];
							city=array[10];
							zip=array[11];
						//alert(card_number);
						document.getElementById('cardnumber').value=masked;
						document.getElementById('cardnumbers').value=card_number;
						document.getElementById('cvv').value=pin;
						document.getElementById('month').value=exp_month;
						document.getElementById('year').value=exp_year;
						document.getElementById('fname').value=first_name;
						document.getElementById('lname').value=last_name;
						document.getElementById('address1').value=address1;
						document.getElementById('address2').value=address2;
						document.getElementById('state').value=state;
						document.getElementById('city').value=city;
						document.getElementById('zip').value=zip;
						$('#test').hide();
						$('#test1').show();
						$('#credit_card_flied').show();
						$('#credit').css('display','block');
						$('#back_account_flied').hide(); 
						$('#checkout').hide();
					}
				});
			
	}
  });
});
</script>	
<?php } else { ?>
<script>
$(function () {
	$(".credit_cards,.ext_credit_cards").click(function () {
		$("#credit_card_flied").show('slow');
		$("#back_account_flied").hide('slow');
	});
});
</script>
<?php } ?>
<style>
.help-block{ float:left; margin:5px 0 0 10px; color:#a94442; position:relative}
</style>
<?php
unset($_SESSION['biz_gift_err']);
unset($_SESSION['biz_gift']);
unset($_SESSION['stripe_error']);
?>