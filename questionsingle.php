<?php
	if($_GET['s']) {
				$get_question = $db->get_row("select * from ".tbl_question_answer." where question_type = 'multiple' and feedback_question = 1 ORDER BY RAND() LIMIT 1",ARRAY_A);
	} else { 
		if(isset($_SESSION['question_ans']) && $_SESSION['LAST']['PAGE'] == ru.'question_library') {//echo "here"; exit;
			$max=count($_SESSION['question_ans']);
			$z = 1;
			for($i=0;$i<$max;$i++){	
			
				if ($z == $max)
  				{
					$qid=$_SESSION['question_ans'][$i]['qid'];
					$get_question = $db->get_row("select * from ".tbl_question_answer." where question_type = 'multiple' and qId = '".$qid."'",ARRAY_A);
				}
				$z++;
			}	
		} else {
				//$get_question = $db->get_row("select * from ".tbl_question_answer." where question_type = 'multiple' ORDER BY RAND() LIMIT 1",ARRAY_A);
				$get_question = $db->get_row("SELECT * FROM ".tbl_question_answer." WHERE gift_question_answer.question_type = 'multiple' and gift_question_answer.qId  NOT IN (SELECT qId FROM gift_answer where gift_answer.userId = '".$_SESSION['LOGINDATA']['USERID']."') ORDER BY RAND() LIMIT 1",ARRAY_A);
				
			}
	}	
?>
<script>
	$(document).ready(function(){
	  $("#submit_answer").click(function(){
		$("#reality_check").slideDown();
		$("#submit_answer").hide();
	  });
	});
	$(document).ready(function(){
		$(".ques_rangebar table.range_ans td").click(function(){
			var id = this.id;
			var ans = id.split('_');		
			var answer = ans[1];
			$('#multipile').attr("value",answer);
			$("a").removeClass("active");
			$("td a#"+ans[0]).addClass("active");
	  });
	});
</script>
<div class="mid_contant">
		<div class="cont_bar">
			<h3 class="use_nam">&nbsp;</h3>
			<img src="<?php echo ru_resource;?>images/jester_ac.png" alt="Jester Image" class="jst_ans" />
			<h3 class="use_nam ques_wht"><?php echo str_replace('[MEMBER.FirstName]',ucfirst($user_first_name),$get_question['question']); ?></h3>
			<div class="cont_bar_inner">
				<div class="ques_range_outer">
					<!--<h5>Click the marker to move to appropriate point along scale.</h5>-->
					<h5>Make your single choice selection by clicking on a color bar.</h5>
					<div class="ques_rangebar">
						<div class="range"></div>
						<table class="range_ans">
							<tr>
								<td id="answer1_<?php echo $get_question['answer1']; ?>" value="<?php echo $get_question['answer1']; ?>"><a href="javascript:;" class="color_a" id="answer1" ></a></td>
								<td id="answer2_<?php echo $get_question['answer2']; ?>" value="<?php echo $get_question['answer2']; ?>"><a href="javascript:;" class="color_b" id="answer2"></a></td>
								<td id="answer3_<?php echo $get_question['answer3']; ?>" value="<?php echo $get_question['answer3']; ?>"><a href="javascript:;" class="color_c" id="answer3"></a></td>
								<td id="answer4_<?php echo $get_question['answer4']; ?>" value="<?php echo $get_question['answer4']; ?>"><a href="javascript:;" class="color_d" id="answer4"></a></td>
								<td id="answer5_<?php echo $get_question['answer5']; ?>" value="<?php echo $get_question['answer5']; ?>"><a href="javascript:;" class="color_e" id="answer5"></a></td>
								<td id="answer6_<?php echo $get_question['answer6']; ?>" value="<?php echo $get_question['answer6']; ?>"><a href="javascript:;" class="color_f" id="answer6"></a></td>
								<td id="answer7_<?php echo $get_question['answer7']; ?>" value="<?php echo $get_question['answer7']; ?>"><a href="javascript:;" class="color_g" id="answer7"></a></td>
								<td id="answer8_<?php echo $get_question['answer8']; ?>" value="<?php echo $get_question['answer8']; ?>"><a href="javascript:;" class="color_h" id="answer8"></a></td>
							</tr>
							<tr class="value">
								<td>
									<span><?php echo $get_question['answer1']; ?></span>
								</td>
								<td>
									<span><?php echo $get_question['answer2']; ?></span>
								</td>
								<td>
									<span><?php echo $get_question['answer3']; ?></span>
								</td>
								<td>
									<span><?php echo $get_question['answer4']; ?></span>
								</td>
								<td>
									<span><?php echo $get_question['answer5']; ?></span>
								</td>
								<td>
									<span><?php echo $get_question['answer6']; ?></span>
								</td>
								<td>
									<span><?php echo $get_question['answer7']; ?></span>
								</td>
								<td>
									<span><?php echo str_replace('[MEMBER.FirstName]',ucfirst($_SESSION['LOGINDATA']['NAME']),$get_question['answer8']); ?></span>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="range_btm">
					<div class="range_option quest" onclick="somebody_question()" style="cursor:pointer">
						<?php /*?><img src="<?php echo ru_resource;?>images/icon_m.png" alt="Answer Questions Icon" /><?php */?>
						<span>Answer Questions About Somebody Else</span>
					</div>
					<div class="range_option bkm bkms <?php if($get_question['bookmark_question'] == 1) { ?>active<?php } ?>" onclick="bookmark_question('<?php echo $get_question['qId']; ?>')" style="cursor:pointer">
						<?php /*?><img src="<?php echo ru_resource;?>images/icon_n.png" alt="Answer Questions Icon" /><?php */?>
						<span>Bookmark in Q&A Library</span>
					</div>
					<div class="range_option exit_qa" onclick="exit_question()" style="cursor:pointer">
						<?php /*?><img src="<?php echo ru_resource;?>images/icon_o.png" alt="Answer Questions Icon" /><?php */?>
						<span>Exit Q&A </span>
					</div>
					<div class="range_option bkm skp" onclick="skip_question()" style="cursor:pointer">
						<?php /*?><img src="<?php echo ru_resource;?>images/icon_p.png" alt="Answer Questions Icon" /><?php */?>
						<span>Skip Question</span>
					</div>
					<a href="javascript:;" id="submit_answer">Submit answer</a>
				</div>
			</div>
		</div>
		<div class="cont_bar" id="reality_check" style="display:none">
			<h2 class="title retly">Reality Check<sup>SM</sup></h2>
			<div class="graph">
				<div class="chart_bar">
					<span><?php echo ucfirst($user_first_name); ?>'s&nbsp;<span class="i">i</span><span class="f">f</span><span class="t">t</span>Clique</span>
					<img src="<?php echo ru_resource;?>images/chart_img.jpg" alt="Chart Image" />
				</div>
				<div class="chart_bar">
					<span>Similar Persons</span>
					<img src="<?php echo ru_resource;?>images/chart_img.jpg" alt="Chart Image" />
				</div>
				<div class="chart_bar">
					<span>The World</span>
					<img src="<?php echo ru_resource;?>images/chart_img.jpg" alt="Chart Image" />
				</div>
				<img src="<?php echo ru_resource;?>images/jester_ad.jpg" alt="Jester Image" class="jst_ques" />
				<input type="hidden" name="multipile" id="multipile" value=""  />
				<a href="javascript:;" id="confirm_question">Confirm answer</a>
			</div>
		</div>
	</div>
