<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "courses");
    $collection2 = new MongoCollection( $db, "users-courses");
    include_once "config.php";
    if (!loggedIn()){
        header("Location: /index.php");
    }
    else{
        if($_GET["course"]!=""){
            $course=$_GET["course"];
            $course = str_replace("_"," ",$course);
            $name = $collection->findOne(array('c_number' => $course));
            if(!$name){
               header("Location: 404.php");
               exit;
            }
        }
        else{
            header("Location: 404.php");
            exit;
        }
        //$results = array('course_id' => 'DET 210', 'user_id'=> $_SESSION["login"]);
        //$cursor = $collection2->find($results);
        //$cursor->fields(array("xp" => true, 'user_role' => true,'_id' => false, 'user_id'=>false, 'course_id'=> false));
        //$cursor=$cursor->sort(array("title"=>1));
        //$role="";
        //$xp="";
        //foreach ($cursor as $doc) {
        //    foreach ($doc as $k => $v) {
        //        if($k=='xp'){
        //            $xp=$v;
        //        }
        //        else{
        //            $role=$v;
        //        }
        //    }
        //}
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EduQuest | Course Home</title>
        <?php include_once "headStyle.php"; ?>
    </head>
    <body class="skin-blue">
        <?php include_once "navTemplate.php";?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php $course; ?><!-- DET 210 -->
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content" style="background-image: url(img/wood4.png); background-repeat: repeat; height:100vh;">
                    <!-- Notification from teacher -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h4>Notification Test</h4>
                                <p>Do this one quest and stuff.</p>
                            </div>
                        </div>
                        <!-- Link to Quests & Awards -->
                        <a href="quests.php"><button class="btn btn-default btn-lg">Quests</button></a>
                        <button class="btn btn-default btn-lg">Awards</button>
                    </div>
                    <!-- Course Progress -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="callout callout-info">
                                <h4>Course Progress</h4>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                        40%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>
