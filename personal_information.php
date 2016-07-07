<?php
	$UserInfo = $db->get_row("select * from ".tbl_user." where userid = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
?>
<div class="mid_contant">
		<h2 class="title">Control: Your Personal Info</h2>
		<div class="cont_bar">
			<div class="cont_bar_inner">
				<div class="upload_img user_img">
					<?php 
						$userthumbImg = ru.'media/user_image/'.$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$UserInfo['user_image'];
						if(@getimagesize($userthumbImg)) {
					?>
						<img src="<?php echo $userthumbImg;?>" alt="Upload Image" />		
					<?php 
					} else {
					?>
							<img src="<?php echo ru_resource;?>images/upload_img_b.jpg" alt="Upload Image" />
					<?php } ?>
					
					<a href="<?php echo ru;?>photo_upload" class="orange">upload photo</a>
				</div>
				<div class="regs_form regs_form_c">
					<form method="post" action="<?php echo ru; ?>process/process_userinfo.php">
						<div class="flied">
							<label>First Name <span>*</span></label>
								<input type="text" placeholder="First Name" name="fname" id="fname" <?php if(isset($_SESSION['personalinfo_err']['fname'])) { ?> class="hightlight" <?php } ?> value="<?php echo $UserInfo['first_name']; ?>" />
								<?php if(isset($_SESSION['personalinfo_err']['fname'])) { ?>
								<div class="modal" id="model_fname">
									<a style="cursor:pointer" onClick="close_div();">
										<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
									</a>
									<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
									<div class="valid_msg"><?php echo $_SESSION['personalinfo_err']['fname']; ?></div>
								</div>
								<?php } ?>
						</div>
						<div class="flied">
							<label>Last Name <span></span></label>
								<input type="text" placeholder="Last Name" name="lname" id="lname" value="<?php echo $UserInfo['last_name']; ?>" />
						</div>
						<div class="flied">
							<label>Address 1: <span></span></label>
								<input type="text" placeholder="Address 1" name="address1" id="address1" value="<?php echo $UserInfo['address']; ?>" />	
						</div>
						<div class="flied">
							<label>Address 2: </label>
							<input type="text" placeholder="Address 2" name="address2" id="address2" value="<?php echo $UserInfo['address2']; ?>" />
						</div>
						<div class="flied flied_b">
							<label>City: <span></span></label>
								<input type="text" placeholder="City" class="city" name="city" id="city" value="<?php echo $UserInfo['city']; ?>" />
						</div>
						<div class="flied flied_b state">
							<label>State: <span></span></label>
								<div class="select select_b">
									<select name="state" id="state" class="custom-select">
										<option>State</option>
										<?php foreach($StateAbArray as $key => $val) { ?>
										<option value="<?php echo $key;?>" <?php if($UserInfo['state'] == $key) { echo 'selected="selected"';}?>><?php echo $val;?></option>
										<?php } ?>	             
									</select>
								</div>
						</div>
						<div class="flied flied_b zip">
							<label>Zip Code: <span></span></label>
								<input type="text" placeholder="Zip" name="zip" id="zip" value="<?php echo $UserInfo['zip_code'];?>" />
						</div>
						<div class="flied flied_b state count">
							<label>Country: </label>
							<div class="select select_b">
								<select name="country" id="country" class="custom-select">
									<option value="US">United States</option>            
								</select>
							</div>
						</div>
						<div class="flied">
							<label>Phone number: </label>
							<input type="text" placeholder="Phone Number" name="phone" id="phone" value="<?php echo $UserInfo['phone']; ?>" />
						</div>
						<div class="flied">
							<label>Primary E-mail: <span>*</span></label>
								<input type="text" placeholder="Email" name="email" id="email" <?php if($_SESSION['personalinfo_err']['email']) { ?> class="hightlight" <?php } ?> value="<?php echo $UserInfo{'email'}; ?>" />
								<?php if($_SESSION['personalinfo_err']['email']) { ?>
								<div class="modal" id="model_email">
									<a style="cursor:pointer" onClick="close_div();">
										<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
									</a>
									<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
									<div class="valid_msg"><?php echo $_SESSION['personalinfo_err']['email'] ?></div>
								</div>
								<?php } ?>
						</div>
						<div class="flied">
							<label>Emergency Backup E-mail:</label>
							<input type="text" placeholder="Emergency Email" name="emergency_email" id="emergency_email" value="<?php echo $UserInfo{'emergency_email'}; ?>" />
						</div>
						<div class="flied">
							<label>Birthdate: <span></span></label>
								<input type="text" placeholder="m/d/Y" name="dob" <?php if($_SESSION['personalinfo_err']['dob']) { ?> class="hightlight" <?php } ?> value="<?php echo $UserInfo['dob'];?>" />
								<?php if($_SESSION['personalinfo_err']['dob']) { ?>
								<div class="modal" id="model_email">
									<a style="cursor:pointer" onClick="close_div();">
										<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
									</a>
									<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
									<div class="valid_msg"><?php echo $_SESSION['personalinfo_err']['dob'] ?></div>
								</div>
								<?php } ?>
						</div>
						<?php
						$cyear = date('Y');
						$useryear = explode('/',$UserInfo['dob']);
						$calculatedage = ($cyear - $useryear[2]);
						$userage = $db->get_row("SELECT count(age) as c from ".tbl_recipient." where email = '".$UserInfo{'email'}."'",ARRAY_A);
						$total_record = $userage['c'];
						$userage1 = $db->get_row("SELECT count(age) as c from ".tbl_recipient." where email = '".$UserInfo{'email'}."' and age = '".$calculatedage."'",ARRAY_A);
						$equal_age = $userage1['c'];
						
						$actual_ages = @round(($equal_age/$total_record) * 100);
						
						
						$userage2 = $db->get_row("SELECT count(age) as c from ".tbl_recipient." where email = '".$UserInfo{'email'}."' and age > '".$calculatedage."'",ARRAY_A);
						$greater_age = $userage2['c'];
						
						$greater_ages = @round(($greater_age/$total_record) * 100);
						
						$userage3 = $db->get_row("SELECT count(age) as c from ".tbl_recipient." where email = '".$UserInfo{'email'}."' and age < '".$calculatedage."'",ARRAY_A);
						$less_age = $userage3['c'];
						
						$less_ages = @round(($less_age/$total_record) * 100);
						?>
						<div class="flied">
							<label class="rlt_age">Age Reality Check: <span></span></label>
							<div class="ques_range_outer">
								<div class="ques_rangebar single_ques">
									<div id="mainDemo" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all ui-slider-pips age_scroll" aria-disabled="false">
										<a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 50%;">
											<h4 class="age_range">Actual Age: (enter your birthdate above)</h4>
											<div class="age_range_line">
												<span><?php echo $actual_ages;?>%</span>
											</div>
											<div class="age_value">
												<span class="downrange">}</span>
												<h6><?php echo $less_ages;?>%</h6>
											</div>
											<div class="age_value age_value_b">
												<span class="downrange">}</span>
												<h6><?php echo $greater_ages;?>%</h6>
											</div>
										</a>
										<div class="range_scroll"></div>
										<input type="hidden" name="range" id="range" value="50"  />
										<span style="left:0%" class="ui-slider-pip ui-slider-pip-first ui-slider-pip-label ui-slider-pip-0">
											<span class="ui-slider-line"></span>
											<span data-value="0" class="ui-slider-label">0</span>
										</span>
										<span style="left:12.5000%" class="ui-slider-pip ui-slider-pip-1">
											<span class="ui-slider-line"></span><span data-value="1" class="ui-slider-label">1</span>
										</span>
										<span style="left:25.0000%" class="ui-slider-pip ui-slider-pip-2">
											<span class="ui-slider-line"></span><span data-value="2" class="ui-slider-label">2</span>
										</span>
										<span style="left:37.5000%" class="ui-slider-pip ui-slider-pip-3">
											<span class="ui-slider-line"></span><span data-value="3" class="ui-slider-label">3</span>
										</span>
										<span style="left:50.0000%" class="ui-slider-pip ui-slider-pip-4">
											<span class="ui-slider-line"></span><span data-value="4" class="ui-slider-label">4</span>
										</span>
										<span style="left:62.5000%" class="ui-slider-pip ui-slider-pip-5">
											<span class="ui-slider-line"></span><span data-value="5" class="ui-slider-label">5</span>
										</span>
										<span style="left:75.0000%" class="ui-slider-pip ui-slider-pip-6">
											<span class="ui-slider-line"></span><span data-value="6" class="ui-slider-label">6</span>
										</span>
										<span style="left:87.5000%" class="ui-slider-pip ui-slider-pip-7">
											<span class="ui-slider-line"></span>
											<span data-value="7" class="ui-slider-label">7</span>
										</span>
										<span style="left:100.0000%" class="ui-slider-pip ui-slider-pip-8">
											<span class="ui-slider-line"></span><span data-value="8" class="ui-slider-label">8</span>
										</span>
									</div>
								</div>
							</div>
						</div>
						<input type="submit" value="Save" name="PersonalInfo" id="PersonalInfo" class="orange" />
					</form>
				</div>
				<img src="<?php echo ru_resource;?>images/jester_l.jpg" alt="Jester Image" class="persn_jstr" />
			</div>
		</div>
	</div>
	<?php if($_SESSION['personalinfo_err']) { ?>
		<div class="overlay"></div>
	<?php } ?>
	<?php if($_SESSION['personalinfo_err']['success']) { ?>
	<div class="modal" id="modal_success">
		<a style="cursor:pointer" onClick="close_div();">
			<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
		</a>
		<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
		<div class="valid_msg"><?php echo $_SESSION['personalinfo_err']['success']; ?></div>
	</div>
	<?php } ?>
