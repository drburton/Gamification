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
              print('<tr>');
              foreach ($doc as $k => $v) {
                $userId=$v;
              }
              $userCollection = new MongoCollection( $db, "users");
              $userCursor = $userCollection->findOne(array('_id' => $userId));

              print('<td>'.$userCursor['name'].' ('.$userCursor['_id'].')</td>');
              foreach ($allQuests as $id) {
                $quest = $collection2->findOne(array('_id' => new MongoId($id)));
                print($id.'<br/>');
                //print($id."<br/>");
              }
              for ($i = 0; $i <= 5; $i++) {
                print("<td style='min-width: 150px; text-align:center;'>-</td>");
              }
              print("<td style='min-width: 150px; text-align:center;'>- / $maxEXP</td>");
              print('</tr>');
            }

          ?>

        </tbody>
        </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div>