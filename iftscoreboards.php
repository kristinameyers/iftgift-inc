<div class="mid_contant">
	<h2 class="title">Control: Your iftScore Board</h2>
	<?php include("common/controls_leftmenu.php"); ?>
	<div class="cont_bar outbox_left outbox_right inbox_right">
			<div class="ift_bar_a ift_score">
				<div class="drop_menu">
					<h4>Your iftClique Stats</h4>
				</div>
				<div class="ift_bar_btm">
					<?php
						$user_thumbimg = ru.'media/user_image/'.$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$view_image['user_image'];	
						if(@getimagesize($user_thumbimg)) {
						?>
						<img src="<?php echo $user_thumbimg; ?>" alt="<?php echo $view_image['first_name']?>" width="114" height="114" />
						<?php } else { ?>
					<img src="<?php echo ru_resource;?>images/avtar.jpg" alt="Avtar Image" />
					<?php } ?>
					<div class="flied_outer">
						<div class="flied lgt_green">
							<label>Redeemable Points:</label>
							<input type="text" placeholder="" value="<?php echo $view_image['points']; ?>">
						</div>
						<div class="flied red">
							<label>Points already redeemed:</label>
							<input type="text" placeholder="">
						</div>
						<div class="flied gray">
							<label>Points Earned This Week:</label>
							<input type="text" placeholder="">
						</div>
						<div class="flied lgt_orange">
							<label>Your Lifetime iftPoints:</label>
							<input type="text" placeholder="" value="<?php echo $view_image['points']; ?>">
						</div>
					</div>
					<p>View the <a href="javascript:;" id="schedule_awards">iftScore Schedule of Awards</a></p>
					<input type="submit" value="Redeem" />
				</div>
			</div>
			<div class="ift_bar_a ift_score ift_status">
				<div class="drop_menu">
					<h4>Your iftStats</h4>
				</div>
				<div class="ift_bar_btm">
					<div class="flied_outer">
					<?php
						$get_outbox = "SELECT count( giv_email ) AS cnt FROM ".tbl_delivery." WHERE giv_email = '".$view_image['email']."'";
						$view_outbox = $db->get_row($get_outbox,ARRAY_A);
						?>
						<div class="flied">
							<label>Total iftGifts Sent:</label>
							<input type="text" placeholder="" value="<?php echo $view_outbox['cnt'];?>">
						</div>
						<?php
						 $get_inbox = "SELECT count( recp_email ) AS cnt FROM ".tbl_delivery." WHERE recp_email = '".$view_image['email']."' and inbox = '1'";
						$view_inbox = $db->get_row($get_inbox,ARRAY_A);
						?>
						<div class="flied">
							<label>Total iftGifts Received:</label>
							<input type="text" placeholder="" value="<?php echo $view_inbox['cnt'];?>">
						</div>
						<?php
						 $get_qans = "SELECT count( answerId ) AS cnt FROM ".tbl_answer." WHERE userId = '".$_SESSION['LOGINDATA']['USERID']."'";
						 $view_qans = $db->get_row($get_qans,ARRAY_A);
						?>
						<div class="flied">
							<label>Total Q&A&rsquo;s YOU Answered:</label>
							<input type="text" placeholder="" value="<?php echo $view_qans['cnt'];?>">
						</div>
					</div>
				</div>
			</div>
			
			<div class="ift_bar_a ift_bar_c score">
				<div class="drop_menu">
					<h4>Search Their Score</h4>
					<span>For All Your Friends' Scores: <a href="#">See iftClique Page</a></span>
				</div>
				<div class="ift_bar_btm">
					<div class="score_left">
						<input type="text" placeholder="Enter Name">
						<input type="text" placeholder="Enter E-mail">
						<p><span class="wide">Invite to ftGift via:</span></p>
						<div class="social_icon">
							<a class="f" href="javascript:;" onClick="FacebookInviteFriends();"></a>
							<a class="m" href="#"></a>
						</div>
						<input type="button" value="Search">
					</div>
					<div class="score_point">
						<div class="user_bar">
							<img src="<?php echo ru_resource;?>images/avtar.png" alt="User Image" />
							<span>Harry Houdini</span>
						</div>
						<div class="record_point">
							<h4>995,000</h4>
							<h5>Lifetime iftPoints</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="ift_what">
				<div class="drop_menu">
					<h4>Winners of the Week: May 1, 2015 to May 7,2015</h4>
				</div>
				<img src="<?php echo ru_resource;?>images/jester_x.jpg" alt="Jester Image" class="jst_pnt" />
				<ul class="other_frd jester_point">
					<li>
						<a href="#" class="friend_bar">
							<div class="frd_img_outer">
								<img src="<?php echo ru_resource;?>images/jest_frd_a.jpg" alt="Friend Image" />
								<div class="tag">#1</div>
							</div>
							<h5>Tim Higgins</h5>
							<h6><span>500</span> Point Increase</h6>
							<h6><span>3,500</span> Lifetime iftPoints</h6>
						</a>
					</li>
					<li>
						<a href="#" class="friend_bar">
							<div class="frd_img_outer">
								<img src="<?php echo ru_resource;?>images/jest_frd_b.jpg" alt="Friend Image" />
								<div class="tag">#2</div>
							</div>
							<h5>Tim Higgins</h5>
							<h6><span>500</span> Point Increase</h6>
							<h6><span>3,500</span> Lifetime iftPoints</h6>
						</a>
					</li>
					<li>
						<a href="#" class="friend_bar">
							<div class="frd_img_outer">
								<img src="<?php echo ru_resource;?>images/jest_frd_c.jpg" alt="Friend Image" />
								<div class="tag">#3</div>
							</div>
							<h5>Tim Higgins</h5>
							<h6><span>500</span> Point Increase</h6>
							<h6><span>3,500</span> Lifetime iftPoints</h6>
						</a>
					</li>
					<li>
						<a href="#" class="friend_bar">
							<div class="frd_img_outer">
								<img src="<?php echo ru_resource;?>images/jest_frd_d.jpg" alt="Friend Image" />
								<div class="tag">#4</div>
							</div>
							<h5>Tim Higgins</h5>
							<h6><span>500</span> Point Increase</h6>
							<h6><span>3,500</span> Lifetime iftPoints</h6>
						</a>
					</li>
					<li>
						<a href="#" class="friend_bar">
							<div class="frd_img_outer">
								<img src="<?php echo ru_resource;?>images/jest_frd_a.jpg" alt="Friend Image" />
								<div class="tag">#5</div>
							</div>
							<h5>Tim Higgins</h5>
							<h6><span>500</span> Point Increase</h6>
							<h6><span>3,500</span> Lifetime iftPoints</h6>
						</a>
					</li>
					<li>
						<a href="#" class="friend_bar">
							<div class="frd_img_outer">
								<img src="<?php echo ru_resource;?>images/jest_frd_b.jpg" alt="Friend Image" />
								<div class="tag">#6</div>
							</div>
							<h5>Tim Higgins</h5>
							<h6><span>500</span> Point Increase</h6>
							<h6><span>3,500</span> Lifetime iftPoints</h6>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="modals" id="schedule_awards_div" style="display:none">
			<a style="cursor:pointer" onClick="close_div2();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<h3 class="gift_title">iftScore Schedule of Awards</h3>
			<div class="cont_bar_inner cont_bar_inner_b gift_idea">
				<div class="regs_form regs_form_e regs_form_f">
					<div class="ift_schd">
						<h4>Answering iftput Q&A&rsquo;S </h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">Range</div>
								<div class="notft">Multiple Choice</div>
							</li>
							<li class="record">
								<div class="from">YOU earn for answering about them</div>
								<div class="occas">6</div>
								<div class="notft">8</div>
							</li>
							<li class="record record_bgk">
								<div class="from">THEY earn when you answer</div>
								<div class="occas">4</div>
								<div class="notft">6</div>
							</li>
							<li class="record">
								<div class="from">YOU when answering about yourself</div>
								<div class="occas">10</div>
								<div class="notft">14</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Clicking Reality Check</div>
								<div class="occas">2</div>
								<div class="notft">2</div>
							</li>
							<li class="record">
								<div class="from">Submitting your own question</div>
								<div class="occas">12</div>
								<div class="notft">18</div>
							</li>
							<li class="record record_bgk">
								<div class="from">When your question is published</div>
								<div class="occas">60</div>
								<div class="notft">90</div>
							</li>
							<li class="record">
								<div class="from">For answering Feedback Q&A&rsquo;s</div>
								<div class="occas">6</div>
								<div class="notft">6</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Feedback essays earn: 10 points</div>
								<div class="occas">&nbsp;</div>
								<div class="notft">&nbsp;</div>
							</li>						
						</ul>
					</div>
					<div class="ift_schd">
						<h4>Personal Reminders</h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">You</div>
								<div class="notft">Them</div>
							</li>
							<li class="record">
								<div class="from">Creating Reminder</div>
								<div class="occas">10</div>
								<div class="notft">2</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Each Notification</div>
								<div class="occas">8</div>
								<div class="notft">1</div>
							</li>					
						</ul>
					</div>
					<div class="ift_schd">
						<h4>Build an iftGift </h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">You</div>
								<div class="notft">Them</div>
							</li>
							<li class="record">
								<div class="from">Select a suggestion</div>
								<div class="occas">10</div>
								<div class="notft">2</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Add item to iftWish List</div>
								<div class="occas">8</div>
								<div class="notft">1</div>
							</li>
							<li class="record">
								<div class="from">Add item to Owned / Hide List</div>
								<div class="occas">6</div>
								<div class="notft">1</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Transfer Funds into Cash Stash</div>
								<div class="occas">1 point per dollar (amounts rounded up)</div>
								<div class="notft">&nbsp;</div>
							</li>						
						</ul>
					</div>
					<div class="ift_schd">
						<h4>Collect an iftGift / Shop iftGift</h4>
						<ul class="unwrp_list">
							<li class="title_bar">
								<div class="from">&nbsp;</div>
								<div class="occas">You</div>
								<div class="notft">Them</div>
							</li>
							<li class="record">
								<div class="from">Release Request</div>
								<div class="occas">10</div>
								<div class="notft">2</div>
							</li>
							<li class="record record_bgk">
								<div class="from">View Suggestion Detail</div>
								<div class="occas">8</div>
								<div class="notft">1</div>
							</li>
							<li class="record">
								<div class="from">Add item to iftWish List</div>
								<div class="occas">6</div>
								<div class="notft">1</div>
							</li>
							<li class="record record_bgk">
								<div class="from">Add item to Owned / Hide List</div>
								<div class="occas">4</div>
								<div class="notft">5</div>
							</li>
							<li class="record">
								<div class="from">Purchase a Suggestion / Item</div>
								<div class="occas">123</div>
								<div class="notft">33</div>
							</li>					
						</ul>
					</div>
				</div>
				<img src="<?php echo ru_resource;?>images/jester_as.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
			</div>	
		</div>
		</div>
