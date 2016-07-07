<?php
 $get_cuser = $db->get_row("select available_cash,email from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
 $available_cash = $get_cuser['available_cash'];
?>
<script type="text/javascript">
$(function () {
	$("#dcash_stash,#wcash_stash").on('click', function () {
		var transfer_cash = this.value;
		if(transfer_cash == 'withdraw') {
			window.location = "<?php echo ru; ?>withdraw_cash";
		} else if(transfer_cash == 'deposit') {
			window.location = "<?php echo ru; ?>deposit_cash";			
		}
	});
});
</script>
<div class="mid_contant">
	<h2 class="title">Cash Stash<sup>SM:</sup> Transfer Funds</h2>
	<div class="cont_bar" onclick="copy_amount();">
		<div class="cont_bar_inner cont_bar_inner_d cash_stach">
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
						<?php /*?><div class="time_flied with_draw" id="draw_fund_btm" style="display:none">
							<div class="flied"><label>Enter Amount</label><input type="text" placeholder="$000.00" class="value" /><label class="usd">USD</label></div>
							<div class="terms terms_c">
									<span>...AND send to your bank account</span>
									<div class="squaredFour left">
										<input type="radio" name="check" id="twentythree" value="None">
										<label class="deps_account" for="twentythree"></label>
									</div>
									<label class="title">Bank Account</label>
								</div>
							<div class="time_flied" id="deps_account_btm" style="display:none">
									<div class="flied flied_e">
										<input type="text" placeholder="Routing Number" />
										<input type="text" placeholder="Account Number" />
									</div>
								</div>
							<div class="terms terms_c">
									<span>...OR send to your credit card</span>
									<div class="squaredFour left">
										<input type="radio" name="check" id="twentyfour" value="None">
										<label class="deps_cardit" for="twentyfour"></label>
									</div>
									<label class="title">Credit Card</label>
									<div class="card_icon">
										<img alt="Card Image A" src="<?php echo ru_resource;?>images/card_a.jpg">
										<img alt="Card Image B" src="<?php echo ru_resource;?>images/card_b.jpg">
										<img alt="Card Image C" src="<?php echo ru_resource;?>images/card_c.jpg">
										<img alt="Card Image D" src="<?php echo ru_resource;?>images/card_d.jpg">
									</div>
								</div>
							<div class="time_flied" id="deps_cardit_btm" style="display:none">
									<div class="flied flied_e">
										<input type="text" placeholder="Card Number" />
										<input type="text" placeholder="3 Digit PIN" class="cardit_flied" />
										<input type="text" placeholder="Month" class="cardit_flied" />
										<input type="text" placeholder="Year" class="cardit_flied" />
									</div>
								</div>
							<div class="time_flied">
									<h4>Your Billing Address</h4>
									<div class="flied flied_e flied_f">
											<label>First Name *</label>
											<input type="text" placeholder="First Name" />
										</div>
									<div class="flied flied_e flied_f">
											<label>Last Name *</label>
											<input type="text" placeholder="Last Name" />
										</div>
									<div class="flied flied_e flied_f">
											<label>Address 1 *</label>
											<input type="text" placeholder="Address 1" />
										</div>
									<div class="flied flied_e flied_f">
											<label>Address 2</label>
											<input type="text" placeholder="Address 2" />
										</div>
									<div class="flied flied_e flied_f">
											<label>City *</label>
											<input type="text" placeholder="City" />
										</div>
									<div class="flied flied_e flied_f">
											<label>State *</label>
											<div class="select">
											<select name="location" id="location" class="custom-select state">
												<option>Select State</option>
												<option value="AL">Alabama</option>
												<option value="AK">Alaska</option>
												<option value="AZ">Arizona</option>
												<option value="AR">Arkansas</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="DC">Columbia</option>
												<option value="CT">Connecticut</option>
												<option value="DE">Delaware</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="IA">Iowa</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="ME">Maine</option>
												<option value="MD">Maryland</option>
												<option value="MA">Massachusetts</option>
												<option value="MI">Michigan</option>
												<option value="MN">Minnesota</option>
												<option value="MS">Mississippi</option>
												<option value="MO">Missouri</option>
												<option value="MT">Montana</option>
												<option value="NE">Nebraska</option>
												<option value="NV">Nevada</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NM">New Mexico</option>
												<option value="NY">New York</option>
												<option value="NC">North Carolina</option>
												<option value="ND">North Dakota</option>
												<option value="OH">Ohio</option>
												<option value="OK">Oklahoma</option>
												<option value="OR">Oregon</option>
												<option value="PA">Pennsylvania</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="SD">South Dakota</option>
												<option value="TN">Tennessee</option>
												<option value="TX">Texas</option>
												<option value="UT">Utah</option>
												<option value="VT">Vermont</option>
												<option value="VA">Virginia</option>
												<option value="WA">Washington</option>
												<option value="WV">West Virginia</option>
												<option value="WI">Wisconsin</option>
												<option value="WY">Wyoming</option>
											</select>
										</div>
										</div>
									<div class="flied flied_e flied_f">
											<label>Zip Code *</label>
											<input type="text" placeholder="Postal Code" />
										</div>
									<div class="flied"><label>Total Deposit</label><input type="text" class="value calcut" placeholder="[calculate total]"><label class="usd fee">Plus 6.0% fee</label></div>
									<div class="flied flied_e">
											<input type="submit" value="Complete Transaction" class="orange" />
										</div>
								</div>
						</div><?php */?>
					</div>
					<div class="sugget_left">
						<div class="terms">
							<div class="terms_inner_b">
								<div class="squaredFour left">
									<input type="radio" name="cash_stash" id="dcash_stash" value="deposit">
									<label class="doposit_fund" for="dcash_stash"></label>
								</div>
								<label class="title">Deposit Funds <span class="into">INTO</span> Cash Stash</label>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>