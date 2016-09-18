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
        $userId;
        $results;
        $securityQuestion;
        $user_answer;
        $validAnswer = false;
        $error;

        if(isset($_POST["userId"])){
            $userId = $_POST["userId"];
            $results = $userCollection->findOne(array('_id' => $userId));

            $securityQuestion = $secCollection->findOne(array('name' => $results['security_question']));
        }

        if(isset($_POST["sec_answer"])){
            $user_answer=$_POST["sec_answer"];
            if($user_answer==$results['sec_answer']){
                $validAnswer = true;
            }else{
                $error = "Incorrect Information. Please Try Again.";
            }

        }

        if(isset($_POST["input1"])&&isset($_POST["input2"])){
            $validAnswer = true;
            if($_POST["input1"]==$_POST["input2"]){
                updatePassword($userId, $_POST["input1"]);
                cleanMemberSession($userId);
                header("Location: dashboard.php");
            }
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
            <form id="recoveryForm" action="<?=$_SERVER["PHP_SELF"];?>" method="POST">

                <div class="body bg-gray">
                    <div class='alert alert-danger' id="errorMessage" align='center' <?php if(!$error){?>style="display:none"<?php }?>>
                    <b><?php print($error)?></b></div>

                    <?php //begin first stage of user input -> username?>
                    <?php if(!$userId){ ?>
                    <div class="form-group">
                        <p>Please Enter Your Username:</p>
                        <input type="text" name="userId" required class="form-control"/>
                    </div>

                    <?php //begin second stage of user input -> getting securty question answer?>
                    <?php }elseif(!$validAnswer){?>
                    <div class="form-group">
                        <input type="hidden" name="userId" value="<?php print($userId); ?>"/>
                        <p><?php print($securityQuestion["question"]); ?></p>
                        <input type="password" name="sec_answer" class="form-control" placeholder="Security Question Answer"/>
                    </div>

                    <?php //finally, upon correct answer, create new password?>
                    <?php }else{?>
                    <div class="form-group">
                        <input type="hidden" name="userId" value="<?php print($userId); ?>"/>
                        <p>Please type your new password:</p>
                        <input type="password" id="input1" name="input1" class="form-control" required/>
                        <p>Please re-enter your new password:</p>
                        <input type="password" id="input2" name="input2" class="form-control" required/>
                    </div>
                    <?php }?>
                </div>
                <div class="footer" align="center">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <?php if($validAnswer){?>
        <script >
            $("#recoveryForm").submit(function(){
                if($("#input1").val()!=$("#input2").val()){
                    $("#errorMessage").html("<b>The New Passwords Did Not Match.</b>");
                    $("#errorMessage").slideDown();
                    return false;
                }else{
                    return true;
                }
            });
        </script>
        <?php }?>

    </body>
</html>