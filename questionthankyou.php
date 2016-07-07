<?php
if(!isset($_SESSION['question_ans'])) {
	header("Location:".ru."dashboard");
} 
?>
<div class="mid_contant regst">
	<h1 class="regst thank_title"><span class="i">Thanks</span> <span class="f">For</span> <span class="t">Input</span></h1>
	<div class="regs_form_outer sign_form">
		<div class="sign_form_inner forget_pass thnkyu">
			<p>Your iftPut is already helping our system understand you.<br />iftGift suggestions may be based on everything we've learned about<br />a person, including all responses from your family and friends.</p>
			<div class="thank_btn">
				<a href="<?php echo ru;?>question" class="thank_qa">Answer More Questions</a>
				<a href="<?php echo ru;?>step_1" class="thank_qa orange">Send an iftGift</a>
			</div>
		</div>
	</div>
</div>