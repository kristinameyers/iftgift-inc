<?php
$userId = $_SESSION['LOGINDATA']['USERID'];
$get_user_info = $db->get_row("select * from ".tbl_user." where userId = '".$userId."'",ARRAY_A);
$giver_email = $get_user_info['email'];
$get_user_dev = $db->get_results("select distinct(recp_email) from ".tbl_delivery." where giv_email = '".$giver_email."'",ARRAY_A);
if($get_user_dev) {
	foreach($get_user_dev as $users) {
		$recp_email = $users['recp_email'];
 		$get_recp_info = $db->get_results("select distinct(recp_email) from ".tbl_delivery." where giv_email = '".$recp_email."'",ARRAY_A);
		if($get_recp_info) {
			foreach($get_recp_info as $users2) {
			$recp_email2 = $users2['recp_email'];
			if($giver_email == $recp_email2) {
				$friend_count = count($recp_email2);
			 	$totalfriend_count += $friend_count;
				$query = mysql_fetch_array(mysql_query("select userId from ".tbl_user." where email = '".$recp_email."'"));
				$get_user_points = mysql_fetch_array(mysql_query("select * from ".tbl_userpoints." where userId = '".$query['userId']."'"));
				$points = $get_user_points['points'];
				$total += $points;
				} 
	  		}	
		}
	}
}
?>
<div class="mid_contant">
		<h2 class="title">Control: Your iftClique<sup>SM</sup></h2>
		<?php include("common/controls_leftmenu.php");?>
		<div class="cont_bar outbox_left outbox_right inbox_right">
			<div class="ift_bar_a">
				<div class="drop_menu">
					<h4>Your iftClique Stats</h4>
				</div>
				<div class="ift_bar_btm">
					<p><span>Your iftClique&rsquo;s Total Friends:</span><span class="ift_rcd"><?php echo $totalfriend_count; ?></span></p>
					<p><span>Your iftClique&rsquo;s Total Points:</span><span class="ift_rcd"><?php echo $total; ?></span></p>
					<p><span>Your iftClique&rsquo;s Point Average:</span><span class="ift_rcd">1,800</span></p>
					<p><span>Your Personal Point Rank:</span><span class="ift_rcd">12th</span></p>
					<p><span class="wide">Largest Systemwide iftClique</span></p>
					<p><span>For Number of Friends:</span><span class="ift_rcd">5,000</span></p>
					<p><span>For Number of Points:</span><span class="ift_rcd">575,000</span></p>
				</div>
			</div>
			<div class="ift_bar_a ift_bar_b">
				<div class="drop_menu">
					<h4>Shout Out</h4>
				</div>
				<div class="ift_bar_btm">
					<p><span>Email the Members of Your iftClique</span></p>
					<img src="<?php echo ru_resource; ?>images/jester_u.jpg" alt="Jester Image" />
					<a href="#">SELECT</a>
				</div>
			</div>
			<div class="ift_bar_a ift_bar_c">
				<div class="drop_menu">
					<h4>Expand Your iftClique</h4>
				</div>
				<div class="ift_bar_btm">
					<input type="text" placeholder="Enter Name" />
					<input type="text" placeholder="Enter E-mail" />
					<p><span class="wide">Invite to Your iftClique Via:</span></p>
					<input type="button" value="Invite Via Email" >
					<div class="social_icon">
						<a href="#"></a>
						<a href="javascript:;" onClick="FacebookInviteFriends();" class="f"></a>
						<a href="#" class="t"></a>
						<a href="#" class="g"></a>
						<a href="#" class="m"></a>
					</div>
				</div>
			</div>
			<div class="ift_what">
				<div class="drop_menu">
					<h4>What's up with...</h4>
				</div>
				<div id="friends_iftClique"></div>
				<?php /*?><div class="iftgift_tag">
					<div class="ift_tag_blue">
						<div class="send_ift"><span>TAQ YOU'RE IT!</span> Send and iftGift</div>
						<img src="<?php echo ru_resource; ?>images/gift_icon_b.png" alt="Gift Icon"/>
						<h5>LAST iftGift FROM <span><span class="tem">THEM</span> 07/06/13</span></h5>
					</div>
					<div class="friend_point">
						<h5>Lauie James</h5>
						<img src="<?php echo ru_resource; ?>images/friend_img.jpg" align="Friend Image" />
						<h5 class="like">3,500 <span>Pts</span></h5>
						<img src="<?php echo ru_resource; ?>images/alarm_icon.jpg" alt="Alaram Icon" class="alram_icon" />
						<h5 class="birthday">Birthday 8/10/2013</h5>
					</div>
					<div class="ift_tag_blue ift_tag_pink">
						<div class="send_ift"><span>TAQ YOU'RE IT!</span> Send and iftGift</div>
						<img src="<?php echo ru_resource; ?>images/qa_icon.jpg" alt="Gift Icon"/>
						<h5>LAST Q&A FROM <span><span class="tem">THEM</span> 07/06/13</span></h5>
					</div>
					<img src="<?php echo ru_resource; ?>images/jester_v.png" alt="Jester Icon" class="jester_icon" />
					<div class="terms">
						<label>Count 'Em Out</label>
						<div class="squaredFour">
							<input type="checkbox" value="None" id="squared-Four" name="check">
							<label for="squared-Four"></label>
						</div>
					</div>
				</div><?php */?>
			</div>
			<ul class="other_frd">
				<?php
					$array = $get_user_dev;
					$count_array = count($array);
					$count       = 0;
					if($get_user_dev) {
					foreach($get_user_dev as $users) {
					$recp_email = $users['recp_email'];
					$get_recp_info = $db->get_results("select distinct(recp_email) from ".tbl_delivery." where giv_email = '".$recp_email."'",ARRAY_A);
					if($get_recp_info) {
					foreach($get_recp_info as $users2) {
					$recp_email2 = $users2['recp_email'];
					if($giver_email == $recp_email2) {	
					$query = mysql_fetch_array(mysql_query("select * from ".tbl_user." where email = '".$recp_email."'"));
					if($query['user_image']) {	
						$user_image = ru."media/user_image/".$query['userId']."/thumb/".$query['user_image']; 
					} else {
						$user_image = ru_resource."images/avtar.jpg";
					}
				?>
				<li>
					<a href="javascript:;" onclick="friendimg('<?php echo $query['userId']; ?>')" id="friend_<?php echo $query['userId']; ?>" class="friend_bar">
						<h5><?php echo ucfirst($query['first_name']).'&nbsp;'.ucfirst($query['last_name']); ?></h5>
						<div class="frd_img_outer">
							<img src="<?php echo $user_image;?>" alt="<?php echo ucfirst($query['first_name']).'&nbsp;'.ucfirst($query['last_name']); ?>" />
						</div>
					</a>
				</li>
				<?php } } } } } ?>
			<?php /*?>	<li>
					<a href="#" class="friend_bar">
						<h5>Tom Jones</h5>
						<div class="frd_img_outer frd_img_outer_b">
							<img src="<?php echo ru_resource; ?>images/jest_frd_b.jpg" alt="Friend Image" />
						</div>
					</a>
				</li>
				<li>
					<a href="#" class="friend_bar">
						<h5>Harry James</h5>
						<div class="frd_img_outer frd_img_outer_c">
							<img src="<?php echo ru_resource; ?>images/jest_frd_c.jpg" alt="Friend Image" />
						</div>
					</a>
				</li>
				<li>
					<a href="#" class="friend_bar">
						<h5>Emma Wiggins</h5>
						<div class="frd_img_outer frd_img_outer_c">
							<img src="<?php echo ru_resource; ?>images/jest_frd_d.jpg" alt="Friend Image" />
						</div>
					</a>
				</li>
				<li>
					<a href="#" class="friend_bar">
						<h5>Harry James</h5>
						<div class="frd_img_outer frd_img_outer_c">
							<img src="<?php echo ru_resource; ?>images/jest_frd_c.jpg" alt="Friend Image" />
						</div>
					</a>
				</li>
				<li>
					<a href="#" class="friend_bar">
						<h5>Lauie James</h5>
						<div class="frd_img_outer">
							<img src="<?php echo ru_resource; ?>images/jest_frd_a.jpg" alt="Friend Image" />
						</div>
					</a>
				</li>
				<li>
					<a href="#" class="friend_bar">
						<h5>Emma Wiggins</h5>
						<div class="frd_img_outer frd_img_outer_c">
							<img src="<?php echo ru_resource; ?>images/jest_frd_d.jpg" alt="Friend Image" />
						</div>
					</a>
				</li>
				<li>
					<a href="#" class="friend_bar">
						<h5>Tom Jones</h5>
						<div class="frd_img_outer frd_img_outer_b">
							<img src="<?php echo ru_resource; ?>images/jest_frd_b.jpg" alt="Friend Image" />
						</div>
					</a>
				</li><?php */?>
			</ul>
		</div>
	</div>
<script type="text/javascript">
function friendimg(id) {
	var userId = id;
	$.ajax({
			url: '<?php echo ru;?>process/get_friendiftclique.php?dId='+userId,
			type: 'get', 
			success: function(output) {
				$("#friends_iftClique").html(output);
				$(".friend_bar").removeClass("active");
				$("#friend_"+userId).toggleClass('active');
			}
	}); 
}
</script>	
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
 FB.init({ 
   appId:'338285303000069', cookie:true, 
   status:true, xfbml:true 
 });

 

function FacebookInviteFriends() {
	FB.ui({ method: 'apprequests', 
	message: 'My diaolog...'});
}
</script>	