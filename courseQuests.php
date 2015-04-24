<?php
    $m = new MongoClient();
    $db = $m->selectDB("gamification_db");
    $collection = new MongoCollection( $db, "users-courses");
    $collection2 = new MongoCollection( $db, "quests");
    include_once "config.php";
    if (!loggedIn()){
        header("Location: /index.php");
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EduQuest | Quests</title>
        <?php include_once "headStyle.php"; ?>
    </head>
    <body class="skin-blue">
        <?php include_once "navTemplate.php";?>
                        <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        (Course Name) Quests
                        <small>Choose wisely.</small>
                    </h1>
                </section>

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
                                        <tr>
                                            <th>Quest</th>
                                            <th>XP</th>
                                            <th>Due Date</th>
                                            <th>Details</th>
                                        </tr>

                                        <!-- PHP to pull quest data and put in table -->
                                            <?php

                                              $results = array('course_id' => 'DET 210');
                                              $cursor = $collection2->find($results);
                                              $cursor->fields(array("title" => true, 'due_date' => true, 'xp' => true, 'desc' => true, '_id' => false));
                                              $cursor=$cursor->sort(array("title"=>1));
                                              $title="";
                                              $due_date="";
                                              $xp="";
                                              $desc='';
                                              $dbid="";
                                              foreach ($cursor as $doc) {
                                                print "<tr>";
                                                foreach ($doc as $k => $v) {
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

                                                print "<td><a href=\"#\"><button class=\"btn btn-default btn-sm\" data-toggle=\"modal\" data-target=\"#seedetails\" data-id=$title data-due=$due_date data-xp=$xp data-desc=$desc>See Details</button></a></td>";
                                                print "</tr>";

                                                }
                                             ?>

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

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
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
          //console.log(questDesc)
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this)
          modal.find('#detailsLabel').text(questId)
          modal.find('#detailsTitle').text(questId)
          modal.find('#detailsXp').text(questXp)
          modal.find('#detailsDesc').html(questDesc)
          modal.find('#detailsDue').text(questDue)
          //<!--modal.find('.modal-body input').val(recipient)-->
        });
      </script>
    </body>
</html>