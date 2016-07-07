<?php
if(!isset($_SESSION['LOGINDATA']['USERID'])){
	unset($_SESSION['recipit_id']['New']);
	unset($_SESSION['cart']);	
}
if(isset($_SESSION['DRAFT']['delivery_id'])){
	$delivery_id = $_SESSION['DRAFT']['delivery_id'];
	$query = mysql_fetch_array(mysql_query("select * from ".tbl_delivery." where delivery_id = '".$_SESSION['DRAFT']['delivery_id']."'"));
	$_SESSION['biz_rep']['cash_amount']=$query['cash_amount']; 
	$_SESSION['biz_rep']['first_name']=$query['recp_first_name'];
	$_SESSION['biz_rep']['last_name']=$query['recp_last_name']; 
	$_SESSION['biz_rep']['email']=$query['recp_email'];
	$_SESSION['biz_rep']['gender']=$query['gender'];
	$_SESSION['biz_rep']['age']=$query['age'];
	$_SESSION['biz_rep']['location']=$query['location'];
	
 	$getoccss = explode("_",$query['occassionid']);
	if($query['occassionid'] == 'other_'.$getoccss[1]){
		$_SESSION['biz_rep']['ocassion']= $getoccss[0];
		$_SESSION['biz_rep']['ocassion1'] = $getoccss[1];	
	}else{
		$get_occas = $db->get_row("select occasionid,occasion_name from ".tbl_occasion." where occasionid='".$query['occassionid']."' ",ARRAY_A);
		 $_SESSION['biz_rep']['ocassion']= $get_occas['occasionid'];	
	}	
} else if(isset($_SESSION['recipit_id']['New'])){ 
	$delivery_id = $_SESSION['recipit_id']['New'];
	$query = mysql_fetch_array(mysql_query("select * from ".tbl_delivery." where delivery_id = '".$_SESSION['recipit_id']['New']."'"));
	$_SESSION['biz_rep']['cash_amount']=$query['cash_amount']; 
	$_SESSION['biz_rep']['first_name']=$query['recp_first_name'];
	$_SESSION['biz_rep']['last_name']=$query['recp_last_name']; 
	$_SESSION['biz_rep']['email']=$query['recp_email'];
	$_SESSION['biz_rep']['gender']=$query['gender'];
	$_SESSION['biz_rep']['age']=$query['age'];
	$_SESSION['biz_rep']['location']=$query['location'];
		 
 	$getoccss = explode("_",$query['occassionid']);
	if($query['occassionid'] == 'other_'.$getoccss[1]){
		 $_SESSION['biz_rep']['ocassion']= $getoccss[0];
		 $_SESSION['biz_rep']['ocassion1'] = $getoccss[1];	
	}else{
		$get_occas = $db->get_row("select occasionid,occasion_name from ".tbl_occasion." where occasionid='".$query['occassionid']."' ",ARRAY_A);
		$_SESSION['biz_rep']['ocassion']= $get_occas['occasionid'];	
	}	
}

