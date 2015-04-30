<?php
include_once("config.php");
if(loggedIn()){
  header('Location: dashboard.php');
}
$submitted=false;
$test="test";
if(isset($_POST["submit"])){
  $submitted=true;
	if(!($_POST["password"] == $_POST["password2"])){
	 print "<p>Your passwords did not match</p>";
  }
	else{
    $query = $coll->findOne(array('_id' => $_POST['login']));
  	if(empty($query)){
  	 	newUser($_POST["login"], $_POST["name"], $_POST["password"]);
  	 	cleanMemberSession($_POST["login"]);
  	 	header("Location: dashboard.php");
    }
  	else{
  	  print '<p>Username already exists, please choose another username.</p>';
  	}
  }
}
?>

<!-- <!DOCTYPE html> -->
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <?php include_once "headStyle.php"; ?>

    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">

            <div class="header">EduQuest Registration</div>
            <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST">

                <div class="body bg-gray">
                  <?php
                    if($submitted==true){
                      if(!($_POST["password"] == $_POST["password2"])){
                       //print "<p>Your passwords did not match</p>";
                        print "<div class='alert alert-danger' align='center'><b>Your passwords do not match.<br/>Please try again.</b></div>";
                      }
                      else{
                        $query = $coll->findOne(array('_id' => $_POST['login']));
                        if(empty($query)){
                          newUser($_POST["login"], $_POST["name"], $_POST["password"]);
                          cleanMemberSession($_POST["login"]);
                          header("Location: dashboard.php");
                        }
                        else{
                          //print '<p>Username already exists, please choose another username.</p>';
                          print "<div class='alert alert-danger' align='center'><b>That username already exists.<br/>Please Try Again.</b></div>";
                        }
                      }
                    }
                  ?>
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" placeholder="ACU ID (abc12d)"
                        value="<?php print isset($_POST["login"]) ? $_POST["login"] : "" ; ?>"maxlength="6" required="true">
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name"
                        value="<?php print isset($_POST["name"]) ? $_POST["name"] : "" ; ?>"maxlength="50" required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" class="form-control" placeholder="Re-enter Password" required="true">
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Me Up</button>
                </div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
