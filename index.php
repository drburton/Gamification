<?php
    include_once "config.php";
    $passMiss=false;
    if (loggedIn()){
        header("Location: http://gamedev.garrettyamada.com/dashboard.php");
    }
    else{
        if(isset($_POST["submit"])){
          if(!($row = checkPass($_POST["userid"], $_POST["password"]))){
            //echo "<p>Incorrect login/password, try again</p>";
            $passMiss=true;
          }
          else{
              cleanMemberSession($_POST["userid"], $_POST["password"]);
              header("Location: dashboard.php");
          }
      }
    }

?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">

            <div class="header">EduQuest</div>
            <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST">

                <div class="body bg-gray">
                    <?php
                        if($passMiss){
                            print "<div class='alert alert-danger'>Incorrect Information. &#13;$#10;Try Again.</div>";
                        }
                    ?>
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                </div>
                <div class="footer">
                    <a href="signUp.php" style="font-color:white;"><button type="button" class="btn bg-primary btn-block">Sign Up</button></a><br/>
                    <button type="submit" name="submit" class="btn bg-primary btn-block">Sign me in</button>
                    <?php
                    // if(!$Session){
                    //     print "<p>The Var Does Not Exist!</p>";
                    // }
                    // else{
                    //     print "<p>The Vars Exist</p>";
                    // }
                    ?>
                </div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

