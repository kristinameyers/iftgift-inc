<?php 
	$_SESSION['SHOPPRODUCT'] = $_SERVER['REQUEST_URI'];
	$chk_users = mysql_query("select available_cash from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'");
	if(mysql_num_rows($chk_users) > 0) {
	$get_userid = mysql_fetch_array($chk_users);
	$available_cash = $get_userid['available_cash'];
	}

 $query_demo = "select * from ".tbl_product." where (status = 1 or status = 0) and price <= '".$available_cash."' and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%' limit 0,60";

 $select_products =  $query_demo;

 $view_product = $db->get_row($select_products,ARRAY_A);	
	 
/***********************GET NEXT PRODUCT********************************/
 $nxtsql = "SELECT proid FROM ".tbl_product." WHERE proid>{$view_product['proid']} and (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
    $result = mysql_query($nxtsql);
    if (@mysql_num_rows($result)>0) {
        $nextid = mysql_result($result,0);
    }
/***********************GET NEXT PRODUCT********************************/

/***********************GET PREVIOUS PRODUCT********************************/
$prevsql = "SELECT proid FROM ".tbl_product." WHERE proid<{$view_product['proid']} and (status = 1 or status = 0) and hide_id not like '%".$_SESSION['LOGINDATA']['USERID']."%'";
    $results = mysql_query($prevsql);
    if (@mysql_num_rows($results)>0) {
        $previd = mysql_result($results,0);
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
<?php if(isset($_SESSION['recipit_id']['New'])) { ?>
					<div class="prod_messg">Select up to <span><?php echo $count;?></span> suggestions to go along with your <span>$<?php echo $view['cash_gift'];?></span> cash gift</div>
<?php } ?>					
					<?php 
					if($view_product) {?>
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
					<a href="javascript:;" id="suggect_item">Purchase</a>								
					<div class="feedback_option">
						<h4>Leave Feedback (optional)</h4>
						<!---------------------OWN_IT------------------------------->
						<?php
							$get_own = mysql_num_rows(mysql_query("select userId from ".tbl_own." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and proid = '".$view_product['proid']."'"));
							$get_q = "SELECT count( own_it ) AS cnt FROM ".tbl_own." WHERE proid = '".$view_product['proid']."' GROUP BY proid HAVING Count( own_it )";
							$view_q = $db->get_row($get_q,ARRAY_A);?>
						<div id="own_it" class="icon_a <?php if($get_own > 0) {?>active<?php } ?>" <?php if($get_own == 0) { ?>onclick="own_it('<?php echo $view_product['proid'];?>','<?php echo $_SESSION['LOGINDATA']['USERID'];?>','own')" <?php } ?>>
							<span>Own It</span>
							<div class="own_it_icon"></div>
							<?php if($get_own > 0) {?>
							<span class="user_view"><?php echo $view_q{'cnt'}; ?> People Own it</span>
							<?php } ?>
						</div>
						<div id="own_itbtm"></div>
						<!---------------------OWN_IT------------------------------->
						<!---------------------LOVE_IT------------------------------->
						<?php
							$get_love = mysql_num_rows(mysql_query("select * from ".tbl_love." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and proid = '".$view_product['proid']."'"));
							$rec_love = mysql_fetch_array(mysql_query("select * from ".tbl_love." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and proid = '".$view_product['proid']."'"));
							$get_l = "SELECT count( love_it ) AS cnt FROM ".tbl_love." WHERE proid = '".$view_product['proid']."' GROUP BY proid HAVING Count( love_it )";
							$view_l = $db->get_row($get_l,ARRAY_A);
							if($get_love > 0 && $rec_love['love_number_setting'] != 0) {
							?>
							<div class="icon_b active">
								<div class="counter">
									<span>Love It</span>
									<div class="counter_inner">
										<samp class="minus" id="<?php echo $rec_love['love_id']; ?>"></samp>
										<input id="qty1_<?php echo $rec_love['love_id']; ?>" type="text" disabled="disabled" value="<?php echo $rec_love['love_number_setting']; ?>" class="qty"/>
										<input id="proid_<?php echo $rec_love['love_id']; ?>" value="<?php echo $rec_love['proid']; ?>" type="hidden"/>
										<samp class="add" id="<?php echo $rec_love['love_id']; ?>"></samp>
									</div>
									<span class="user_view"><?php echo $view_l{'cnt'}; ?> People Love It</span>
								</div>
							</div>
							<?php } else { ?>
							<div id="love_it" class="icon_b" onclick="love_it('<?php echo $view_product['proid'];?>','<?php echo $_SESSION['LOGINDATA']['USERID'];?>','love')">
							<span>Love It</span> 
							<div class="love_it_icon"></div>
						</div>
							<?php } ?>
						<div id="love_itbtm"></div>
						<!---------------------LOVE_IT------------------------------->
						<!---------------------HIDE_IT------------------------------->
						<?php
							$get_hide = mysql_num_rows(mysql_query("select userId from ".tbl_hide." where userId = '".$_SESSION['LOGINDATA']['USERID']."' and proid = '".$view_product['proid']."'"));
							$get_h = "SELECT count( hide_it ) AS cnt FROM ".tbl_hide." WHERE proid = '".$view_product['proid']."' GROUP BY proid HAVING Count( hide_it )";
							$view_h = $db->get_row($get_h,ARRAY_A);?>
						<div id="hide_it" class="icon_c <?php if($get_hide > 0) {?>active<?php } ?>" <?php if($get_hide == 0) { ?>onclick="hide_it('<?php echo $view_product['proid'];?>','<?php echo $_SESSION['LOGINDATA']['USERID'];?>','hide')" <?php } ?>>
							<span>Hide It</span>
							<div class="hide_it_icon"></div>
							<?php if($get_hide > 0) {?>
							<span class="user_view"><?php echo $view_h{'cnt'}; ?> People Hide it</span>
							<?php } ?>
						</div>
						<div id="hide_itbtm"></div>
						<!---------------------HIDE_IT------------------------------->
					</div>
					<?php } ?>
				</div>	
	<div id="prev_nxt_product"></div>
	<?php include_once("common/step_2aright.php");?>
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
	//$('#hide_itbtm').html(output);
	location.reload();
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
	
$(function () {
	$('.add').on('click',function(event){
		var love_id = this.id;
		var qty=$("#qty1_"+love_id).val();
		var currentVal = parseInt(qty);
		if(currentVal == 5) {
			var love_num = parseInt(currentVal);
			$("#qty1_"+love_id).unbind( event );
		} else if (currentVal == 0) {
			var love_num = parseInt(currentVal + 3);
			$("#qty1_"+love_id).val(love_num);
		}  
		else if (!isNaN(currentVal)) {
			var love_num = parseInt(currentVal + 1);
			$("#qty1_"+love_id).val(love_num);
		}
		
		if((currentVal != '' || currentVal == 0) && love_id != '') {
			//alert(currentVal);
			var myData = "love_num="+love_num+"&loveid="+love_id+"&num_seting=num_seting";
			$.ajax({
				url:"<?php echo ru;?>process/process_product.php",
				type: "GET",
				data: myData,
				success:function (response) {
					if(response) {
						//location.reload();
					}
				}
			});
		}
	});
	
	$('.minus').on('click',function(event){
		var love_id = this.id;
		var qty=$("#qty1_"+love_id).val();
		var currentVal = parseInt(qty);
		if (!isNaN(currentVal) && currentVal > 0) {
			var love_num = parseInt(currentVal - 1);
			$("#qty1_"+love_id).val(love_num);
		}
		
		if(currentVal != '' && love_id != '') {
			var dId = $("#proid_"+love_id).val();
			var uId = '<?php echo $userId; ?>';
			var myData = "love_num="+love_num+"&loveid="+love_id+"&num_seting=num_seting&proid="+dId+"&uId="+uId;
			$.ajax({
				url:"<?php echo ru;?>process/process_product.php",
				type: "GET",
				data: myData,
				success:function (response) {
					if(response && love_num == 0) {
						//alert(love_num ) 
						location.reload();
					}
				}
			});
		} 
	});
});		
</script>