<script type="text/javascript">
function somebody_question() {
	window.location = "<?php echo ru;?>questionsadd";
}

function exit_question() {
	window.location = "<?php echo ru;?>dashboard";
}

function skip_question() {
	var currentLocation = window.location;
	if(currentLocation == '<?php echo ru;?>questionsingle/feedback') {
		window.location = "<?php echo ru;?>question/feedback";
	} else {
		window.location = "<?php echo ru;?>question";
	}
}

$(function () {
	$('#confirm_question').on('click',function () {
		var qId = '<?php echo $get_question['qId']; ?>';
		var qAns = $('#multipile').val();
		var userId = '<?php echo $_SESSION['LOGINDATA']['USERID'];?>';
		var max_count = '<?php echo count($_SESSION['question_ans']);?>';
		var cart_question = '<?php echo $_SESSION['question_ans']; ?>';
		var myData = 'qId='+qId+'&qAns='+qAns+'&userId='+userId+'&question=1';
		$.ajax({
			url:'<?php echo ru;?>process/process_question.php',
			type:'POST',
			data:myData,
			success:function (response) {
				if(response) {
					setTimeout(function() { 
						var currentLocation = window.location;
						if(currentLocation == '<?php echo ru;?>questionsingle/feedback') {
							window.location = "<?php echo ru;?>question/feedback";
						} else if(max_count == 1 && cart_question == '<?php echo $_SESSION['question_ans']; ?>') {
							window.location.href = '<?php echo ru; ?>questionthankyou'; 
						}else {
    						window.location.href = '<?php echo ru; ?>questionsingle'; 
						}
 					}, 1000);
				}
			}
		});
	})
})

function bookmark_question(qId) {
	var QId = qId;
	var myData = 'qId='+QId+'&bkmquestion=1';
	$.ajax({
		url:'<?php echo ru;?>process/process_question.php',
			type:'POST',
			data:myData,
			success:function (response) {
			if(response) {
				$(".bkms").addClass('active');
			}
		}
	});
}
</script>		