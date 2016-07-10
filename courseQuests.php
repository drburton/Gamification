<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "users-courses");
    $collection2 = new MongoCollection( $db, "quests");
    $collection3 = new MongoCollection( $db, "courses");
    $collection4 = new MongoCollection( $db, "users-quests");
    include_once "config.php";
    if (!loggedIn()){
        header("Location: /index.php");
    }
    else{
      if($_GET["course"]!=""){
        $course_under=$_GET["course"];
        $course = str_replace("_"," ",$course_under);
        $search=array('c_number' => $course);
        $courseCursor = $collection3->find($search);
        if($courseCursor->count()==0){
          header("Location: 404.php");
        }
      }
      else{
        header("Location: 404.php");
        exit;
      }
    }

    $results = array('course_id' => $course, 'user_id'=> $_SESSION["login"]);
    $cursor = $collection->find($results);
    $cursor->fields(array('user_role' => true,'_id' => false));
    //$cursor=$cursor->sort(array("title"=>1));
    $role="";
    foreach ($cursor as $doc) {
      foreach ($doc as $k => $v) {
        $role=$v;
      }
    }
    if($role=="admin"){
      $new = str_replace(" ","_",$course);
      header("Location: /quests.php?course=".$new);
      exit;
    }

    $curQuests=[];
    $results = array('course_id' => $course, 'user_id'=>$_SESSION['login']);//$course);array('course_id' => $course,'user_id'=>$_SESSION['login']);
    $cursor = $collection4->find($results); //Return a quest result set
    $cursor->fields(array('_id' => true, 'title' => true)); //Get specific data
    $cursor->sort(array("title"=>1));
    foreach($cursor as $doc){
      foreach($doc as $k=>$v){
      	if($k=="_id"){
          //print($v);
        	array_push($curQuests,$v);
      	}
       // $curQuests[]=$v;
      }
    }
    //print_r($curQuests);
?>


