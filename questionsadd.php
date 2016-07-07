<script type="text/javascript">
$(document).ready(function(){
  $(".your_friend").click(function(){
	$("#your_friend_flied").show('slow');
  });
  
  $(".yourself, .iftgift").click(function(){
	$("#your_friend_flied").hide('slow');
  });	
});
</script>
<div class="mid_contant">
	<h2 class="title">s&rsquo;Jester Q&A: Provide iftPut</h2>
	<div class="cont_bar">
		<h3>Who is this <span class="i">Insightful </span><span class="f">Fun </span><span class="t">Test </span>about?</h3>
		<div class="cont_bar_inner cont_bar_inner_d">
				<img src="<?php echo ru_resource;?>images/jester_s.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
				<div class="regs_form">
					
						<div class="sugget_left">
							<div class="terms">
								<div class="squaredFour left">
									<input type="radio" value="yourself" id="twentyone" name="check" checked="checked" />
									<label for="twentyone" class="yourself"></label>
								</div>
								<label>Yourself</label>
							</div>
						</div>
						<div class="sugget_left">
							<div class="terms">
								<div class="squaredFour left">
									<input type="radio" value="yourfriend" id="twentytwo" name="check" />
									<label for="twentytwo" class="your_friend"></label>
								</div>
								<label>Your Friend</label>
							</div>
							<div class="time_flied" id="your_friend_flied" style="display:none">
								<div class="flied"><input type="text" placeholder="First Name" /></div>
								<div class="flied"><input type="text" placeholder="Last Name" /></div>
								<div class="flied"><input type="text" placeholder="Email Address" /></div>
								<div class="flied">
									<div class="select">
										<select name="location" id="location" class="custom-select">
											<option>Select Gender</option>
											<option value="AL">Female</option>
											<option value="AK">Male</option>
										</select>
									</div>
								</div>
								<div class="flied"><input type="text" placeholder="Age (guess if necessary)" /></div>
								<div class="flied">
									<div class="select">
										<select name="location" id="location" class="custom-select">
											<option>Location</option>
											<?php foreach($StateAbArray as $key => $val) { ?>
												<option value="<?php echo $key;?>" <?php if($_SESSION['biz_rep']['location'] == $key) { ?> selected="selected" <?php } ?>><?php echo $val;?></option>
											<?php } ?>	
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="sugget_left">
							<div class="terms">
								<div class="squaredFour left">
									<input type="radio" value="feedback" id="twentythree" name="check" />
									<label for="twentythree" class="iftgift"></label>
								</div>
								<label>iftGift (We appreciate the feedback)</label>
							</div>
						</div>
						<input type="submit" onclick="getrand_question()" value="Answer Q&A" class="orange" />
				</div>
			</div>
	</div>
</div>
<script type="text/javascript">
function getrand_question() {
	var val = document.querySelector('input[name="check"]:checked').value;
	window.location = "<?php echo ru;?>question/"+val;
}
</script>