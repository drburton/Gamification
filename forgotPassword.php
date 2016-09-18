<?php
    include_once "config.php"; //Connecting to database and handling auth.
    $passMiss=false;
    if (loggedIn()){
        header("Location: dashboard.php");
    }
    else{

        $m = new MongoClient();
        $db = $m->selectDB("gamification_db");
        $userCollection = new MongoCollection( $db, "users");
        $secCollection = new MongoCollection( $db, "security-questions");
        $results;
        $securityQuestion;

        if(isset($_POST["userId"])){
            $results = $userCollection->findOne(array('_id' => $_POST["userId"]));

            $securityQuestion = $secCollection->findOne(array('name' => $results['securityQuestion']));
        }


        /*if(isset($_POST["submit"])){
          if(!($row = checkPass($_POST["userId"], $_POST["password"]))){
            $passMiss=true;
          }
          else{
              cleanMemberSession($_POST["userId"]);
              header("Location: dashboard.php");
          }*/
      }
    }
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>EduQuest | Forgot Password</title>
        <?php include_once "headStyle.php"; ?>

    </head>
    <body class="bg-black">
        <div class="form-box" id="security-box">

            <div class="header">EduQuest</div>
            <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST">

                <div class="body bg-gray">
                    <?php
                        if($passMiss){
                            print "<div class='alert alert-danger' align='center'><b>Incorrect Information. Please Try Again.</b></div>";
                        }
                    ?>
                    <div class="form-group">
                        <input type="text" name="userId" class="form-control" placeholder="ACU Username"
                        value="<?php print isset($_POST["userId"]) ? $_POST["userId"] : "" ; ?>"/>
                    </div>
                    <div class="form-group">
                        <p><?php print($securityQuestion["question"]); ?></p>
                        <p>Test</p>
                        <input type="password" name="sec_answer" class="form-control" placeholder="Security Question Answer"/>
                    </div>
                </div>
                <div class="footer" align="center">
                    <?php /*<button type="submit" name="submit" class="btn btn-primary btn-block" style="width:46%; display:inline-block;">Sign In</button>
                    <div style="width:5%; display:inline-block;"></div> */?>
                </div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>