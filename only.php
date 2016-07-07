<?php 
	if(isset($_SESSION['recipit_id']['New'])) {
	$recption_id = $_SESSION['recipit_id']['New'];
 	$get_recp = get_recp_info($recption_id);
 	$cash = $get_recp['cash_gift'];
	$gender = $get_recp['gender'];
	$age = $get_recp['age'];
	$ocassion = $get_recp['ocassion'];
	$get_price = get_price($cash);
	$get_data = get_category($gender,$age);
	$get_occassion_data = get_ocassion($ocassion);
 
 
 
		$chk_users = mysql_query("select userId,email from ".tbl_user." where email = '".$get_recp['email']."'");
		if(mysql_num_rows($chk_users) > 0) {
		$get_userid = mysql_fetch_array($chk_users);
		$uId = $get_userid['userId'];
		$owndata = "and own_id not like '%".$uId."%'";
		$hidedata = "and hide_id not like '%".$uId."%'";
		$lovedata = "and love_id like '%".$uId."%'";
		$query_udemo = "UNION select * from ".tbl_product." where (status = 1 or status = 0) $get_price $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' $lovedata ORDER BY FIND_IN_SET('".$uId."',love_id) DESC";
		}
		
		

$query_demo = "select * from ".tbl_product." where (status = 1 or status = 0) $get_data $get_price $get_occassion_data $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";



 $select_products =  $query_demo." ".$query_udemo;
 
		$view_product = $db->get_row($select_products,ARRAY_A);
		//$get_pro = $db->get_results($select_products,ARRAY_A);
		
		/***********************GET NEXT PRODUCT********************************/
		$nxtsql = "SELECT proid FROM ".tbl_product." WHERE proid>{$view_product['proid']}  $get_data $get_price $get_occassion_data and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
 if(mysql_num_rows($chk_users) > 0) {
 $nxtsqls = "UNION SELECT proid FROM ".tbl_product." WHERE proid>{$view_product['proid']} $get_price and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' $lovedata ORDER BY proid LIMIT 1";
 }
 $next_pro =  $nxtsql." ".$nxtsqls;
 
    $result = mysql_query($next_pro);
    if (@mysql_num_rows($result)>0) {
        $nextid = mysql_result($result,0);
    }
		/***********************GET NEXT PRODUCT********************************/
		
		/***********************GET PREVIOUS PRODUCT********************************/
		$prevsql = "SELECT proid FROM ".tbl_product." WHERE proid<{$view_product['proid']} $get_data $get_price $get_occassion_data and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
if(mysql_num_rows($chk_users) > 0) {
$prevsqls = "UNION SELECT proid FROM ".tbl_product." WHERE proid<{$view_product['proid']} $get_price and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' $lovedata ORDER BY proid DESC LIMIT 1";
}
$prev_pro =  $prevsql." ".$prevsqls;

    $results = mysql_query($prev_pro);
    if (@mysql_num_rows($results)>0) {
        $previd = mysql_result($results,0);
    }
}	
		/***********************GET PREVIOUS PRODUCT********************************/	
