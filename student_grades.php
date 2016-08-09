<?php
    $user_results = array('course_id' => $course, 'user_id'=> $_SESSION["login"]);
    $userCourseCursor = $collection2->findOne($user_results);
    $userXP = $userCourseCursor["xp"];
    $gradePercentage = $userXP/$maxEXP;
    $gradePercentage = round($gradePercentage, 2, PHP_ROUND_HALF_DOWN)*100;
    $letterMilestone;
    $milestoneValue;

//switch to determine the next milestone for the student
    switch($gradePercentage){
		case $gradePercentage<60:
			$letterMilestone="D";
			$milestoneValue = $maxEXP*0.60;
			break;
		case $gradePercentage<70:
			$letterMilestone="C";
			$milestoneValue = $maxEXP*0.70;
			break;
		case $gradePercentage<80:
			$letterMilestone="B";
			$milestoneValue = $maxEXP*0.80;
			break;
		case $gradePercentage<90:
			$letterMilestone="A";
			$milestoneValue = $maxEXP*0.90;
			break;
		default:
			$letterMilestone="None";
			return;
?>

<div class="col-xs-12">
	<div class="box">
		<div>
			<h1 class="centered-text">Course Progress: <?php print($gradePercentage);?>%</h1>
			<div class="progress horizontal-centered" style="width:80%;">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow=<?php print("$gradePercentage"); ?>
			  aria-valuemin="0" aria-valuemax="100" style=<?php print("width:".$gradePercentage."%");?>>
			    <?php print($userXP."/".$maxEXP); ?>
			  </div>
			</div>
			<div class="centered-text">
				<p>EXP Required for Next Milestone (<?php print($letterMilestone);?>): <?php //print($milestoneValue-$userXP);?></p>
			</div>
		</div>
	</div>
</div>