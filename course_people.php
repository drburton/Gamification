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
            $course_under=$_GET["course"];
            $course = str_replace("_"," ",$course_under);
            $courseCursor = $collection->find(array('c_number' => $course));
            if($courseCursor->count()==0){
                header("Location: 404.php");
            }
        }
        else{
            header("Location: 404.php");
        }
        $cMax=0;
         foreach ($courseCursor as $doc) {
            foreach ($doc as $k => $v) {
                if($k=="max_points"){
                    $cMax=$v;
                }
            }
        }

        $results = array('course_id' => 'DET 210', 'user_id'=> $_SESSION["login"]);
        $cursor = $collection2->find($results);
        $cursor->fields(array("xp" => true, 'user_role' => true,'_id' => false));
        //$cursor=$cursor->sort(array("title"=>1));
        $role="";
        $xp="";
        foreach ($cursor as $doc) {
            foreach ($doc as $k => $v) {
                if($k=="xp"){
                    $xp=$v;
                }
                else{
                    $role=$v;
                }
            }
        }
        if($xp<=$cMax){
            $cPercent=floor(($xp/$cMax)*100);
        }
        else{
            $cPercent=100;
        }
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EduQuest | Course People</title>
        <?php include_once "headStyle.php"; ?>
    </head>
    <body class="skin-blue">
        <?php include_once "navTemplate.php";?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php print $course; ?><!-- DET 210 -->
                    </h1>
                </section>

                <?php 
                    include_once "courseNav.php";
                ?>

                <!-- Main content -->
                <section class="content" style="background-image: url(img/wood4.png); background-repeat: repeat; height:100vh;">

                    <!--<p>Search People</p>-->

                    <?php if($role=="admin"){ ?>

                    <button type="button" id="addButton" class="btn btn-primary btn-lg"><i class="fa fa-user-plus"
                    aria-hidden="true"> Add People</i></button><br/><br/>

                    <div id="addFormDiv" display="none">
                        <form method="POST" action="functions.php">
                            <input name="user" type="text"/>
                            <input class="btn btn-primary" type="submit"/>
                        </form>
                    </div>

                    <?php } ?>

                    <!-- table box div -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">People in this course:</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table id="coursePeople" class="table table-hover">
                                <thead style="font-weight:bold;">
                                    <tr>
                                        <td>Name</td>
                                        <td>Role</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $user_results = array('course_id' => $course);
                                        $userCourseCursor = $collection2->find($user_results);
                                        $userCourseCursor->fields(array('user_id' => true,'user_role' => true,'_id' => false));
                                        $userCourseCursor = $userCourseCursor->sort(array("user_id"=>1)); //Sort by title
                                        $userArray = [];

                                        $userCollection = new MongoCollection( $db, "users");

                                        foreach ($userCourseCursor as $doc) {
                                          $userId;
                                          $user_role;
                                          $last_name;
                                          foreach ($doc as $k => $v) {
                                            if($k=='user_role'){
                                                $user_role=$v;
                                            }elseif($k=="user_id"){
                                                $userId=$v;
                                            }
                                            
                                          }
                                          $userCursor = $userCollection->findOne(array('_id' => $userId));
                                          $lastName = $userCursor['last_name'];
                                          $userArray[$lastName]=array('userId'=>$userId,'role'=>$user_role);
                                        }
                                        ksort($userArray);
                                        //print_r($userArray);
                                        //print("<br/>");
                                        //print_r($userArray['Graham']);
                                        foreach ($userArray as $k => $v) {
                                          print('<tr id="'.$v['userId'].'">');
                                          $userCollection = new MongoCollection( $db, "users");
                                          $userCursor = $userCollection->findOne(array('_id' => $v['userId']));

                                          print('<td>'.$userCursor['name'].' ('.$userCursor['_id'].')</td>');
                                          print('<td>'.$v['role'].'</td>');
                                          //for ($i = 0; $i <= 5; $i++) {
                                          //  print("<td style='min-width: 150px; text-align:center;'>-</td>");
                                          //}
                                          //print("<td id='".$userId."_exp' style='min-width: 150px; text-align:center;'>".$totalXP." / $maxEXP</td>");
                                          print('</tr>');
                                        }

                                      ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script>
            $("#addButton").click(function(){
                $("#addFormDiv").toggle();
            })
        </script>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

    </body>
</html>