<?php
require('config.php');

 if(isset($_GET['id'])){

    $mid = intval($_GET['id']);
    
    $stmt = $con->prepare("SELECT * FROM statistic WHERE id = :mid");
    $stmt->bindParam(':mid', $mid, PDO::PARAM_INT);
    
    $stmt->execute();
    $obj = $stmt->fetch(PDO::FETCH_OBJ);

    if($obj){
        $lokasi = $obj->lokasi;
        $latitude = $obj->latitude;
        $longitude = $obj->longitude;
        $tempoh_wabak = $obj->tempoh_wabak;
        $kes_terkumpul = $obj->kes_terkumpul;
        $location = "$latitude, $longitude";
    }

     $stmt2 = $con->prepare("SELECT distinct tahun, sum(kes_terkumpul) AS jumlah_kes FROM statistic WHERE lokasi = :lokasi");
      $stmt2->bindParam(':lokasi', $lokasi, PDO::PARAM_STR);
      $stmt2->execute();
      $obj2 = $stmt2->fetch(PDO::FETCH_OBJ);
      
      foreach($obj2 as $key=>$val)
      {
      $tahun = $obj2->tahun;
      $jumlah_kes = $obj2->jumlah_kes;
      }


 }


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

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function initialize() {
    var position = new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude;?>);
    var myOptions = {
      zoom: 15,
      center: position,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(
        document.getElementById("map"),
        myOptions);
 
    var marker = new google.maps.Marker({
        position: position,
        map: map
    });  
 
    var contentString = '<?php echo "<b>$lokasi</b><br>Wabak Terkumpul: $jumlah_kes kes <br>" ;?>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    infowindow.open(map,marker);
 
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
 
  }
 
</script>


<script src="js/SimpleChart.js"></script>
    <script>

    
    <?php
    $lokasi_wild = "%$lokasi%";

    $chechtahun = $con->prepare("SELECT distinct tahun FROM statistic WHERE lokasi LIKE :lokasi");
    $chechtahun->bindParam(':lokasi', $lokasi_wild);
    $chechtahun->execute();
    $chechtahun->setFetchMode(PDO::FETCH_OBJ);
    $c=1;
    $y = array();
    while($ch = $chechtahun->fetch()){
      $year = $ch->tahun;
      $y[] = "graphdata$c";
      $gr = implode(', ', $y);
      
      echo "var graphdata$c = {
          linecolor: \"Random\",
          title: \"$year\",
          values: [
          ";

      
      $query = $con->prepare("SELECT * FROM statistic WHERE tahun=$year AND lokasi LIKE :lokasi ORDER BY tahun, id");
      $query->bindParam(':lokasi', $lokasi_wild);
      $query->execute();
      $query->setFetchMode(PDO::FETCH_OBJ);
      while($r = $query->fetch()){
        $tahun = $r->tahun;
        $minggu = $r->minggu;
        $kes_terkumpul = $r->kes_terkumpul;
            echo "{ X: \"$minggu\", Y: $kes_terkumpul },";
      }
      $c++;
      echo "
          ]
        }
      ";
    }

    ?>
        
        $(function () {
            $("#Linegraph").SimpleChart({
                ChartType: "Line",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [<?php echo "$gr";?>],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Minggu',
                title: '',
                yaxislabel: 'Jumlah Kes'
            });
            });

    </script>

<body onload="initialize()">
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
                          <h3>DataSet: <?php echo $lokasi; ?></h3>
                          <div class="pull-right position">
                            <!-- getWorkshopInfo("subscription_end_on")) -->
                          	<b><?php //echo getWorkshopInfo("subscription_end_on"); ?></b>
                          </div>
                      </div>
                      <div class="inbox-body">
                         
                             <div id="map" style="width:100%; height:300px"></div>

                             <div id="Linegraph" style="width: 98%; height: 400px"></div>
                        
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
</body>
</html>