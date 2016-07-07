<?php 
//include_once('../connect/connect.php');
//include_once('../config/config.php');
 if(isset($_SESSION['recipit_id']['New'])) {
 $recption_id = $_SESSION['recipit_id']['New'];
 $query = "select recipit_id,cash_gift,gender,age,ocassion,email from ".tbl_recipient." where recipit_id = '".$recption_id."'";
 $get_info = $db->get_row($query,ARRAY_A);
 $cash = $get_info['cash_gift'];
 $gender = $get_info['gender'];
 $age = $get_info['age'];
 $ocassion = $get_info['ocassion'];
 $get_price = get_price($cash);
 $get_data = get_category($gender,$age);
 $get_occassion_data = get_ocassion($ocassion);
 $price_less = $cash - ($cash * 10/100);
 $price_add = $cash + ($cash * 10/100);
}
 if($_GET['s'] != ''  && $_GET['o'] == '0') {
 $price_from = $_GET['s'] - ($_GET['s'] * 10/100);
 $price_to = $_GET['s'] + ($_GET['s'] * 10/100);
 //echo $price_to;
 } else  if($_GET['s'] == '0'  && $_GET['o'] != '') {
 $price_from = $_GET['o'] - ($_GET['o'] * 10/100);
 $price_to = $_GET['o'] + ($_GET['o'] * 10/100);
 //echo $price_to;
 } else  if($_GET['s'] != ''  && $_GET['o'] != '') {
  $price_from = $_GET['s'] - ($_GET['s'] * 10/100);
  $price_to = $_GET['s'] + ($_GET['s'] * 10/100);
  $price_from1 = $_GET['o'] - ($_GET['o'] * 10/100);
  $price_to1 = $_GET['o'] + ($_GET['o'] * 10/100);
 } else if($_GET['s'] != '') {	
 $keyword = $_GET['s'];
 }

if(isset($_SESSION['recipit_id']['New'])) {
$chk_users = mysql_query("select userId,email from ".tbl_user." where email = '".$get_info['email']."'");
 	if(mysql_num_rows($chk_users) > 0) {
 	$get_userid = mysql_fetch_array($chk_users);
	$uId = $get_userid['userId'];
	$owndata = "and own_id not like '%".$uId."%'";
	$hidedata = "and hide_id not like '%".$uId."%'";
	$lovedata = "ORDER BY love_id DESC";
}
}
 
 if($price_from != '' && $price_to != '' && $price_from1 != '' && $price_to1 != '') {
 	$price = "AND (price >= '".$price_from."' AND price <= '".$price_to."' OR price >= '".$price_from1."' AND price <= '".$price_to1."')";
 } else if($price_from != '' && $price_to != '') {
 	$price = "AND (price >= '".$price_from."' AND price <= '".$price_to."')";
 } else if($price_from != '' &&  $price_to == '') {
 	$price = "AND price <= '".$price_from."'";
 } else if($price_from == '' &&  $price_to != '') {
 	$price = "AND price <= '".$price_to."'";
 }else {
 	$price = "AND (price >= '".$price_less."' AND price <= '".$price_add."')";
 }
include_once("common/step_2atop.php");
include_once("common/step_2aleft.php");
$count = 6 - count($_SESSION["cart"]); 
if(isset($_SESSION['recipit_id']['New'])) {
						if($_GET['s'] != ''  && $_GET['o'] != '' && $_GET['s'] != ''  && $_GET['o'] != '') {
							$search_query = "select * from ".tbl_product." where (status = 1 or status = 0) $get_data $price $get_occassion_data and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
						} else {
						 $search_query = "select * from ".tbl_product." where (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%') $get_data $get_occassion_data $price $owndata $hidedata  and (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
					 }
} else {
	if($_GET['s'] != ''  && $_GET['o'] != '' && $_GET['s'] != ''  && $_GET['o'] != '') {
							$search_query = "select * from ".tbl_product." where (status = 1 or status = 0) $price and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
						} else {
						 $search_query = "select * from ".tbl_product." where (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%') and (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
					 }
}					 
					$view_product = $db->get_row($search_query,ARRAY_A);
/***********************GET NEXT PRODUCT********************************/
if(isset($_SESSION['recipit_id']['New'])) {
 $nxtsql = "SELECT proid,love_id FROM ".tbl_product." WHERE proid>{$view_product['proid']} and (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%')  $get_data $price $get_occassion_data and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
 if(mysql_num_rows($chk_users) > 0) {
 $nxtsqls = "UNION SELECT proid,love_id FROM ".tbl_product." WHERE proid>{$view_product['proid']} and (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%') $price $get_occassion_data and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
 }
 	$next_pro =  $nxtsql." ".$nxtsqls."ORDER BY proid LIMIT 1";
} else {
	$nxtsql = "SELECT proid,love_id FROM ".tbl_product." WHERE proid>{$view_product['proid']} and (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%') and (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
 	$next_pro =  $nxtsql."ORDER BY proid LIMIT 1";
}
    $result = mysql_query($next_pro);
    if (@mysql_num_rows($result)>0) {
        $nextid = mysql_result($result,0);
    }