include_once("common/step_2atop.php");
include_once("common/step_2aleft.php");
$count = 6 - count($_SESSION["cart"]);
if(isset($_SESSION['recipit_id']['New'])) {
?>
	<div class="sugget_mid" id="product_algo">
	
					<div class="prod_messg">Select up to <span><?php echo $count;?></span> suggestions to go along with your <span>$<?php echo $view['cash_gift'];?></span> cash gift</div>
					<?php if($view_product) {?>
					<div class="product_bar">
						<div class="left_arrow" id="getPicButton_<?php echo $previd;?>">
							<?php if($previd != '') { ?>
								<img src="<?php echo ru_resource; ?>images/left_arrow.png" alt="Right Arrow" />
							<?php } ?>
						</div>	
					<?php if($view_product) { ?>	
						<div class="prod_img">
							<img src="<?php  get_image($view_product['image_code']);?>" height="280" alt="<?php echo  $view_product['pro_name'];?>" />
						</div>
					<?php } ?>	
					<?php if($nextid != '') { ?>	
						<div class="left_arrow right_arrow" id="getPicButton_<?php echo $nextid;?>"> <img src="<?php echo ru_resource; ?>images/right_arrow.png" alt="Right Arrow" /></div>
					<?php } ?>	
					</div>
					<?php } ?>
					<div class="prod_detail">
						<div class="prod_title">
							<h4><?php echo substr($view_product['pro_name'],0,20);?></h4>
							<p><span>Vendor:</span> <?php echo  $view_product['vendor'];?>, <span>Category:</span> <?php echo  $view_product['category'];?>, <?php echo  $view_product['sub_category'];?></p>
						</div>
						<h4 class="item_price">$<?php echo  number_format($view_product['price'],2);?></h4>
					</div>
					<div id="intro-wrap3">
						<div class="cat_title">
							<h2>More info</h2>
							<div class="open-intro3"><img src="<?php echo ru_resource; ?>images/arrow_a.png" alt="Down Arrow" /></div>
							<div class="close-intro3"><img src="<?php echo ru_resource; ?>images/arrow_e.png" alt="Down Arrow" /></div>	
						</div>
						<div id="contentWrap3" style="display:none">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>
					</div>
					<input type="hidden" name="proId" id="proId"/>
					<input type="hidden" name="type" id="type"/>
					<a href="javascript:;" id="suggect_item">Suggest this item</a>								
					<div class="feedback_option">
						<h4>Leave Feedback (optional)</h4>
						<!---------------------OWN_IT------------------------------->
						<?php
							$get_q = "SELECT count( own_it ) AS cnt FROM ".tbl_own." WHERE proid = '".$view_product['proid']."' GROUP BY proid HAVING Count( own_it )";
							$view_q = $db->get_row($get_q,ARRAY_A);?>
						<div id="own_it" class="icon_a <?php if($view_q > 0) {?>active<?php } ?>" <?php if($get_own == 0) { ?>onclick="own_it('<?php echo $view_product['proid'];?>','<?php echo $_SESSION['LOGINDATA']['USERID'];?>','own')" <?php } ?>>
							<span>Own It</span>
							<div class="own_it_icon"></div>
							<?php if($view_q > 0) {?>
							<span class="user_view"><?php echo $view_q{'cnt'}; ?> People Own it</span>
							<?php } ?>
						</div>
						<div id="own_itbtm"></div>
						<!---------------------OWN_IT------------------------------->
						<!---------------------LOVE_IT------------------------------->
						<?php
							$get_l = "SELECT count( love_it ) AS cnt FROM ".tbl_love." WHERE proid = '".$view_product['proid']."' GROUP BY proid HAVING Count( love_it )";
							$view_l = $db->get_row($get_l,ARRAY_A);?>
						<div id="love_it" class="icon_b <?php if($view_l > 0) {?>active<?php } ?>" <?php if($get_love == 0) { ?>onclick="love_it('<?php echo $view_product['proid'];?>','<?php echo $_SESSION['LOGINDATA']['USERID'];?>','love')" <?php } ?>>
							<span>Love It</span>
							<div class="love_it_icon"></div>
							<?php if($view_l > 0) {?>
							<span class="user_view"><?php echo $view_l{'cnt'}; ?> People Love it</span>
							<?php } ?>
						</div>
						<div id="love_itbtm"></div>
						<!---------------------LOVE_IT------------------------------->
						<!---------------------HIDE_IT------------------------------->
						<?php
							$get_h = "SELECT count( hide_it ) AS cnt FROM ".tbl_hide." WHERE proid = '".$view_product['proid']."' GROUP BY proid HAVING Count( hide_it )";
							$view_h = $db->get_row($get_h,ARRAY_A);?>
						<div id="hide_it" class="icon_c <?php if($view_h > 0) {?>active<?php } ?>" <?php if($get_hide == 0) { ?>onclick="hide_it('<?php echo $view_product['proid'];?>','<?php echo $_SESSION['LOGINDATA']['USERID'];?>','hide')" <?php } ?>>
							<span>Hide It</span>
							<div class="hide_it_icon"></div>
							<?php if($view_h > 0) {?>
							<span class="user_view"><?php echo $view_h{'cnt'}; ?> People Hide it</span>
							<?php } ?>
						</div>
						<div id="hide_itbtm"></div>
						<!---------------------HIDE_IT------------------------------->
					</div>
				</div>
	<div id="prev_nxt_product"></div>
	<?php } else { ?>
	<div class="sugget_mid" id="message_div">
		<div class="feedback_option jester_img">
			<img src="<?php echo ru_resource; ?>images/jester_aa.jpg" alt="Jester Image"/>
		</div>
	</div>	
	<?php } include_once("common/step_2aright.php");?>
