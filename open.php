<?php
$delivery_id = $_GET['s'];
$get_dev = $db->get_row("select * from ".tbl_delivery." where delivery_id = '".$delivery_id."'",ARRAY_A);
$occassionid = $get_dev['occassionid'];
$cash_amount = $get_dev['cash_amount'];
$get_user = $db->get_row("select user_image,available_cash,party_mode from ".tbl_user." where userId = '".$_SESSION['LOGINDATA']['USERID']."'",ARRAY_A);
$thumb_image_location = ru."media/user_image/".$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$get_user['user_image'];
if (@getimagesize($thumb_image_location)) {
	$user_image = ru."media/user_image/".$_SESSION['LOGINDATA']['USERID'].'/thumb/'.$get_user['user_image'];
} else {
	$user_image = ru_resource."images/upload_img_b.jpg";
}
$available_cash = $get_user['available_cash'];
$party_mode = $get_user['party_mode'];
///new code occasion
$getoccss = explode("_",$occassionid);
	//print_r($getoccss);
if($occassionid == 'other_'.$getoccss[1]){
	$occasion_name = $getoccss[1];
}else{
$get_occas = $db->get_row("select occasion_name from ".tbl_occasion." where occasionid = '".$occassionid."'",ARRAY_A);
						$occasion_name = $get_occas['occasion_name'];
}
?>
<div class="mid_contant">
		<h2 class="title">Unwrap: Pending iftGift</h2>
		<div class="cont_bar">
			<div class="mile_birthday"><img src="<?php echo $user_image?>" width="48" height="62" /><h3>Your <?php echo $occasion_name;?> iftGift from <?php echo $get_dev['giv_first_name'].' '.$get_dev['giv_last_name'];?></div>
			<?php /*?><div class="unwrp_right unlock_right">
				<label>Party Mode!</label>
				<div class="on_off">
					<a href="javascript:;" id="off" class="off">OFF</a>
					<a href="javascript:;" id="on" class="on <?php if($party_mode == 'on' || $page == "open") { ?>active<?php } ?>">ON</a>
				</div>
				<p>OFF reveals cash amount. <br/>ON hides cash amount, <br/>but displays your iftGifts.</p>
			</div><?php */?>
			<script type="text/javascript">
			var $j = jQuery.noConflict();
			$j('.on_off a').on('click', function() {
				var id = $j(this).attr('id');
				var uid = '<?php echo $_SESSION['LOGINDATA']['USERID']; ?>';
				$j.ajax({
				url: '<?php echo ru;?>process/process_mode.php',
				type: 'POST', 
				data: {mode:id,userid:uid} ,
				success: function(output) {
					if(output == 'on')
					{
						$j('#row_dim').hide();
						$j('#on').addClass('active');
						$j('#off').removeClass('active');
						$j('.locker').show();
					} else {
						$j('#row_dim').show(); 
						$j('#off').addClass('active');
						$j('#on').removeClass('active');
						$j('.locker').hide();
					}
				}
				})
			});
			</script>
			<div class="cont_bar_inner">
				<div class="unlock_time">
					<h4>Unlocks in:</h4>
					<div class="unlock_time_inner">
						<div class="time_bar">
							<div class="time_bar_inner">O</div>
							<span>WEEKS</span>
						</div>
						<div class="time_bar">
							<div class="time_bar_inner">P</div>
							<span>DAYS</span>
						</div>
						<div class="time_bar">
							<div class="time_bar_inner">E</div>
							<span>HOURS</span>
						</div>
						<div class="time_bar">
							<div class="time_bar_inner">N</div>
							<span>MINUTES</span>
						</div>
						<div class="time_bar second">
							<div class="time_bar_inner">!</div>
							<span>SECONDS</span>
						</div>
					</div>
					<?php
						$timestamps = strtotime($get_dev['unlock_date']);
						$unlock_date = date('l F d, Y', $timestamps);
					?>
					<div class="unlock_day opon_day"><?php echo $unlock_date?> @ <?php echo $get_dev['unlock_time']; ?></div>
				</div>
				
				<?php if ($get_dev['game_flag'] == 1) {?>	

<link rel="stylesheet" href="<?php echo ru; ?>game/brickslayer.css"/>
<div class="mid_contant regst game">
	<!--<h1 class="regst">iftGift Game</h1>-->
	<div class="game_outer">
		<div id="console">
  <!-- main screen of the game -->
  <div id="game" class="screen">
	<div id="paddle" class="sprite"></div>
    <div id="ball" class="sprite"></div>
    <div id="bricks"></div>

<!--	<div style="  background: none repeat scroll 0 0 #ccc;    border-top: 1px solid #999;    height: 20px;    margin: 0;    position: relative;    top: 282px;
    width: 100%;">-->
    <div id="lake"></div>
    <div class="wall" id="leftWall"></div>
    <div class="wall" id="rightWall"></div>
    <div class="wall" id="ceiling"></div>
    <div class="wall" id="floor"></div>
	
	<div id="scorecard"><span class="i">i</span><span class="f">f</span><span class="t">t</span>Points:</div><div id="score">0</div>
	<div id="levelarea">level:</div>
    <div id="level">1</div>
	<div id="liveremain">Lives Remaining:</div>
	<div class="spare" id="spare1"></div>
    <div class="spare" id="spare2"></div>
    <div class="spare" id="spare3"></div>
	
    
<!--</div>-->

  </div>
 <div class="overlay" style="display:none"></div>
	
	<div class="modal modal_d" id="model_allfields" style="display:none">
			<a style="cursor:pointer" onclick="divclose();" class="cross_btn"><img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" /></a>
			<h4>IftGift Slayer</h4>
			<p class="jest_tray">The objective of the game is to break rows of multi-colored gift boxes by bouncing the gift box between the s'Jester's tray and the gift boxes above. The game is won when all of the multicolored gift boxes are broken.</p>
			
			<p>Press <span>ENTER to START</span> the game.</p>
			<p>Use the <span>ARROW KEYS</span> to launch ball to move the <span>LEFT</span> and <span>RIGHT.</span></p>
			<p>Use the <span>UP ARROW</span> to <span>LAUNCH</span> the golden gift box upward.</p>
			<p>Press <span>P to PAUSE.</span></p>
			<a class="orange orange_b orange_c" onClick="divclose();">Back to the Game</a>
	</div> 
  <!-- title screen -->
 <div id="title" class="overlay screen">
   
  </div>

  <!-- pause screen -->
  <div id="pause" class="overlay screen">
    <img src="sprites/paused.png" alt="paused"/>
    <p>press <strong>p</strong> again to unpause</p>
  </div>

  <!-- game over screen -->
  <div id="gameover" class="overlay screen">
    <img src="sprites/gameover.png" alt="game over"/>
  </div>
  
  <!-- level clear screen -->
  <div id="clear" class="overlay screen">
    <img src="sprites/levelclear.png" alt="level clear!"/>
  </div>
  <!-- high score screen -->
  <div id="scores" class="overlay screen">
   <!-- <img src="sprites/highscores.png" alt="high scores" />-->
    <table id="scoretable" width="100%">
    </table>
    <script type="text/javascript">
    /* <![CDATA[ */
		for (i=1; i<=5; i++) {
			jQuery('scoretable').innerHTML += (
			   '<tr id="high_row_' + i +  '" class="old">' +
			   '<td class="name" id="high_name_' + i + '"</td>'+
			   '<td class="score" id="high_score_' + i + '"</td>'+
			   '</tr>');
		}
    /* ]]> */
    </script>
    <p class="pressenter">Press <span>ENTER</span> to start</p>
  </div>
  
  <!-- enter your name screen -->
  <div id="congrats" class="overlay screen">
  <!-- <img src="sprites/congrats.png" alt="congratulations!" />
  	<p>You made the High Score List! Enter Your Name!</p>
    <label>name
      <input type="text" id="player_name" name="player_name" />
      <input type="hidden" id="player_score" name="player_score" />
      <input type="hidden" id="player_level" name="player_level" />
    </label>
    <button onclick="post_score()">go</button>-->
  </div>


</div>
	</div>
</div>

			<?php } else {?>
			
				<div class="safe_bar">
					<div class="safe_bar_inner safe_bar_inner_b">
						<h4>Your Cash Gift</h4>
						
						<div class="total_cash" id="row_dim" style="display:none">
							<h4>$<?php echo number_format($cash_amount,2);?></h4>
							<div class="total_cash_inner">Total Cash Stash<br/><span>$<?php echo number_format($available_cash,2);?></span></div>
						</div>
						
						<div class="total_cash" id="row_dim" style="display:none">
							<h4>$<?php echo number_format($cash_amount,2);?></h4>
							<div class="total_cash_inner">Total Cash Stash <span>$<?php echo number_format($available_cash,2);?></span></div>
						</div>
						
						<img src="<?php echo ru_resource; ?>images/icon_i.jpg" class="locker"  alt="Locker Icon" />
						
						
						
					</div>
					<div class="sugget_left">
						<div class="terms">
							<div class="squaredFour left">
								<input type="radio" value="on" id="eleven" name="radiog_lite" onclick="go_unwrap('<?php echo $delivery_id; ?>');" />
								<label for="eleven"></label>
							</div>
							<label class="title">Unwrap Your iftGift</label>
						</div>
					</div>
					<script type="text/javascript">
					function go_unwrap(Id)
					{
						var dId = Id;
						var d=new Date();
						var dat=d.getDate();
						var mon=d.getMonth()+1;
						var year=d.getFullYear();
						var todayDate = mon+"/"+dat+"/"+year;
						
						var date=new Date();
						var hours = date.getHours();
						var ampm = hours >= 12 ? 'PM' : 'AM'; 
						var minutes = date.getMinutes();
						hours = hours % 12;
						hours = hours ? hours : 12; // the hour '0' should be '12'
						hours = hours < 10 ? '0'+hours : hours;
						minutes = minutes < 10 ? '0'+minutes : minutes;
						var time_dev = todayDate+'_'+hours+':'+minutes+' '+ampm;
						jQuery.ajax({
						url: '<?php echo ru;?>process/process_unwrap.php?pId='+dId+'&time_dev='+time_dev+'&cash_amount=<?php echo $cash_amount;?>&tcash=<?php echo $available_cash;?>',
						type: 'get', 
						success: function(output) {
						if(output == 'Success')
						{
							window.location = "<?php echo ru?>unwrapped/"+dId;
						}
						}
						});
					}
					</script>
				</div>
				<div class="or your_sugst"><div class="line"><span>Your Suggestions</span></div></div>
				<ul class="gift_box">
					<li><img src="<?php echo ru_resource; ?>images/gift_box_a.jpg" alt="Gift Box A" /></li>
					<li><img src="<?php echo ru_resource; ?>images/gift_box_b.jpg" alt="Gift Box B" /></li>
					<li><img src="<?php echo ru_resource; ?>images/gift_box_c.jpg" alt="Gift Box C" /></li>
					<li><img src="<?php echo ru_resource; ?>images/gift_box_d.jpg" alt="Gift Box D" /></li>
					<li><img src="<?php echo ru_resource; ?>images/gift_box_e.jpg" alt="Gift Box E" /></li>
					<li><img src="<?php echo ru_resource; ?>images/gift_box_f.jpg" alt="Gift Box F" /></li>
				</ul>
				<a href="<?php echo ru; ?>dashboard" class="go_deshbord">Go to Your Dashboard</a>
					<?php }?>
			</div>
		</div>
	</div>
<?php 
/*if($_GET['open'])
{

	$delivery_id = $_GET['open'];	
	$Qry = mysql_query("update ".tbl_delivery." set game_flag = 0 where delivery_id = '".$delivery_id."'");
	if($Qry)
	{
		echo "Success";
	}
	}*/
	
 ?>