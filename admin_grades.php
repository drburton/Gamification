<div class="col-xs-12">
  <div class="box">
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
        <thead>
          <!--
            <tr>
                <th>Quest</th>
                <th>XP</th>
                <th>Due Date</th>
                <th>Details</th>
                <th>Accept</th> -->

            <?php
            foreach ($questCursor as $doc) { //Turn cursor (results) human readable
              //print "<tr>";
              foreach ($doc as $k => $v) {
                print($v);
              }
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