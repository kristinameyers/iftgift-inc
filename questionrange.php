<?php
	 if($_GET['s']) {	
				$get_question = $db->get_row("select * from ".tbl_question_answer." where question_type = 'range' and feedback_question = 1 ORDER BY RAND() LIMIT 1",ARRAY_A);
		} else {
			if(isset($_SESSION['question_ans']) && $_SESSION['LAST']['PAGE'] == ru.'question_library') {
			$max=count($_SESSION['question_ans']);
			$z = 1;
			for($i=0;$i<$max;$i++){	
			
				if ($z == $max)
  				{
					$qid=$_SESSION['question_ans'][$i]['qid'];
					$get_question = $db->get_row("select * from ".tbl_question_answer." where question_type = 'range' and qId = '".$qid."'",ARRAY_A);
				}
				$z++;
			}	
		} else {
					//$get_question = $db->get_row("select * from ".tbl_question_answer." where question_type = 'range' ORDER BY RAND() LIMIT 1",ARRAY_A);
					$get_question = $db->get_row("SELECT * FROM ".tbl_question_answer." WHERE gift_question_answer.question_type = 'range' and gift_question_answer.qId NOT IN (SELECT qId FROM gift_answer where gift_answer.userId = '".$_SESSION['LOGINDATA']['USERID']."') ORDER BY RAND() LIMIT 1",ARRAY_A);
					
			}
		}
	$answer1 =	$get_question['answer1'];
	$answer2 =	$get_question['answer2'];
?>
<link rel="stylesheet" type="text/css" href="<?php echo ru_resource;?>css/jquery-ui.css">

<script src="<?php echo ru_resource;?>js/jquery-ui.js"></script>
<script src="<?php echo ru_resource;?>js/jquery-ui-slider-pips.js"></script>
<script>
$(document).ready(function() {
	$.extend( $.ui.slider.prototype.options, {
		animate: false ,
		stop: function(e,ui) {
			//ga("send", "event", "slider", "interact", this.id );
		}
	});
	var $slider1 = $("#mainDemo").slider({ value: 50,
		min: 10,
		max: 90,
		step: 10,
		change: function(event, ui) { 
        	$("#range").attr("value",ui.value);
 		 } 
	});
		$slider1.slider("pips");
	 var min = 10;
	 var max = 90;
	if(min == 10) {
		$(".ui-slider-pip-first .ui-slider-label").html("<?php echo $answer1; ?>");
	}  
	if(max == 90) {
		$(".ui-slider-pip-last .ui-slider-label").html("<?php echo $answer2; ?>");
	}
	
	$("#submit_answer").click(function(){
		$("#reality_check").slideDown();
		$("#submit_answer").hide();
  });
});
</script>
<style>
	.ui-slider-pip-first .ui-slider-label, .ui-slider-pip-last .ui-slider-label{width:auto; left:auto; word-break: keep-all}
	
</style>
<div class="mid_contant">
		<div class="cont_bar">
			<h3 class="use_nam">&nbsp;</h3>
			<img src="<?php echo ru_resource;?>images/jester_ac.png" alt="Jester Image" class="jst_ans" />
			<h3 class="use_nam ques_wht"><?php echo str_replace('[MEMBER.FirstName]',ucfirst($user_first_name),$get_question['question']); ?></h3>
			<div class="cont_bar_inner">
				<div class="ques_range_outer">
					<!--<h5>Make your selection by clicking on the bar to move the marker</h5>-->
					<h5>Click the marker to move to appropriate point along scale.</h5>
					<div class="ques_rangebar single_ques">
						<div id="mainDemo" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all ui-slider-pips" aria-disabled="false" >
							<table>
								<a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 50%;"></a>
								<div class="range_scroll"></div>
								<input type="hidden" name="range" id="range" value="50"  />
								<td style="left:0%" class="ui-slider-pip ui-slider-pip-first ui-slider-pip-label ui-slider-pip-0">
									<span class="ui-slider-line"></span>
									<span data-value="0" class="ui-slider-label">0</span>
								</td>
								<td style="left:12.5000%" class="ui-slider-pip ui-slider-pip-1">
									<span class="ui-slider-line"></span><span data-value="1" class="ui-slider-label">1</span>
								</td>
								<td style="left:25.0000%" class="ui-slider-pip ui-slider-pip-2">
									<span class="ui-slider-line"></span><span data-value="2" class="ui-slider-label">2</span>
								</td>
								<td style="left:37.5000%" class="ui-slider-pip ui-slider-pip-3">
									<span class="ui-slider-line"></span><span data-value="3" class="ui-slider-label">3</span>
								</td>
								<td style="left:50.0000%" class="ui-slider-pip ui-slider-pip-4">
									<span class="ui-slider-line"></span><span data-value="4" class="ui-slider-label">4</span>
								</td>
								<td style="left:62.5000%" class="ui-slider-pip ui-slider-pip-5">
									<span class="ui-slider-line"></span><span data-value="5" class="ui-slider-label">5</span>
								</td>
								<td style="left:75.0000%" class="ui-slider-pip ui-slider-pip-6">
									<span class="ui-slider-line"></span><span data-value="6" class="ui-slider-label">6</span>
								</td>
								<td style="left:87.5000%" class="ui-slider-pip ui-slider-pip-7">
									<span class="ui-slider-line"></span>
									<span data-value="7" class="ui-slider-label">7</span>
								</td>
								<td style="left:100.0000%" class="ui-slider-pip ui-slider-pip-8">
									<span class="ui-slider-line"></span><span data-value="8" class="ui-slider-label">8</span>
								</td>
							</table>
						</div>
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
					<span><?php echo ucfirst($user_first_name); ?>'s <span class="i">i</span><span class="f">f</span><span class="t">t</span>Clique</span>
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
	if(currentLocation == '<?php echo ru;?>questionrange/feedback') {
		window.location = "<?php echo ru;?>question/feedback";
	} else {
		window.location = "<?php echo ru;?>question";
	}
}

$(function () {
	$('#confirm_question').on('click',function () {
		var qId = '<?php echo $get_question['qId']; ?>';
		var qAns = $('#range').val();
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
						if(currentLocation == '<?php echo ru;?>questionrange/feedback') {
							window.location = "<?php echo ru;?>question/feedback";
						} else if(max_count == 1 && cart_question == '<?php echo $_SESSION['question_ans']; ?>') {
							window.location.href = '<?php echo ru; ?>questionthankyou'; 
						} else {
    						window.location.href = '<?php echo ru; ?>questionrange'; 
						}
 					}, 1000);
				}
			}
		});
	})
});

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