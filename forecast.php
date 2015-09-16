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
   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.3.0/knockout-min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js'></script>
<style>
#ftable td{
   padding: 3px;
}
.forecast h4{
  margin-left: 30px;
}

.forecast ul{
      list-style: none;
    }
    .forecast li {
      background-color: #f4faff;
      margin-left: 30px;
    }
    .date{
      color:#008000
    }
    .side-text{
      margin-top: -45px;
      margin-left: 80px;
      margin-bottom: 5px;
    }
    
    .image{
      padding-bottom: 0px;
    }
</style>
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
                          <h3>5 Days Forecast:
                            <?php
                            $today = date("d M Y");
                            $enddate = date('d M Y', strtotime($today. ' + 5 days'));
                            echo "$today - $enddate";
                            ?>
                          </h3>
                          <div class="pull-right position">
                            Realtime update every 3 hour
                          	<b><?php //echo getWorkshopInfo("subscription_end_on"); ?></b>
                          </div>
                      </div>
                      <div class="inbox-body">
                         
    <div class='forecast'>

      <form action='' method='post'>
        <center> <input type=text required="required" name=loc placeholder="Bandar atau Daerah atau Negeri" size="50px"></center>
      </form>
      <span data-bind='text:"Updated On: "+u()' style="float:right; font-size:11px;"></span>
      <?php
        if(isset($_POST['loc'])){
          $loc = htmlspecialchars($_POST['loc'], ENT_QUOTES);
          $loc = strtoupper($loc);
          echo "<h4>$loc</h4>";
        }
        else{
          $loc = "Kuala Lumpur";
          echo "<h4>$loc</h4>";
        }
      ?>
    
    <ul data-bind='foreach:forecasts'>
      <li class='image'><img data-bind='attr:{src:"http://openweathermap.org/img/w/"+icn+".png"}' /></li>
      <li>
        <ul class='side-text'>
          <li class='date'>
            <span data-bind='text:dt'></span>
          </li>
          <li>
            <span data-bind='text:"Pagi : "+m'></span>
          </li>
          <li>
            <span data-bind='text:"Petang : "+e'></span>
          </li>
          <li>
            <span data-bind='text:"Malam : "+n'></span>
          </li>
          <li>
            <span data-bind='text:"Minimum : "+min'></span>
          </li>
          <li>
            <span data-bind='text:"Maximum : "+max'></span>
          </li>
        </ul>
      </li>
    </ul>
  </div>

  <script>
  var getDateTime = function (x) {
      var g = null; //return g
      var m = moment(x);
      if(!m || !m.isValid()) { return; } //if we can't find a valid or filled moment, we return.
      var malam = 18, petang = 12, pagi = 4;
      var cur = parseFloat(m.format("HH"));
      if (cur === 0){
        cur = 24;
      }
      if(cur >= pagi && cur < petang) {
        g = 'm'; // "pagi";
      }else if(cur >= petang && cur <= malam) {
        g = 'e'; // "petang";
      } else {
        g = 'n';//"malam";
      }
      return g;
  },ViewModel = new function(){
      var self = this;
      self.forecasts = ko.observableArray();
      self.u = ko.observable();
    }, Refresh = function(){
     // $.getJSON('http://api.openweathermap.org/data/2.5/forecast?q=cyberjaya,my&mode=json&units=metric&cnt=64',function(data){
       $.getJSON('http://api.openweathermap.org/data/2.5/forecast?q=<?php echo $loc;?>,my&mode=json&units=metric&cnt=64',function(data){
        var viewData  = [];
        for(var k=0;k<data.list.length;k++){
          var v = data.list[k],s =v.dt_txt.split(" "),d = s[0],vdk = getDateTime(v.dt_txt);
          if(typeof(viewData[d]) === 'undefined'){
            viewData[d] = [];
          }
          if(typeof(viewData[d].max) === 'undefined' || typeof(viewData[d].min) === 'undefined'){
            viewData[d].min = viewData[d].max = 0;
          }
          if(viewData[d].max < v.main.temp_max){
            viewData[d].max = parseFloat(v.main.temp_max);
          }
          if(viewData[d].min > v.main.temp_min || viewData[d].min == 0){
            viewData[d].min = parseFloat(v.main.temp_min);
          }
          viewData[d][vdk] = v.weather[0].main;
          viewData[d]['icn'] = v.weather[0].icon;
        }
        ViewModel.forecasts.removeAll();
        for (var i in viewData) {
          var v  = viewData[i];
          v.m = v.m || '-';
          v.e = v.e || '-';
          v.n = v.n || '-';
          v.dt = moment(i).format("D MMM YYYY");;
          v.max+=" Celcius";
          v.min+=" Celcius";
          ViewModel.forecasts.push(v);
        }
      });
      var m = moment().format("D MMM YYYY h:mm A");
      ViewModel.u(m);
  };
  ko.applyBindings(ViewModel);
  $(document).ready(function(){
      Refresh();
      setInterval(Refresh,1200000);//2 hours update = 120 Minute Update
  });
  </script>  

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