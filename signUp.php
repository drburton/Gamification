<?php
include_once("config.php");
if(loggedIn()){
  header('Location: dashboard.php');
}
$submitted=false;
$test="test";

 $m = new MongoClient();
$db = $m->selectDB("gamification_db");
$secCollection = new MongoCollection( $db, "security-questions");
$results = $secCollection->find();
$results->fields(array('name' => true,'question' => true,'_id' => false));

if(isset($_POST["submit"])){
  $submitted=true;
	if(!($_POST["password"] == $_POST["password2"])){
	 $error='Password';
  }
	else{
    $username=strtolower($_POST['login']);
    $query = $coll->findOne(array('_id' => $username));
  	if(empty($query)){
  	 	newUser($username, $_POST["first_name"], $_POST["last_name"], $_POST["password"]);
  	 	cleanMemberSession($username);
  	 	header("Location: dashboard.php");
    }
  	else{
  	  $error='Name';
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
                      if($error='Password'){
                       //print "<p>Your passwords did not match</p>";
                        print "<div class='alert alert-danger' align='center'><b>Your passwords do not match.<br/>Please try again.</b></div>";
                      }
                      else{
                        if($error='Name'){
                          //print '<p>Username already exists, please choose another username.</p>';
                          print "<div class='alert alert-danger' align='center'><b>That username already exists.<br/>Please Try Again.</b></div>";
                        }
                      }
                    }
                  ?>
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" placeholder="ACU ID (abc12d)"
                        value="<?php print isset($_POST["login"]) ? $username : "" ; ?>" minlength="6" maxlength="6" required="true">
                    </div>
                    <?php /*<div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Your Name"
                        value="<?php print isset($_POST["name"]) ? $_POST["name"] : "" ; ?>"maxlength="50" required="true">
                    </div> */?>

                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" placeholder="Your First Name"
                        value="<?php print isset($_POST["first_name"]) ? $_POST["first_name"] : "" ; ?>"maxlength="50" required="true">
                    </div>

                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" placeholder="Your Last Name"
                        value="<?php print isset($_POST["last_name"]) ? $_POST["last_name"] : "" ; ?>"maxlength="50" required="true">
                    </div>

                    Select your security questions:
                    <div class="form-group">
                        <select type="select" name="security_question" class="form-control" required="true">
                          <?php 
                            foreach ($results as $doc) {
                              $name;
                              $question;
                              foreach ($doc as $k => $v) {
                                if($k=="name"){
                                  $name=$v;
                                }else{
                                  $question=$v;
                                }
                              }
                              print("<option value=".$name.">".$question."</option>");
                            }
                          ?>
                        </select>
                        <input type="text" name="sec_answer" class="form-control" placeholder="Answer"
                        value="" required="true">
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
