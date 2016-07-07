<?php
$get_upoints = "select points from ".tbl_userpoints." where userId = '".$_SESSION['LOGINDATA']['USERID']."'"; 
$view_upoints = $db->get_row($get_upoints,ARRAY_A);
?>
<div class="mid_contant">
		<h2 class="title">Control: Retailer Rewards</h2>
		<?php include("common/controls_leftmenu.php");?>
		<div class="cont_bar outbox_left outbox_right inbox_right retailer">
			<div class="sort_by">
				<div class="flied">
					<label>Sort By:</label>
					<input type="text" placeholder="Enter Keywords">
					<input type="submit" value="Search" />
				</div>
				<div class="your_redeem">
					<div class="flied">
						<label>Your Redeemable <span class="i">i</span><span class="f">f</span><span class="t">t</span> Points:</label>
						<input type="text" placeholder="2,500" value="<?php echo $view_upoints['points'];?>">
					</div>
				</div>
			</div>
			<ul class="unwrp_list">
				<li class="title_bar">
					<div class="from">Retailer <img src="<?php echo ru_resource;?>images/arrow_j.png" alt="Down Arrow" /></div>
					<div class="occas">Expiration <img src="<?php echo ru_resource;?>images/arrow_j.png" alt="Down Arrow" class="expirat" />
						<div style="display:none" class="expirat_down" id="expirat_down">
							<a href="#" class="expt">Earliest</a>
							<a href="#" class="latest">Latest</a>
						</div>
					</div>
					<div class="notft">Amount <img src="<?php echo ru_resource;?>images/arrow_j.png" alt="Down Arrow" class="amount" />
						<div style="display:none" class="expirat_down" id="amount_down">
							<a href="#" class="expt">Highest</a>
							<a href="#" class="latest">Lowest</a>
						</div>
					</div>
					<div class="resp_btn"></div>
				</li>
				
				<li class="record">
					<div class="from"><img src="<?php echo ru_resource;?>images/img_d.jpg" alt="Retailer Image" /> <span>15% off Purchases of $500 or more</span></div>
					<div class="occas">03/10/2013</div>
					<div class="notft">30 <span class="i">i</span><span class="f">f</span><span class="t">t</span>Points</div>
					<div class="resp_btn"><a href="javascript:;" onclick="retail_points('30');" class="orange unwraped">redeem</a></div>
				</li>
				<li class="record">
					<div class="from"><img src="<?php echo ru_resource;?>images/img_e.jpg" alt="Retailer Image" /> <span>30% off Purchases of $100 or more</span></div>
					<div class="occas">03/10/2013</div>
					<div class="notft">30 <span class="i">i</span><span class="f">f</span><span class="t">t</span>Points</div>
					<div class="resp_btn"><a href="javascript:;" onclick="retail_points('30');" class="orange unwraped">redeem</a></div>
				</li>
				<li class="record">
					<div class="from"><img src="<?php echo ru_resource;?>images/img_f.jpg" alt="Retailer Image" /> <span>25% off Purchases of $100 or more</span></div>
					<div class="occas">03/10/2013</div>
					<div class="notft">25 <span class="i">i</span><span class="f">f</span><span class="t">t</span>Points</div>
					<div class="resp_btn"><a href="javascript:;" onclick="retail_points('25');" class="orange unwraped">redeem</a></div>
				</li>
				<li class="record">
					<div class="from"><img src="<?php echo ru_resource;?>images/img_g.jpg" alt="Retailer Image" /> <span>25% off Purchases of $100 or more</span></div>
					<div class="occas">03/10/2013</div>
					<div class="notft">25 <span class="i">i</span><span class="f">f</span><span class="t">t</span>Points</div>
					<div class="resp_btn"><a href="javascript:;" onclick="retail_points('25');" class="orange unwraped">redeem</a></div>
				</li>
				<li class="record">
					<div class="from"><img src="<?php echo ru_resource;?>images/img_h.jpg" alt="Retailer Image" /> <span>25% off Purchases of $100 or more</span></div>
					<div class="occas">03/10/2013</div>
					<div class="notft">25 <span class="i">i</span><span class="f">f</span><span class="t">t</span>Points</div>
					<div class="resp_btn"><a href="javascript:;" onclick="retail_points('25');" class="orange unwraped">redeem</a></div>
				</li>
			</ul>
		</div>
	</div>
	<div class="overlay" style="display:none"></div>
	<div class="modal" id="modal_pass" style="display:none">
		<a style="cursor:pointer" onClick="close_div();">
			<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
		</a>
		<img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  />
		<div class="valid_msg"><u><span id="points" style="color:#333333"></span></u> points will be deducted from your points available for redemption.You will receive an email with your redemption code.<br />
			<button class="orange" id="redeem" type="button">Redeem</button>
		</div>
	</div>
<?php 
unset($_SESSION['sort_by']);
unset($_SESSION['sort']);
?>	

<script>
$(document).ready(function(){
  $(".expirat").click(function(){
	$("#expirat_down").show();
	$("#amount_down").hide();
	$("#item_down").hide();
  });

  $(".amount").click(function(){
	$("#amount_down").show();
	$("#expirat_down").hide();
	$("#item_down").hide();
  });

  $(".items").click(function(){
	$("#item_down").show();
	$("#expirat_down").hide();
	$("#amount_down").hide();
  });
});
		

	</script>	
<script type="text/javascript">
$(function () {
	$("#search_rec").click(function () {
		var key = $("#keyword").val();
		var day = $("#day").val();
		var month = $("#month").val();
		var year = $("#year").val();
		var days = $("#days").val();
		var months = $("#months").val();
		var years = $("#years").val();
		var myData = "key="+key+"&day="+day+"&month="+month+"&year="+year+"&days="+days+"&months="+months+"&years="+years;
		$.ajax({
			url:"<?php echo ru; ?>process/process_searchwish.php",
			type: "GET",
			data: myData,
			success:function (response) {
				$("#serach_rec").html(response);
				$("#default_rec").hide();
			}
		});
		
	});
});

function retail_points(points) {
	var retail_points = points;
	$(".overlay").show();
	$("#modal_pass").slideDown('slow');
	$("#points").text(retail_points);
	
	$("#redeem").on('click',function () {
		var myData = "points="+retail_points+"&userId=<?php echo $_SESSION['LOGINDATA']['USERID'];?>&retail_points=1";
		$.ajax({
			url:"<?php echo ru; ?>process/process_userinfo.php",
			type: "POST",
			data: myData,
			success:function (response) {
				if(response) {
					setTimeout(function() { 
    					window.location = "<?php echo ru; ?>retailer_rewards";
 					}, 1500);
				}
			}
		});
	})
}

</script>		