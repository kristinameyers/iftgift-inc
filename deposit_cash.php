<?php
 $get_cuser = $db->get_row("select available_cash,email from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
 $available_cash = $get_cuser['available_cash'];
?>
<div class="mid_contant">
	<h2 class="title">Cash Stash<sup>SM:</sup> Transfer Funds</h2>
	<div class="cont_bar" onClick="copy_amount();">
		<div class="cont_bar_inner cont_bar_inner_d cash_stach">
			<?php if(isset($_SESSION['biz_deposit_err']['depositcashstash'])) { ?>
				<script type="text/javascript">
			$(function () {
				$('.overlay').show();
				$('#deposit_success').toggle( "slow" );
			});
			
			function redirect_func() {
				window.location = "<?php echo ru;?>deposit_cash";
			}
			</script>
		<div class="overlay" style="display:none"></div>
		<div class="modal" id="deposit_success" style="display:none">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg">$<?php echo number_format($_SESSION['deposit']['amount'],'2'); ?> will be deposited<br />into your cash stash.<br />You have $<?php echo $available_cash; ?> in your cash stash.
			<button class="orange" onClick="redirect_func()" type="submit">Continue</button>
			</div>
		</div>
			<?php } ?>
			<img src="<?php echo ru_resource;?>images/jester_ab.jpg" alt="Jester Image" />
			<div class="regs_form">
				<div class="sugget_left">
					<div class="cash_blnce">
						<span>Cash Stash <br/>Balance</span>
						<div class="cash_amount"><span>$<?php echo $available_cash;?></span></div>
					</div>
				</div>
				<div class="sugget_left">
					<div class="terms">
						<div class="terms_inner_b">
							<div class="squaredFour left">
								<input type="radio" name="cash_stash" id="wcash_stash" value="withdraw">
								<label class="draw_fund" for="wcash_stash"></label>
							</div>
							<label class="title">Withdraw Funds <span>FROM</span> Cash Stash...</label>
						</div>
					</div>
				</div>
				<div class="sugget_left">
					<div class="terms">
						<div class="terms_inner_b">
							<div class="squaredFour left">
								<input type="radio" name="cash_stash" id="dcash_stash" value="deposit" checked="checked" />
								<label class="doposit_fund" for="dcash_stash"></label>
							</div>
							<label class="title">Deposit Funds <span class="into">INTO</span> Cash Stash</label>
						</div>
					</div>
					<form id="payment-form" class="form-horizontal" method="post" action="<?php echo ru;?>process/process_depositcash.php">
						<input name="userId" id="userId" value="<?php echo $_SESSION['LOGINDATA']['USERID'];?>" type="hidden">
						<input name="email" id="email" value="<?php echo $get_cuser['email'];?>" type="hidden">
						<input name="calculate_tax" id="calculate_tax" value="" type="hidden">
						<input name="DepositCash" id="DepositCash" value="1" type="hidden">
						<div class="time_flied with_draw" id="doposit_fund">
							<div class="form-group">
								<div class="flied">
									<label>Enter Amount</label>
									<input type="text" name="amount" id="amount" placeholder="Amount" onClick="event.stopPropagation()" class="value" />
									<label class="usd">USD</label>
								</div>
							</div>
							<?php $payment_setting = mysql_fetch_array(mysql_query("select * from ".tbl_payment_setting.""));
								  if($payment_setting['payment_option'] == '1') { ?>	
							<div class="form-group">
								<?php /*?><div class="terms terms_c">
									<span>...AND take from bank account</span>
									<div class="squaredFour left">
										<input type="radio" name="checkout_method" id="checkout_bank_account" value="bank_account">
										<label class="deps_account" for="checkout_bank_account"></label>
									</div>	
									<label class="title">Bank Account</label>
								</div>
								<div class="time_flied" id="deps_bank_account" style="display:none">
									<div class="flied flied_e">
										<span style="color:#FF0000;;margin: 0 0 0 30px; font-weight:bold">Coming Soon</span>
										
									</div>
								</div><?php */?>
								<div class="terms terms_c">
									<span>...AND take from credit card</span>
									<?php /*?><?php
										$get_card = $db->get_results("select card_number,memberID from ".tbl_member_card." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
										if($get_card) {
										foreach($get_card as $card) {
										$card_num = decrypt($card['card_number']);
										$last_four_digits = substr("$card_num", -4);
										$masked = "xxxx-xxxx-xxxx-".$last_four_digits;
									?>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" name="checkout_method" class="extcheckout_credit_card" id="<?php echo $card['memberID']; ?>" value="<?php echo $card['memberID']; ?>">
										<label class="deps_cardit" for="<?php echo $card['memberID']; ?>"></label>
									</div>
									<label class="title">Use Credit Card <?php  echo $masked; ?></label>
								</div>
									<?php } } ?><?php */?>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" name="checkout_method" id="checkout_credit_card" value="credit_card" <?php if($_SESSION['biz_deposit']['checkout_method'] == 'credit_card') echo 'checked="checked"'; ?> />
										<label class="deps_cardit" for="checkout_credit_card"></label>
									</div>
									<label class="title">Credit Card</label>
									<div class="card_icon">
										<img alt="Card Image A" src="<?php echo ru_resource;?>images/card_a.jpg">
										<img alt="Card Image B" src="<?php echo ru_resource;?>images/card_b.jpg">
										<img alt="Card Image C" src="<?php echo ru_resource;?>images/card_c.jpg">
										<img alt="Card Image D" src="<?php echo ru_resource;?>images/card_d.jpg">
									</div>
								</div>
							</div>
						</div>
						<?php
								if($_SESSION['stripe_error']){?>
									<strong><span style="color:#FF0000;margin-left: 20px;"><?php echo $_SESSION['stripe_error']; ?></span></strong>
							<?php } ?>
						<div class="time_flied" id="deps_cardit_card" <?php if($_SESSION['biz_deposit_err'] != '') { } else { ?>style="display:none"<?php } ?>>
							<div class="flied flied_e">
								<div class="form-group">
									<div id="test">
										<input type="text" id="cardnumber" name="cardnumber" autocomplete="off" maxlength="19" class="card-number form-control" placeholder="Card Number" />
									</div>
									<div id="test1" style="display:none">
										<input type="text" id="cardnumbers" maxlength="19" autocomplete="off" placeholder="Card Numbersssssss">
									</div>
								</div>
								
								<span id="error" class="help-block"><?php echo $_SESSION['biz_deposit_err']['cardnumber']?></span>
								<div class="form-group">
									<input type="text" id="cvv" name="cvv" autocomplete="off" placeholder="3 Digit PIN" class="cardit_flied form-control" />
								</div>
								<div class="form-group">	
									<input type="text" id="month" name="month" maxlength="2" autocomplete="off" data-stripe="exp-month" placeholder="Month" class="cardit_flied card-expiry-month stripe-sensitive required form-control" />
									<input type="text" name="year" id="year" autocomplete="off" data-stripe="exp-year" placeholder="Year" class=" cardit_flied card-expiry-year stripe-sensitive required form-control" />
								</div>	
							</div>
							<div class="time_flied">
								<h4>Your Billing Address</h4>
								<div class="form-group">
									<div class="flied flied_e flied_f">
										<label>First Name *</label>
										<input type="text" name="fname" id="fname" maxlength="65" placeholder="First Name" value="<?php echo $_SESSION['biz_deposit']['fname']; ?>" class="fname form-control" />
									</div>
								</div>
								<div class="form-group">	
									<div class="flied flied_e flied_f">
										<label>Last Name *</label>
											<input type="text" name="lname" id="lname" maxlength="65" placeholder="Last Name" value="<?php echo $_SESSION['biz_deposit']['lname']; ?>" class="lname form-control" />
									</div>
								</div>
								<div class="form-group">
									<div class="flied flied_e flied_f">
										<label>Address 1 *</label>
										<input type="text" name="address1" id="address1" placeholder="Address 1" value="<?php echo $_SESSION['biz_deposit']['address1']; ?>" class="address form-control" />
									</div>
								</div>
								<div class="flied flied_e flied_f">
									<label>Address 2</label>
									<input type="text" name="address2" id="address2" placeholder="Address 2" value="<?php echo $_SESSION['biz_deposit']['address2']; ?>" class="address2 form-control" />
								</div>
								<div class="form-group">
									<div class="flied flied_e flied_f">
										<label>City *</label>
											<input type="text" name="city" id="city" placeholder="City" value="<?php echo $_SESSION['biz_deposit']['city']; ?>" class="city form-control" />
									</div>
								</div>
								<div class="form-group">
									<div class="flied flied_e flied_f">
										<label>State *</label>
										<div class="select">
											<select name="state" id="state" class="custom-select state">
												<option>Select State</option>
												<?php foreach($StateAbArray as $key => $val) { ?>
												<option value="<?php echo $key;?>" <?php if($_SESSION['biz_deposit']['state'] == $key) echo 'selected="selected"'; ?>><?php echo $val;?></option>
												<?php } ?>	
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="flied flied_e flied_f">
										<label>Zip Code *</label>
										<input type="text" name="zip" id="zip" maxlength="9" placeholder="Postal Code" value="<?php echo $_SESSION['biz_deposit']['zip']; ?>" class="zip form-control" />
									</div>
								</div>
							</div>
						</div>
						<?php } ?>			
						<div class="flied">
							<label>Total Deposit</label>
							<input type="text" name="total_amount" id="total_amount" value="<?php echo $_SESSION['biz_deposit']['total_amount']; ?>" class="value calcut" placeholder="[calculate total]">
							<label class="usd fee">Plus 6.0% fee</label>
						</div>
						<?php  if($payment_setting['payment_option'] == '1') { ?>
						<div class="flied flied_e">
							<button class="orange" id="credit" type="submit">COMPLETE TRANSACTION</button>
							<?php /*?><input type="submit" value="Complete Transaction" class="orange" /><?php */?>
						</div>
						<?php } ?>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
unset($_SESSION['biz_deposit_err']);
unset($_SESSION['biz_deposit']);
unset($_SESSION['deposit']['amount']);
?>	
<script type="text/javascript">
$(function () {
	$("#wcash_stash").on('click', function () {
		window.location = "<?php echo ru; ?>withdraw_cash";
	})
	$("#checkout_bank_account,#checkout_credit_card,.extcheckout_credit_card").on('click', function () {
		var checkout_method = this.value;
		if(checkout_method == 'bank_account') {
			$("#deps_bank_account").slideDown("slow");
			$("#deps_cardit_card").slideUp("slow");
		} else if(checkout_method == 'credit_card') {
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
			$("#deps_bank_account").slideUp("slow");
			$("#deps_cardit_card").slideDown("slow");
			$('#test').show();
			$('#test1').hide();
		} else {	
			$.ajax({
				url : "<?php echo ru;?>process/get_checkoutcreditcard.php?card_id="+checkout_method,
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
					$('span[id^="error"]').remove();
					$('#test').hide();
					$('#test1').show();
					$("#deps_cardit_card").slideDown("slow");
					$("#deps_bank_account").slideUp("slow");
					
				}
			});
		}
	});

});

function copy_amount() {
	var amount =  document.getElementById('amount').value;
	if(amount != '') {
	var calculate_tax = Number(amount) / 100 * 6.00;
	document.getElementById('calculate_tax').value="$"+calculate_tax.toFixed(2);
	var add_tax_amount = Number(amount) + Number(calculate_tax);
	var total_amount = add_tax_amount.toFixed(2);
	document.getElementById('total_amount').value="$"+total_amount;
	}
}
</script>
<style>
	.form-group{ width:98%}
	.help-block{ float:left; margin:5px 0 0 10px; color:#a94442; position:relative}
</style>
<?php unset($_SESSION['stripe_error']); ?>