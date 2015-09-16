<?php
require('config.php');

 if(isset($_GET['id'])){

    $rid = intval($_GET['id']);
    
    $stmt = $con->prepare("SELECT * FROM request WHERE id = :rid");
    $stmt->bindParam(':rid', $rid, PDO::PARAM_INT);
    
    $stmt->execute();
    $obj = $stmt->fetch(PDO::FETCH_OBJ);

    if($obj){
        $lokasi = $obj->address;
        $latitude = $obj->latitude;
        $longitude = $obj->longitude;
        $req_date = $obj->req_date;
        $location = "$latitude, $longitude";
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
 
    var contentString = '<?php echo "<b>$lokasi</b><br>" ;?>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    infowindow.open(map,marker);
 
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });
 
  }
 
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


                          <?php

$APPLICATION_ID = "LEKvVz6itMB5FayjYaujnIfBQBQmkUcWaLRFCUbq";
$REST_API_KEY = "MPWwAg4b1wJ1v4ebIsMfANKh3U96aDDLdljFxeb0";
$MESSAGE = "Salam 1Malaysia, dimaklumkan bahawa aktiviti semburan asap nyamuk akan dilakukan disekitar kawasan anda. 
Sila ambil tindakan yang sewajarnya. Terima Kasih.";

if (!empty($_POST)) {

    $errors = array();
    foreach (array('app' => 'APPLICATION_ID', 'api' => 'REST_API_KEY', 'body' => 'MESSAGE') as $key => $var) {
        if (empty($_POST[$key])) {
            $errors[$var] = true;
        } else {
            $$var = $_POST[$key];
        }
    }

    if (!$errors) {
        $url = 'https://api.parse.com/1/push';
        $data = array(
            //'channel' => '',
            'where' => '{}',
            //'type' => 'android',
            'expiry' => 1451606400,
            'data' => array(
                'alert' => $MESSAGE,
            ),
        );
        $_data = json_encode($data);
        $headers = array(
            'X-Parse-Application-Id: ' . $APPLICATION_ID,
            'X-Parse-REST-API-Key: ' . $REST_API_KEY,
            'Content-Type: application/json',
            'Content-Length: ' . strlen($_data),
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //disable ssl
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($curl);
    }
}
?>

    <?php  if (isset($response)) {
       // echo '<h2>Response from Parse API</h2>';
       // echo '<pre>' . htmlspecialchars($response) . '</pre>';
       // echo '<hr>';
      echo "<script>alert(\"Pesanan Berjaya Dihantar!\")</script>";
    } elseif ($_POST) {
        echo '<h2>Error!</h2>';
        echo '<pre>';
        var_dump($APPLICATION_ID, $REST_API_KEY, $MESSAGE);
        echo '</pre>';
    } ?>

    <h4>Notify nearby resident</h4>
    <form id="parse" action="" method="post" accept-encoding="UTF-8">
        
            <input type="hidden" name="app" id="app" value="<?php echo htmlspecialchars($APPLICATION_ID); ?>">
            <input type="hidden" name="api" id="api" value="<?php echo htmlspecialchars($REST_API_KEY); ?>">
        
        <p>
            <textarea name="body" id="body"  cols=110 rows=5><?php echo htmlspecialchars($MESSAGE); ?></textarea>
        </p>
        <p>
            <input type="submit" class="btn btn-success pull-right" value="Broadcast Now"><br>
        </p>
    </form>


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