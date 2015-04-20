<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "courses");
    $collection2 = new MongoCollection( $db, "quests");
    $course=$_GET["course"];
    $course = str_replace("_"," ",$course);
    //console.log(array("course" => $_GET["course"]));

    //header("Location: http://gamedev.garrettyamada.com/quests.php");
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>AdminLTE | Quests</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
      <!-- <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> -->
        <link href="../css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php
            $results = array('course_id' => 'jad00a');
            $count=1;
            $cursor = $collection->find($results);
            $cursor->fields(array("course_id" => true));
            foreach ($cursor as $doc) {
                foreach ($doc as $k => $v) {
                    if($count%2==0){
                        $new = str_replace(" ","_",$v);
                        print "<li><a href=\"test.php?course=" . $new . "\"><i class=\"fa fa-angle-double-right\"></i>$v</a></li>";
                    }

                    $count++;

                }

            }
            print"<h1>Test</h1>";
    		print"<p>$course</p>";;
    </body>
    </html>