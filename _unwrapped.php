<?php //unset($_SESSION['cart']);

$delivery_id = $_GET['s'];
$get_dev = $db->get_row("select * from ".tbl_delivery." where delivery_id = '".$delivery_id."'",ARRAY_A);
$occassionid = $get_dev['occassionid'];
$cash_amount = $get_dev['cash_amount'];
$get_user = $db->get_row("select user_image,available_cash,party_mode from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
$thumb_image_location = ru."media/user_image/".$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$get_user['user_image'];
if (@getimagesize($thumb_image_location)) {
	$user_image = ru."media/user_image/".$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$get_user['user_image'];
} else {
	$user_image = ru_resource."images/upload_img_b.jpg";
}
$available_cash = $get_user['available_cash'];
$party_mode = $get_user['party_mode'];
$get_occas = $db->get_row("select occasion_name from ".tbl_occasion." where occasionid = '".$occassionid."'",ARRAY_A);
///new code occasion
$getoccss = explode("_",$occassionid);
//print_r($getoccss);
	if($occassionid == 'other_'.$getoccss[1]){
		$occasion_name = $getoccss[1];
	}else{
		$occasion_name =$get_occas['occasion_name'];
		}
?>
<div class="mid_contant">
		<h2 class="title">Unwrap: Pending iftGift</h2>
		<div class="cont_bar">
			<div class="mile_birthday"><img src="<?php echo $user_image?>" width="48" height="62" /><h3>Your <?php echo $occasion_name;?> iftGift from <?php echo $get_dev['giv_first_name'].' '.$get_dev['giv_last_name'];?></div>
			<div class="unwrp_right unlock_right">
				<label>Party Mode!</label>
				<div class="on_off">
					<a href="javascript:;" id="off" class="off <?php if($party_mode == 'off' || $party_mode == '') { ?>active<?php } ?>">OFF</a>
					<a href="javascript:;" id="on" class="on <?php if($party_mode == 'on') { ?>active<?php } ?>">ON</a>
				</div>
				<p>OFF reveals cash amount. <br/>ON hides cash amount, <br/>but displays your iftGifts.</p>
			</div>
			<script type="text/javascript">
			$('.on_off a').on('click', function() {
				var id = $(this).attr('id');
				var uid = '<?php echo $_SESSION['LOGINDATA']['USERID']; ?>';
				$.ajax({
				url: '<?php echo ru;?>process/process_mode.php',
				type: 'POST', 
				data: {mode:id,userid:uid} ,
				success: function(output) {
					if(output == 'on')
					{
						$('#row_dim').hide();
						$('#on').addClass('active');
						$('#off').removeClass('active');
						$('.locker').show();
					} else {
						$('#row_dim').show(); 
						$('#off').addClass('active');
						$('#on').removeClass('active');
						$('.locker').hide();
					}
				}
				})
			});
			</script>
			<div class="cont_bar_inner">
				<div class="unlock_time">
					<h4>Unlocks in:</h4>
					<div class="unlock_time_inner">
						<div class="time_bar">
							<div class="time_bar_inner">O</div>
							<span>WEEKS</span>
						</div>
						<div class="time_bar">
							<div class="time_bar_inner">P</div>
							<span>DAYS</span>
						</div>
						<div class="time_bar">
							<div class="time_bar_inner">E</div>
							<span>HOURS</span>
						</div>
						<div class="time_bar">
							<div class="time_bar_inner">N</div>
							<span>MINUTES</span>
						</div>
						<div class="time_bar second">
							<div class="time_bar_inner">!</div>
							<span>SECONDS</span>
						</div>
					</div>
					<?php
						$timestamps = strtotime($get_dev['unlock_date']);
						$unlock_date = date('l F d, Y', $timestamps);
					?>
					<div class="unlock_day opon_day"><?php echo $unlock_date?> @ <?php echo $get_dev['unlock_time']; ?></div>
				</div>
				<div class="safe_bar">
					<div class="safe_bar_inner safe_bar_inner_b">
						<h4>Your Cash Gift</h4>
						<?php if($party_mode == 'off' || $party_mode == '') { ?>
						<div class="total_cash" id="row_dim">
							<h4>$<?php echo number_format($cash_amount,2);?></h4>
							<div class="total_cash_inner">Total Cash Stash<br/><span>$<?php echo number_format($available_cash,2);?></span></div>
						</div>
						<?php } else { ?>
						<div class="total_cash" id="row_dim" style="display:none">
							<h4>$<?php echo number_format($cash_amount,2);?></h4>
							<div class="total_cash_inner">Total Cash Stash <span>$<?php echo number_format($available_cash,2);?></span></div>
						</div>
						<?php } ?>
						<?php if($party_mode == 'on') { ?>
						<img src="<?php echo ru_resource; ?>images/icon_i.jpg"  class="locker" alt="Locker Icon" />
						<?php } else { ?>
						<img src="<?php echo ru_resource; ?>images/icon_i.jpg"  style="display:none" class="locker" alt="Locker Icon" />
						<?php } ?>
					</div>
					
				</div>
				<div class="next_btn open_gift_btn">
					<?php if($get_dev['thank_mail'] == '0') {?>
					<input type="button" onclick="thankyou('<?php echo $get_dev['delivery_id'] ?>')" class="blue" value="Send a Thank You">
					<?php } ?>
					<!--<input type="submit" class="pink" value="Shop iftGift"  onclick="shop_pro();">-->
					<input type="submit" class="pink" value="Shop iftGift"  onclick="shop_pro1();">
					<?php if($_SESSION['cart']) { ?>
					<input type="submit" onclick="shop_cart()" class="orange" value="Checkout">
					<?php } else { ?>
					<input type="button"  id="shoping_cart" class="orange" value="Checkout">
					<?php } ?>
				</div>
				<div class="or your_sugst"><div class="line"><span>Your Suggestions</span></div></div>
				<ul class="gift_box your_suggst">
					<?php
					$proId = $get_dev['proid'];
					$proid = json_decode($proId,true);
					if($proid) {
						foreach($proid as $pro )
						{
							$product_id = $pro['proid'];
							$caption = $pro['caption'];
							$get_pro = "select * from ".tbl_product." where proid = '".$product_id."'";
							$view_pro = $db->get_results($get_pro,ARRAY_A);
							if($view_pro){
							foreach($view_pro as $product)
							{
					?>
					<li>
						<div class="img_box"><img src="<?php  get_image($product['image_code']);?>" width="190" height="190" alt="Suggestion Image" /></div>
						<h5><?php echo substr($product['pro_name'],0,50);?></h5>	
						<h5 class="price">$<?php echo number_format($product['price'],2);?></h5>	
						<div class="terms">
							<input type="hidden" name="proId" id="proId_<?php echo $product_id; ?>"/>
							<input type="hidden" name="type" id="type"/>
							<div class="squaredFour">
								<input type="checkbox" name="cart_product" class="ads_Checkbox" id="<?php echo $product_id ?>" value="<?php echo $product_id ?>">
								<label for="<?php echo $product_id ?>"></label>
							</div>
							<?php /*?><label>Add to Cart</label><?php */?><label>Buy Now</label>
						</div>
						<p>"<?php echo $caption;?>"</p>
					</li>
					<?php } } } } ?>
				</ul>
				<a href="<?php echo ru; ?>dashboard" class="go_deshbord">Go to Your Dashboard</a>
			</div>
		</div>
	</div>
	<div class="modal modal_b modal_c" id="thankyou_div_<?php echo $get_dev['delivery_id']; ?>" style="display:none">
		<a style="cursor:pointer" onClick="close_div2();">
			<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
		</a>
		<div class="mid_contant thankyou">
			<div class="cont_bar_inner cont_bar_inner_d">
				<h4 class="snd">iftGift eCard</h4>
				<img src="<?php echo ru_resource;?>images/jester_ar.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
				<div class="regs_form send_ques send_tansk" style="margin:0">
					<form id="sndEmail" action="<?php echo ru; ?>process/process_thankmail.php" method="post">
						<div class="flied fill">
						<input name="delivery_id" id="delivery_id" value="<?php echo $get_dev['delivery_id']; ?>" type="hidden">
						<input name="giv_email" id="giv_email" value="<?php echo $get_dev['giv_email']; ?>" type="hidden">
						<input name="recp_email" id="recp_email" value="<?php echo $get_dev['recp_email']; ?>" type="hidden">
						<input name="giv_name" id="giv_name" value="<?php echo $get_dev['giv_first_name']; ?>" type="hidden">
						<input name="recp_name" id="recp_name" value="<?php echo $get_dev['recp_first_name']; ?>" type="hidden">
						<input type="text" name="subject" id="subject" placeholder="So recipient sees in the email subject line that it&acute;s you and not SPAM" />
						<textarea name="message" placeholder="[Enter Your Text Here]"></textarea>
						<input type="submit" name="ThankMail" id="ThankMail" value="Send">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="overlay" style="display:none"></div>
	<div class="modal" id="modal_checkout" style="display:none">
		<a style="cursor:pointer" onClick="close_div();">
			<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
		</a>
		<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
		<div class="valid_msg">Please select an item to continue.</div>
	</div>
<style>
.element .hightlight{border:2px solid #ea4e18}
.thankyou{width:100%; max-width:100%}
/*.overlay{position:fixed; top:0; left:0; height:100%; width:100%; background:url(../resource/images/overlay_bg.png); z-index:9999999}
.modal{width:auto; max-width:510px; padding:20px; height:auto; background:#fafbfc; position:fixed; top:50%; left:50%; margin-top:-110px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc); text-align:center; z-index: 99999999}
.modal img{float:left; margin:0}
.valid_msg{font-size:18px; color:#3b3e3c; font-family: 'open_sansbold'; float:left; margin:-18px 0 0 136px}
.valid_msg span{color:#ea4e18}
.modal a{float:right;}
.modal a img{ margin:-38px -38px 0 0}
.modals{width:auto; height:auto; padding:0 0 10px; position:fixed; top:30%; left:44%; background-color:#fff; margin-top:-180px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc);z-index:99999999}
.cont_bar h3{-moz-border-radius:12px 12px 0 0; -webkit-border-radius:12px 12px 0 0; border-radius:12px 12px 0 0}
.modals img{float:left; margin:0}
.modals a{float:right}
.modals a img{margin:-16px -16px 0 0}*/
</style>
<?php //unset($_SESSION['cart']);?>			
<script type="text/javascript">
/***********************SHOP ITEM******************************/
$(function () {
	$('#shoping_cart').on('click',function () {
		if(!$('[name="cart_product"]').is(':checked')) {
			$(".overlay").show();
			$("#modal_checkout").toggle("slow");
		} else if($('[name="cart_product"]').is(':checked')) {
			var final = '';
			$('.ads_Checkbox:checked').each(function(){
				 var proid = $(this).val();
				 $('#proId_'+proid).val(proid);
				 final += proid+',';
			});
			 	var lastChar = final.slice(-1);
				if(lastChar == ',') {
				  ids = final.slice(0, -1);
				} 
				 $('#type').val('add');
				 var myData = 'proid='+ids+'&type=add';
				 $.ajax({
					url: "<?php echo ru;?>process/process_shopcart.php",
					type: "POST",
					data: myData,
					success:function(output) {
						window.location = "<?php echo ru; ?>buildcheckoutshop";
					}
				});
		}
	});
});

function thankyou(devID) {
	$(".overlay").show();
	$("#thankyou_div_"+devID).show("slow");
}

function close_div2()
{
	jQuery(".modal").slideUp("slow");
	jQuery(".overlay").css("display","none");
}

function shop_pro() {
	window.location = "<?php echo ru;?>shopproduct";
}
function shop_pro1() {
		if(!$('[name="cart_product"]').is(':checked')) {
			window.location = "<?php echo ru; ?>shopproduct";
			/*$(".overlay").show();
			$("#modal_checkout").toggle("slow");*/
		} else if($('[name="cart_product"]').is(':checked')) {
			var final = '';
			$('.ads_Checkbox:checked').each(function(){
				 var proid = $(this).val();
				 $('#proId_'+proid).val(proid);
				 final += proid+',';
			});
			 	var lastChar = final.slice(-1);
				if(lastChar == ',') {
				  ids = final.slice(0, -1);
				} 
				 $('#type').val('add');
				 var myData = 'proid='+ids+'&type=add';
				 $.ajax({
					url: "<?php echo ru;?>process/process_shopcart.php",
					type: "POST",
					data: myData,
					success:function(output) {
						window.location = "<?php echo ru; ?>shopproduct";
					}
				});
		}
}


</script>	