?>
<?php  if($_SESSION['biz_rep_err']) { ?>	
	<div class="overlay"></div>
<?php } ?> 
<?php if($_SESSION['biz_rep_err']['errors']) { ?>
	<div class="modal" id="model_allfields">
	<a style="cursor:pointer" onClick="close_div();">
		<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
	</a>
	<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
	<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['errors'];?></div>
</div>
<?php } ?>
<div class="mid_contant">
	<h2 class="title">Send: Who Are You iftGifting?</h2>
	<div class="cont_bar">
		<h3>What is the cash amount you want to send?</h3>
		<div class="cont_bar_inner">	
			<div class="regs_form regs_form_b">
				<form method="post" id="myForm" action="<?php echo ru; ?>process/process_recipit.php" class="suggest_form">
					<input type="hidden" name="userId" id="userId" value="<?php echo $userId;?>">
					<?php if(isset($_SESSION['DRAFT']['delivery_id']) || isset($_SESSION['recipit_id']['New'])) {?>
						<input type="hidden" name="recipt_id" id="recipt_id" value="<?php echo $delivery_id; ?>">
						
					<?php } else { ?>
						<input type="hidden" name="SaveRecipits" id="SaveRecipits" value="1">
					<?php } ?>
					<div class="flied cash_gift">
						<label>Cash Gift *</label>
						<input type="text" name="cash_amount" id="cash_amount"  <?php if($_SESSION['biz_rep_err']['cash_amount'] || $_SESSION['biz_rep_err']['errors']) { ?> class="hightlight" <?php } ?> placeholder="$0.00" value="<?php echo $_SESSION['biz_rep']['cash_amount'];?>" onkeypress="changecolor()" onclick="changetext();">
						<?php if($_SESSION['biz_rep_err']['cash_amount']) { ?>	
							<div class="modal" id="model_cash">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['cash_amount']; ?></div>
							</div>
						<?php } ?>
						<p class="follow_perms">Your recipient can use this to buy from<br/>your suggestions, to shop for other items<br/>or they can transfer the cash to their bank.</p>		
					</div>
					<h4>Tell us about your recipient ...</h4>
					
					<div class="flied">
						<label>First Name *</label>
						<input type="text" name="first_name" id="first_name" <?php if($_SESSION['biz_rep_err']['first_name'] || $_SESSION['biz_rep_err']['errors']) { ?> class="hightlight" <?php } ?> placeholder="First Name" value="<?php echo $_SESSION['biz_rep']['first_name'];?>" />
						<?php if($_SESSION['biz_rep_err']['first_name']) { ?>
							<div class="modal" id="model_fname">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['first_name']; ?></div>
							</div>
						<?php } ?>
					</div>
					<div class="flied">
						<label>Last Name</label>
						<input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo $_SESSION['biz_rep']['last_name'];?>" />
					</div>
					<div class="flied">
						<label>Email *</label>
						<input type="text" name="email" id="email" <?php if($_SESSION['biz_rep_err']['email'] || $_SESSION['biz_rep_err']['errors']) { ?> class="hightlight" <?php } ?> placeholder="Email" value="<?php echo $_SESSION['biz_rep']['email'];?>" />
						<?php if($_SESSION['biz_rep_err']['email']) { ?>
							<div class="modal" id="model_email">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['email']; ?></div>
							</div>
						<?php } ?>
					</div>
					<div class="flied">
						<label>Gender *</label>
						<div class="select select_b <?php if($_SESSION['biz_rep_err']['gender'] || $_SESSION['biz_rep_err']['errors']) { ?> hightlight <?php } ?>" id="gnd">
							<select name="gender" id="gender" class="custom-select">
								<option>Select</option>
								<option value="female" <?php if($_SESSION['biz_rep']['gender'] == 'female') { ?> selected="selected" <?php } ?>>Female</option>
								<option value="male" <?php if($_SESSION['biz_rep']['gender'] == 'male') { ?> selected="selected" <?php } ?>>Male</option>
                    		</select>
						</div>
						<?php if($_SESSION['biz_rep_err']['gender']) { ?>
							<div class="modal" id="model_gender">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['gender'];?></div>
							</div>
						<?php } ?>
					</div>
					<div class="flied">
						<label> Age *</label>
						<input type="text" name="age" id="age" <?php if($_SESSION['biz_rep_err']['age'] || $_SESSION['biz_rep_err']['errors']) { ?> class="hightlight" <?php } ?> placeholder="(Guess if necessary)" value="<?php echo $_SESSION['biz_rep']['age'];?>" />
						<?php if($_SESSION['biz_rep_err']['age']) { ?>
							<div class="modal" id="model_age">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['age']; ?></div>
							</div>
						<?php } ?>
					</div>
					<div class="flied">
						<label>Location</label>
						<div class="select select_b" id="loc">
							<select name="location" id="location" class="custom-select">
								<option>State</option>
								<?php foreach($StateAbArray as $key => $val) { ?>
								<option value="<?php echo $key;?>" <?php if($_SESSION['biz_rep']['location'] == $key) { ?> selected="selected" <?php } ?>><?php echo $val;?></option>
								<?php } ?>	                
                    		</select>
						</div>
					</div>
					<div class="flied">
						<label>Occasion: *</label>
						<div class="select select_b <?php if($_SESSION['biz_rep_err']['ocassion'] || $_SESSION['biz_rep_err']['errors']) { ?> hightlight <?php } ?>" id="gg">
							<select name="ocassion" id="ocassion" class="custom-select">
								<option>Event</option>
								<?php
								$pcatQry = mysql_query("SELECT occasionid, occasion_name from ".tbl_occasion." where occasion_type = 1 and status = 1");
								while($pshort = mysql_fetch_array($pcatQry)){
								?>
								<optgroup label="<?php echo $pshort['occasion_name']; ?>">
								<?php 
								$catQry = mysql_query("SELECT occasionid, occasion_name from ".tbl_occasion." where p_occasionid = ".$pshort['occasionid']." and status = 1");
                				while($short = mysql_fetch_array($catQry)){?>
								<option value="<?php echo $short['occasionid']; ?>" <?php if($_SESSION['biz_rep']['ocassion']==$short['occasionid']) { echo 'selected="selected"';}?>><?php echo $short['occasion_name']; ?></option>
								<?php }	
								?>
								</optgroup>
								<?php
								} ?>   
								<optgroup label="Other&acute;s">
									<option value="other" <?php if($_SESSION['biz_rep']['ocassion']=='other') { echo 'selected="selected"';}?>>Other</option>  
								 </optgroup>  
							</select>
						</div>
						<?php if($_SESSION['biz_rep_err']['ocassion']) { ?>
							<div class="modal" id="model_ocassion">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['ocassion']; ?></div>
							</div>
						<?php } ?>
					</div>
					
					<div class="flied" style=" <?php if($_SESSION['biz_rep']['ocassion'] == 'other') {  ?>display:block<?php } else {?>display:none;<?php } ?>"  id="othertxt1" >
						<label> Other: *</label>
						<input type="text" name="ocassion1" id="ocassion1" <?php if($_SESSION['biz_rep_err']['ocassion1'] || $_SESSION['biz_rep_err']['errors']) { ?> class="hightlight" <?php } ?> placeholder="input Your Occasion" value="<?php echo $_SESSION['biz_rep']['ocassion1'];?>" />
						<?php if($_SESSION['biz_rep_err']['ocassion1']) { ?>
							<div class="modal" id="model_ocassion1">
								<a style="cursor:pointer" onClick="close_div();">
									<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
								</a>
								<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
								<div class="valid_msg"><?php echo $_SESSION['biz_rep_err']['ocassion1']; ?></div>
							</div>
						<?php } ?>
						</div>
					
					<input type="submit" class="orange" name="SaveRecipit" id="SaveRecipit" value="Continue" />
					<?php if(isset($_SESSION['LOGINDATA']['ISLOGIN'])) {?>
					<input type="submit" class="orange save_resume" name="SaveDraft" id="SaveDraft" value="Save & Resume Later" />
					<?php } ?>
					<p class="info">We never reveal any information to a third party without consent. Click here to view our Privacy Policy.<br/>* Indicates a required field</p>
				</form>	
			</div>
		</div>
	</div>
