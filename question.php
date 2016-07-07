<?php
	$_SESSION['LAST']['PAGE'] = $_SERVER['HTTP_REFERER'];
	if(isset($_SESSION['question_ans']) && $_SESSION['LAST']['PAGE'] == ru.'question_library')
	{
		$max=count($_SESSION['question_ans']);
		$z = 1;
		for($i=0;$i<$max;$i++){
			
			if ($z == $max)
  			{
				
				$qid=$_SESSION['question_ans'][$i]['qid'];
				$get_question =$db->get_row("select * from ".tbl_question_answer." where qId = '".$qid."'",ARRAY_A);
				$question = $get_question['question_type'];
				if($question == 'multiple') {
					header("location:".ru."questionsingle");
				} else if($question == 'range') {
					header("location:".ru."questionrange");
				}
			}	
		$z++;	
		}				
	} else {
		if($_GET['s'] == 'feedback') {
			$get_question = $db->get_row("select * from ".tbl_question_answer." where feedback_question = 1 ORDER BY RAND() LIMIT 1",ARRAY_A);
			$question = $get_question['question_type'];
			if($question == 'multiple') {
				header("location:".ru."questionsingle/feedback");
			} else if($question == 'range') {
				header("location:".ru."questionrange/feedback");
			}
		} else {
		//echo "HERE";exit;
			//$get_question = $db->get_row("select * from ".tbl_question_answer." ORDER BY RAND() LIMIT 1",ARRAY_A);
$get_question = $db->get_row("SELECT * FROM ".tbl_question_answer." WHERE gift_question_answer.qId NOT IN (SELECT qId FROM gift_answer where gift_answer.userId = '".$_SESSION['LOGINDATA']['USERID']."') ORDER BY RAND() LIMIT 1",ARRAY_A);
			$question = $get_question['question_type'];
			if($question == 'multiple') {
				header("location:".ru."questionsingle");
			} else if($question == 'range') {
				header("location:".ru."questionrange");
			}
		}
	}
?>