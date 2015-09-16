<?php
require('config.php');
?>
<html>
<title>Qitto Alert | Administrator Dashboard</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="css/abootstrap.css">
    <link rel="stylesheet" href="css/aanimate.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/abootstrap.css">
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="css/adatepicker.css">
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/custom.js"></script>
   <script src="js/bootstrap.min.js"></script> 
   <script src="js/datepicker.js"></script> 
   <link href="css/adataTables.css" rel="stylesheet">

<script src="js/SimpleChart.js"></script>
<?php 
if(isset($_GET['code'])){
  $neg = htmlspecialchars($_GET['code'], ENT_QUOTES);
}
?>
<center><a href="map-graph.php?code=<?php echo $neg;?>" target="blank">View New Window</a></center>
    <script>

<?php
    
    $d = $con->prepare("SELECT distinct daerah FROM statistic WHERE negeri = :neg");
    $d->bindParam(':neg', $neg);
    $d->execute();
    $d->setFetchMode(PDO::FETCH_OBJ);
    $c=1;
    $y = array();
    while($ch = $d->fetch()){
      $daerah = $ch->daerah;
      $y[] = "graphdata$c";
      $gr = implode(', ', $y);
      
      echo "var graphdata$c = {
          linecolor: \"Random\",
          title: \"$daerah\",
          values: [
          ";

      
      $query = $con->prepare("SELECT minggu, tahun, sum(kes_terkumpul) AS kes_terkumpul from statistic where daerah='$daerah' group by minggu order by tahun DESC");
      $query->execute();
      $query->setFetchMode(PDO::FETCH_OBJ);
      while($r = $query->fetch()){
        $tahun = $r->tahun;
        $tahun_short = date("y", strtotime($tahun));

        $minggu = $r->minggu;
        $kes_terkumpul = $r->kes_terkumpul;
            echo "{ X: \"$tahun_short ($minggu)\", Y: $kes_terkumpul },";
      }
      $c++;
      echo "
          ]
        };
      ";
    }

    ?>
      
        
        $(function () {
            $("#StackedHybridbargraph").SimpleChart({
                ChartType: "StackedHybrid",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [<?php echo $gr;?>],
                legendsize: "140",
                legendposition: 'bottom',
                xaxislabel: 'Tahun (Minggu)',
                title: '',
                yaxislabel: 'Jumlah Kes'
            });
            });

    </script>

    <div id="StackedHybridbargraph" style="height: 400px"></div>

</head>
</html>