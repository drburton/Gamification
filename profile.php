<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "users-courses");
    include_once "config.php";
    if (!loggedIn()){
        header("Location: /index.php");
    }

    $collection = new MongoCollection( $db, "programs");
    $courseCursor = $collection->findOne(array('short' => 'DET'));
    $testId=null;

    //vars to display on page
    $program;
    $specialization;
    //find user data
    $userCollection = new MongoCollection( $db, "users");
    $user=$userCollection->findOne(array('_id' => $_SESSION["login"]));
    //set vars
    $program = $user['program_id']?:'None';
    $specialization = $user['specialization']?:'Unknown';

    //get the correct program title to display
    $programCollection = new MongoCollection( $db, "programs");
    $courseCursor = $collection->findOne(array('_id' => $program));
    //display var
    $displayProgram = $courseCursor['name'];
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
                        Profile
                    </h1>
                </section>


                <!-- Main content -->
                <section class="content" style="background-image: url(img/wood4.png); background-repeat: repeat; height:100vh;">

                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">My Stats:</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table stats-table">
                                <tr>
                                    <td>Name: <?php print($_SESSION["name"]); ?></td>
                                </tr>
                                <tr>
                                    <td>Username: <?php print($_SESSION["login"]); ?></td>
                                </tr>
                                <tr>
                                    <td>Major/Program: <?php print($displayProgram); ?></td>
                                </tr>
                                <tr>
                                    <td>Specialization: <?php print($specialization); ?></td>
                                </tr>
                                <tr>
                                    <td>Current Title: None</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <?php
                $testId = $courseCursor['_id'];

                ?>

                <form method="POST" action="functions.php">
                    <input type="hidden" name="program" value="<?php print($testId); ?>"/>
                    <input type="hidden" name="form" value="changeProgram"/>
                    <input type="hidden" name="login" value="<?php print($_SESSION["login"]);?>"/>
                    <button type="button submit">Click Me!</button>
                </form>

                </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


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