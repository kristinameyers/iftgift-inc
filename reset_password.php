<div class="mid_contant regst">
	<h1 class="regst">Forgot Your password?</h1>
	<div class="regs_form_outer sign_form">
			<div class="sign_form_inner forget_pass">
				<img src="<?php echo ru_resource; ?>images/jester_d.png" alt="Jester Image" />
				<div class="regs_form">
					<form method="post" action="<?php echo ru;?>process/process_forgotpassword.php">
						<input type="hidden" name="userId" id="userId" value="<?php echo $_GET['s']; ?>" />
						<input type="password" name="password" id="password" <?php if($_SESSION['reset_err']['password']) { ?> class="hightlight" <?php } ?> placeholder="Password...." />
						<?php if($_SESSION['reset_err']['password']) { ?>
							<div class="modal" id="modal_pass">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['reset_err']['password'];?></div>
							</div>
						<?php } ?>	
						<input type="password" name="cpassword" id="cpassword" <?php if($_SESSION['reset_err']['cpassword']) { ?> class="hightlight" <?php } ?> placeholder="Confirm password" />
						<?php if($_SESSION['reset_err']['cpassword']) { ?>
							<div class="modal" id="modal_cpass">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['reset_err']['cpassword']; ?></div>
							</div>
						<?php } ?>	
						<input type="submit" id="ResetPassword" name="ResetPassword" value="submit" class="orange"/>
					</form>
				</div>
			</div>
		</div>
	<?php if($_SESSION['reset_err']['succ']) { ?>
		<div class="modal" id="modal_email">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg"><?php echo $_SESSION['reset_err']['succ'] ?></div>
		</div>
		<script type="text/javascript">
			setTimeout(function() { 
				window.location.href = '<?php echo ru; ?>login'; 
			}, 2000);
		</script>	
	<?php } ?>
	<?php if($_SESSION['reset_err']) { ?>
		<div class="overlay"></div>
	<?php } ?>
</div>
<style>
.overlay{position:fixed; top:0; left:0; height:100%; width:100%; background:url(../resource/images/overlay_bg.png); z-index:9999999}
</style>
<?php
unset($_SESSION['reset_err']);
?>