<?php
require('config.php');
?>
<html>
<head>
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
  <script src="js/my-map.js"></script>
    <link rel="stylesheet" href="css/jquery-jvectormap-2.0.4.css" type="text/css" media="screen"/>
<script src="js/SimpleChart.js"></script>
 <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="js/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'img/loading.gif',
        closeImage   : 'img/closelabel.png'
      })
    })
  </script>
  <style>#temp{display: none;}</style>

</head>
<body>
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
                          <li> <a href="analytics.php"> <i class=" fa fa-sign-blank text-danger"></i> Analytics <span class="label label-success pull-right"></span></a> </li>
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
                          <h3>Analytics</h3>
                          <div class="pull-right position">
                            <!-- getWorkshopInfo("subscription_end_on")) -->
                          	<b><?php //echo getWorkshopInfo("subscription_end_on"); ?></b>
                          </div>
                      </div>
                      <div class="inbox-body">
<script>
<?php

    $chechtahun = $con->prepare("SELECT distinct tahun FROM statistic");
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

      
      $query = $con->prepare("SELECT negeri, sum(kes_terkumpul) AS kes_terkumpul FROM statistic WHERE tahun=$year GROUP BY negeri;");
      $query->execute();
      $query->setFetchMode(PDO::FETCH_OBJ);
      while($r = $query->fetch()){
        $negeri = $r->negeri;
        if($negeri=="Perlis"){
          $negeri = "PLS";
        }
        if($negeri=="Kedah"){
          $negeri = "KDH";
        }
        if($negeri=="Pulau Pinang"){
          $negeri = "PP";
        }
        if($negeri=="Perak"){
          $negeri = "PRK";
        }
        if($negeri=="Kelantan"){
          $negeri = "KTN";
        }
        if($negeri=="Terengganu"){
          $negeri = "TRG";
        }
        if($negeri=="Pahang"){
          $negeri = "PHG";
        }
        if($negeri=="Selangor"){
          $negeri = "SEL";
        }
        if($negeri=="Kuala Lumpur"){
          $negeri = "KUL";
        }
        if($negeri=="Putrajaya"){
          $negeri = "PJY";
        }
        if($negeri=="Melaka"){
          $negeri = "MLK";
        }
        if($negeri=="Negeri Sembilan"){
          $negeri = "NS";
        }
        if($negeri=="N. Sembilan"){
          $negeri = "NS";
        }
        if($negeri=="Johor"){
          $negeri = "JHR";
        }
        if($negeri=="Sarawak"){
          $negeri = "SWK";
        }
        if($negeri=="Sabah"){
          $negeri = "SBH";
        }
        $kes_terkumpul = $r->kes_terkumpul;
            echo "{ X: \"$negeri\", Y: $kes_terkumpul }, ";
      }
      $c++;
      echo "
          ]
        }
      ";
    }

    ?>

$(function () {
                $("#Areagraph").SimpleChart({
                ChartType: "Area",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [ graphdata1, graphdata2, graphdata3, graphdata4, graphdata5, graphdata6 ],
                legendsize: "150",
                legendposition: 'bottom',
                xaxislabel: 'Negeri',
                title: '',
                yaxislabel: 'Jumlah Kes'
            });
            });

</script>      


