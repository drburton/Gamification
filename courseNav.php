<nav class="navbar course-nav navbar-default navbar-collapse" style="margin:0px;">
    <div class="navbar-left">
        <ul class="nav navbar-nav">
        	<li><a href="/coursehome.php?course=<?php print($course_under);?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-exclamation" aria-hidden="true"></i> Announcements</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Grades</a></li>
            <li><a href="/courseQuests.php?course=<?php print($course_under);?>"><i class="fa fa-shield" aria-hidden="true"></i> Quests</a></li>
            <!--<li><a href="/courseQuests.php?course=<?php print($course_under);?>"><i class="fa fa-bookmark"></i> Quests</a></li>-->
            <li><a href="/course_people.php?course=<?php print($course_under);?>"><i class="fa fa-users" aria-hidden="true"></i> People</a></li>
            <li><a href="#"><i class="fa fa-trophy" aria-hidden="true"></i> Achievements</a></li>
        </ul>
    </div>
</nav>