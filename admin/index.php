<?php
include ($_SERVER['DOCUMENT_ROOT'].'/pages/header.php');
if (!$staff || $staff->getRoleID() < 7){
    //Not Authorized to see this Page
    header("Location: /index.php");
	exit();
}
?>
<title><?php echo $sv['site_name'];?> Admin</title>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Admin Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fas fa-hourglass-half"></i> Transactions by Hour
                    <div class="pull-right">
                      <p>Week of: <input type="text" id="weekly_trans_by_hour_datepicker"></p>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="weekly_trans_by_hour_chart"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class='far fa-chart-bar fa-fw'></i> Transactions By Devices
                    <div class="pull-right">
                      &nbsp;&nbsp;
                      <div class="btn-group btn-group-xs">
                        <button class="btn btn-default" type="button" id="trans_by_devices_button">Run</button>
                      </div>
                    </div>
                    <div class="pull-right">
                      <p>&nbsp;&nbsp;&nbsp;&nbsp;End: <input type="text" id="trans_by_devices_datepicker_end"></p>
                    </div>
                    <div class="pull-right">
                      <p>Start: <input type="text" id="trans_by_devices_datepicker_start"></p>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="trans_by_devices_table_title"> </div>
                    <div class="table-responsive" id="trans_by_devices_table"></div>
                    <div id="trans_by_devices_donut"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <i class='fas fa-table fa-lg'></i> Training Certifications - Total Stats
              </div>
              <!-- /.panel-heading -->
              <div class="panel-body">
                <table class="table table-condensed">
                      <tbody>
                          <?php if($result = $mysqli->query("
                              SELECT count(*) as count
                              FROM `trainingmodule`
                      ")){
                          $row = $result->fetch_assoc()?>
                          <tr>
                              <td><i class="far fa-file fa-lg"></i> Training Modules</td>
                              <td><?php echo $row['count'];?></td>
                          </tr>
                      <?php } else { ?>
                          <tr>
                              <td>Training Modules</td><td>-</td>
                          </tr>
                      <?php } ?>
                      <?php if($result = $mysqli->query("
                          SELECT count(*) as count
                          FROM `tm_enroll`
                          WHERE `current` = 'Y'
                      ")){
                          $row = $result->fetch_assoc()?>
                          <tr>
                              <td><i class="far fa-check-circle fa-lg"></i> Certificates Issued</td>
                              <td><?php echo $row['count'];?></td>
                          </tr>
                      <?php } else { ?>
                          <tr>
                              <td>Training Enrollments</td><td>-</td>
                          </tr>
                      <?php } ?>
                      </tbody>
                    </table>
              </div>
              <!-- /.panel-body -->
          </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fas fa-check-square"></i> Complete/Failed Jobs
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Device Group <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" id="failed_pie_chart_dropdown" role="menu">
                              <li><a>All</a></li>
                              <?php
                              if($result = $mysqli->query("SELECT dg_desc FROM device_group")) {
                                while($row = $result->fetch_assoc()) {?>
                                  <li><a><?php echo $row['dg_desc'];?></a></li>
                              <?php }
                              } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="pull-right">
                    <p>End: <input type="text" id="failed_pie_chart_datepicker_end" size="10">&nbsp;&nbsp;</p>
                  </div>
                  <div class="pull-left">
                    <p>&nbsp;&nbsp;Start: <input type="text" id="failed_pie_chart_datepicker_start" size="10"></p>
                  </div>
                  <div class="panel-body">
                    <div class="panel-body">
                  <div id="failed_pie_chart_pie"></div>
                </div>
              </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="far fa-chart-bar"></i> Donut Chart Example
                </div>
                <div class="panel-body">
                    <div id="morris-donut-chart"></div>
                    <a href="#" class="btn btn-default btn-block">View Details</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

            <!-- /.panel .chat-panel -->
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<?php
//Standard call for dependencies
include ($_SERVER['DOCUMENT_ROOT'].'/pages/footer.php');
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript" src="/admin/reports/interactions.js"></script>
