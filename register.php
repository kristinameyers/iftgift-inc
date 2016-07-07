<?php
if(isset($s)){ 
	$userId = explode('_',base64_decode($s));
	$getinfo = @mysql_fetch_array(mysql_query("select giv_first_name,giv_last_name,occassionid from ".tbl_delivery." where delivery_id = '".$userId[1]."'"));
	$getoccss = explode("_",$getinfo['occassionid']);
		if($getinfo['occassionid'] == 'other_'.$getoccss[1]){
			$occasion_name = $getoccss[1];
		}else{ 
			$getoc = @mysql_fetch_array(mysql_query("select occasion_name from ".tbl_occasion." where occasionid = '".$getinfo['occassionid']."'"));
			$occasion_name = $getoc['occasion_name'];
		}
?>
<div class="modal" id="modal_pass">
	<a style="cursor:pointer" onClick="close_div();">
		<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
	</a>
	<img src="<?php echo ru_resource; ?>images/jester_az.jpg" alt="Validation Icon"  />
	<div class="cont_bar_inner confim">
	<div class="valid_msg valid_msg_b"><p class="confirm">You have received a <span class="user_reg">&quot;<?php echo $occasion_name; ?>&quot; </span> <br />iftGift from <span class="user_reg"><?php echo ucfirst($getinfo['giv_first_name']).' '.ucfirst($getinfo['giv_last_name']); ?></span>. <br /> <a href="#" onClick="close_div();" >Click here </a> to Complete registration.</p></div></div>
</div>
<div class="overlay" ></div>
<?php 
	$last=mysql_query("SELECT * From ".tbl_user." where userId='".$userId[0]."'");
	$rs=mysql_fetch_array($last);
	$_SESSION['register']['fname']= $rs['first_name'];
	$_SESSION['register']['lname']= $rs['last_name'];
	$_SESSION['register']['email']=$rs['email'];
} 
?>
<div class="mid_contant regst">
	<h1 class="regst">Register</h1>
    
    <!-- pause facebook signin
    
	<p class="privacy">WE RESPECT YOUR PRIVACY AND WILL NEVER POST TO FACEBOOK WITHOUT YOUR PERMISSION</p>
	<a href="javascript:;" onclick="FBLogin()"><img src="<?php echo ru_resource; ?>images/fb_reg_icon.jpg" alt="Facebook Register" class="fb_regs" /></a>
	<div class="or"><div class="line"><span>OR</span></div></div>
    
         -->
    
	<p class="privacy">Sign in with your Gmail address and password.<br/> IftGift uses Google Wallet and requires <br/>that you have a Google account.<br/><br/>
            <a href="https://gmail.com" target="_new">Click here to get a Gmail account.</a></p>
	<div class="resg_bar">
		<div class="left_side"><img src="<?php echo ru_resource; ?>images/jester_a.jpg" alt="Jester Image" /></div>
		<div class="left_side right_side"><img src="<?php echo ru_resource; ?>images/jester_b.jpg" alt="Jester Image" /></div>
		<div class="regs_form_outer">
			<div class="regs_form">
				<form method="post" action="<?php echo ru; ?>process/process_register.php">
				<?php if(isset($s)){?>
				<input type="hidden" name="userId"  value="<?php echo $s?>" />
				<?php }?>
					<input type="text" name="fname" id="fname" <?php if(isset($_SESSION['register_err']['fname'])) { ?> class="hightlight" <?php } ?> value="<?php echo $_SESSION['register']['fname'];?>" placeholder="First Name" />
					
					<input type="text" name="lname" id="lname" value="<?php echo $_SESSION['register']['lname'];?>" placeholder="Last name..." />
					
					<input type="text" name="email" id="email" <?php if($_SESSION['register_err']['email']) { ?> class="hightlight" <?php } ?> value="<?php echo $_SESSION['register']['email'];?>" placeholder="E-mail..." />
					
					<input type="password" name="password" <?php if($_SESSION['register_err']['password']) { ?> class="hightlight" <?php } ?> id="password" placeholder="Password...." />
					
					<input type="password" name="cpassword" id="cpassword" <?php if($_SESSION['register_err']['cpassword']) { ?> class="hightlight" <?php } ?> placeholder="Confirm password" />
					
					<div class="terms">
						<div class="terms_inner">
							<div class="squaredFour">
								<input type="checkbox" name="agree_term" value="1" <?php if($_SESSION['register']['agree_term'] == '1') { echo 'checked="checked"'; }?> id="squaredFour"/>
								<label for="squaredFour"></label>
							</div>
							<label>Agree to Our Terms and Conditions</label>
						</div>
					</div>
					<div class="terms">
						<div class="terms_inner">
							<div class="squaredFour">
								<input type="checkbox" value="None" id="squaredFive" name="check" />
								<label for="squaredFive"></label>
							</div>
							<label>Remember me on this computer</label>
						</div>	
					</div>
					<input type="submit" id="submit" name="register" value="register"/>
				</form>
			</div>
		</div>
	</div>
	<!--Register_page_for_mobile-->
	<div class="resg_bar_b">
		<div class="left_side"><img src="<?php echo ru_resource; ?>images/jester_a.jpg" alt="Jester Image" /></div>
		<div class="regs_form_outer">
			<div class="regs_form">
				<form method="post" action="<?php echo ru; ?>process/process_register.php">
					<input type="text" name="fname" id="fname" <?php if(isset($_SESSION['register_err']['fname'])) { ?> class="hightlight" <?php } ?> value="<?php echo $_SESSION['register']['fname'];?>" placeholder="First Name" />
					
					<input type="text" name="lname" id="lname" value="<?php echo $_SESSION['register']['lname'];?>" placeholder="Last name..." />
					
					<input type="text" name="email" id="email" <?php if($_SESSION['register_err']['email']) { ?> class="hightlight" <?php } ?> value="<?php echo $_SESSION['register']['email'];?>" placeholder="E-mail..." />
					
					<input type="password" name="password" <?php if($_SESSION['register_err']['password']) { ?> class="hightlight" <?php } ?> id="password" placeholder="Password...." />
					<input type="password" name="cpassword" id="cpassword" <?php if($_SESSION['register_err']['cpassword']) { ?> class="hightlight" <?php } ?> placeholder="Confirm password" />
					<div class="terms">
						<div class="terms_inner">
							<div class="squaredFour">
								<input type="checkbox" name="agree_term" value="1" <?php if($_SESSION['register']['agree_term'] == '1') { echo 'checked="checked"'; }?> id="squaredFour1"/>
								<label for="squaredFour1"></label>
							</div>
							<label>Agree to Our Terms and Conditions</label>
						</div>
					</div>
					<div class="terms">
						<div class="terms_inner">
							<div class="squaredFour">
								<input type="checkbox" value="None" id="squaredFive1" name="check" />
								<label for="squaredFive1"></label>
							</div>
							<label>Remember me on this computer</label>
						</div>	
					</div>
					<input type="submit" id="submit" name="register" value="register"/>
				</form>
			</div>
		</div>
		<div class="left_side right_side"><img src="<?php echo ru_resource; ?>images/jester_b.jpg" alt="Jester Image" /></div>
	</div>
	<?php if($_SESSION['register_err']) { ?>
		<div class="overlay"></div>
		<!---------------------Ragister_POPUP--------------------->
		<?php if(isset($_SESSION['register_err']['fname'])) { ?>
			<div class="modal" id="model_fname">
				<a style="cursor:pointer" onClick="close_div();">
					<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
				</a>
				<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
				<div class="valid_msg"><?php echo $_SESSION['register_err']['fname']; ?></div>
			</div>
		<?php } ?>
		
		<?php /*?><?php if($_SESSION['register_err']['lname']) { ?>
			<div class="modal" id="model_lname">
				<a style="cursor:pointer" onClick="close_div();">
					<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
				</a>
				<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
				<div class="valid_msg"><?php echo $_SESSION['register_err']['lname']; ?></div>
			</div>
		<?php } ?><?php */?>
		
		<?php if($_SESSION['register_err']['email']) { ?>
			<div class="modal" id="modal_email">
				<a style="cursor:pointer" onClick="close_div();">
					<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
				</a>
				<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
				<div class="valid_msg"><?php echo $_SESSION['register_err']['email'] ?></div>
			</div>
		<?php } ?>
		
		<?php if($_SESSION['register_err']['password']) { ?>
			<div class="modal" id="modal_pass">
				<a style="cursor:pointer" onClick="close_div();">
					<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
				</a>
				<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
				<div class="valid_msg"><?php echo $_SESSION['register_err']['password']; ?></div>
			</div>
		<?php } ?>
		
		<?php if($_SESSION['register_err']['cpassword']) { ?>
			<div class="modal" id="modal_cpass">
				<a style="cursor:pointer" onClick="close_div();">
					<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
				</a>
				<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
				<div class="valid_msg"><?php echo $_SESSION['register_err']['cpassword']; ?></div>
			</div>
		<?php } ?>
		
		<?php if($_SESSION['register_err']['agree_term']) { ?>
			<div class="modal" id="model_term">
				<a style="cursor:pointer" onClick="close_div();">
					<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
				</a>
				<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
				<div class="valid_msg"><?php echo $_SESSION['register_err']['agree_term']; ?></div>
			</div>
		<?php } ?>	
		<!---------------------Ragister_POPUP--------------------->
	<?php } ?>
</div>
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
	appId      : '341516796048593',
	channelUrl : '//WWW.zs-dev.COM/iftgift', 
	status     : true, 
	cookie     : true, 
	xfbml      : true  
	});
};
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));

function FBLogin(){
	FB.login(function(response){
		if(response.authResponse){
			window.location.href = "<?php echo ru;?>process/process_fb.php?action=fblogin";
		}
	}, {scope: 'email,user_likes'});
}
</script>	
<?php
unset($_SESSION['register_err']);
unset($_SESSION['register']);
?>