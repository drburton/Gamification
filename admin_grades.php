<div class="col-xs-12">
  <div class="box">
    <div class="box-body table-responsive no-padding">
        <table class="table table-bordered table-hover" style="overflow:scroll;">
        <thead>
            <tr><!--
                <th>Quest</th>
                <th>XP</th>
                <th>Due Date</th>
                <th>Details</th>
                <th>Accept</th> -->
            <th style="text-align:center;">Users</th>
            <?php
            foreach ($questCursor as $doc) { //Turn cursor (results) human readable
              $title;
              $exp;
              print('<th style="text-align:center;">');
              foreach ($doc as $k => $v) {
                //print($k.": ".$v);
                //print('<br/>');
                if($k=='title'){
                  $title = $v;
                }elseif($k=='xp'){
                  $exp=$v;
                }
              }
              print($title."<br/>".$exp." xp</th>");
            }

            ?>


            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
</div>