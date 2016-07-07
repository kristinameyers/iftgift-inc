<?php
if(!isset($_SESSION['recipit_id']['New']) && !isset($_SESSION['DRAFT']['delivery_id'])) {
	header('location:'.ru.'dashboard'); exit;
}

if(isset($_SESSION['recipit_id']['New']) ){
 $get_recipit = "select r.recp_first_name,r.recp_last_name,r.delivery_id,r.recp_email,r.cash_amount,r.occassionid,r.gender,r.age,r.location,r.proid,o.occasionid,o.occasion_name from ".tbl_delivery." as r left join ".tbl_occasion." as o on r.occassionid=o.occasionid where r.delivery_id = '".$_SESSION['recipit_id']['New']."'";
	$recip_info = $db->get_row($get_recipit,ARRAY_A);
	$gift_id = $_SESSION['recipit_id']['New'];
	$cash = $recip_info['cash_amount'];
	$ocassion = $recip_info['occassionid'];
	$firstname = $recip_info['recp_first_name'];
	$lastname = $recip_info['recp_last_name'];
	$email = $recip_info['recp_email'];
} else if(isset($_SESSION['DRAFT']['delivery_id'])){  
	$query = mysql_fetch_array(mysql_query("select * from ".tbl_delivery." where delivery_id = '".$_SESSION['DRAFT']['delivery_id']."'"));
	$gift_id =$query['delivery_id']; 
	$cash = $query['cash_amount'];
	$firstname = $query['recp_first_name'];
	$lastname = $query['recp_last_name'];
	$email = $query['recp_email'];
	$_SESSION['dev_detail']['date_future'] =$query['date'];
	$_SESSION['dev_detail']['time_future'] =$query['time'];
	$_SESSION['dev_detail']['udate_future']=$query['unlock_date'];
	$_SESSION['dev_detail']['utime_future']= $query['unlock_time'];
	$_SESSION['dev_detail']['game_flag']   = $query['game_flag'];
	$_SESSION['dev_detail']['email_sub']   = $query['email_subject'];
	$_SESSION['dev_detail']['notes']   = $query['notes'];
	
	$ocassions = explode("_",$query['occassionid']);
	if($query['occassionid'] == 'other_'.$ocassions[1]){
		$ocassion = $query['occassionid'];
	} else {
		$ocassion = $query['occassionid'];
	}
	$proid = json_decode($query['proid'],true);
	//print_r($proid);
		if($proid) { 
		
		/*foreach($proid as $pro){
				$captionss[] = $pro['caption'];
				$_SESSION['dev_detail']['captions']=$captionss;
				$product_id[] = $pro['proid'];
				//$product_id = $pro['productid']; 
		}*/
	 	$_SESSION['cart'] = $proid;
	}
	
}
$get_sender = "select first_name,last_name,email from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'";
$sender_info = $db->get_row($get_sender,ARRAY_A);
?>	
<link rel="stylesheet" href="<?php echo ru_resource?>js/datepicker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo ru_resource?>js/time_picker/timepicker.css" type="text/css" />
<script src="<?php echo ru_resource?>js/datepicker/jquery-ui.js"></script>
<script src="<?php echo ru_resource?>js/time_picker/jquery.ui.timepicker.js?v=0.3.3"></script>
<script type="text/javascript" src="<?php echo ru_resource?>js/time_picker/jquery.ui.core.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $(".curent_date").click(function(event){
	$("#time_flied").show('slow'); 
	$("#Sevenfteen").prop('checked', true);
	$("#time_flied_c").show('slow');
	$("#time_flied_b").hide();
	$("#time_flied_d").hide();
	var d=new Date();
	var dat=d.getDate();
	var mon=d.getMonth()+1;
	var year=d.getFullYear();
	if(dat<10){
		dat='0'+dat
	} 
	if(mon<10){
		mon='0'+mon
	} 
	var todayDate = mon+"/"+dat+"/"+year;
	$('#datepickers').val(todayDate);
	$('#uidatepickers').val(todayDate);
	
	var date=new Date();
	var hours = date.getHours();
	var ampm = hours >= 12 ? 'PM' : 'AM'; 
	var minutes = date.getMinutes();
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	hours = hours < 10 ? '0'+hours : hours;
	minutes = minutes < 10 ? '0'+minutes : minutes;
	$('#timepicker').val(hours+':'+minutes+' '+ampm);
	$('#uitimepicker').val(hours+':'+minutes+' '+ampm);
  });
  
  
  $(".featured_date").click(function(){
	$("#time_flied_b").show('slow');
	$("#Sevenfteen").prop('checked', false);
	$("#time_flied_c").hide();
	$("#time_flied").hide();
	$("#datepickers").val("");
	$("#timepicker").val("");
  });
		
  //$("#datepickers").datepicker({ minDate: 0 });
  $("#fdatepickers").datepicker({ minDate: 0 });
  
  /*$('#timepicker').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true
  });*/
 
  $('#ftimepicker').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true
  });
  
});


