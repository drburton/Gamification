<nav class="navbar course-nav navbar-default navbar-collapse" style="margin:0px;">
    <div class="navbar-left">
        <ul class="nav navbar-nav">
        	<li><a href="/coursehome.php?course=<?php print($course_under);?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-exclamation"></i> Announcements</a></li>
            <li><a href="#"><i class="fa fa-book"></i> Grades</a></li>
            <li><a href="/courseQuests.php?course=<?php print($course_under);?>"><i class="fa fa-shield"></i> Quests</a></li>
            <!--<li><a href="/courseQuests.php?course=<?php print($course_under);?>"><i class="fa fa-bookmark"></i> Quests</a></li>-->
            <li><a href="/course_people.php?course=<?php print($course_under);?>"><i class="fa fa-users"></i> People</a></li>
        </ul>
    </div>
</nav>