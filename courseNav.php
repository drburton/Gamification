<?php
    $results = array('course_id' => $course, 'user_id'=> $_SESSION["login"]);
    $cursor = $collection2->find($results);
    $cursor->fields(array('user_role' => true,'_id' => false));
    //$cursor=$cursor->sort(array("title"=>1));
    $role="";
    foreach ($cursor as $doc) {
        foreach ($doc as $k => $v) {
            $role=$v;
        }
    }
?>

<nav class="navbar course-nav navbar-default navbar-collapse" style="margin:0px;">
    <div class="navbar-left">
        <ul class="nav navbar-nav">
        	<li><a href="/coursehome.php?course=<?php print($course_under);?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-exclamation" aria-hidden="true"></i> Announcements</a></li>
            <li><a href="/gradebook.php?course=<?php print($course_under);?>"><i class="fa fa-book"></i> Grades</a></li>
            <?php if($role=="admin"){ ?>
            <li><a href="/quests.php?course=<?php print($course_under);?>"><i class="fa fa-shield" aria-hidden="true"></i> Quests</a></li>
            <?php }else{ ?>
            <li><a href="/courseQuests.php?course=<?php print($course_under);?>"><i class="fa fa-shield" aria-hidden="true"></i> Quests</a></li>
            <?php } ?>
            <!--<li><a href="/courseQuests.php?course=<?php print($course_under);?>"><i class="fa fa-bookmark"></i> Quests</a></li>-->
            <li><a href="/course_people.php?course=<?php print($course_under);?>"><i class="fa fa-users" aria-hidden="true"></i> People</a></li>
            <li><a href="#"><i class="fa fa-trophy" aria-hidden="true"></i> Achievements</a></li>
        </ul>
    </div>
</nav>