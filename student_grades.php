<?php
    $user_results = array('course_id' => $course, 'user_id'=> $_SESSION["login"]);
    $userCourseCursor = $collection2->findOne($user_results);
    $userCourseCursor->fields(array('xp' => true,'_id' => false));
    $userXP = $userCourseCursor["xp"];
?>

<div class="col-xs-12">
	<div class="box">
		<div>
			<h1 class="centered-text">Course Progress: <?php print($userXP);?></h1>
			<div class="progress horizontal-centered" style="width:80%;">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
			  aria-valuemin="0" aria-valuemax="100" style="width:70%">
			    70%
			  </div>
			</div><br/>
		</div>
	</div>
</div>