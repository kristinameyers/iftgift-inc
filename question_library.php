<?php
if($_GET['s'] == 'bkm') {
$get_question = $db->get_results("select * from ".tbl_question_answer." where bookmark_question = '1'",ARRAY_A);
} else if($_GET['s'] != 'bkm' && $_GET['s'] != '') {
	$get_question = $db->get_results("select * from ".tbl_question_answer." where (question like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer1 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer2 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer3 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer4 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer5 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer6 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer7 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%' or answer8 like '%".mysql_real_escape_string(stripslashes(trim($_GET['s'])))."%')",ARRAY_A);
 } else {
$get_question = $db->get_results("select * from ".tbl_question_answer."",ARRAY_A);
}
//unset($_SESSION['question_ans']);
?>
<script type="text/javascript" src="<?php echo ru_resource;?>js/lib/jquery.tinycarousel.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#slider1').tinycarousel();
		});
	</script>	
<div class="mid_contant">
	<h2 class="title">Q&A Library</h2>
	<div class="cont_bar cont_bar_b">
		<div class="cont_bar_inner cont_bar_inner_c">
			<img src="<?php echo ru_resource;?>images/lib_jester.png" alt="Jester Library Image" class="lib_jester" />
			<h2 class="title">Create a Custom iftPut Q&A Qiuz <span>So You Can Send and Receive Smarter iftGifts</span></h2>
			<div class="sugget_box">
					<?php include("common/question_top.php");?>
					<div class="qa_btn">
						<a href="<?php echo ru;?>question" class="answer_q">Answer now</a>
						<a href="javascript:;" id="email_friend" class="orange">Email to a Friend</a>
					</div>
				</div>
				<h2 class="title">Select From Questions Below <span>Use Our Search Tools to Find the Perfect Q&A </span></h2>
				<form method="post" action="<?php echo ru;?>process/search_question.php">
				<div class="sugget_box qa_bookmark">
					<div class="flied">
						<input type="text" name="keyword" id="keyword" placeholder="Keyword..." />
					</div>
					<div class="answr">
						<label>Answered:</label>
						<div class="terms">
							<div class="squaredFour">
								<input type="checkbox" name="check" id="twentyfour" value="None">
								<label for="twentyfour"></label>
							</div>
							<label>About You</label>
						</div>
						<div class="terms">
							<div class="squaredFour">
								<input type="checkbox" name="check" id="twentyfive" value="None">
								<label for="twentyfive"></label>
							</div>
							<label>By You</label>
						</div>
						<input type="submit" value="Search" class="search" />
					</div>
					<a href="<?php echo ru; ?>question_library/bkm" class="flied bookmark">
						<img src="<?php echo ru_resource;?>images/bkm_icon.png" alt="bookMrak Icon" />BOOKMARKED QUESTIONS
					</a>
				</div>
				</form>
				<ul class="unwrp_list qa_list">
					<li class="title_bar">
						<div class="from">#</div>
						<div class="occas">Select</div>
						<div class="notft">Question and Answers</div>
						<div class="unlock">&nbsp;</div>
						<div class="unwrapd">&nbsp;</div>
					</li>	
					<?php
						if($get_question) {
						$c = true;
						$i = 0;
							foreach($get_question as $question) {
					?>
						<li id="record_<?php echo $question['qId']?>" class="record <?php if($question['bookmark_question']) {?>bkm_list<?php } ?> <?php if($c = !$c) { ?>record_bgk<?php } else { } ?>">
							<div class="from"><?php echo ++$i; ?></div>
							<div class="occas">
								<div class="squaredFour">
									<input type="checkbox" class="test" value="None" onclick="select_question('<?php echo $question['qId']?>')" id="<?php echo $question['qId']?>" name="check" />
									<label for="<?php echo $question['qId']?>"></label>
								</div>
								<?php if($question['bookmark_question'] == 0) {?>
								<img src="<?php echo ru_resource;?>images/bkm_icon_b.png" class="nobookmark_icon" id="nobookmark_<?php echo $question['qId']?>" alt="bookMrak Icon" style="cursor:pointer" />
								<?php } else { ?>
								<img src="<?php echo ru_resource;?>images/bkm_icon_c.png" class="bookmark_icon" id="bookmark_<?php echo $question['qId']?>" alt="bookMrak Icon" style="cursor:pointer" />
								<?php } ?>
							</div>
							<div class="notft">
								<span>Q: <?php echo $question['question']; ?></span>
								<span>A: <?php echo $question['answer1']; ?>, <?php echo $question['answer2']; ?> <?php if($question['answer3']) { echo ",".$question['answer3']; } ?> <?php if($question['answer4']) { echo ",".$question['answer4']; } ?> <?php if($question['answer5']) { echo ",".$question['answer5']; } ?> <?php if($question['answer6']) { echo ",".$question['answer6']; } ?> <?php if($question['answer7']) { echo ",".$question['answer7']; } ?> <?php if($question['answer8']) { echo ",".$question['answer8']; } ?> </span>	
							</div>
							<div class="unlock">3</div>
							<div class="unwrapd">56</div>
						</li>
					<?php } } ?>
				</ul>
			</div>
	</div>
	<div class="modal modal_b modal_c" id="email_friend_div" style="display:none">
			<a style="cursor:pointer" onClick="close_div2();">
				<img src="<?php echo ru_resource; ?>images/close_icon.png" alt="Closed Icon" />
			</a>
			<div class="cont_bar_inner cont_bar_inner_d">
				<img src="<?php echo ru_resource; ?>images/jester_ae.jpg" alt="Jester Image" class="reg_jst_a reg_jst_e" />
				<div class="regs_form send_ques">
					<h4 class="snd">Send Questions to Friends</h4>
					<form>
					<div class="multi-field-wrapper">
					<div class="multi-fields">
					<div class="multi-field">
						<div class="flied">
							<input type="text" name="firstname[]" placeholder="First Name" />
							<input type="text" name="lastname[]"  placeholder="Last Name" />
							<input type="text" name="email[]"  placeholder="Email" />
						</div>
						</div>	
						</div>
						<a href="javascript:;" class="add-field">+ Click here to add more friends</a>
						</div>
						<div class="flied fill">
							<h4 class="snd fill">Fill in your desired text to accompany your questions.</h4>
							<input type="text" placeholder="Subject Header:to the recipient" />
							<textarea placeholder="[Enter Your Text Here]"></textarea>
							<input type="submit" value="Send Q&A">
						</div>
					</form>
				</div>
			</div>
		</div>
