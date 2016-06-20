<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "users-courses");
    // if (!loggedIn()){
    //     header("Location: /index.php");
    // }
    $showPeople = false;
    //if isset($_GET["course"]){
    //    //$showPeople = true;
    //    echo("set");
    //}
    echo("Stuff");
?>




        <!-- header logo -->
        <header class="header">
            <a href="dashboard.php" class="logo" >
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                EduQuest
            </a>

            <!-- Header Navbar
            --------------------------------------------- -->

            <nav class="navbar navbar-static-top" role="navigation" >
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                      <!-- - User Account, Top right drop down
                      --------------------------------------------- -->

                      <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Profile<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="img/avatar5.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php print $_SESSION["name"]; ?>
                                        <small>Level 25 Web Developer</small>
                                    </p>
                                </li>
                                <!-- /Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- / User Account, Top right drop down -->

                    </ul>
                </div>
            </nav>
            <!-- /Header Navbar -->
        </header>
        <!-- /header -->

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar
            --------------------------------------------- -->

            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar -->
                <section class="sidebar">

                    <!-- Sidebar user panel
                    --------------------------------------------- -->

                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php print $_SESSION["name"]; ?></p>

                            <a href="#"><i class="fa fa-trophy"></i> Web Developer</a>
                        </div>
                    </div>
                    <!-- /Sidebar user panel -->

                    <!-- Sidebar Menu 
                    --------------------------------------------- -->

                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="dashboard.php">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-university"></i>
                                <span>My Courses</span>
                            </a>
                            <ul class="treeview-menu">
                              <?php

                                  $results = array('user_id' => $_SESSION["login"]);//'jad00a');
                                  $count=1;
                                  $cursor = $collection->find($results);
                                  $cursor->fields(array("course_id" => true));
                                  foreach ($cursor as $doc) {
                                    foreach ($doc as $k => $v) {

                                      if($count%2==0){
                                        $new = str_replace(" ","_",$v);
                                        print "<li><a href=\"coursehome.php?course=" . $new . "\"><i class=\"fa fa-angle-double-right\"></i>$v</a></li>";
                                        //print "<li><a href=\"coursehome.php\"><i class=\"fa fa-angle-double-right\"></i>$v</a></li>";
                                      }

                                      $count++;

                                    }

                                  }

                               ?>

                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-users"></i> <span>People</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-gear"></i> <span>Settings</span>
                            </a>
                        </li>

                    </ul>
                    <!-- /Sidebar Menu -->
                </section>
                <!-- /.sidebar -->
            </aside>
<!-- </body>
</html> -->