</div>
<script>
function changecolor() {
	$('#cash_amount').css('color','#006600');
}
function changetext() {
	var value = $("#cash_amount").val('$');
	$('#cash_amount').attr('value');
}
//$.noConflict();
function othertext() {
	$('#othertxt1').show('slow');
}
$('#ocassion').change(function() {
    if ($(this).val() === 'other') {
       $('#othertxt1').show();
    } else {
		$('#othertxt1').removeAttr("name");
		 $('#othertxt1').hide();
	}
});

</script>
<?php /*?><?php if(isset($_SESSION['COPYINFO'])){?>
<script type="text/javascript">
$(function(){
var myString = "<?PHP echo  $_SESSION['COPYINFO']?>";
//alert(myString);
var mySplitResult = myString.split(",");
	var first_name=mySplitResult[0];
	var last_name=mySplitResult[1];
	var occasions=mySplitResult[2];
	var cash=mySplitResult[3];
	var occas=mySplitResult[4];
	$("#first_name").val(first_name);
	$("#last_name").val(last_name);
	$("#cash_amount").val(cash);
	var occ = occasions.split("_");
	
	//alert(occ[1]);
	//$("#ocassion").val(occasions);
	$("select option").each(function() {
	  if (occ[0] == "Event") {
	  	//$(occ[1]).attr("selected", "selected");
	   	$('#othertxt1').hide();
		$("#ocassion :selected").text(occ[1]);
		$("#ocassion :selected").val(occas);
	   	$("#gg .holder").text(occ[1]);
		$("#gg .holder").val(occas);
   	// return $(this).text() == occasions; 
	} else if(occ[0] == "other"){
		$(this).attr("selected", "selected");
			$("#ocassion1").val(occ[1]);
			 $('#othertxt1').show();
			 $("#gg .holder").text("other");
            
	}
	return;
	});
});
</script>
<?php } ?><?php */?>
<?php 
unset($_SESSION['biz_rep_err']);
unset($_SESSION['biz_rep']);
?>