<script type="text/javascript">
$(document).ready(function() {
$(".left_arrow").on("click", function() {
	var myPictureId = $(this).attr('id');
	var getImgId =  myPictureId.split("_");
	getPicture(getImgId[1]); 
	return false;
});
});

function getPicture(myPicId)
{
var myData = 'picID='+myPicId;
jQuery.ajax({
    url: "<?php echo ru;?>process/get_product.php",
	type: "GET",
    dataType:'html',
	data:myData,
    success:function(response)
    {
		$('#prev_nxt_product').html(response);
		$('#product_algo').hide();
		//$('#no_cart_btn').hide();
    }
    });
}


function own_it(proid,uid,type)
{
	var proId = proid;
	var userId = uid;
	var type = type;
	$.ajax({
	url: '<?php echo ru;?>process/process_product.php?proid='+proId+'&userId='+userId+'&type='+type,
	type: 'get', 
	success: function(output) {
	$('#own_it').hide();
	$('#own_itbtm').html(output);
	}
	});
}

function love_it(proid,uid,type)
{
	var proId = proid;
	var userId = uid;
	var type = type;
	$.ajax({
	url: '<?php echo ru;?>process/process_product.php?proid='+proId+'&userId='+userId+'&type='+type,
	type: 'get', 
	success: function(output) {
	$('#love_it').hide();
	$('#love_itbtm').html(output);
	}
	});
}

function hide_it(proid,uid,type)
{
	var proId = proid;
	var userId = uid;
	var type = type;
	$.ajax({
	url: '<?php echo ru;?>process/process_product.php?proid='+proId+'&userId='+userId+'&type='+type,
	type: 'get', 
	success: function(output) {
	$('#hide_it').hide();
	$('#hide_itbtm').html(output);
	}
	});
}

/***********************SUGGECT ITEM******************************/
$(function () {
	$('#suggect_item').on('click',function () {
		$('#proId').val('<?php echo $view_product['proid'];?>');
		$('#type').val('add');
		var myData = 'productid=<?php echo $view_product['proid'];?>&type=add';
		$.ajax({
			url: "<?php echo ru;?>process/process_cart.php",
			type: "GET",
			data: myData,
			success:function(output) {
				$('#cart_suggest').html(output);
				$('#no_cart').hide();
				$('#no_cart_btn').hide();
			}
		});
	});
});

$('.open-intro3').click(function() {
		$('#intro-wrap3').animate({
		//opacity: 1,
		
	  }, function(){
		// Animation complete.
	  });
		$('.open-intro3').hide();
		$('.close-intro3').show();
		$('#contentWrap3').slideUp('fast');
	});
	$('.close-intro3').click(function() {
		$('#intro-wrap3').animate({
		//opacity: 0.25,
		
	  }, function() {
		// Animation complete.
	  });
		$('.open-intro3').show();
		$('.close-intro3').hide();
		$('#contentWrap3').slideDown('slow');
	});
</script>