</div>
<div class="overlay" style="display:none"></div>
<script src="http://connect.facebook.net/en_US/all.js">
   </script>
   <script>
     FB.init({ 
       appId:'338285303000069', cookie:true, 
       status:true, xfbml:true 
     });

     

function FacebookInviteFriends()
{
FB.ui({ method: 'apprequests', 
   message: 'My diaolog...'});
}

$(function () {
	$('#schedule_awards').on('click',function () {
		$('.overlay').show();
		$('#schedule_awards_div').slideDown();
	})
});

function close_div2() {
	$('#schedule_awards_div').slideUp();
	$('.overlay').hide();
}
</script>
<style>
/* overlay styles, all needed */
.overlay{position:fixed; top:0; left:0; height:100%; width:100%; background:url(resource/images/overlay_bg.png); z-index:9999999}
/* just some content with arbitrary styles for explanation purposes */
.modals{width:auto; height:auto; padding:0 0 10px; /*position:relative;*/ position:absolute; top:30%; left:32%; background-color:#fff; margin-top:-110px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc);z-index:99999999}
.modals h3{-moz-border-radius:12px 12px 0 0; -webkit-border-radius:12px 12px 0 0; border-radius:12px 12px 0 0}
.modals img{float:left; margin:0}
.modals a{float:right}
.modals a img{margin:-16px -16px 0 0}
</style>   	