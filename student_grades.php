<?php
    $user_results = array('course_id' => $course, 'user_id'=> $_SESSION["login"]);
    $userCourseCursor = $collection2->findOne($user_results);
    $userXP = $userCourseCursor["xp"];
    $gradePercentage = $userXP/$maxEXP;
    $gradePercentage = round($gradePercentage, 2, PHP_ROUND_HALF_DOWN)*100;
?>

<div class="col-xs-12">
	<div class="box">
		<div>
			<?php print($gradePercentage);?>
			<h1 class="centered-text">Course Progress: <?php print($userXP);?>XP</h1>
			<div class="progress horizontal-centered" style="width:80%;">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow=<?print("$gradePercentage"); ?>
			  aria-valuemin="0" aria-valuemax="100" style=<?print("width:".$gradePercentage."%");?>>
			    <?print($gradePercentage."/".$maxEXP); ?>
			  </div>
			</div><br/>
		</div>
	</div>
</div>