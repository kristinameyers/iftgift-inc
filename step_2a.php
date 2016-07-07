<div class="loaderr" >
   <center>
       <img class="loading-image" src="<?php echo ru_resource; ?>images/spinner2.gif" alt="loading.." >
   </center>
</div>
 <div class="overlays" style="display:none"></div>
<div class="mid_contant">
	<?php
		include_once("common/step_2atop.php");
		include_once("common/step_2aleft.php");
		$count = 6 - count($_SESSION["cart"]);
	?>
	<div class="sugget_mid" id="product_algo">
		<div class="prod_messg">Select up to <span><?php echo $count;?></span> suggestions to go along with your <span>$<?php echo $cash_gift;?></span> cash gift</div>
		<?php
		$view_page = $db->get_row("select visited_page from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
		if($_SESSION['LOGINDATA']['LOGINAS'] == 'facebook') {
			if($view_page['visited_page'] == '0') {
				$update = mysql_query("update ".tbl_user." set visited_page = '1' where userId = '".$_SESSION['LOGINDATA']['USERID']."'");
		?>
		<div class="sugget_mid" id="message_div2">
			<div class="feedback_option jester_img resp_fb">
				<p><?php echo ucfirst($view['first_name']).' '.ucfirst($view['last_name']);?><br/>needs more people in<br/>their iftClique.<br/>Why not invite mutual<br/>Facebook friends to join?</p>
				<img src="<?php echo ru_resource; ?>images/jester_av.jpg" alt="Jester Image"/>
				<img src="<?php echo ru_resource; ?>images/fb_frdinvite.jpg" alt="Jester Image" onClick="FacebookInviteFriends();"/>
				<div class="invite_frd">
					<h5>Also Invite Friends by Email</h5>
					<img src="<?php echo ru_resource; ?>images/email_icon.jpg" alt="Jester Image"/>
				</div>
			</div>
		</div>
		<?php
		} } else {
			if($view_page['visited_page'] == '0') {
			$update = mysql_query("update ".tbl_user." set visited_page = '1' where userId = '".$_SESSION['LOGINDATA']['USERID']."'");
		?>
		<div class="sugget_mid" id="message_div2">
			<div class="feedback_option jester_img resp_fb">
				<div class="invite_frd" style="border:0">
					<h5>Also Invite Friends by Email</h5>
					<img src="<?php echo ru_resource; ?>images/email_icon.jpg" alt="Jester Image"/>
				</div>
			</div>
		</div>
		<?php
		}  }
		?>
	<?php
		if($view_page['visited_page'] != '0') {	
			include_once("content_product.php");
		}	
	?>
	<?php 
	if($view_page['visited_page'] != '0') {
		if($view_product == 0) {?>
			<div class="sugget_mid" id="message_div">
				<div class="feedback_option jester_img">
					<img src="<?php echo ru_resource; ?>images/jester_aa.jpg" alt="Jester Image"/>
				</div>
			</div>		
	<?php } } ?>
		<div class="show_option control_item">
			<h4>Show <span class="i">i</span><span class="f">f</span><span class="t">t</span> Wish Items</h4>
			<div class="terms">
				<img src="<?php echo ru_resource; ?>images/heart_icon_a.jpg" alt="Heart Icon"/>
				<div class="item_check">
					<div class="squaredFour">
						<input type="radio" value="mine" <?php if($page == 'mine') { ?> checked="checked" <?php } ?> id="thirteen" name="iftwish" class="mine" />
						<label for="thirteen"></label>
					</div>
					<label class="title">Mine</label>
				</div>
			</div>
			<div class="terms terms_b">
				<img src="<?php echo ru_resource; ?>images/heart_icon_b.jpg" alt="Heart Icon"/>
				<div class="item_check">
					<div class="squaredFour">
						<input type="radio" value="theirs" <?php if($page == 'theris') { ?> checked="checked" <?php } ?> id="fourteen" name="iftwish" class="theris" />
						<label for="fourteen"></label>
					</div>
					<label class="title">Theirs</label>
				</div>
			</div>
		</div>
	</div>
	<div id="load_product" class="sugget_mid" style="display:none"></div>
	<div id="prev_nxt_product"></div>
	<?php	
		include_once("common/step_2aright.php");
	?>
</div>		
<script>
/***********************SUGGECT ITEM******************************/
$(function () {
	$('#suggect_item').on('click',function() {
		$('#proId').val('<?php echo $view_product['proid'];?>');
		$('#type').val('add');
		var maxcount = '<?php echo count($_SESSION['cart']);?>'; 
		var myData = 'proid=<?php echo $view_product['proid'];?>&type=add';
		$.ajax({
			url: "<?php echo ru;?>process/process_cart.php",
			type: "GET",
			data: myData,
			 async: false,
			success:function(output) { 
				$('#cart_suggest').html(output);
				$('#load_product').show();
				$("#load_product").load("<?php echo $ru;?>process/content_product.php");
				$('#product_algo').hide();
				$('#no_cart').hide();
				$('#no_cart_btn').hide();
				$('#no_cart_btn2').hide();
				$('#no_cart_btn3').hide();
			},
			 beforeSend: function(){
					$('.overlays').show();
					$('.loaderr').show();  
					  
					},
    		complete: function(){
				$('.loaderr').hide();
				$('.overlays').hide();  			
			    }
		});
	});
});
</script>