<div class="col-xs-12">
  <div class="box">
    <div class="box-body table-responsive no-padding" style="overflow:scroll;">
        <table class="table table-bordered table-hover">
        <thead>
            <tr><!--
                <th>Quest</th>
                <th>XP</th>
                <th>Due Date</th>
                <th>Details</th>
                <th>Accept</th> -->
            <th style="text-align:center; vertical-align:middle; min-width: 175px;">Students</th>
            <?php
            $allQuests=[];
            foreach ($questCursor as $doc) { //Turn cursor (results) human readable
              $title;
              $exp;
              print('<th style="text-align:center; min-width: 175px;">');
              foreach ($doc as $k => $v) {
                //print($k.": ".$v);
                //print('<br/>');
                if($k=='title'){
                  $title = $v;
                }elseif($k=='xp'){
                  $exp=$v;
                }elseif($k=='_id'){
                  array_push($allQuests,$v);
                }
              }
              print($title."<br/>".$exp." xp</th>");
            }

            /*for ($i = 0; $i <= 15; $i++) {
                print("<th style='min-width: 150px;'>Overflow Test</th>");
            }*/

            ?>
            <th style="text-align:center; vertical-align:middle; min-width: 175px;">Class Experience</th>

            </tr>
        </thead>
        <tbody>

          <?php
            $user_results = array('course_id' => $course, 'user_role' => array('$ne' => 'admin'));
            $userCourseCursor = $collection2->find($user_results);
            $userCourseCursor->fields(array('user_id' => true,'_id' => false));
            $userCourseCursor = $userCourseCursor->sort(array("name"=>1)); //Sort by title

            foreach ($userCourseCursor as $doc) {
              $userId;
              foreach ($doc as $k => $v) {
                $userId=$v;
                $totalXP=0;
              }
              print('<tr id="'.$userId.'">');
              $userCollection = new MongoCollection( $db, "users");
              $userCursor = $userCollection->findOne(array('_id' => $userId));

              print('<td>'.$userCursor['name'].' ('.$userCursor['_id'].')</td>');
              foreach ($allQuests as $id) {
                $newId = $id->{'$id'};
                $search = array('user_id'=>$userId,'quest_id'=>$newId);
                $quest = $userQuestsCollection->findOne($search);
                if($quest['status']!='submitted' and $quest['status']!='graded'){
                  print("<td id='".$newId."_".$userId."' style='min-width: 150px; text-align:center;'>-</td>");
                }elseif($quest['status']=='submitted'){
                  print("<td id='".$newId."_".$userId."' style='min-width: 150px; text-align:center;'><button class=\"btn btn-danger btn-sm\" 
                    style='width:100px;' onclick=\"gradeQuest('$userId','$newId',$(this))\"><b>Grade</b></button></td>");
                }elseif($quest['status']=='graded'){
                  $totalXP+=$quest['grade'];
                  print("<td id='".$newId."_".$userId."' style='min-width: 150px; text-align:center;'>".$quest['grade']."</td>");
                }
              }
              //for ($i = 0; $i <= 5; $i++) {
              //  print("<td style='min-width: 150px; text-align:center;'>-</td>");
              //}
              print("<td id='".$userId."_exp' style='min-width: 150px; text-align:center;'>".$totalXP." / $maxEXP</td>");
              print('</tr>');
            }

          ?>

        </tbody>
        </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div>

<script>

  function undoGrade(){//(button,form){
    //button.show();
    //form.remove();
    alert("Lost Focus");
  }

	function gradeQuest(user,qId,button){
		//alert(user+"\n"+qId);
		button.hide();
		var id = '#'+qId+'_'+user;
		//alert(id); //"+button+",$(this)
		var gradeForm = "<input autofocus type='number' align='center' style='borderStyle=\"none\"' onfocusout='undoGrade()' onchange='(changeGrade(\""+user+"\",\""+qId+"\",$(this).val()))'/>"
		$(id).append("<b>"+gradeForm+"</b>");
	}

	function changeGrade(user,quest,grade){
		//alert(grade);
		$.ajax({url: "ajax_functions.php?action=changeGrade&user="+user+"&qId="+quest+"&grade="+grade, 
			success: function(result){
        	var id = '#'+quest+'_'+user;
        	$(id).html(grade);
        	var total = 0;
        	var num;
        	var rowId = "#"+user;
        	alert(rowId);
        	$(rowId).find("td").each(function(index){
        		//alert(index);
            var cell = $(this).html();
            if(parseInt(cell,10) && $(this).attr('id') != user+"_exp"){
        			total = total+parseInt(cell,10);
              //alert(total);
        		}
        	})
        	//total = total - num;
        	var oldTotal = $("#"+user+"_exp").val();
        	$("#"+user+"_exp").html(total+<?php print("' / ".$maxEXP."'");?>);
    	}});
    	/*
    	, error: function(result){
    		alert("The site was unable to change the grade due to an error.");
    	}
    	*/
	}
</script>