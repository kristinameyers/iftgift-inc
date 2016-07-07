<?php 
 $query_demo = "select * from gift_product where (status = 1 or status = 0) and (love_id not like '0' and FIND_IN_SET('".$_SESSION['LOGINDATA']['USERID']."',love_id))";
 $select_products =  $query_demo;
 $view_product = $db->get_row($query_demo,ARRAY_A);	
	 
/***********************GET NEXT PRODUCT********************************/
 $nxtsql = "SELECT proid FROM ".tbl_product." WHERE proid>{$view_product['proid']} and (status = 1 or status = 0) and FIND_IN_SET('".$_SESSION['LOGINDATA']['USERID']."',love_id) ORDER BY proid LIMIT 1";
 
    $result = mysql_query($nxtsql);
    if (@mysql_num_rows($result)>0) {
        $nextid = mysql_result($result,0);
    }
/***********************GET NEXT PRODUCT********************************/

/***********************GET PREVIOUS PRODUCT********************************/
$prevsql = "SELECT proid FROM ".tbl_product." WHERE proid<{$view_product['proid']} and (status = 1 or status = 0) and FIND_IN_SET('".$_SESSION['LOGINDATA']['USERID']."',love_id) ORDER BY proid LIMIT 1";

    $results = mysql_query($prevsql);
    if (@mysql_num_rows($results)>0) {
        $previd = mysql_result($results,0);
    }

if(isset($_SESSION['recipit_id']['New'])){
	$cash = $view['cash_amount'];
} else if(isset($_SESSION['DRAFT']['delivery_id'])){
	$cash = $_SESSION['DRAFT']['cash_amount'];
}	
/***********************GET PREVIOUS PRODUCT********************************/	 
?>
<div class="mid_contant">
<?php	 
include_once("common/step_2atop.php");
include_once("common/step_2aleft.php");
$count = 6 - count($_SESSION["cart"]);
?>
	<div class="sugget_mid" id="product_algo">
	<?php if(isset($_SESSION['recipit_id']['New']) || isset($_SESSION['DRAFT']['delivery_id'])) { ?>
					<div class="prod_messg">Select up to <span><?php echo $count;?></span> suggestions to go along with your <span>$<?php echo $cash ;?></span> cash gift</div>
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
						<?php if($view_product['img'] != ''){ ?>
							<img src="<?php echo  $view_product['img'];?>" height="280" alt="<?php echo  $view_product['pro_name'];?>" />
							<?php }else{ ?>
							<img src="<?php  get_image($view_product['image_code']);?>" height="280" alt="<?php echo  $view_product['pro_name'];?>" />
						<?php } ?>
							<?php /*?><img src="<?php  get_image($view_product['image_code']);?>" height="280" alt="<?php echo  $view_product['pro_name'];?>" /><?php */?>
						</div>
					<?php } ?>	
					<?php if($nextid != '') { ?>	
						<div class="left_arrow right_arrow" id="getPicButton_<?php echo $nextid;?>"> <img src="<?php echo ru_resource; ?>images/right_arrow.png" alt="Right Arrow" /></div>
					<?php } ?>	
					</div>
					<?php } ?>
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
						<?php if($view_product['description'] != ''){ ?>
						<div id="contentWrap3" style="display:none">
							<p><?php echo $view_product['description']; ?></p>
						</div>
						<?php } ?>
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
	<div id="prev_nxt_product"></div>
	<?php include_once("common/mine_right.php");?>
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
    url: "<?php echo ru;?>process/get_mineproduct.php",
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
		var myData = 'proid=<?php echo $view_product['proid'];?>&type=add';
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
<style>
.overlays{position:fixed; top:0; left:0; height:100%; width:100%; background:url(resource/images/overlay_bg.png); z-index:9999999}
</style>		