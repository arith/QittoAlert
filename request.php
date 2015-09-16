<?php
require('config.php');
?>
<html>
<title>Qitto Alert | Administrator Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/datepicker.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/custom.js"></script>
   <script src="js/bootstrap.min.js"></script> 
   <script src="js/datepicker.js"></script> 
   <link href="css/dataTables.css" rel="stylesheet">
   <script src="js/jquery-jvectormap-2.0.4.min.js"></script>
  <script src="js/jquery-jvectormap-asia-mill.js"></script>
    <link rel="stylesheet" href="css/jquery-jvectormap-2.0.4.css" type="text/css" media="screen"/>

<div class="container">
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
 <div class="mail-box">
                  <aside class="sm-side">
                      <div class="user-head">
                              <a href="dashboard.php"><img src='img/logo.png'></a>
                      </div>
                    
                      <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
                          <li> <h4>Intelligence Events</h4> </li>
                          <li> <a href="dashboard.php"> <i class=" fa fa-sign-blank text-danger"></i> HeatMap <span class="label label-info pull-right"><?php //getPromotionNum("all");?></span></a> </li>
                          <li> <a href="analytics.php"> <i class=" fa fa-sign-blank text-danger"></i> Analytics <span class="label label-success pull-right"><?php //getPromotionNum("active");?></span></a> </li>
                          <li> <a href="forecast.php"> <i class=" fa fa-sign-blank text-danger"></i> Forecast <span class="label label-success pull-right"></span></a> </li>
                          <li> <a href="dataset.php"> <i class=" fa fa-sign-blank text-info "></i> DataSet <span class="label label-danger pull-right"><?php //getPromotionNum("expired");?></span></a></li>
                          <li> <a href="request.php"> <i class=" fa fa-sign-blank text-info "></i> Fogging Request <span class="label label-danger pull-right"><?php echo $jumlah;?></span></a></li>
                      </ul>
                      <ul class="nav nav-pills nav-stacked labels-info ">
                          <li> <h4>Settings</h4> </li>
                          <li> <a href="profile.php"> <i class=" fa fa-user text-success"></i>Profile <p>Administration Settings</p></a>  </li>
                          <li> <a href="support.php"> <i class=" fa fa-question-circle text-success"></i>Support<p>Get support.</p></a>
                          <li> <a href="logout.php"> <i class=" fa fa-sign-out text-danger"></i>Logout</a>
                          </li>
                      </ul>

                      <div class="inbox-body text-center">
                          <div class="btn-group">
                              <a class="btn mini btn-primary" href="javascript:;">
                                  <i class="fa fa-plus"></i>
                              </a>
                          </div>
                          <div class="btn-group">
                              <a class="btn mini btn-success" href="javascript:;">
                                  <i class="fa fa-phone"></i>
                              </a>
                          </div>
                          <div class="btn-group">
                              <a class="btn mini btn-info" href="javascript:;">
                                  <i class="fa fa-cog"></i>
                              </a>
                          </div>
                      </div>

                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Fogging Request</h3>
                          <div class="pull-right position">
                            <!-- getWorkshopInfo("subscription_end_on")) -->
                          	<b><?php //echo getWorkshopInfo("subscription_end_on"); ?></b>
                          </div>
                      </div>
                      <div class="inbox-body">
                         
                         
                         <table id="requesttable" class="table-responsive table-dt table-hover table-bordered-dt dataTable" >
                  <thead class="hidden-xs hidden-sm">
                    <tr>
                      <th>#</th>
                      <th>Alamat</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th width=120px>Tarikh</th>
                      <th>Status</th>
                      <th width=120px>Action</th>
                    </tr>
                  </thead>
                  <tfoot class="hidden-xs hidden-sm">
                    <tr>
                      <th>#</th>
                      <th>Alamat</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>Tarikh</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
                         

                      </div>
                  </aside>
              </div>
</div>
<br><br>
<div class="footer">
                    <p>Copyright &copy; 2015. Crafted by <a href="http://www.rootmybox.com" target="_blank">ROOTMYBOX</a></p>
                </div>

<script type="text/javascript">
    $(document).ready(function () {
        
        $('#datestart').datepicker({
            format: "yyyy/mm/dd"
        }).val(); 

        $('#dateend').datepicker({
            format: "yyyy/mm/dd"
        }).val();  
    
    });
</script>
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="js/request.tables.js"></script>
</html>