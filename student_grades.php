<?php
    $user_results = array('course_id' => $course, 'user_id'=> $_SESSION["login"]);
    $userCourseCursor = $collection2->findOne($user_results);
    $userXP = $userCourseCursor["xp"];
    $gradePercentage = $userXP/$maxEXP;
    $gradePercentage = round($gradePercentage, 2, PHP_ROUND_HALF_DOWN)*100;
    $letterMilestone;
    $milestoneValue;

//determine the next milestone for the student
    if($gradePercentage<60){
		$letterMilestone="D";
		$milestoneValue = $maxEXP*0.60;
	}elseif($gradePercentage<70){
		$letterMilestone="C";
		$milestoneValue = $maxEXP*0.70;
	}elseif($gradePercentage<80){
		$letterMilestone="B";
		$milestoneValue = $maxEXP*0.80;
	}elseif($gradePercentage<90){
		$letterMilestone="A";
		$milestoneValue = $maxEXP*0.90;
	}else{
		$letterMilestone="None";
	}

	if($gradePercentage>100){
		$gradePercentage = 100;
	}
?>

<div class="col-xs-12">
	<div class="box">
		<div>
			<h1 class="centered-text">Course Progress: <?php print($gradePercentage);?>%</h1>
			<div class="progress horizontal-centered" style="width:80%;">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow=<?php print("$gradePercentage"); ?>
			  aria-valuemin="0" aria-valuemax="100" style=<?php print("width:".$gradePercentage."%");?>>
			    <strong><?php print($userXP."/".$maxEXP." Points"); ?></strong>
			  </div>
			</div>
			<div class="centered-text">
				<?php if($letterMilestone!=="None"){ ?>
					<p>Next Milestone: <?php print($letterMilestone." (".$milestoneValue." points)");?>&emsp;
					EXP Required for Next Milestone: <?php print($milestoneValue-$userXP);?> points</p>
				<?php }?>
			</div>
			<div>
				<h2> Quest Grades: work in Progress</h2>
				<div class="box-body table-responsive no-padding" style="width:50%;">
                    <table class="table table-hover">
                    	<thead>
                    		<tr>
	                            <th>Quest Name</th>
	                            <th>XP Earned</th>
                            <tr>
                        </thead>
                        <tbody>
                        	<?php 
                        		$userQuestResults = array('course_id' => $course, 'user_id' => $_SESSION["login"]);
						        $userQuestCursor = $userQuestsCollection->find($userQuestResults);
						        $userQuestCursor->fields(array('title' => true,'status' => true,'grade' => true, "_id" => false));
						        $userQuestCursor=$userQuestCursor->sort(array("title"=>1)); //Sort by title
						        print($userQuestResults["course_id"]);
						        print($userQuestResults["user_id"]);
						        foreach ($userQuestCursor as $doc) {
						        	$title;
						        	$grade;
						        	$status
					             	foreach ($doc as $k => $v) {
						            	if($k=="title"){
						            		$title=$v;
						            	}elseif($k=="grade"){
						            		$grade=$v;
						            	}else{
						            		$status=$v;
						            	}
						            	//$totalXP=0;
						            }
						            if($grade){
						            	print("<tr><td>".$title."</td><td>".$grade."</td></tr>");
						            }else{
						            	print("<tr><td>".$title."</td><td>".$status."</td></tr>");
						            }
					          	}

                        	?>
                        	<tr>
                        			
                        	</tr>
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>