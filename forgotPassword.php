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
        $user_answer;

        if(isset($_POST["userId"])){
            $results = $userCollection->findOne(array('_id' => $_POST["userId"]));

            $securityQuestion = $secCollection->findOne(array('name' => $results['security_question']));
        }

        if(isset($_POST["sec_answer"])){
            $user_answer=$_POST["sec_answer"];
        }


        /*if(isset($_POST["submit"])){
          if(!($row = checkPass($_POST["userId"], $_POST["password"]))){
            $passMiss=true;
          }
          else{
              cleanMemberSession($_POST["userId"]);
              header("Location: dashboard.php");
          }
        }*/
    }
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>EduQuest | Log in</title>
        <?php include_once "headStyle.php"; ?>

    </head>
    <body class="bg-black">
        <div class="form-box" id="security-box">

            <div class="header">EduQuest: Password Recovery</div>
            <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST">

                <div class="body bg-gray">
                    <div class='alert alert-danger' align='center' style="display:none"><b>Incorrect Information. Please Try Again.</b></div>
                    <?php if(!$securityQuestion){ ?>
                    <div class="form-group">
                        <p>Please Enter Your Username:</p>
                        <input type="text" name="userId" required class="form-control"/>
                    </div>
                    <?php }elseif(!$user_answer){?>
                    <div class="form-group">
                        <input type="hidden" name="userId" value="<?php print($userId); ?>"/>
                        <p><?php print($securityQuestion["question"]); ?></p>
                        <input type="password" name="sec_answer" class="form-control" placeholder="Security Question Answer"/>
                    </div>
                    <?php }else{?>
                    <div class="form-group">
                        <input type="hidden" name="userId" value="<?php print($userId); ?>"/>
                        <p>Please type your new password:</p>
                        <input type="password" name="input1" class="form-control" required/>
                        <p>Please re-enter your new password:</p>
                        <input type="password" name="input2" class="form-control" required/>
                    </div>
                    <?php }?>
                </div>
                <div class="footer" align="center">
                    <?php /*<button type="submit" name="submit" class="btn btn-primary btn-block" style="width:46%; display:inline-block;">Sign In</button>
                    <div style="width:5%; display:inline-block;"></div> */?>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>