<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>EduQuest | Quests</title>
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
                      <?php print $course." Quests";//(Course Name) Quests ?>
                      <small>Choose wisely.</small>
                  </h1>
              </section>

              <?php 
                include_once "courseNav.php";
              ?>

              <!-- Main content -->
              <section class="content">

                  <div class="row">
                      <div class="col-xs-12">
                          <div class="box">
                              <div class="box-header">
                                  <h3 class="box-title">Available Quests</h3>
                              </div><!-- /.box-header -->
                              <div class="box-body table-responsive no-padding">
                                  <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Quest</th>
                                          <th>XP</th>
                                          <th>Due Date</th>
                                          <th>Details</th>
                                          <th>Accept</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                      <!-- PHP to pull quest data and put in table -->
                                          <?php

                                            $results = array('course_id' => $course);//$course);
                                            $cursor = $collection2->find($results); //Return a quest result set
                                            $cursor->fields(array("title" => true, 'due_date' => true, 'xp' => true, 'desc' => true, '_id' => true)); //Get specific data
                                            $cursor=$cursor->sort(array("title"=>1)); //Sort by title
                                            $title="";
                                            $due_date="";
                                            $xp="";
                                            $desc='';
                                            $dbid="";
                                            //echo(count($cursor));
                                            foreach ($cursor as $doc) { //Turn cursor (results) human readable
                                              print "<tr>";
                                              foreach ($doc as $k => $v) { //Filter out keys from key-value pairs in the returned array
                                                  if($k=='_id'){
                                                    $dbid = $v;
                                                  }elseif($k=="title"){
                                                    $title=$v;
                                                  }
                                                  elseif($k=="due_date"){
                                                    $due_date=$v;
                                                  }
                                                  elseif($k=="xp"){
                                                    $xp=$v;
                                                  }
                                                  elseif($k=="desc"){
                                                  	$desc=$v;
                                              	  }
                                              	  if ($k != "desc" and $k!= "_id" and !in_array($dbid, $curQuests)){
                                                	print "<td>$v</td>";
                                                  }
                                                }
                                                $title = str_replace(" ","_",$title);
                                                $desc = str_replace(" ","_",$desc);
                                                //print "<td>$desc</td>";

	                                              if(!in_array($title, $curQuests)){
	                                              	print "<td><a href=\"#\"><button class=\"btn btn-default btn-sm\" data-toggle=\"modal\" data-target=\"#seedetails\" data-id=$title data-due=$due_date data-xp=$xp data-desc=$desc>See Details</button></a></td>";
	                                              	print "<td><a href=\"#\"><button class=\"btn btn-default btn-sm\" data-toggle=\"modal\" data-target=\"#acceptquest\" data-course=$course_under data-id=$dbid>Accept Quest</button></a></td>";
	                                              	print "</tr>";
	                                          	  }
                                              }
                                           ?>
                                  </tbody>
                                  </table>
                              </div><!-- /.box-body -->
                          </div><!-- /.box -->
                      </div>
                  </div>
                  <?php 
                    print(count($curQuests));
                  ?>
                  <div class="row">
                      <div class="col-xs-12">
                          <div class="box">
                              <div class="box-header">
                                  <h3 class="box-title">Current Quests</h3>
                              </div><!-- /.box-header -->
                              <div class="box-body table-responsive no-padding">
                                  <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Quest</th>
                                          <th>XP</th>
                                          <th>Due Date</th>
                                          <th>Details</th>
                                          <th>Turn In</th>
                                          <th>Drop</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                      <!-- PHP to pull quest data and put in table -->
                                          <?php

                                            $results = array('course_id' => $course,'user_id'=>$_SESSION['login']);//$course);
                                            $cursor2 = $collection4->find($results);
                                            $cursor2->fields(array("title" => true,'_id' => false)); //Get specific data 
                                            //print($cursor2);
                                            $due_date="";
                                            $xp="";
                                            $desc='';
                                            $dbid="";
                                            $title="";
                                            foreach ($cursor2 as $doc) { //Turn cursor (results) human readable
                                              foreach ($doc as $k => $v) { //Filter out keys from key-value pairs in the returned array
                                                if ($k != "desc"){
                                                  if($k=="title"){
                                                    $title=$v;
                                                  }
                                                  if($k=="due_date"){
                                                    $due_date=$v;
                                                  }
                                                  if($k=="xp"){
                                                    $xp=$v;
                                                  }
                                                  print "<td>$v</td>";
                                                }
                                                else{
                                                  $desc=$v;
                                                }
                                                }
                                                $title = str_replace(" ","_",$title);
                                                $desc = str_replace(" ","_",$desc);
                                                //print "<td>$desc</td>";

                                              print("<td>Item</td>");
                                              print("<td>Item</td>");
                                              print "<td><a href=\"#\"><button class=\"btn btn-default btn-sm\" data-toggle=\"modal\" data-target=\"#seedetails\" data-id=$title data-due=$due_date data-xp=$xp data-desc=$desc>See Details</button></a></td>";
                                              print "<td><a href=\"#\"><button class=\"btn btn-success btn-sm\" data-course=$course_under data-id=$title>Turn In Quest <i class='fa fa-check-circle'
                                              aria-hidden='true'></button></a></td>";
                                              print "<td><a href=\"#\"><button class=\"btn btn-danger btn-sm\" data-toggle=\"modal\" data-target=\"#dropquest\" data-course=$course_under data-id=$title>Drop Quest <i class='fa fa-times-circle'
                                              aria-hidden='true'></button></a></td>";
                                              print "</tr>";
                                              }
                                              //print("After Loop");
                                           ?>
                                  </tbody>
                                  </table>
                              </div><!-- /.box-body -->
                          </div><!-- /.box -->
                      </div>
                  </div>
              </section><!-- /.content -->
          </aside><!-- /.right-side -->
      </div><!-- ./wrapper -->

       <!-- View Details Modal -->
           <div class="modal fade" id="seedetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title" id="detailsLabel">Quest Details</h4>
                 </div>
                 <div class="modal-body">
                   <h6>Title</h6>
                   <p id="detailsTitle">Quest Title</p>
                   <h6>XP</h6>
                   <p id="detailsXp">XXX</p>
                   <h6>Due Date</h6>
                   <p id="detailsDue"></p>
                   <h6>Description</h6>
                   <p id="detailsDesc">Details about the quest such as what it entails.</p>
                 </div>
                 <div class="modal-footer">
                 </div>
               </div>
             </div>
           </div>
        <!-- /View Details Modal -->

        <!-- Accept Quest Modal -->
           <div class="modal fade" id="acceptquest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title" id="acceptLabel">Quest Details</h4>
                 </div>
                 <div class="modal-body">
                  <form action="questFunctions.php" method="POST">
                      <div class="form-group" align="center">
                        <h4>Are You Sure You Want To Accept This Quest?</h4>
                      </div>
                     <div class="form-group">
                       <input type="hidden" class="form-control" id="acceptTitle" name="title">
                     </div>
                     <div class="form-group">
                       <input type="hidden" class="form-control" id="acceptCourse" name="course"></input>
                     </div>
                     <div class="form-group">
                       <input type="hidden" class="form-control" id="action" name="action" value="accept"></input>
                     </div>
                 </div>
                 <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button submit" class="btn btn-primary">Accept Quest</button>
                 </div>
                 </form>
               </div>
             </div>
           </div>
        <!-- /Accept Quest Modal -->

        <!-- Drop Quest Modal -->
           <div class="modal fade" id="dropquest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title" id="dropLabel">Quest Details</h4>
                 </div>
                 <div class="modal-body">
                  <form action="questFunctions.php" method="POST">
                      <div class="form-group" align="center">
                        <h4>Are You Sure You Want To Drop This Quest?</h4>
                      </div>
                     <div class="form-group">
                       <input type="hidden" class="form-control" id="dropTitle" name="title">
                     </div>
                     <div class="form-group">
                       <input type="hidden" class="form-control" id="dropCourse" name="course"></input>
                     </div>
                     <div class="form-group">
                       <input type="hidden" class="form-control" id="action" name="action" value="drop"></input>
                     </div>
                 </div>
                 <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="button submit" class="btn btn-primary">Drop Quest</button>
                 </div>
                 </form>
               </div>
             </div>
           </div>
        <!-- /Drop Quest Modal -->

      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- AdminLTE App -->
      <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
      <script type="text/javascript">
        $('#seedetails').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var questId = button.data('id') // Extract info from data-* attributes
          var questDue = button.data('due')
          var questXp = button.data('xp')
          var questDesc = button.data('desc')
              while (questId.search("_")!=-1){
                questId=questId.replace("_"," ")
              }
              while (questDesc.search("_")!=-1){
                questDesc=questDesc.replace("_"," ")
              }
              while (questDesc.search("~")!=-1){
                    //console.log(questDesc.search("~"))
                    questDesc=questDesc.replace("~","<br/>")
                    //console.log("in loop")
              }

          var modal = $(this)
          modal.find('#detailsLabel').text(questId) //Input results returned into the modals.
          modal.find('#detailsTitle').text(questId)
          modal.find('#detailsXp').text(questXp)
          modal.find('#detailsDesc').html(questDesc)
          modal.find('#detailsDue').text(questDue)

      });
      $('#acceptquest').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var questId = button.data('id') // Extract info from data-* attributes
        var questCourse = button.data('course')
        var modal = $(this)
        modal.find('#acceptLabel').text("Accept Quest: "+questId) //Input results returned into the modals.
        modal.find('#acceptTitle').val(questId)
        modal.find('#acceptCourse').val(questCourse)
      });

      $('#dropquest').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var questId = button.data('id') // Extract info from data-* attributes
        var questCourse = button.data('course')
        var modal = $(this)
        modal.find('#dropLabel').text("Drop Quest: "+questId) //Input results returned into the modals.
        modal.find('#dropTitle').val(questId)
        modal.find('#dropCourse').val(questCourse)
      });
    </script>
  </body>
</html>