</div>
<div class="overlay" style="display:none"></div>
<style>
/* overlay styles, all needed */
/*.overlay{position:fixed; top:0; left:0; height:100%; width:100%; background:url(resource/images/overlay_bg.png); z-index:9999999}*/
/* just some content with arbitrary styles for explanation purposes */
/*.modals{width:auto; height:auto; padding:0 0 10px; position:absolute; top:30%; left:32%; background-color:#fff; margin-top:-110px; margin-left:-280px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; behavior:url(PIE.htc);z-index:99999999}
.cont_bar h3{-moz-border-radius:12px 12px 0 0; -webkit-border-radius:12px 12px 0 0; border-radius:12px 12px 0 0}
.modals img{float:left; margin:0}
.modals a{float:right}
.modals a img{margin:-16px -16px 0 0}*/
.cont_bar_inner.cont_bar_inner_d .regs_form.send_ques{ max-width:100%; margin:0; width:100%}
</style>	
<script type="text/javascript">
$(function () {
	$('.multi-field-wrapper').each(function() {
		var $wrapper = $('.multi-fields', this);
		$(".add-field", $(this)).click(function(e) {
			$('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('');
		});
	});
});

$(function () {	
	$("#email_friend").on('click',function () {
		$(".overlay").show();
		$("#email_friend_div").show("slow");
	});
	
	$("#Releaserequests").on('click',function () {
		var form = $("#Releaserequest")
		$.ajax({
			url: "<?php echo ru; ?>process/process_releaserequest.php",	
			type: "POST",
			data: form.serialize(),
			success: function (data) {
				if(data == 1) {
					setTimeout(function() { 
						window.location.href = '<?php echo ru; ?>locked/<?php echo $get_dev['delivery_id']; ?>'; 
					}, 1000);
				} 
			}
		});		
	});
});

function close_div2()
{
	jQuery(document).ready(function () {
	jQuery(".modal").slideUp("slow");
	jQuery(".overlay").css("display","none");
	});
}

$(function () {
	$('.bookmark_icon,.nobookmark_icon').on('click', function () {
		var qId = this.id;
		var divId = qId.split('_');
		if(divId[0] == 'bookmark') {
			var myData = 'bQId='+divId[1]+'&bkmquestion=0';
			$.ajax({
				url:'<?php echo ru;?>process/process_question.php',
					type:'POST',
					data:myData,
					success:function (response) {
					if(response) {
						$("#"+qId).attr("src", "<?php echo ru_resource;?>images/bkm_icon_b.png");
						$("#record_"+divId[1]).removeClass(" bkm_list");
						$("#"+qId).attr("id", "nobookmark_"+divId[1]);
						$("#"+qId).removeClass("bookmark_icon");
						$("#"+qId).addClass("nobookmark_icon");
					}
				}
			});
		} else if(divId[0] == 'nobookmark') {
			var myData = 'bQId='+divId[1]+'&bkmquestion=1';
			$.ajax({
				url:'<?php echo ru;?>process/process_question.php',
					type:'POST',
					data:myData,
					success:function (response) {
					if(response) {
						$("#"+qId).attr("src", "<?php echo ru_resource;?>images/bkm_icon_c.png");
						$("#"+qId).removeClass("nobookmark_icon");
						$("#"+qId).attr("id", "bookmark_"+divId[1]);
						$("#"+qId).addClass("bookmark_icon");
						$("#record_"+divId[1]).addClass(" bkm_list");
					}
				}
			});
		}
	});
});

/***********************SELECT QUESTION******************************/
function select_question(qid) {
	var qId = qid;
	var input = document.getElementById (qId);
    var isChecked = input.checked;
    isChecked = (isChecked)? "checked" : "not checked";
    if(isChecked == 'checked') { 
	var myData = 'qid='+qId+'&type=add';
	$.ajax({
		url: "<?php echo ru;?>process/process_question.php",
		type: "GET",
		data: myData,
		success:function(output) {
			$('#cart_suggest').html(output);
			$('#cart_suggest').addClass('no_card_ques');
			$('#no_cart').hide();
		}
	});
	} else if(isChecked == 'not checked') { 
	var myData = 'qid='+qId+'&type=delete';
	$.ajax({
		url: "<?php echo ru;?>process/process_question.php",
		type: "GET",
		data: myData,
		success:function(output) {
			$('#cart_suggest').html(output);
			$('#cart_suggest').addClass('no_card_ques');
			$('#no_cart').hide();
		}
	});
	}
}

</script>	