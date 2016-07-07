<?php
	error_reporting(0);
	require_once("common/imagecrop_functions.php");
	$getuserImg = $db->get_row("select user_image from ".tbl_user." where userid = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
	$thumb_width = "150";
	$thumb_height = "150";
	$large_image_location = ru.'media/user_image/'.$_SESSION['LOGINDATA']['USERID'].'/'.$getuserImg['user_image'];
	if(@getimagesize($large_image_location)) {
		$current_large_image_width = getWidth($large_image_location);
		$current_large_image_height = getHeight($large_image_location);
	} else {
		$current_large_image_width = "100";
		$current_large_image_height = "100";
	}
?>
<script type="text/javascript" src="<?php echo ru_resource; ?>js/jquery-pack.js"></script>
<script type="text/javascript" src="<?php echo ru_resource; ?>js/jquery.imgareaselect-0.3.min.js"></script>
<script type="text/javascript">
function preview(img, selection) { 
	var scaleX = <?php echo $thumb_width;?> / selection.width; 
	var scaleY = <?php echo $thumb_height;?> / selection.height; 
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 

$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			$('.overlay').show();
			$('#modal_thumbimg').toggle( "slow" );
			//alert("You must make a selection first");
			return false;
		}else{
			return true;
		}
	});
}); 

$(window).load(function () { 
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>',x1: 100, y1: 100, x2: 200, y2: 200, onSelectChange: preview }); 
});

</script>
<div class="mid_contant">
		<h2 class="title">Your Dashboard</h2>
		<?php include_once("common/dashboard_left.php");
		if($_SESSION['biz_userimg_err']){
			if($_SESSION['biz_userimg_err']['image']) {
			echo "<div style='color:#FF4242; float:left; width:500px; margin:5px 0 0 10px;'>".$_SESSION['biz_userimg_err']['image']."</div>";
			} else if($_SESSION['biz_userimg_err']['ext']) {
				echo "<div style='color:#FF4242; float:left; width:500px; margin:5px 0 0 10px;'>".$_SESSION['biz_userimg_err']['ext']."</div>";
			} else if($_SESSION['biz_userimg_err']['size']) {
				echo "<div style='color:#FF4242; float:left; width:500px; margin:5px 0 0 10px;'>".$_SESSION['biz_userimg_err']['size']."</div>";
			}
		}
		?>
		<div class="dash_left dash_right photo_upload">
			<div class="unwrap">
				<div class="upload_img_box">
					<!--Large_image-->
					<?php
						if($getuserImg['user_image'] != '') {
							$user_image = ru.'media/user_image/'.$_SESSION['LOGINDATA']['USERID'].'/'.$getuserImg['user_image'];
						} else {
							$user_image = ru_resource.'images/dummy_img_upload.jpg';
						} 
					?>
					<?php
						if($getuserImg['user_image'] != '') { ?>
					<img src="<?php echo $user_image;?>" id="thumbnail" style="float: left; margin-right: 10px; width:320px; height:269px;" alt="upload image" />
					<!--Thumb-->
					<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden;width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
						<img src="<?php echo $user_image;?>" alt="upload image" />
					</div>
					<?php } else {?>
						<img src="<?php echo $user_image;?>" style="float: left; margin-right: 10px;" alt="upload image" />
						<img src="<?php echo ru_resource;?>images/dummy_crop_img.jpg" alt="upload image" />
					<?php } ?>
					<div class="instur">
						<h4>Upload Photo Instructions:</h4>
						<p><span>1)</span> Adjust and move selection <br/>box to crop and select photo.</p>
						<p><span>2)</span> Your selection will appear in <br/>the thumbnail box above.</p>
						<p><span>3)</span> Click "Save Thumbnail" and <br/>your selection will be active.</p>
						<p><span>4)</span> Click "Choose File" to select <br/>and upload another photo.</p>
					</div>
					<form name="thumbnail" action="<?php echo ru;?>process/process_user.php" method="post">
						<input type="hidden" name="image_name" value="<?php echo $getuserImg['user_image']; ?>"/>
						<input type="hidden" name="x1" value="" id="x1" />
						<input type="hidden" name="y1" value="" id="y1" />
						<input type="hidden" name="x2" value="" id="x2" />
						<input type="hidden" name="y2" value="" id="y2" />
						<input type="hidden" name="w" value="" id="w" />
						<input type="hidden" name="h" value="" id="h" />
						<input type="submit" name="upload_thumbnail" value="Save Thumbnail" id="save_thumb" class="orange" />
					</form>
					<form name="photo" enctype="multipart/form-data" method="post" action="<?php echo ru;?>process/process_user.php"/>
						<input type="hidden" name="oldimage" id="oldimage" value="<?php echo $getuserImg['user_image']; ?>" />
						<input type="file" name="image" id="image" />
						<input type="submit" value="Upload" name="upload" class="orange" />
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="overlay" style="display:none"></div>
	<div class="modal" id="modal_thumbimg" style="display:none"><a style="cursor:pointer" onClick="close_div();"><img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" /></a><img src="<?php echo ru_resource; ?>images/jester_icon_validation.png" alt="Validation Icon"  /><div class="valid_msg">You must make a selection first.</div></div>
<?php unset($_SESSION['biz_userimg_err']);?>	