$(document).ready(function(){
  $(".curent_date_b").click(function(){
	$("#time_flied_c").show('slow');
	$("#time_flied_d").hide();
	var d=new Date();
	var dat=d.getDate();
	var mon=d.getMonth()+1;
	var year=d.getFullYear();
	if(dat<10){
		dat='0'+dat
	} 
	if(mon<10){
		mon='0'+mon
	} 
	var todayDate = mon+"/"+dat+"/"+year;
	$('#datepickers').val(todayDate);
	$('#uidatepickers').val(todayDate);
	
	var date=new Date();
	var hours = date.getHours();
	var ampm = hours >= 12 ? 'PM' : 'AM'; 
	var minutes = date.getMinutes();
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	hours = hours < 10 ? '0'+hours : hours;
	minutes = minutes < 10 ? '0'+minutes : minutes;
	$('#timepicker').val(hours+':'+minutes+' '+ampm);
	$('#uitimepicker').val(hours+':'+minutes+' '+ampm);
  });

  $(".featured_date_b").click(function(){
	$("#time_flied_d").show('slow');
	$("#time_flied_c").hide();
	$("#uidatepickers").val("");
	$("#uitimepicker").val("");
  });
  
  /*$("#uidatepickers").datepicker({ minDate: 0 });*/
  $("#ufdatepickers").datepicker({ minDate: 0 });
  
  /*$('#uitimepicker').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true
  });*/
 
  $('#uftimepicker').timepicker({
	showMinutes: true,
	showPeriod: true,
	showLeadingZero: true
  });
  
  
  
 $(".caption").click(function(){
 	var pid = this.id;
	var cap = pid.replace("caption_", ""); 
	//alert(cap);
	$("#add_caption_"+cap).show();
	$("#textcursor_"+cap).focus();
	$("#caption_"+cap).hide();
 });
		
});

function del(pid){
	var myData = 'productid='+pid+'&type=delete';
	$.ajax({
		url: "<?php echo ru;?>process/process_cart.php",
		type: "GET",
		data: myData,
		success:function(output) {
			//window.location = "<?php echo ru;?>delivery_detail";
			window.location = "<?php echo ru;?>step_2a";
		}
	});
}
	
function cancel_iftgift(dId)
{
	var delivery = dId;
	$.ajax({
	url: '<?php echo ru;?>process/process_delivery.php?dId='+delivery,
	type: 'get', 
	success: function(output) {
	if(output == 'Success')
	{
		window.location = "<?php echo ru?>dashboard";
	}
	}
	});
}	

$(document).ready(function() {
  $("#test-list").sortable({
  	axis: "x"
  });
});



$(document).ready(function(){
	var d2=new Date();
	var dat=d2.getDate();
	var mon=d2.getMonth()+1;
	var year=d2.getFullYear();
	if(dat<10){
		dat='0'+dat
	} 
	if(mon<10){
		mon='0'+mon
	} 
	var hours = d2.getHours();
	var ampm = hours >= 12 ? 'PM' : 'AM'; 
	var minutes = d2.getMinutes();
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	hours = hours < 10 ? '0'+hours : hours;
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var todayDate = year+"-"+mon+"-"+dat+" "+hours+':'+minutes;
	$('#created_date').val(todayDate);
 	
 }); 