/***********************GET NEXT PRODUCT********************************/

/***********************GET PREVIOUS PRODUCT********************************/
if(isset($_SESSION['recipit_id']['New'])) {
$prevsql = "SELECT proid,love_id FROM ".tbl_product." WHERE proid<{$view_product['proid']} and (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%') $get_data $price $get_occassion_data and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
if(mysql_num_rows($chk_users) > 0) {
$prevsqls = "UNION SELECT proid,love_id FROM ".tbl_product." WHERE proid<{$view_product['proid']} and (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%') $price $get_occassion_data and (status = 1 or status = 0) $owndata $hidedata and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
}
	$prev_pro =  $prevsql." ".$prevsqls."ORDER BY proid DESC LIMIT 1";
} else {
	$prevsql = "SELECT proid,love_id FROM ".tbl_product." WHERE proid<{$view_product['proid']} and (sub_category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or category like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%' or pro_name like '%".mysql_real_escape_string(stripslashes(trim($keyword)))."%') and (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
	$prev_pro =  $prevsql."ORDER BY proid DESC LIMIT 1";
}
    $results = mysql_query($prev_pro);
    if (@mysql_num_rows($results)>0) {
        $previd = mysql_result($results,0);
    }
/***********************GET PREVIOUS PRODUCT********************************/	 					
					$view_pro = $db->get_results($search_query,ARRAY_A);
					//echo '<pre>';print_r($view_pro);
					?>
					<div class="sugget_mid" id="product_algo">
					<?php if(isset($_SESSION['recipit_id']['New'])) { ?>
					<div class="prod_messg">Select up to <span><?php echo $count;?></span> suggestions to go along with your <span>$<?php echo $cash;?></span> cash gift</div>
					<?php } ?>
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
					<div class="prod_detail">
						<div class="prod_title">
							<h4><?php echo substr($view_product['pro_name'],0,60);?></h4>
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
					<?php } ?>
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
				<?php if($view_product == 0) {?>
				<div class="sugget_mid" id="message_div">
					<div class="feedback_option jester_img">
						<img src="<?php echo ru_resource; ?>images/jester_aa.jpg" alt="Jester Image"/>
					</div>
				</div>	
				<?php } ?>
				<div id="prev_nxt_product"></div>
				<?php if($view_product) {?>
					<div class="sugget_left sugget_right" id="rightproduct_algo2">
				<div class="show_option">
					<div class="cat_title">
						<h2><span>Keyword:</span> <?php echo ucfirst($keyword); ?></h2>
					</div>
					<span class="view">Click image to view item:</span>
					<!-- content -->
					<ul class="content mCustomScrollbar">
					<?php
					if($view_pro)
					{
						foreach($view_pro as $product)
						{
					?>
						<li onclick="get_product('<?php echo $product['proid']; ?>')"><img src="<?php get_image($product['image_code']); ?>" alt="<?php echo $product['pro_name']; ?>" width="92" height="92" /></li>
					<?php } } ?>	
					</ul>
				</div>
			</div>
				<?php } ?>
			</div>
	</div>
</div>	
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
    url: "<?php echo ru;?>process/get_searchproduct.php",
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

function get_product(pid)
{ 
	var proId = pid;
	$.ajax({
		url: '<?php echo ru;?>process/get_searchproduct.php?picID='+proId,
		type: 'get', 
		success: function(output) {
			$('#prev_nxt_product').html(output);
			$('#product_algo').hide();
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

function close_div2() {
	$('#schedule_awards_div').hide();
	$('.overlays').hide();
}
</script>
<script src="<?php echo ru_resource;?>js/jquery.cookie.js"></script>
<?php if($_GET['s'] && $_GET['o']) { ?>	
<style>
.overlays{position:fixed; top:0; left:0; height:100%; width:100%; background:url(../../resource/images/overlay_bg.png); z-index:9999999}
.modal .ques_rangebar {
    width: 90%;
}
</style>	
<?php } else { ?>
<style>
.overlays{position:fixed; top:0; left:0; height:100%; width:100%; background:url(../resource/images/overlay_bg.png); z-index:9999999}
.modal .ques_rangebar {
    width: 90%;
}
</style>	
<?php } ?>	