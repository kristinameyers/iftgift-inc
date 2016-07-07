<?php
$userId = $_SESSION['LOGINDATA']['USERID'];
?>
<div class="mid_contant">
		<h2 class="title">Item Preference Icons: Tools to Make Suggesting Easier</h2>
		<?php include("common/controls_leftmenu.php");?>
		<div class="cont_bar outbox_right item">
			<img src="<?php echo ru_resource; ?>images/jester_z.jpg" alt="Jester Image" />
			<div class="regs_form item_right">
				<h5>When you turn icons &quot;OFF&quot;, your information will not be shared with other iftGifters.</h5>
				<div class="item_wish">
					<div class="counter">
						<div class="counter_inner counter_icon">
							<input id="qty1" type="text" value="1" class="qty"/>
						</div>
					</div>
					<h5><span>Their iftWish:</span> Item is on the Recipient&rsquo;s iftWish List. The number indicates their degree of &rsquo;Like&rsquo;.</h5>
					<div class="on_off on_off_b">
						<a class="off" id="their_off" href="javascript:;">OFF<div class="unactive"></div></a>
						<a class="on active" id="their_on" href="javascript:;">ON<div class="unactive_b"></div></a>
					</div>
				</div>
				<div class="item_wish">
					<div class="counter">
						<div class="counter_inner">
							<samp class="minus"></samp>
							<input id="qty1" type="text" value="1" class="qty"/>
							<samp class="add"></samp>
						</div>
					</div>
					<h5><span>Your iftWish:</span> Item is on your iftWish List. Adjust number to indicate degree. To edit /review all iftWish items, go to <a href="<?php echo ru; ?>wishlist">Your iftWish List.</a></h5>
					<div class="on_off on_off_b">
						<a class="off active" id="you_off" href="javascript:;">OFF<div class="unactive"></div></a>
						<a class="on" id="you_on" href="javascript:;">ON<div class="unactive_b"></div></a>
					</div>
				</div>
				<div class="item_wish">
					<div class="counter">
						<div class="counter_inner counter_icon">
							<img src="<?php echo ru_resource; ?>images/icon_j.jpg" alt="Owned Icon" />
						</div>
					</div>
					<h5><span>Owned:</span> Item is already owned by you. To edit / review all Owned items, go to <a href="<?php echo ru; ?>owned">Owned Items.</a></h5>
					<div class="on_off on_off_b">
						<a class="off" id="owned_off"  href="javascript:;">OFF<div class="unactive"></div></a>
						<a class="on active" id="owned_on" href="javascript:;">ON<div class="unactive_b"></div></a>
					</div>
				</div>
				<div class="item_wish">
					<div class="counter">
						<div class="counter_inner counter_icon">
							<img src="<?php echo ru_resource; ?>images/icon_k.jpg" alt="Hide Icon" />
						</div>
					</div>
					<h5><span>Hidden:</span> Item removed from consideration. To hide all similar items or to reactivate and reveal a particular item, go to <a href="<?php echo ru;?>hidden">Hidden Items.</a></h5>
					<div class="on_off on_off_b">
						<a class="off" id="hide_off" href="javascript:;">OFF<div class="unactive"></div></a>
						<a class="on active" id="hide_on" href="javascript:;">ON<div class="unactive_b"></div></a>
					</div>
				</div>
				<div class="item_wish">
					<div class="counter">
						<div class="counter_inner counter_icon">
							<img src="<?php echo ru_resource; ?>images/icon_l.jpg" alt="Check Icon" />
						</div>
					</div>
					<h5><span>Double Check:</span> Inform others that the item was already suggested for you by another iftGifter within the last...</h5>
					<div class="on_off on_off_b">
						<a class="off active" id="dchk_off" href="javascript:;">OFF<div class="unactive"></div></a>
						<a class="on" id="dchk_on" href="javascript:;">ON<div class="unactive_b"></div></a>
					</div>
				</div>
				<div class="item_wish item_checkbox">
					<div class="terms">
						<div class="squaredFour">
							<input type="checkbox" name="check" id="3month" value="None">
							<label for="3month"></label>
						</div>
						<label class="title">3 Months</label>
					</div>
					<div class="terms">
						<div class="squaredFour">
							<input type="checkbox" name="check" id="6month" value="None">
							<label for="6month"></label>
						</div>
						<label class="title">6 Months</label>
					</div>
					<div class="terms">
						<div class="squaredFour">
							<input type="checkbox" name="check" id="1year" value="None">
							<label for="1year"></label>
						</div>
						<label class="title">1 Year</label>
					</div>
					<div class="terms">
						<div class="squaredFour">
							<input type="checkbox" name="check" id="ever" value="None">
							<label for="ever"></label>
						</div>
						<label class="title">Ever</label>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
$(function () {
	$("#their_on,#their_off").click(function () {
		var their_id = this.id;
		if(their_id == 'their_on') {
		$('#their_on').removeClass('active');
		$('#their_off').addClass('active');
		} else if(their_id == 'their_off') {
		$('#their_on').addClass('active');
		$('#their_off').removeClass('active');
		}
	});
	
	$("#you_on,#you_off").click(function () {
		var you_id = this.id;
		if(you_id == 'you_on') {
		$('#you_on').removeClass('active');
		$('#you_off').addClass('active');
		} else if(you_id == 'you_off') {
		$('#you_on').addClass('active');
		$('#you_off').removeClass('active');
		}
	});
	
	$("#owned_on,#owned_off").click(function () {
		var owned_id = this.id;
		if(owned_id == 'owned_on') {
		$('#owned_on').removeClass('active');
		$('#owned_off').addClass('active');
		} else if(owned_id == 'owned_off') {
		$('#owned_on').addClass('active');
		$('#owned_off').removeClass('active');
		}
	});
	
	$("#hide_on,#hide_off").click(function () {
		var hide_id = this.id;
		if(hide_id == 'hide_on') {
		$('#hide_on').removeClass('active');
		$('#hide_off').addClass('active');
		} else if(hide_id == 'hide_off') {
		$('#hide_on').addClass('active');
		$('#hide_off').removeClass('active');
		}
	});
	
	$("#dchk_on,#dchk_off").click(function () {
		var dchk_id = this.id;
		if(dchk_id == 'dchk_on') {
		$('#dchk_on').removeClass('active');
		$('#dchk_off').addClass('active');
		} else if(dchk_id == 'dchk_off') {
		$('#dchk_on').addClass('active');
		$('#dchk_off').removeClass('active');
		}
	});
});
</script>		