</script>
<div class="mid_contant">
	<ul class="steps">
		<li class="step_a"><a href="<?php echo ru; ?>step_1"><span>1.</span> Enter cash gift and recipient info</a><span class="arrow"></span></li>
		<li class="step_b"><span class="arrow arrow_left"></span><a href="<?php echo ru; ?>step_2a"><span>2.</span> Select your gift suggestions</a><span class="arrow"></span></li>
		<li class="step_a step_c active"><span class="arrow arrow_left"></span><a href="<?php echo ru; ?>delivery_detail"><span>3.</span> Delivery details</a><span class="arrow"></span></li>
		<li class="step_c step_d"><span class="arrow arrow_left"></span><a href="javascript:;"><span>4.</span> Checkout</a></li>
	</ul>
	<div class="cont_bar">
		<div class="cont_bar_inner cont_bar_inner_b">
			<a href="javascript:;" onclick="cancel_iftgift('<?php echo $gift_id; ?>')" class="cancel_btn">CANCEL IFTGIFT</a>
			<form id="devform" method="post" action="<?php echo ru; ?>process/process_delivery.php">
				<input type="hidden" name="occassionid" value="<?php echo $ocassion; ?>"  />
				<input type="hidden" name="dated" id="created_date" value="" />
				<? if(isset($_SESSION['DRAFT']['delivery_id'])) { ?>
					<input type="hidden" name="draft_id" value="<?php echo $_SESSION['DRAFT']['delivery_id']; ?>" />
				<?php } else if(isset($_SESSION['recipit_id']['New'])){ ?>
					<input type="hidden" name="draft_id" value="<?php echo $_SESSION['recipit_id']['New']; ?>" />
					<input type="hidden" name="gender" value="<?php echo $recip_info['gender']; ?>" />
					<input type="hidden" name="age" value="<?php echo $recip_info['age']; ?>" />
					<input type="hidden" name="location" value="<?php echo $recip_info['location']; ?>" />
				<?php } ?>
				<div class="box">
					<div class="num_outer">
						<div class="one">1</div>
					</div>
					<h4>Is the cash gift you want to send still ...</h4>
					<div class="flied cash_gft">
						<input type="text" placeholder="Amount" name="amount" value="$<?php echo $cash; ?>"  />
						<span>(Enter new amount if desired)</span>
					</div>
				</div>		
				<div class="box blue">
					<div class="num_outer">
						<div class="one">2</div>
					</div>
					<h4>Confirm Contact Info</h4>
					<div class="form_bar">
						<div class="flied_outer">
							<img src="<?php echo ru_resource; ?>images/recp.jpg" alt="Recipient Image" class="recp_img" />
							<div class="flied">
								<label>First name: <span>*</span></label>
									<input type="text" placeholder="First Name" name="recp_first_name" <?php if(isset($_SESSION['dev_detail_err']['recp_first_name'])) { ?> class="hightlight" <?php } ?> value="<?php echo $firstname; ?>" />
									<?php if(isset($_SESSION['dev_detail_err']['recp_first_name'])) { ?>
										<div class="modal" id="modal_recp_fname">
											<a style="cursor:pointer" onClick="close_div();">
												<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
											</a>
											<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
											<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['recp_first_name']; ?></div>
										</div>
									<?php } ?>
								</div>
								<div class="flied">
									<label>Last name:</label>
									<div class="element">
										<input type="text" placeholder="Last Name" name="recp_last_name" value="<?php echo $lastname; ?>" />
									</div>	
								</div>
								<div class="flied">
									<label>E-mail: <span>*</span></label>
									<input type="text" placeholder="Email" name="recp_email" <?php if($_SESSION['dev_detail_err']['recp_email']) { ?> class="hightlight" <?php } ?> value="<?php echo $email; ?>" />
									<?php if($_SESSION['dev_detail_err']['recp_email']) { ?>
										<div class="modal" id="modal_recp_email">
											<a style="cursor:pointer" onClick="close_div();">
												<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
											</a>
											<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
											<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['recp_email'] ?></div>
										</div>
									<?php } ?>
								</div>
							</div>
							<div class="flied_outer">
								<img src="<?php echo ru_resource; ?>images/you.jpg" alt="You Image" class="you_img" />
								<div class="flied">
									<label>First name: <span>*</span></label>
									<input type="text" placeholder="First Name" name="snd_first_name" <?php if($_SESSION['dev_detail_err']['snd_first_name']) { ?> class="hightlight" <?php } ?> value="<?php echo $sender_info['first_name']; ?>" />
									<?php if(isset($_SESSION['dev_detail_err']['snd_first_name'])) { ?>
										<div class="modal" id="modal_snd_fname">
											<a style="cursor:pointer" onClick="close_div();">
												<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
											</a>
											<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
											<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['snd_first_name']; ?></div>
										</div>
									<?php } ?>	
								</div>
								<div class="flied">
									<label>Last name: <span>*</span></label>
									<input type="text" placeholder="Last Name" name="snd_last_name" <?php if($_SESSION['dev_detail_err']['snd_last_name']) { ?> class="hightlight" <?php } ?> value="<?php echo $sender_info['last_name']; ?>" />
									<?php if(isset($_SESSION['dev_detail_err']['snd_last_name'])) { ?>
										<div class="modal" id="modal_snd_lname">
											<a style="cursor:pointer" onClick="close_div();">
												<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
											</a>
											<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
											<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['snd_last_name']; ?></div>
										</div>
									<?php } ?>		
								</div>
								<div class="flied">
									<label>E-mail: <span>*</span></label>	
									<input type="text" placeholder="Email" name="snd_email" <?php if($_SESSION['dev_detail_err']['snd_email']) { ?> class="hightlight" <?php } ?> value="<?php echo $sender_info['email']; ?>" />
									<?php if($_SESSION['dev_detail_err']['snd_email']) { ?>
										<div class="modal" id="modal_snd_email">
											<a style="cursor:pointer" onClick="close_div();">
												<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
											</a>
											<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
											<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['snd_email'] ?></div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<div class="box blue orang">
						<div class="num_outer">
							<div class="one">3</div>
						</div>
						<h4>Delivery Date and Time</h4>
						<div class="form_bar">
							<div class="sugget_left">
								<h4>When should we <span>notify</span> them about this iftGift?</h4>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" value="1" id="fifteen" name="notify" <?php if($_SESSION['dev_detail_err']['date_imd'] || $_SESSION['dev_detail_err']['time_imd'] || $_SESSION['dev_detail']['date_imd'] || $_SESSION['dev_detail']['time_imd']) { ?>checked="checked"<?php } else { } ?> />
										<label for="fifteen" class="curent_date"></label>
									</div>
									<label>IMMEDIATELY</label>
								</div>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" value="2" id="sixteen" name="notify" <?php if($_SESSION['dev_detail_err']['date_future'] || $_SESSION['dev_detail_err']['time_future'] || $_SESSION['dev_detail']['date_future'] || $_SESSION['dev_detail']['time_future']) { ?>checked="checked"<?php } else { } ?> />
										<label for="sixteen" class="featured_date"></label>
									</div>
									<label>SET FUTURE DATE</label>
									<?php echo $_SESSION['dev_detail']['notify']; ?>
								</div>
								<?php if($_SESSION['dev_detail_err']['notify']) { ?>
									<div class="modal" id="modal_notify">
										<a style="cursor:pointer" onClick="close_div();">
											<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
										</a>
										<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
										<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['notify'] ?></div>
									</div>
								<?php } ?>
								<div class="time_flied" id="time_flied" <?php if($_SESSION['dev_detail_err']['date_imd'] || $_SESSION['dev_detail_err']['time_imd'] || ($_SESSION['dev_detail']['date_imd'] || $_SESSION['dev_detail']['time_imd'] && $_SESSION['dev_detail']['notify'] == '1')) {  } else {?> style="display:none"<?php } ?>>
									<div class="flied">
										<input type="text" placeholder="Date" name="date_imd" id="datepickers" <?php if($_SESSION['dev_detail_err']['date_imd']) { ?> class="hightlight" <?php } ?> value="" />
										<?php if($_SESSION['dev_detail_err']['date_imd']) { ?>
											<div class="modal" id="date_imd">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['date_imd'] ?></div>
											</div>
										<?php } ?>
										<input type="text" placeholder="Times" name="time_imd" id="timepicker" <?php if($_SESSION['dev_detail_err']['time_imd']) { ?> class="hightlight" <?php } ?> value="" />
										<?php if($_SESSION['dev_detail_err']['time_imd']) { ?>
											<div class="modal" id="date_imd">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['time_imd'] ?></div>
											</div>
										<?php } ?>
									</div>
								</div>
								<div class="time_flied" id="time_flied_b" <?php if($_SESSION['dev_detail_err']['date_future'] || $_SESSION['dev_detail_err']['time_future'] || $_SESSION['dev_detail']['date_future'] || $_SESSION['dev_detail']['time_future'] && $_SESSION['dev_detail']['notify'] == '2') {  } else {?> style="display:none"<?php } ?>>
									<div class="flied">
										<input type="text" placeholder="mm/dd/yyyy" name="date_future" <?php if($_SESSION['dev_detail_err']['date_future']) { ?> class="hightlight" <?php } ?> id="fdatepickers" value="<?php echo $_SESSION['dev_detail']['date_future']?>" />
										<?php if($_SESSION['dev_detail_err']['date_future']) { ?>
											<div class="modal" id="modal_date_future">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['date_future'] ?></div>
											</div>
										<?php } ?>
										<input type="text" placeholder="00:00 PM" name="time_future" <?php if($_SESSION['dev_detail_err']['time_future']) { ?> class="hightlight" <?php } ?>  id="ftimepicker" value="<?php echo $_SESSION['dev_detail']['time_future']?>" />
										<?php if($_SESSION['dev_detail_err']['time_future']) { ?>
											<div class="modal" id="modal_time_future">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['time_future'] ?></div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="sugget_left">
								<h4>When should we allow them to <span>unlock</span> this iftGift?</h4>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" value="1" id="Sevenfteen" name="unlock" <?php if($_SESSION['dev_detail_err']['uidate_imd'] || $_SESSION['dev_detail_err']['uftime_imd']) { ?>checked="checked"<?php } else { } ?> />
										<label for="Sevenfteen" class="curent_date_b"></label>
									</div>
									<label>IMMEDIATELY upon notification</label>
								</div>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" value="2" id="Eightteen" name="unlock" <?php if($_SESSION['dev_detail_err']['udate_future'] || $_SESSION['dev_detail_err']['utime_future'] || $_SESSION['dev_detail']['udate_future'] || $_SESSION['dev_detail']['utime_future']) { ?>checked="checked"<?php } else { } ?> />
										<label for="Eightteen" class="featured_date_b"></label>
									</div>
									<label>SET FUTURE DATE</label>
									<?php echo $_SESSION['dev_detail']['unlock']; ?>
								</div>
								<?php if($_SESSION['dev_detail_err']['unlock']) { ?>
									<div class="modal" id="modal_unlock">
										<a style="cursor:pointer" onClick="close_div();">
											<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
										</a>
										<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
										<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['unlock'] ?></div>
									</div>
								<?php } ?>
								<div class="time_flied" id="time_flied_c" <?php if($_SESSION['dev_detail_err']['uidate_imd'] || $_SESSION['dev_detail_err']['uftime_imd']) {  } else {?> style="display:none"<?php } ?>>
									<div class="flied">
										<input type="text" placeholder="Date" name="uidate_imd" <?php if($_SESSION['dev_detail_err']['uidate_imd']) { ?> class="hightlight" <?php } ?> id="uidatepickers" value="" />
										<?php if($_SESSION['dev_detail_err']['uidate_imd']) { ?>
											<div class="modal" id="date_imd">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['uidate_imd'] ?></div>
											</div>
										<?php } ?>
										<input type="text" placeholder="Time" name="uftime_imd" <?php if($_SESSION['dev_detail_err']['uftime_imd']) { ?> class="hightlight" <?php } ?> id="uitimepicker" value="" />
										<?php if($_SESSION['dev_detail_err']['uftime_imd']) { ?>
											<div class="modal" id="date_imd">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['uftime_imd'] ?></div>
											</div>
										<?php } ?>
									</div>
								</div>
								<div class="time_flied" id="time_flied_d" <?php if($_SESSION['dev_detail_err']['udate_future'] || $_SESSION['dev_detail_err']['utime_future'] || $_SESSION['dev_detail']['udate_future'] || $_SESSION['dev_detail']['utime_future'] && $_SESSION['dev_detail']['notify'] == '2') {  } else {?> style="display:none"<?php } ?>>
									<div class="flied">
										<input type="text" placeholder="mm/dd/yyyy" name="udate_future" <?php if($_SESSION['dev_detail_err']['udate_future'])  { ?> class="hightlight" <?php } ?> id="ufdatepickers" value="<?php echo $_SESSION['dev_detail']['udate_future']?>" />
										<?php if($_SESSION['dev_detail_err']['udate_future']) { ?>
											<div class="modal" id="modal_udate_future">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['udate_future'] ?></div>
											</div>
										<?php } ?>
										<input type="text" placeholder="00:00 PM" name="utime_future" <?php if($_SESSION['dev_detail_err']['utime_future']) { ?> class="hightlight" <?php } ?> id="uftimepicker" value="<?php echo $_SESSION['dev_detail']['utime_future']?>" />
										<?php if($_SESSION['dev_detail_err']['utime_future']) { ?>
											<div class="modal" id="modal_utime_future">
												<a style="cursor:pointer" onClick="close_div();">
													<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
												</a>
												<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
												<div class="valid_msg"><?php echo $_SESSION['dev_detail_err']['utime_future'] ?></div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>				
							<?php /*?><div class="sugget_left sugget_left_b">
								<h4>Would you like them to complete a game to <span>unlock</span> this iftGift? <span class="recp_attmp">(If the recipient is not successful after 2 attempts, the gift automatically opens.)</span>
								</h4>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" value="1" id="game_flag" name="game_flag" <?php if($_SESSION['dev_detail_err']['game_flag'] || $_SESSION['dev_detail']['game_flag'] == '1'){ ?>checked="checked"<?php } else { } ?> />
										<label for="game_flag"></label>
									</div>
									<label>YES</label>
								</div>
								<div class="terms">
									<div class="squaredFour left">
										<input type="radio" value="0" id="game_flag2" name="game_flag" <?php if($_SESSION['dev_detail_err']['game_flag'] || $_SESSION['dev_detail']['game_flag'] == '0'){ ?>checked="checked"<?php } else { } ?> />
										<label for="game_flag2"></label>
									</div>
									<label>NO</label>
								</div>
								<div class="terms terms_d">
									<img src="<?php echo ru_resource; ?>images/jester_ay.png" alt="Jester Image" />
									<!--<a href="<?php //echo ru;?>iftgiftgame">Click to learn more about the game</a>-->
									<a style="cursor:pointer"  onClick="divopen();">Click to learn more about the game</a>
								</div>
							</div><?php */?>
						</div>
					</div>
					<div class="box blue green">
						<div class="num_outer">
							<div class="one">4</div>
						</div>
						<h4>Make Your Suggestions More Meaningful: <span>(Drag &lsquo;n Drop to rearrange order of suggestions)</span></h4>
						<div class="form_bar">
							<?php /*?><div id="info">Waiting for update</div> <?php */?>
							
							<ul id="test-list">
								<?php 
									include_once("process/cart_functions.php");
									$max=count($_SESSION['cart']);
									for($i=0;$i<$max;$i++){
										$pid=$_SESSION['cart'][$i]['proid'];
										$q=$_SESSION['cart'][$i]['qty'];
										$pname=get_product_name($pid);
										$image=get_pro_image($pid);
										$imges=get_image_name($pid);
								?>
										<li id="listItem_<?php echo $pid?>"> 
										<?php if($imges != ''){ ?>
											<img src="<?php echo $imges ;?>" class="handle" width="113" height="113" alt="<?php  echo substr($pname,0,30);?>" />
										<?php }else{ ?>
											<img src="<?php  get_image($image);?>" class="handle" width="113" height="113" alt="<?php  echo substr($pname,0,30);?>" />
										<?php } ?>
											<?php /*?><img src="<?php  get_image($image);?>" class="handle" width="113" height="113" alt="<?php  echo substr($pname,0,30);?>" /><?php */?><?php if($s) { }else { ?> 
												<a href="javascript:del(<?php echo $pid?>)"><img src="<?php echo ru_resource; ?>images/refresh_icon.png" alt="Refresh Icon" class="refresh" /></a>	<?php }?>
												<h5><?php  echo substr($pname,0,20);?></h5>
												<h5 class="price">$<?php  echo get_prices($pid);?></h5>
												<div class="caption" id="caption_<?php echo $pid; ?>" <?php if($_SESSION['cart'][$i]['caption'] != '') {?>  style="display:none"<?php } else { }?>>ADD CAPTION (optional)</div>
												<div class="caption enter_caption" id="add_caption_<?php  echo $pid; ?>" <?php if($_SESSION['dev_detail']['captions'] != '' || $_SESSION['cart'][$i]['caption'] != '') { } else { ?> style="display:none" <?php } ?>  >
													<textarea name="captions[]" <?php if($_SESSION['dev_detail_err']['captions']) { ?> class="hightlight" <?php } ?> id="textcursor_<?php echo $pid; ?>" maxlength="200" placeholder="Enter your caption here max 200 characters." ><?php echo $_SESSION['cart'][$i]['caption']; ?></textarea> 
												</div>
												<h5 class="price cap_count" id="chars_<?php echo $pid; ?>">200 Characters</h5>
												<input type="hidden" name="proid[]" value="<?php echo $pid; ?>" />	
										</li>
								<?php } ?>		
							</ul>	
							<div class="or"><div class="line"><span>(Drag 'n Drop to rearrange order of suggestions) </span></div></div>
						</div>
					</div>
					<div class="box blue">
						<div class="num_outer">
							<div class="one">5</div>
						</div>
						<h4>Personalize Your Notification Email</h4>
						<div class="form_bar">
							<div class="flied flied_c">
								<p class="mesge"><span>RE:Guard<sup>SM</sup></span> - To prove it&rsquo;s you, and not SPAM, add text only the two of you know. <span class="exp">Example: It was awesome seeing you Saturday@Joe&rsquo;s</span></p>
								<div class="send_flied">
									<img src="<?php echo ru_resource; ?>images/ift_monogram_b.png" >
									<label>It&rsquo;s Fun Time - <?php echo ucfirst($sender_info['first_name']); ?> has sent you an iftGift&nbsp;</label>
									<input type="text" name="email_sub" id="email_sub" placeholder="(Add your RE:Guard text here ...)" value="<?php echo $_SESSION['dev_detail']['email_sub']; ?>"/>
								</div>
								<textarea name="notes" id="notes" placeholder="(Enter email message here ...)"><?php echo $_SESSION['dev_detail']['notes']; ?></textarea>
							</div>
						</div>
					</div>
					<div class="box_btm"></div>
					<div class="deliv_btn">
						<input type="submit" id="delivery_detail" name="delivery_detail" value="COMPLETE ORDER" class="orange" />
						<input type="submit" class="orange save_resume" name="SaveDraft" id="SaveDraft" value="Save & Resume Later" />
					</div>
				</form>
				<img src="<?php echo ru_resource; ?>images/jester_m.jpg" alt="Jester Image" class="sleep_jester" />
			</div>
		</div>
		<?php if($_SESSION['dev_detail_err']) { ?>
			<div class="overlay"></div>
		<?php } ?>
	</div>
</div>	
<div class="overlay" style="display:none"></div>
<div class="modal modal_d" id="model_allfield1" style="display:none">
	<a style="cursor:pointer" onclick="divclose();" class="cross_btn"><img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" /></a>
	<h4>IftGift Slayer</h4>
	<p class="jest_tray">The objective of the game is to break rows of multi-colored gift boxes by bouncing the gift box between the s'Jester's tray and the gift boxes above. The game is won when all of the multicolored gift boxes are broken.</p>
	<p>Press <span>ENTER to START</span> the game.</p>
	<p>Use the <span>ARROW KEYS</span> to launch ball to move the <span>LEFT</span> and <span>RIGHT.</span></p>
	<p>Use the <span>UP ARROW</span> to <span>LAUNCH</span> the golden gift box upward.</p>
	<p>Press <span>P to PAUSE.</span></p>
	<a class="orange orange_b orange_c" onClick="divclose();">Back to the Game</a>
</div>
<style>
.hightlight{border:1px solid red !important}
</style>
<?php
unset($_SESSION['dev_detail_err']);
unset($_SESSION['dev_detail']);
?>
<script>
function goto_s2a() {
	window.location = "<?php echo ru?>step_2a";
}
</script>

<script >
$(document).ready( function() {
$(".caption").click(function(){
 	var pid = this.id;
	var cap = pid.replace("caption_", ""); 
	var elem = $("#chars_"+cap);
	$("#textcursor_"+cap).limiter(200, elem);
});
});
(function($) {
	$.fn.extend( {
		limiter: function(limit, elem) {
			$(this).on("keyup focus", function() {
				setCount(this, elem);
			});
			function setCount(src, elem) {
				var chars = src.value.length;
				if (chars > limit) {
					src.value = src.value.substr(0, limit);
					chars = limit;
				}
				elem.html( limit - chars );
			}
			setCount($(this)[0], elem);
		}
	});
})(jQuery);

</script>
<script>

function divopen() {
	$('.overlay').show();
	$('#model_allfield1').slideDown();
}
function divclose() {
	$('.overlay').slideUp(500);
	$('#model_allfield1').slideUp(500);
}
</script>