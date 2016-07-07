<?php 
if(isset($s)){
	$userId = explode('_',base64_decode($s));
	if($userId[2] == 'res'){
		$getinfo = @mysql_fetch_array(mysql_query("select giv_first_name,giv_last_name from ".tbl_delivery." where delivery_id = '".$userId[1]."'"));
?>
<div class="modal" id="modal_pass">
	<a style="cursor:pointer" onClick="close_div();">
		<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
	</a>
	<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
	<div class="valid_msg">&quot;You have received a Release Request from &quot;<?php echo ucfirst($getinfo['giv_first_name']).' '.ucfirst($getinfo['giv_last_name']); ?>&quot;.Login below to respond.&quot;</div>
</div>
<div class="overlay"></div>
<?php
	}else{
		if($userId[0] != $_SESSION['LOGINDATA']['USERID']){ 
		unset($_SESSION['LOGINDATA']);
		unset($_SESSION['cart']);
		unset($_SESSION['DRAFT']);
		//header("location:".ru."login");exit;
		$getinfo = @mysql_fetch_array(mysql_query("select giv_first_name,giv_last_name,occassionid from ".tbl_delivery." where delivery_id = '".$userId[1]."'"));
		$getoccss = explode("_",$getinfo['occassionid']);
			if($getinfo['occassionid'] == 'other_'.$getoccss[1]){
				$occasion_name = $getoccss[1];
			}else{ 
				$getoc = @mysql_fetch_array(mysql_query("select occasion_name from ".tbl_occasion." where occasionid = '".$getinfo['occassionid']."'"));
				$occasion_name = $getoc['occasion_name'];
			}
?>
<div class="modal" id="modal_pass" >
	<a style="cursor:pointer" onClick="close_div();">
		<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
	</a>
	<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
	<div class="valid_msg">&quot;You have received an &quot;<?php echo $occasion_name; ?>&quot; iftGift from &quot;<?php echo ucfirst($getinfo['giv_first_name']).' '.ucfirst($getinfo['giv_last_name']); ?>&quot;.Login below to access your iftGift&quot;</div>
</div>
<div class="overlay"></div>
<?php	
		} else {
			header("location:".ru."gift_collect/".base64_encode($userId[0]));exit;
		}
	}
}
 ?>
<div class="mid_contant regst">
	<h1 class="regst">Sign in</h1>
   
    
  <!-- pause facebook signin
    
    
	<p class="privacy">WE RESPECT YOUR PRIVACY AND WILL NEVER POST TO FACEBOOK WITHOUT YOUR PERMISSION</p>
	<a href="javascript:;" onclick="FBLogin()"><img src="<?php echo ru_resource; ?>images/fb_signin_icon.jpg" alt="Facebook Register" class="fb_regs" /></a>
    

    
    
	<div class="or"><div class="line"><span>OR</span></div></div> 
    
     -->
    
	 
            <p class="privacy">Sign in with your Gmail address and password.<br/> IftGift uses Google Wallet and requires <br/>that you have a Google account.<br/><br/>
            <a href="https://gmail.com" target="_new">Click here to get a Gmail account.</a></p>
            
            
	<div class="regs_form_outer sign_form">
		<div class="sign_form_inner">
			<img src="<?php echo ru_resource; ?>images/jester_c.jpg" alt="Jester Image" />
            
            
			<div class="regs_form">
				<form method="post" action="<?php echo ru;?>process/process_login.php">
					<?php if($userId[2] == 'res') { ?>
						<input type="hidden" name="releaseres" id="releaseres" value="<?php echo $s; ?>"  />
					<?php } else if(isset($s)) {?>
						<input type="hidden" name="existinguser" id="existinguser" value="<?php echo $userId[0]; ?>"  />
						<input type="hidden" name="existinguser2" id="existinguser2" value="<?php echo $s; ?>"  />
					<?php } ?>
					<input type="text" name="email" id="email" <?php if($_SESSION['login_err']['email']) { ?> class="hightlight" <?php } ?> placeholder="E-mail..." value="<?php echo $_COOKIE['username']; ?>" />
					<?php if($_SESSION['login_err']['email']) { ?>
						<div class="modal" id="modal_email">
							<a style="cursor:pointer" onClick="close_div();">
								<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
							</a>
							<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
							<div class="valid_msg"><?php echo $_SESSION['login_err']['email'];?></div>
						</div>
					<?php } ?>
					<input type="password" name="password" id="password" <?php if($_SESSION['login_err']['password']) { ?> class="hightlight" <?php } ?> placeholder="Password...." value="<?php echo $_COOKIE['password']; ?>" />
					<?php if($_SESSION['login_err']['password']) { ?>
						<div class="modal" id="modal_pass">
							<a style="cursor:pointer" onClick="close_div();">
								<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
							</a>
							<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
							<div class="valid_msg"><?php echo $_SESSION['login_err']['password'];?></div>
						</div>
					<?php } ?>	
					<div class="terms">
						<div class="terms_inner">
							<div class="squaredFour">
								<input type="checkbox" value="1" id="squaredFour" name="remember_me" />
								<label for="squaredFour"></label>
							</div>
							<label>Remember me on this computer<br/>Forgot your password? <a href="<?php echo ru;?>forget_password">click here</a></label>
						</div>
					</div>
					<input type="submit" value="submit" id="login" name="login" class="orange"/>
				</form>
			</div>
		</div>
	</div>
	<?php if($_SESSION["login_err"]["error"]) { ?>
		<div class="modal" id="modal_pass">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg"><?php echo $_SESSION['login_err']['error'];?></div>
		</div>
	<?php } ?>	
	<?php if($_SESSION['login_err']) { ?>
		<div class="overlay"></div>
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
unset($_SESSION['login_err']);
unset($_SESSION['login']);
?>