<link rel="stylesheet" href="<?php echo ru_resource?>js/datepicker/jquery-ui.css">
<script src="<?php echo ru_resource?>js/datepicker/jquery-ui.js"></script>	
<script language="javascript">
	$(function() {
		$("#datepicker").hide();
		$("#buttonHere").click(function(){
    		$("#datepicker").toggle();
		}); 

		$("#datepicker").datepicker({ 
      		onSelect: function(data, date) {
				$("#dob").val(data); 
         		$("#datepicker").hide(); 
      		} 
		});
	});
</script>	
<script src="<?php echo ru_resource;?>js/jquery-ui-slider-pips.js"></script>
<script>
$(document).ready(function() {
	var d=new Date();
	var get_uyear = Date.parse('<?php echo $UserInfo['dob'];?>');
	var actual_age = d - get_uyear;
	var num_years = actual_age/31536000000;
	
	if(isNaN(num_years)) {
		var actual_ages = '(enter your birthdate above)';
	 } else { 
	 	var actual_ages = Math.floor(num_years);
	 }
	$( ".age_range" ).text('Actual Age: '+actual_ages);
	var $slider1 = $("#mainDemo").slider({ value: actual_ages,
		min: 0,
		max: 100,
		step: 1,
		change: function(event, ui) { 
        //$("#range").attr("value",ui.value);
		//alert(ui.value);
    	} 
	});
	
	$slider1.slider("pips", {
		rest: 'label',
		step: 10
	});
});
</script>
<style>
	.ui-slider-pip-first .ui-slider-label, .ui-slider-pip-last .ui-slider-label{text-align:right}
	.ui-slider-pip-first .ui-slider-label{margin:0; text-align:left}
	.ui-slider-pips .ui-slider-label{ top:10px; background:#fff; margin-left:0}
	.flied .ques_range_outer .ques_rangebar .ui-slider .range_scroll{ margin-top:-152px;}
	.single_ques .ui-slider-horizontal .ui-slider-handle{top:-40px;}
</style>
<?php
unset($_SESSION['personalinfo_err']);
unset($_SESSION['personalinfo']);
?>	