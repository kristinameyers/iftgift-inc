<div class="mid_contant regst">
	<h1 class="regst">Forgot Your password?</h1>
	<div class="regs_form_outer sign_form">
		<div class="sign_form_inner forget_pass">
			<img src="<?php echo ru_resource; ?>images/jester_d.png" alt="Jester Image" />
			<div class="regs_form">
				<form method="post" action="<?php echo ru;?>process/process_forgotpassword.php">					
					<input type="text" name="email" id="email" <?php if($_SESSION['msgs_err']['email']) { ?> class="hightlight" <?php } ?> placeholder="E-mail..." />
					<?php if($_SESSION['msgs_err']['email']) { ?>
						<div class="modal" id="modal_email">
							<a style="cursor:pointer" onClick="close_div();">
								<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
							</a>
							<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
							<div class="valid_msg"><?php echo $_SESSION['msgs_err']['email'] ?></div>
						</div>
					<?php } ?>
					<input type="submit" id="ForGotPassword" name="ForGotPassword" value="submit" class="orange"/>
				</form>
			</div>
		</div>
	</div>
	<?php if($_SESSION['msgs_err']['succ']) { ?>
		<div class="modal" id="modal_email">
			<a style="cursor:pointer" onClick="close_div();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
			<div class="valid_msg"><?php echo $_SESSION['msgs_err']['succ'] ?></div>
		</div>
		<script type="text/javascript">
			setTimeout(function() { 
				window.location.href = '<?php echo ru; ?>'; 
			}, 2000);
		</script>	
	<?php } ?>
	<?php if($_SESSION['msgs_err']) { ?>
		<div class="overlay"></div>
	<?php } ?>
</div>
<?php
unset($_SESSION['msgs_err']);
unset($_SESSION['msgs']);
?>	