<script>
<?php

    $chechtahun = $con->prepare("SELECT distinct tahun FROM death ORDER BY tahun");
    $chechtahun->execute();
    $chechtahun->setFetchMode(PDO::FETCH_OBJ);
    $c=1;
    $y = array();
    while($ch = $chechtahun->fetch()){
      $year = $ch->tahun;
      $y[] = "deathgraphdata$c";
      $gr = implode(', ', $y);
      
      echo "var deathgraphdata$c = {
          linecolor: \"Random\",
          title: \"$year\",
          values: [
          ";

      
      $query = $con->prepare("SELECT negeri, jumlah AS jumlah_mati FROM death WHERE tahun=$year GROUP BY negeri;");
      $query->execute();
      $query->setFetchMode(PDO::FETCH_OBJ);
      while($r = $query->fetch()){
        $negeri = $r->negeri;
        if($negeri=="Perlis"){
          $negeri = "PLS";
        }
        if($negeri=="Kedah"){
          $negeri = "KDH";
        }
        if($negeri=="Pulau Pinang"){
          $negeri = "PP";
        }
        if($negeri=="Perak"){
          $negeri = "PRK";
        }
        if($negeri=="Kelantan"){
          $negeri = "KTN";
        }
        if($negeri=="Terengganu"){
          $negeri = "TRG";
        }
        if($negeri=="Pahang"){
          $negeri = "PHG";
        }
        if($negeri=="Selangor"){
          $negeri = "SEL";
        }
        if($negeri=="Wpkl/Putrajaya"){
          $negeri = "KUL/PJY";
        }
        if($negeri=="Melaka"){
          $negeri = "MLK";
        }
        if($negeri=="Negeri Sembilan"){
          $negeri = "NS";
        }
        if($negeri=="N. Sembilan"){
          $negeri = "NS";
        }
        if($negeri=="Johor"){
          $negeri = "JHR";
        }
        if($negeri=="Sarawak"){
          $negeri = "SWK";
        }
        if($negeri=="Sabah"){
          $negeri = "SBH";
        }
        if($negeri=="Labuan"){
          $negeri = "LBN";
        }
        $jumlah_mati = $r->jumlah_mati;
            echo "{ X: \"$negeri\", Y: $jumlah_mati }, ";
      }
      $c++;
      echo "
          ]
        }
      ";
    }

    ?>

$(function () {
                $("#Areagraph2").SimpleChart({
                ChartType: "Area",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [ deathgraphdata1, deathgraphdata2, deathgraphdata3, deathgraphdata4, deathgraphdata5, deathgraphdata6],
                legendsize: "150",
                legendposition: 'bottom',
                xaxislabel: 'Negeri',
                title: '',
                yaxislabel: 'Jumlah Kematian'
            });
            });

</script>

<script>
    
    <?php

    $chechtahun = $con->prepare("SELECT distinct tahun FROM tourist");
    $chechtahun->execute();
    $chechtahun->setFetchMode(PDO::FETCH_OBJ);
    $c=1;
    $y = array();
    while($ch = $chechtahun->fetch()){
      $year = $ch->tahun;
      $y[] = "touristdata$c";
      $gr = implode(', ', $y);
      
      echo "var touristdata$c = {
          linecolor: \"Random\",
          title: \"$year\",
          values: [
          ";

      
      $query = $con->prepare("SELECT * FROM tourist WHERE tahun=$year ORDER BY tahun, id");
      $query->execute();
      $query->setFetchMode(PDO::FETCH_OBJ);
      while($r = $query->fetch()){
        $tahun = $r->tahun;
        $bulan = $r->bulan;
        $jumlah = $r->jumlah;
            echo "{ X: \"$bulan\", Y: $jumlah },";
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

<h4>Kes Wabak Terkumpul Tahunan</h4> 
<div id="Areagraph" style="width: 100%; height: 400px"></div>    
<br><br><br>
<h4>Kes Kematian Terkumpul Tahunan</h4> 
<div id="Areagraph2" style="width: 100%; height: 400px"></div>  
<br><br><br>
<h4>Jumlah Pelancong Ke Malaysia Tahunan</h4> 
<div id="Linegraph" style="width: 100%; height: 400px"></div>    
<br><br><br>
<h4>Statistik Daerah Terperinci Mengikut Negeri</h4>                         
<center><div id="my-map" style="width: 90%; height: 400px"></div> </center>
<script>
    $(function() {
    $('#my-map').vectorMap({
        map: 'map',
        backgroundColor: 'transparent',
        zoomOnScroll: false,
        zoomButtons: false,
        hoverColor: false,
        hoverOpacity: 0.5, 
        onRegionClick: function(e, code){
          jQuery(document).ready(function($) {
            var link = $('<a data-toggle="modal" id=temp href="map-graph.php?code='+code+'" data-target="#myModal">Click me !</a>');
            $("#ok").append(link);
            $("#temp")[0].click();
          });
        }, 
        regionStyle: {
        initial: {
          fill: '#0080FF'
        },
        hover: {
            fill: "#08088A"
          }
      }
    });
});
  </script>  
  <span id="ok"></span>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <!-- end modal -->
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

    $('#myModal').on('hidden.bs.modal', function () {
    window.location.reload();
});
</script>
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="js/dataset.tables.js"></script>
</body>
</html>