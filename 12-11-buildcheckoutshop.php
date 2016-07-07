<?php
include_once("process/cart_functions.php");
$get_sender = "select first_name,last_name,email from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'";
$sender_info = $db->get_row($get_sender,ARRAY_A);
?>	
<div class="mid_contant">
		<ul class="steps">
			<li class="step_a"><a href="#"><span>1.</span> Enter cash gift and recipient info</a><span class="arrow"></span></li>
			<li class="step_b"><span class="arrow arrow_left"></span><a href="#"><span>2.</span> Select your gift suggestions</a><span class="arrow"></span></li>
			<li class="step_c step_d step_e active"><span class="arrow arrow_left"></span><a href="#"><span>3.</span> Delivery details & Checkout</a></li>
		</ul>
		<div class="cont_bar">
			<div class="cont_bar_inner cont_bar_inner_b">
				<a href="javascript:;" onclick="cancel_iftgift('')" class="cancel_btn">CANCEL IFTGIFT</a>
				<form id="payment-form" class="form-horizontal" method="post" action="<?php echo ru;?>process/process_shopcart.php">
				<input name="userId" id="userId" value="<?php echo $_SESSION['LOGINDATA']['USERID'];?>" type="hidden">
				<input name="email" id="email" value="<?php echo $sender_info['email'];?>" type="hidden">
				<input name="Shopcheckout" id="Shopcheckout" value="1" type="hidden">
					<div class="box">
						<div class="num_outer">
							<div class="one">1</div>
						</div>
						<h4>Review You selections</h4>
						<div class="form_bar">
						<ul>
						<?php
						 $max = count($_SESSION['cart']);
						 for($i=0;$i<$max;$i++){
							$pid=$_SESSION['cart'][$i]['proid'];
							$q=$_SESSION['cart'][$i]['qty'];
							$pname=get_product_name($pid);
							$image=get_pro_image($pid);	
							$price=get_prices($pid);
						?>
							<li>
								<img src="<?php  get_image($image);?>" width="113" height="113" alt="Suggestion Image" />
								<h5><?php echo substr($pname,0,20);?></h5>
								<h5 class="price">$<?php echo $price;?></h5>
								<div class="caption" onclick="del(<?php echo $pid?>)">REPLACE</div>
							</li>
						<?php } ?>	
						</ul>	
					</div>
					</div>
					<div class="box blue">
						<div class="num_outer">
							<div class="one">2</div>
						</div>
						<h4>Shipping adress</h4>
						<div class="form_bar">
							<div class="flied_outer">
								<div class="flied">
									<label>First name: <span>*</span></label>
									<input type="text" name="shipfname" id="shipfname" value="<?php echo $sender_info['first_name'];?>" placeholder="<?php echo $sender_info['first_name'];?>" />
									<div class="modal" id="modal_fname" style="display:none">
										<a style="cursor:pointer" onClick="close_div();">
											<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
										</a>
										<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
										<div class="valid_msg">Please enter First name.<br/> Please correct the field <span>in red.</span></div>
									</div>
								</div>
								<div class="flied">
									<label>Address: <span>*</span></label>
									<input type="text" name="shipaddress" id="shipaddress" placeholder="Address" />
									<div class="modal" id="modal_address" style="display:none">
										<a style="cursor:pointer" onClick="close_div();">
											<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
										</a>
										<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
										<div class="valid_msg">Please enter Address.<br/> Please correct the field <span>in red.</span></div>
									</div>
								</div>
								<div class="flied">
									<label>Apt., Suite: <span></span></label>
									<input type="text" name="apt_suite" id="apt_suite" placeholder="Apt., Suite" />
								</div>
							</div>
							<div class="flied_outer">
								<div class="flied">
									<label>Last name: <span>*</span></label>
									<input type="text" name="shiplname" id="shiplname" value="<?php echo $sender_info['last_name'];?>" placeholder="<?php echo $sender_info['last_name'];?>" />
									<div class="modal" id="modal_lname" style="display:none">
										<a style="cursor:pointer" onClick="close_div();">
											<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
										</a>
										<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
										<div class="valid_msg">Please enter Last name.<br/> Please correct the field <span>in red.</span></div>
									</div>
								</div>
								<div class="flied">
									<label>City: <span>*</span></label>
									<input type="text" name="shipcity" id="shipcity" placeholder="City" />
									<div class="modal" id="modal_city" style="display:none">
										<a style="cursor:pointer" onClick="close_div();">
											<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
										</a>
										<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
										<div class="valid_msg">Please enter City name.<br/> Please correct the field <span>in red.</span></div>
									</div>
								</div>
								<div class="flied">
									<label>State: <span>*</span></label>
									<div class="select select_b shp_state">
										<select class="custom-select" id="shipstate" name="shipstate">
											<option>State</option>
											<?php foreach($StateAbArray as $key => $val) { ?>
											<option value="<?php echo $key;?>" <?php if($_SESSION['shopcheck_gift']['location'] == $key) { ?> selected="selected" <?php } ?>><?php echo $val;?></option>
											<?php } ?>	          
										</select>
									</div>
									<div class="modal" id="modal_state" style="display:none">
											<a style="cursor:pointer" onClick="close_div();">
												<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
											</a>
											<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
											<div class="valid_msg">Please select State.<br/> Please correct the field <span>in red.</span></div>
										</div>

									<label class="shp_zip" >Zip code: </label>
									<input type="text" name="shipzip" id="shipzip" placeholder="ZIP" class="shp_zip" />
								</div>
							</div>
						</div>
					</div>
					<div class="box blue orang">
						<div class="num_outer">
							<div class="one">3</div>
						</div>
						<h4>Total purchase</h4>
						<div class="form_bar">
							<div class="flied_outer prch">
								<div class="flied">
									<label>Total current purchases:</label>
									<input type="text" name="current_price" id="current_price" value="$<?php echo get_order_total()?>" placeholder="" />
								</div>
								<div class="flied">
									<label>Local Sales TAX:</label>
									<input type="text" name="sale_tax" id="sale_tax" value="5.00" placeholder="5.00" />
								</div>
								<div class="flied">
									<label>Shipping & Handling:</label>
									<input type="text" name="shipping" id="shipping" value="5.00" placeholder="5.00" />
								</div>
								<div class="flied total">
									<label>Total purchase:</label>
									<input type="text" name="total_price" id="total_price" value="$<?php echo number_format(get_order_total()+5.00+5.00,2); ?>" placeholder="" />
								</div>
							</div>
						</div>
					</div>
					<div class="box blue green">
						<div class="num_outer">
							<div class="one">4</div>
						</div>
						<h4>Transfer Funds From:</h4>
						<?php
						$get_blance = "select available_cash from ".tbl_user." where userid = '".$_SESSION['LOGINDATA']['USERID']."'";
						$view_blance = $db->get_row($get_blance,ARRAY_A);?>
						<div class="form_bar">
							<div class="flied_outer flied_outer_b">
								<div class="sugget_left">
									<div class="terms">
										<div class="terms_inner_b">
											<div class="squaredFour left">
												<input type="radio" value="cash_stash" id="fifteen" class="cash_price" name="checkout_method" />
												<label for="fifteen"></label>
											</div>
											<label class="title"><span class="i">Cash</span><span class="f">^</span><span class="t">Stash</span>: <span class="cash_price">$<?php echo $view_blance['available_cash'];?></span> Balance</label>
										</div>
									</div>
									<?php $payment_setting = mysql_fetch_array(mysql_query("select * from ".tbl_payment_setting.""));
										if($payment_setting['payment_option'] == '1') { ?>	
									<div class="terms">
										<div class="squaredFour left">
											<input type="radio" value="bank_account" id="nineteen" name="checkout_method" />
											<label for="nineteen" class="back_account"></label>
										</div>
										<label class="title">Bank Account</label>
									</div>
									<div class="time_flied" id="back_account_flied" style="display:none">
										<div class="flied">
											<?php /*?><input type="text" placeholder="Routing Number" />
											<input type="text" placeholder="Account Number" /><?php */?>
											<span style="color:#FF0000; font-weight:bold; margin:0 0 0 15px;">Coming Soon</span>
										</div>
									</div>
									<?php
									$get_card = $db->get_results("select card_number,memberID from ".tbl_member_card." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A); 
									if($get_card) {
									foreach($get_card as $card) {
									$card_num = decrypt($card['card_number']);
									$last_four_digits = substr("$card_num", -4);
									$masked = "xxxx-xxxx-xxxx-".$last_four_digits;
									?>
									
                                    <div class="terms">
										<div class="squaredFour left">
											<input type="radio" value="<?php echo $card['memberID']; ?>" id="<?php echo $card['memberID']; ?>" class="ext_credit_cards" name="checkout_method" />
											<label for="<?php echo $card['memberID']; ?>" class="credit_card"></label>
										</div>
										<label class="title">Use Credit Card <?php  echo $masked; ?></label>
									</div>
                                    
									<?php } } ?>
									<div class="terms">
										
                                        <div class="squaredFour left">
											<input type="radio" value="credit_card" <?php if($_SESSION['shopcheck_gift']['checkout_method'] == 'credit_card') echo 'checked="checked"'; ?> id="twenty" class="credit_cards" name="checkout_method" />
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
													<div id="test">
														<input type="text" id="cardnumber" name="cardnumber" autocomplete="off" placeholder="Card Number" class="card-number form-control" />
													</div>
													<div id="test1">
														<input type="text" id="cardnumbers" maxlength="19" autocomplete="off" placeholder="Card Numbersssssss">
													</div>
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
											<h4>Your Billing Address</h4>
											<div class="field_group">
												<div class="form-group">
													<input type="text" name="fname" id="fname" maxlength="65" value="<?php echo $_SESSION['shopcheck_gift']['fname']; ?>" placeholder="First Name" class="fname form-control" />
												</div>
												<div class="form-group">
													<input type="text" name="lname" id="lname" maxlength="65" value="<?php echo $_SESSION['shopcheck_gift']['lname']; ?>" placeholder="Last Name" class="lname form-control" />
												</div>
											</div>
											<div class="field_group">
												<div class="form-group">
													<input type="text" name="address1" id="address1" placeholder="Address 1" value="<?php echo $_SESSION['shopcheck_gift']['address1']; ?>" class="address form-control" />
												</div>
												<div class="form-group">
													<input type="text" name="address2" id="address2" placeholder="Address 2" value="<?php echo $_SESSION['shopcheck_gift']['address2']; ?>" class="address2 form-control" />
												</div>
											</div>
											<div class="form-group">
												<input type="text" name="city" id="city" placeholder="City" value="<?php echo $_SESSION['shopcheck_gift']['city']; ?>" class="city form-control" />
											</div>	
											<h4>State</h4>
											<div class="field_group">
												<div class="form-group">
													<div class="select">
														<select name="state" id="state" class="state form-control custom-select">
															<option>Select State</option>
															<?php foreach($StateAbArray as $key => $val) { ?>
															<option value="<?php echo $key;?>" <?php if($_SESSION['shopcheck_gift']['state'] == $key) echo 'selected="selected"'; ?>><?php echo $val;?></option>
														<?php } ?>	
														</select>
													</div>
												</div>	
												<div class="form-group">	
													<input type="text" name="zip" id="zip" value="<?php echo $_SESSION['shopcheck_gift']['zip']; ?>" placeholder="Postal Code" class="zip form-control" />
												</div>
											</div>
										</div>
									</div>
									<?php } else { ?>
									<span class="coming_msg">Bank & Credit Card Method Coming Soon</span>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="box_btm"></div>
					<div class="deliv_btn">
						<input type="submit" id="checkout" value="COMPLETE ORDER" class="orange" />
					</div>
					<button class="orange cmp" id="credit" type="submit" style="display:none">COMPLETE ORDER</button>
					<?php /*?><input type="submit" id="credit" style="display:none" value="COMPLETE ORDER123" class="btn btn-success" /><?php */?>
				</form>
				<img src="<?php echo ru_resource; ?>images/jester_n.jpg" alt="Jester Image" class="sleep_jester sleep_jester_b" />
			</div>
		</div>
		<div class="overlay" style="display:none"></div>
		<div class="modal" id="modal_payment" style="display:none">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg">Please Select Transfer Fund Method!
			</div>
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
  var form = jQuery("#payment-form")
  $("#checkout").click(function () {
  		var fname = jQuery('input[name=shipfname]');
		var lname = jQuery('input[name=shiplname]');
		var address = jQuery('input[name=shipaddress]');
		var shipcity = jQuery('input[name=shipcity]');
		var shipstate = jQuery('#shipstate').val();
		var shipzip = jQuery('input[name=shipzip]');
  		var isChecked = jQuery("input[name=checkout_method]:checked").val();
		if (fname.val()=='') {
			$('.overlay').show();
			$('#modal_fname').toggle( "slow" );
			fname.addClass('hightlight');
			return false;
		} else fname.removeClass('hightlight');
		
		if (address.val()=='') {
			$('.overlay').show();
			$('#modal_address').toggle( "slow" );
			address.addClass('hightlight');
			return false;
		} else address.removeClass('hightlight');
		
		if (lname.val()=='') {
			$('.overlay').show();
			$('#modal_lname').toggle( "slow" );
			lname.addClass('hightlight');
			return false;
		} else lname.removeClass('hightlight');
		
		if (shipcity.val()=='') {
			$('.overlay').show();
			$('#modal_city').toggle( "slow" );
			shipcity.addClass('hightlight');
			return false;
		} else shipcity.removeClass('hightlight');
		
		if (shipstate=='State') {
			$('.overlay').show();
			$('#modal_state').toggle( "slow" );
			
			return false;
		} 
		
		if(!isChecked) {
			$('.overlay').show();
            $('#modal_payment').toggle("slow");
		} else {
			document.getElementById("payment-form").submit();
		}
  });
  
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


function del(pid){
	var myData = 'proid='+pid+'&type=delete';
	$.ajax({
		url: "<?php echo ru;?>process/process_shopcart.php",
		type: "GET",
		data: myData,
		success:function(output) {
			window.location = "<?php echo ru;?>shopproduct";
		}
	});
}
</script>	
<style>
.help-block{ float:left; margin:5px 0 0 10px; color:#a94442; position:relative}
</style>
<?php
unset($_SESSION['biz_shopcheck_err']);
unset($_SESSION['shopcheck_gift']);
?>