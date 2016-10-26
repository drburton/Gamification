<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "users-courses");
    //include_once "navTemplate.php";
    include_once "config.php";
    if (!loggedIn()){
        header("Location: /index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EduQuest | Dashboard</title>
        <?php include_once "headStyle.php"; ?>
    </head>
    <body class="skin-blue">

        <!-- Header Navbar and left User Sidebar
        --------------------------------------------- -->
        <?php include_once "navTemplate.php";?>

<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content" >
                    <?php
                      $results = array('user_id' => $_SESSION["login"]);
                      $cursor = $collection->find($results);
                      $cursor->fields(array("course_id" => true,"xp" => true, 'user_role' => true,'_id' => false));
                      foreach ($cursor as $doc) {
                        $title;
                        $xp;
                        $role;
                        foreach ($doc as $k => $v) {
                            if($k=="course_id"){
                                $title=$v;
                            }else if($k=="xp"){
                                $xp=$v;
                            }else if($k=="user_role"){
                                $role=$v;
                            }
                        }
                        print("
                        <div class=\"col-md-4\">
                        <div class=\"box\">
                            <div class=\"box-header\">
                                <h3 class=\"box-title\">".$title."</h3>
                                <div class=\"box-tools pull-right\">
                                    <h3>Role: ".$role."</h3>
                                    <button class=\"btn btn-default btn-sm\" data-widget=\"collapse\" ><i class=\"fa fa-minus\"></i></button>
                                </div>
                            </div>
                            <div class=\"box-body\">

                            </div><!-- /.box-body -->
                            <div class=\"box-footer\">
                                <div class=\"progress\">
                                  <div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 60%;\">
                                    60%
                                  </div>
                                </div>
                            </div><!-- /.box-footer-->
                        </div><!-- /.box -->
                        </div>");

                      }
                    ?>

                    <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">DET 310</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-default btn-sm" data-widget="collapse" ><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                60%
                              </div>
                            </div>
                        </div><!-- /.box-footer-->
                    </div><!-- /.box -->
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
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>
