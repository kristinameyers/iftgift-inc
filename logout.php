<?php
		ob_start();
		session_start();
		if(isset($_COOKIE['USERID']) && isset($_COOKIE['email']) && isset($_COOKIE['pwd'])) {
			unset($_COOKIE['email']);
			unset($_COOKIE['pwd']);
			setcookie("USERID", false, time() - (86400) ,"/" );
			setcookie("email", false, time() - (86400) ,"/" ); 
			setcookie("pwd", false, time() - (86400) ,"/" );
		}
		/*unset($_SESSION["LOGINDATA"]);
		unset($_SESSION['recipit_id']['New']);
		unset($_SESSION['products']);
		unset($_SESSION['cart']);
		unset($_SESSION['question_ans']);
		unset($_SESSION['delivery_id']['New']);
		unset($_SESSION['QuestionID']);
		unset($_SESSION['friendslist']);*/
		session_destroy();
		header("location:".ru."login?loggedout=true");
	
?>
<?php /*?><script type="text/javascript">
	window.location = "<?php echo ru;?>login?loggedout=true"; 
</script><?php */?>