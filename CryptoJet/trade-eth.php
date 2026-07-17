<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="extra/jet.ico">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/8f7b167549.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Load d3.js -->
    <script src="https://d3js.org/d3.v4.js"></script>
    <title>CryptoJet</title>

<?php
/*
//data1 in hours (12 am, 4 am , 8 am , 12 pm , 4 pm , 8 pm)(every four hours)
//data2 in days (mon, tues, wed, thurs, fri, sat, sun)(every day)
//data3 in weeks (1st week, 2nd week , 3rd week , 4th week)(every seven days)
//data4 in months (every month) 6 months back


//hours

$findH=strtotime("-1 day");
$foundH = date("Y-m-d", $findH) . "T" . date("h:i:s", $findH);
//echo $foundH;

$urlh = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_ETH_USD/history?period_id=4HRS&time_start=$foundH&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urlh;

$gh = file_get_contents($urlh);
$h = json_decode($gh, TRUE);

$h1Open = $h['3']['price_open'];//-24h
$h1High = $h['3']['price_high'];
$h1Low = $h['3']['price_low'];
$h1Close = $h['3']['price_close'];

$h2Open = $h['4']['price_open'];//-20h
$h2High = $h['4']['price_high'];
$h2Low = $h['4']['price_low'];
$h2Close = $h['4']['price_close'];

$h3Open = $h['5']['price_open'];//-16h
$h3High = $h['5']['price_high'];
$h3Low = $h['5']['price_low'];
$h3Close = $h['5']['price_close'];

$h4Open = $h['6']['price_open'];//-12h
$h4High = $h['6']['price_high'];
$h4Low = $h['6']['price_low'];
$h4Close = $h['6']['price_close'];

$h5Open = $h['7']['price_open'];//-8h
$h5High = $h['7']['price_high'];
$h5Low = $h['7']['price_low'];
$h5Close = $h['7']['price_close'];

$h6Open = $h['8']['price_open'];//-4h
$h6High = $h['8']['price_high'];
$h6Low = $h['8']['price_low'];
$h6Close = $h['8']['price_close'];

//days

$findD=strtotime("-7 day");
$foundD = date("Y-m-d", $findD) . "T" . date("h:i:s", $findD);
//echo $foundD;

$urld = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_ETHSD/history?period_id=1DAY&time_start=$foundD&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urld;

$gd = file_get_contents($urld);
$d = json_decode($gd, TRUE);

$d1Open = $d['0']['price_open'];//day 1
$d1High = $d['0']['price_high'];
$d1Low = $d['0']['price_low'];
$d1Close = $d['0']['price_close'];

$d2Open = $d['1']['price_open'];//day 2
$d2High = $d['1']['price_high'];
$d2Low = $d['1']['price_low'];
$d2Close = $d['1']['price_close'];

$d3Open = $d['2']['price_open'];//day 3
$d3High = $d['2']['price_high'];
$d3Low = $d['2']['price_low'];
$d3Close = $d['2']['price_close'];

$d4Open = $d['3']['price_open'];//day 4
$d4High = $d['3']['price_high'];
$d4Low = $d['3']['price_low'];
$d4Close = $d['3']['price_close'];

$d5Open = $d['4']['price_open'];//day 5
$d5High = $d['4']['price_high'];
$d5Low = $d['4']['price_low'];
$d5Close = $d['4']['price_close'];

$d6Open = $d['5']['price_open'];//day 6
$d6High = $d['5']['price_high'];
$d6Low = $d['5']['price_low'];
$d6Close = $d['5']['price_close'];

$d7Open = $d['6']['price_open'];//day 7
$d7High = $d['6']['price_high'];
$d7Low = $d['6']['price_low'];
$d7Close = $d['6']['price_close'];



//weeks

$findW=strtotime("-4 week");
$foundW = date("Y-m-d", $findW) . "T" . date("h:i:s", $findW);
//echo $foundW;

$urlw = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_ETH_USD/history?period_id=7DAY&time_start=$foundW&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urlw;

$gw = file_get_contents($urlw);
$w = json_decode($gw, TRUE);

$w1Open = $w['1']['price_open'];//-4 week
$w1High = $w['1']['price_high'];
$w1Low = $w['1']['price_low'];
$w1Close = $w['1']['price_close'];

$w2Open = $w['2']['price_open'];//-3 week
$w2High = $w['2']['price_high'];
$w2Low = $w['2']['price_low'];
$w2Close = $w['2']['price_close'];

$w3Open = $w['3']['price_open'];//-2 week
$w3High = $w['3']['price_high'];
$w3Low = $w['3']['price_low'];
$w3Close = $w['3']['price_close'];

$w4Open = $w['4']['price_open'];//-1 week
$w4High = $w['4']['price_high'];
$w4Low = $w['4']['price_low'];
$w4Close = $w['4']['price_close'];


//months

$findM=strtotime("-6 month");
$foundM = date("Y-m-d", $findM) . "T" . date("h:i:s", $findM);
//echo $foundM;

$urlm = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_ETHUSD/history?period_id=1MTH&time_start=$foundM&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urlm;

$gm = file_get_contents($urlm);
$m = json_decode($gm, TRUE);

$m1Open = $m['0']['price_open'];//-6 month
$m1High = $m['0']['price_high'];
$m1Low = $m['0']['price_low'];
$m1Close = $m['0']['price_close'];

$m2Open = $m['1']['price_open'];//-5 month
$m2High = $m['1']['price_high'];
$m2Low = $m['1']['price_low'];
$m2Close = $m['1']['price_close'];

$m3Open = $m['2']['price_open'];//-4 month
$m3High = $m['2']['price_high'];
$m3Low = $m['2']['price_low'];
$m3Close = $m['2']['price_close'];

$m4Open = $m['3']['price_open'];//-3 month
$m4High = $m['3']['price_high'];
$m4Low = $m['3']['price_low'];
$m4Close = $m['3']['price_close'];

$m5Open = $m['4']['price_open'];//-2 month
$m5High = $m['4']['price_high'];
$m5Low = $m['4']['price_low'];
$m5Close = $m['4']['price_close'];

$m6Open = $m['5']['price_open'];//-1 month
$m6High = $m['5']['price_high'];
$m6Low = $m['5']['price_low'];
$m6Close = $m['5']['price_close'];
*/
 ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    
  google.charts.load('current', {packages:['corechart']});
  google.charts.setOnLoadCallback(drawExample2);

  function drawExample2() {
    // Some raw data (not necessarily accurate)
 
   var rowData1 = [
      ['Mon', 20, 28, 38, 45],
      ['Tue', 31, 38, 55, 66],
      ['Wed', 50, 55, 77, 80],
      ['Thu', 77, 77, 66, 50],
      ['Fri', 68, 66, 22, 15]
    ];
    var rowData2 = [
      ['Mon', 20, 28, 38, 45],
      ['Tue', 31, 38, 55, 66],
      ['Wed', 50, 55, 77, 80],
      ['Thu', 77, 77, 66, 50],
      ['Fri', 68, 66, 22, 15]
    ];
    var rowData3 = [
      ['Mon', 20, 28, 38, 45],
      ['Tue', 31, 38, 55, 66],
      ['Wed', 50, 55, 77, 80],
      ['Thu', 77, 77, 66, 50],
      ['Fri', 68, 66, 22, 15]
    ];
    var rowData4 = [
      ['Mon', 20, 28, 38, 45],
      ['Tue', 31, 38, 55, 66],
      ['Wed', 50, 55, 77, 80],
      ['Thu', 77, 77, 66, 50],
      ['Fri', 68, 66, 22, 15]
    ];

    // Create and populate the data tables.
    var data = [];
    data[0] = google.visualization.arrayToDataTable(rowData1, true);
    data[1] = google.visualization.arrayToDataTable(rowData2, true);
    data[2] = google.visualization.arrayToDataTable(rowData3, true);
    data[3] = google.visualization.arrayToDataTable(rowData4, true);

    var options = {
      legend : 'none'
    };
    var current = 0;
    // Create and draw the visualization.
    var chart = new google.visualization.CandlestickChart(document.getElementById('example2-visualization'));
    //var button = document.getElementById('example2-b1');
          function drawChart() {
       // Disabling the button while the chart is drawing.
      //button.disabled = true;
      google.visualization.events.addListener(chart, 'ready',
          function() {
            //button.disabled = false;
            //button.value = 'Switch to ' + (current ? 'Hours' : 'Days');
          });
      chart.draw(data[current], options);
      }
    drawChart();
/*
    button.onclick = function() {
      current = this.val();
      drawChart();
    }
    */
    $("button").click(function() {
    current = $(this).val();
    drawChart();
});
  }

    </script>   

</head>

<!-- Start of navigation bar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid justify-content-between">
    
    <div class="d-flex">

 <?php
      if (isset($_REQUEST['id'])) {
        echo "<a class=\"navbar-brand me-2 mb-1 d-flex align-items-center\" href=\"index.php?id=" . $_REQUEST['id'] . "\">";
        echo "<img src=\"extra/jet.ico\" height=\"20\" alt=\"\" style=\"margin-top: 2px;\"/>";
        echo "</a>";
        }
        else{
        echo "<a class=\"navbar-brand me-2 mb-1 d-flex align-items-center\" href=\"index.php\">";
        echo "<img src=\"extra/jet.ico\" height=\"20\" alt=\"\" style=\"margin-top: 2px;\"/>";
        echo "</a>";
        }
?>


      	<form class="input-group w-auto my-auto d-none d-sm-flex">
        	<input autocomplete="on" type="search" name="txtSearch" class="form-control rounded" placeholder="Search" style="min-width: 125px;" />
          <input type="submit" name="custName" value="Go">
      	</form>
	      
<!-- cryptocurrency table has been created, but not implemented yet, need to add values -->
<!-- search should work, but not tested fully -->    
<?php

if (isset($_REQUEST['custName'])){
    
    require_once("config.php");
    
    $search = $_REQUEST['txtSearch'];
    
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("ERROR: unable to connect to database!");

    $query = "SELECT cryptoId, coinName FROM cryptocurrency
            WHERE coinName LIKE '%$search%' 
            ORDER BY coinName ASC";
    
    $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");

        
        echo "<ol>";
        
        while ($row = mysqli_fetch_array($result)) {
            echo "<li>";
            echo "<a href=\"results.php?num=" . $row['cryptoId'] . "\">" . $row['coinName'] ." </a>";
            echo "</li>";
        }
        echo "</ol>";
    mysqli_close($conn);

}

        
?> 
	      
	</div>


  <ul class="navbar-nav flex-row d-none d-md-flex">

  <?php
          if (isset($_REQUEST['id'])) {

          require_once("config.php");

          $id = $_REQUEST['id'];
          $conn1 = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("ERROR: unable to connect to database!");
        
          $query1 ="SELECT fname FROM customer WHERE clientId = $id";
                
          $result1 = mysqli_query($conn1, $query1) or die("ERROR: User Name not found");

          $row = mysqli_fetch_array($result1);        

          $user = $row['fname'];


        echo "<li class=\"nav-item me-3 me-lg-1 active\">";
        echo "<a class=\"nav-link\" href=\"index.php?id=" . $_REQUEST['id'] . "\">";
        echo "<span><i class=\"fas fa-home fa-lg\"></i></span>";
        echo "<span class=\"badge rounded-pill badge-notification bg-danger\"></span>";
        echo "</a>";
        echo "</li>";

        echo "<li class=\"nav-item me-3 me-lg-1\">";
        echo "<a class=\"nav-link\" href=\"wallet.php?id=" . $_REQUEST['id'] . "\">";
        echo "<span><i class=\"fas fa-wallet fa-lg\"></i></span>";
        echo "</a>";
        echo "</li>";


        echo "<li class=\"nav-item me-3 me-lg-1\">";
        echo "<a class=\"nav-link\" href=\"active.php?id=" . $_REQUEST['id'] . "\">";
        echo "<span><i class=\"fas fa-shopping-cart fa-lg\"></i></span>";
        echo "</a>";
        echo "</li>";


        echo "<li class=\"nav-item me-3 me-lg-1\">";
        echo "<a class=\"nav-link\" href=\"trade-eth.php?id=" . $_REQUEST['id'] . "\">";
        echo "<span><img src=\"extra/monero.svg\" height=\"20\" alt=\"\" style=\"margin-top: 2px;\"/></span>";
        echo "</a>";
        echo "</li>";
        echo "</ul>";

    
    echo"<ul class=\"navbar-nav flex-row\">";

        

        echo "<div class=\"dropdown\">";
        echo "<button class=\"dropbtn\" font-size=\"160px\">";
        echo "<li class=\"nav-item me-3 me-lg-1\">";
        echo "<a class=\"nav-link d-sm-flex align-items-sm-center\" href=\"#\">";
        echo "<img src=\"extra/user-icon.jpg\" class=\"rounded-circle\" height=\"22\" alt=\"\" loading=\"lazy\" />";
        echo "<strong class=\"d-none d-sm-block ms-1\">$user</strong>"; 
        echo "</button>";
        echo "</a>";
        echo "</li>";
        echo "<div class=\"dropdown-content\">";
        echo "<a href=\"admin.php?id=" . $_REQUEST['id'] . "\">Details</a>";
        echo "<a href=\"index.php\">Sign out</a>";
        echo "</div>";
        echo "</div>";
          
        echo "<style> .dropbtn
                      {
                        width: 120px;
                        border: none;
                        background: #f8f9fa;
                        outline: none;}
                      .dropdown 
                      {
                      position: relative;
                      display: inline-block;
                    }
                    .dropdown-content {
                      display: none;
                      position: absolute;
                      background-color: #f1f1f1;
                      min-width: 160px;
                      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                      z-index: 1;
                    }
                    .dropdown-content a {
                      color: black;
                      padding: 12px 16px;
                      text-decoration: none;
                      display: block;
                    }
                    .dropdown-content a:hover {background-color: #17a2b8;}

                    .dropdown:hover .dropdown-content {display: block;}

                    .dropdown:hover .dropbtn {background-color: #17a2b8;}
            </style>";

          
          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"conver.php" . $_REQUEST['id'] . "\">";
          echo "<span><i class=\"fas fa-comments fa-lg\"></i></span>";
          $comm = 3;//$_REQUEST['comments'];
          echo "<span class=\"badge rounded-pill badge-notification bg-danger\">$comm</span>";
          echo "</a>";
          echo "</li>";

          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo " <a class=\"nav-link\" href=\"notify.php" . $_REQUEST['id'] . "\">";
          echo "<span><i class=\"fas fa-bell fa-lg\"></i></span>";
          $bell = 5;//$_REQUEST['bell'];
          echo "<span class=\"badge rounded-pill badge-notification bg-danger\">$bell</span>";
          echo "</a>";
          echo "</li>";

          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"assist.php" . $_REQUEST['id'] . "\">";
          echo "<span><i class=\"fas fa-headset\"></i></span>";
          echo "<span class=\"badge rounded-pill badge-notification bg-danger\"></span>";
          echo "</a>";
          echo "</li>";

          	// close the connection to database
        	mysqli_close($conn1);
          }
          else{

          echo "<li class=\"nav-item me-3 me-lg-1 active\">";
          echo "<a class=\"nav-link\" href=\"index.php\">";
          echo "<span><i class=\"fas fa-home fa-lg\"></i></span>";
          echo "<span class=\"badge rounded-pill badge-notification bg-danger\"></span>";
          echo "</a>";
          echo "</li>";

          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"wallet.php\">";
          echo "<span><i class=\"fas fa-wallet fa-lg\"></i></span>";
          echo "</a>";
          echo "</li>";


          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"active.php\">";
          echo "<span><i class=\"fas fa-shopping-cart fa-lg\"></i></span>";
          echo "</a>";
          echo "</li>";


          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"trade-eth.php\">";
          echo "<span><img src=\"extra/monero.svg\" height=\"20\" alt=\"\" style=\"margin-top: 2px;\"/></span>";
          echo "</a>";
          echo "</li>";
          echo "</ul>";

echo"<ul class=\"navbar-nav flex-row\">";

          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link d-sm-flex align-items-sm-center\" href=\"login.php\">";
          echo "<img src=\"extra/user-icon.jpg\" class=\"rounded-circle\" height=\"22\" alt=\"\" loading=\"lazy\" />";
          echo "<strong class=\"d-none d-sm-block ms-1\"></strong>";
          echo "</a>";
          echo "</li>";

          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"conver.php\">";
          echo "<span><i class=\"fas fa-comments fa-lg\"></i></span>";
          echo "<span class=\"badge rounded-pill badge-notification bg-danger\"></span>";
          echo "</a>";
          echo "</li>";

          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"notify.php\">";
          echo "<span><i class=\"fas fa-bell fa-lg\"></i></span>";
          echo "<span class=\"badge rounded-pill badge-notification bg-danger\"></span>";
          echo "</a>";
          echo "</li>";

          echo "<li class=\"nav-item me-3 me-lg-1\">";
          echo "<a class=\"nav-link\" href=\"assist.php\">";
          echo "<span><i class=\"fas fa-headset\"></i></span>";
          echo "<span class=\"badge rounded-pill badge-notification bg-danger\"></span>";
          echo "</a>";
          echo "</li>";
          
          }
        ?>          
<!-- end login button -->
      	
    </ul>
	</div>
</nav>
<!-- end of navigation bar-->


<div class="header">
  <h1>CryptoJet</h1>
</div>

<style>
  .header {
  padding: 60px;
  text-align: center;
  background: #50c6d8;
  color: white;

}
</style>


<!-- This is where the main starts -->
<main style="padding : 10vh 0 10vh;">
<style>

.links li a{
  display: block;
  color: #666;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.links li a:hover:not(.active){
  background-color: #ddd;
}

.links li a.active{
  color: white;
  background-color: #04AA6D;
}
</style>

<?php
if (isset($_REQUEST['id'])) {
echo "<ul class=\"links\" style=\"list-style-type: none;
  margin-right: 1380px;
  margin-left: 100px;
  padding: 10px;
  overflow: hidden;
  border: 1px solid #e7e7e7;
  background-color: #f3f3f3;\">";
echo "<li style=\"float: left;\"><a href=\"trade-btc.php?id=" . $_REQUEST['id'] . "\">BTC</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-ltc.php?id=". $_REQUEST['id'] . "\">LTC</a></li>";
echo "<li style=\"float: left;\"><a class=\"active\" href=\"trade-eth.php?id=". $_REQUEST['id'] . "\">ETH</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-xrp.php?id=". $_REQUEST['id'] . "\">XRP</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-usdc.php?id=". $_REQUEST['id'] . "\">USDC</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-xmr.php?id=". $_REQUEST['id'] . "\">XMR</a></li>";
echo "</ul>";
}
else{
echo "<ul class=\"links\" style=\"list-style-type: none;
  margin-right: 1380px;
  margin-left: 100px;
  padding: 10px;
  overflow: hidden;
  border: 1px solid #e7e7e7;
  background-color: #f3f3f3;\">";
echo "<li style=\"float: left;\"><a href=\"trade-btc.php\">BTC</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-ltc.php\">LTC</a></li>";
echo "<li style=\"float: left;\"><a class=\"active\" href=\"trade-eth.php\">ETH</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-xrp.php\">XRP</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-usdc.php\">USDC</a></li>";
echo "<li style=\"float: left;\"><a href=\"trade-xmr.php\">XMR</a></li>";
echo "</ul>";


}

 ?>
 <div class="h">
  <h1>Ethereum</h1>
</div>

<style>
  .h {
  margin-right: 100px;
  margin-left: 100px;
  padding: 10px;
  border: 1px solid #e7e7e7;
  background-color: #f3f3f3;
  text-align: left;
  color: black;

}
</style>

<div id="check" style="display: block;
  margin-left: 750px;
  margin-right: 200px;
  margin-top: 100px;">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<button id="example2-b1" value="0">DAY</button>
<button id="example2-b1" value="1">WEEK</button>
<button id="example2-b1" value="2">MONTH</button>
<button id="example2-b1" value="3">YEAR</button>
</div>
<!-- plase of graph -->
<div id="example2-visualization" style="width: 900px; height: 500px; display: block;
  margin-left: auto;
  margin-right: auto;
  margin-top: 50px;"></div>

<div class="card text-center" style="margin-right: 300px;
  margin-left: 300px;
  margin-top: 150px;
  padding: 10px;">
  <div class="card-header" style="
  padding: 10px;">
  </div>
  <div class="card-body" style="margin-right: 300px;
  margin-left: 300px;
  padding: 10px;">
    <h2 class="card-title">How much Ethereum do you want to Buy or Sell ?</h2>

<?php  

if(isset($_REQUEST['id'])){

    echo "<form action=\"trade-eth.php\" method=\"POST\">
      
    <input type=\"number\" id=\"amount\" name=\"amount\" min=\"0\" style = \"font-size:40px; height: 90px;\" required><br>

    <input type=\"hidden\" id=\"custId\" name=\"custId\" value=\"" . $_REQUEST['id'] . "\">

    <br><input type=\"submit\" name=\"submit\" value=\"   BUY   \" style = \"font-size:20px; background-color: #467fd0; color: white; border-radius: 8px;\">

    <input type=\"submit\" name=\"submit1\" value=\"   SELL   \" style = \"font-size:20px; margin-left:50px; background-color: #467fd0; color: white; border-radius: 8px;\">

    </form>";

}else {
    echo "<form>
      
    <input type=\"number\" id=\"code\" name=\"code\" min=\"0\" style = \"font-size:40px; height: 90px;\"><br>


    <br><a href=\"wallet.php\" style = \"background-color: #467fd0; font-size:20px;\"class=\"btn btn-primary\">  BUY  </a>

    <a href=\"wallet.php\" style = \"background-color: #467fd0; font-size:20px; margin-left:50px;\"class=\"btn btn-primary\">  SELL  </a>

    </form>";

}


?>    

</style>
  </div>
  <div class="card-footer text-muted" style="
  padding: 10px;">
  </div>
</div>

<div class="row" style="
  padding: 20px; padding-top: 40px;">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Stop-limit order: Buy limit</h5>
        <?php  
if(isset($_REQUEST['id'])){
    echo "<form action=\"trade-eth.php\" method=\"POST\"> 
    <label for=\"stop\">Stop Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"stop\" name=\"stop\" min=\"0\" title=\"A stop price refers to the condition of the specified target price for the trade\"style = \"font-size:20px; height: 30px;\" required><br>
    
    <label for=\"limit\">Limit Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"limit\" name=\"limit\" min=\"0\" title=\"A limit price refers to the instruction for a trader to exit their position\"style = \"font-size:20px; height: 30px;\" required><br>
    <input type=\"hidden\" id=\"custId\" name=\"custId\" value=\"" . $_REQUEST['id'] . "\">
    <br><input type=\"submit\" name=\"holdBuy\" value=\"   BUY   \" style = \"font-size:20px; background-color: #467fd0; color: white; border-radius: 8px;\">
    </form>";

}else {
    echo "<form>   
    <label for=\"stop\">Stop Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"stop\" name=\"stop\" min=\"0\" title=\"A stop price refers to the condition of the specified target price for the trade\"style = \"font-size:20px; height: 30px;\" required><br>
    
    <label for=\"limit\">Limit Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"limit\" name=\"limit\" min=\"0\" title=\"A limit price refers to the instruction for a trader to exit their position\"style = \"font-size:20px; height: 30px;\" required><br>
    <br><a href=\"active.php\" style = \"background-color: #467fd0; font-size:20px;\"class=\"btn btn-primary\">  BUY  </a>
    </form>";
}
?>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Stop-limit order: Sell limit</h5>
        <?php  
if(isset($_REQUEST['id'])){
    echo "<form action=\"trade-eth.php\" method=\"POST\">  
    <label for=\"stop\">Stop Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"stop\" name=\"stop\" min=\"0\" title=\"A stop price refers to the condition of the specified target price for the trade\"style = \"font-size:20px; height: 30px;\" required><br>
    
    <label for=\"limit\">Limit Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"limit\" name=\"limit\" min=\"0\" title=\"A limit price refers to the instruction for a trader to exit their position\"style = \"font-size:20px; height: 30px;\" required><br>
    <input type=\"hidden\" id=\"custId\" name=\"custId\" value=\"" . $_REQUEST['id'] . "\">
    <br><input type=\"submit\" name=\"holdSell\" value=\"   SELL   \" style = \"font-size:20px; background-color: #467fd0; color: white; border-radius: 8px;\">
    </form>";

}else {
    echo "<form>   
    <label for=\"stop\">Stop Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"stop\" name=\"stop\" min=\"0\" title=\"A stop price refers to the condition of the specified target price for the trade\"style = \"font-size:20px; height: 30px;\" required><br>
    
    <label for=\"limit\">Limit Price: </label> 
    <input type=\"number\" placeholder=\"$\"id=\"limit\" name=\"limit\" min=\"0\" title=\"A limit price refers to the instruction for a trader to exit their position\"style = \"font-size:20px; height: 30px;\" required><br>
    <br><a href=\"active.php\" style = \"background-color: #467fd0; font-size:20px;\"class=\"btn btn-primary\">  SELL  </a>
    </form>";
}
?>
      </div>
    </div>
  </div>
</div>


</main>
<!-- This is where the  main ends -->
<!-- deal with instant buy or sell -->
        <?php
        // basic start
        require_once("config.php");

        $conn2 = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("ERROR: unable to connect to database!");

        $x1 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USD/ETH?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
        $r1 = json_decode($x1, TRUE);

        $date = date("Y-m-d") . "T" . date("h:i:s");// date of transaction
        // end of start
        
        $query0 = "SELECT COUNT(*) FROM transaction";
        $result0 = mysqli_query($conn2, $query0) or die("ERROR: unable to Get total transaction query!");
        $row0 = mysqli_fetch_array($result0);
        
        $count = $row0[0] + 1;//next transID
        $cryptoId = 3;//eth

        if (isset($_REQUEST['submit'])) {
        $id = $_REQUEST['custId'];
        $query4 = "SELECT balance FROM wallet 
                  WHERE userId = $id AND cryptoId = 3";

        $result4 = mysqli_query($conn2, $query4) or die("ERROR: unable to check balance!");
        $row4 = mysqli_fetch_array($result4);        
        $current = $row4['balance'];

        $amount = $_REQUEST['amount'];
        $balance = $current + ($amount * $r1['rate']);
        $des = "BUY";
        

        // update wallet start
        $query2 = "UPDATE wallet SET balance = '$balance'
                      WHERE userId = $id AND cryptoId = 3";

        $result2 = mysqli_query($conn2, $query2) or die("ERROR: unable to Update balance!");
        // update wallet end


        $query3 = "INSERT INTO transaction(transId, cryptoId, tranHist, limitP,userId, balance, descrip, stat)
                   VALUE('$count', '$cryptoId', '$date', '$amount', '$id', '$balance', '$des', '1')";
      

        $result3 = mysqli_query($conn2, $query3) or die("ERROR: unable to add transaction (buy)!");
      

        // create long report
        $filename = "reports/user" . $_REQUEST['custId'] .".txt";

        $text = "An immediate-Or-Cancel buy transaction for ETH was completed on the $date . \n";

        $file = fopen($filename, "a") or die("ERROR: cannot open file!");

        fwrite($file,$text);

        fclose($file);
        //close the report

        echo "<script> window.location.href =\"wallet.php?id=" . $_REQUEST['custId'] . "\"</script>";



        }else if(isset($_REQUEST['submit1'])){


          $amount = $_REQUEST['amount'];
          $id = $_REQUEST['custId'];
          $des = "SELL";

          $balance = $amount * $r1['rate'];


          $query4 = "SELECT balance FROM wallet 
                      WHERE userId = $id AND cryptoId = 3";
          $result4 = mysqli_query($conn2, $query4) or die("ERROR: unable to check balance!");
          $row4 = mysqli_fetch_array($result4);        

          $current = $row4['balance'];

          if($current < $balance ){
            echo "<script>alert('transaction isnt possible with your balance!');</script>";
                        // create long report
          $filename = "reports/user" . $_REQUEST['custId'] .".txt";

          $text = "An immediate-Or-Cancel sell transaction for ETH was cancelled on the $date . \n";

          $file = fopen($filename, "a") or die("ERROR: cannot open file!");

          fwrite($file,$text);

          fclose($file);
          //close the report
            echo "<script> window.location.href =\"trade-eth.php?id=" . $_REQUEST['custId'] . "\"</script>";

          }else{

            $new = $current - $balance;

            $query5 = "UPDATE wallet SET balance = '$new'
                        WHERE userId = $id AND cryptoId = 3";

            $result5 = mysqli_query($conn2, $query5) or die("ERROR: unable to Update balance!");

            $query6 = "INSERT INTO transaction(transId, cryptoId, tranHist, limitP,userId, balance, descrip, stat)
                   VALUE('$count', '$cryptoId', '$date', '$amount', '$id', '$new', '$des', '1')";
      
          $result6 = mysqli_query($conn2, $query6) or die("ERROR: unable to add transaction (sell)!");

            // create long report
          $filename = "reports/user" . $_REQUEST['custId'] .".txt";

          $text = "An immediate-Or-Cancel sell transaction for ETH was completed on the $date . \n";

          $file = fopen($filename, "a") or die("ERROR: cannot open file!");

          fwrite($file,$text);

          fclose($file);
          //close the report

            
            echo "<script> window.location.href =\"wallet.php?id=" . $_REQUEST['custId'] . "\"</script>";

          }//else


        }//else if

        // close the connection to database
        mysqli_close($conn2);
        ?>

<!-- deal with stop order buy and sell -->
        <?php

        require_once("config.php");

        $x2 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/ETH/USD?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
        $r2 = json_decode($x2, TRUE);

        $conn3 = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("ERROR: unable to connect to database!");
        
        $query7 = "SELECT COUNT(*) FROM transaction";
        $result7 = mysqli_query($conn3, $query7) or die("ERROR: unable to Get total transaction query!");
        $row7 = mysqli_fetch_array($result7);
        $count = $row7[0] + 1;
        $cryptoId = 3;//eth
        $date = date("Y-m-d") . "T" . date("h:i:s");// date of transaction

        if (isset($_REQUEST['holdBuy'])) {
        // add the database credentials

        // totprice get checked against going price
        $totprice = $_REQUEST['stop'];
        $amount = $_REQUEST['limit'];
        $id = $_REQUEST['custId'];
        $des = "BUY_ORDER";

        //insert into transaction table, and then display on active.php
        // when totprice hits, make transaction happen, and change wallet
        $query8 = "INSERT INTO  transaction(transId, cryptoId, tranHist, stopL, limitP, userId, descrip, stat)
                VALUE('$count', '$cryptoId', '$date', '$totprice', '$amount', '$id', '$des', '0')";
        
        $result8 = mysqli_query($conn3, $query8) or die("ERROR: unable to add transaction (buy order)!");

            // create long report
          $filename = "reports/user" . $_REQUEST['custId'] .".txt";

          $text = "A Stop-limit order [BUY] for ETH was created on the $date . \n";

          $file = fopen($filename, "a") or die("ERROR: cannot open file!");

          fwrite($file,$text);

          fclose($file);
          //close the report

        echo "<script> window.location.href =\"active.php?id=" . $_REQUEST['custId'] . "\"</script>";

        

        }else if(isset($_REQUEST['holdSell'])){


        // totprice get checked against going price
        $totprice = $_REQUEST['stop'];
        $amount = $_REQUEST['limit'];
        $id = $_REQUEST['custId'];
        $des = "SELL_ORDER";

        //insert into transaction table, and then display on active.php
        // when totprice hits, make transaction happen, and change wallet
        $query9 = "INSERT INTO  transaction(transId, cryptoId, tranHist, stopL, limitP, userId, descrip, stat)
                    VALUE('$count', '$cryptoId', '$date', '$totprice', '$amount' ,'$id', '$des', '0')";
      

        $result9 = mysqli_query($conn3, $query9) or die("ERROR: unable to add transaction!");

        // create long report
          $filename = "reports/user" . $_REQUEST['custId'] .".txt";

          $text = "A Stop-limit order [SELL] for ETH was created on the $date . \n";

          $file = fopen($filename, "a") or die("ERROR: cannot open file!");

          fwrite($file,$text);

          fclose($file);
          //close the report

        echo "<script> window.location.href =\"active.php?id=" . $_REQUEST['custId'] . "\"</script>";


        }// else if

        mysqli_close($conn3);
        ?>
<!-- This is where the footer starts -->
<div class="footer-dark">
	<footer>
    <div class="container">
    	<div class="row">
            <div class="col-sm-6 col-md-3 item">
            <h3>Company</h3>
            <ul>
            <li><a href="#">Blog</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Investors</a></li>
            <li><a href="files/legal.txt">Legal & Privacy</a></li>
            <li><a href="files/t&c.txt">Terms & Conditions</a></li>
            <li><a href="#">Cookie policy</a></li>
            </ul>
            </div>

            <div class="col-sm-6 col-md-3 item">
            <h3>About</h3>
            <ul>
            <li><a href="#">Company</a></li>
            <li><a href="#">Team</a></li>
            <li><a href="#">Careers</a></li>
            </ul>
            </div>
                    
            <div class="col-md-6 text">
            <h3>CryptoJet</h3>
            <p>say something about the company</p>
            </div>
                    
            <div class="col social">
            <a href="https://www.facebook.com/groups/discover/"><i class="icon ion-social-facebook"></i></a>
            <a href="https://twitter.com/?lang=en"><i class="icon ion-social-twitter"></i></a>
            <a href="https://www.snapchat.com/"><i class="icon ion-social-snapchat"></i></a>
            <a href="https://www.instagram.com/"><i class="icon ion-social-instagram"></i></a>
            <a href="https://za.linkedin.com/"><i class="icon ion-social-linkedin"></i></a>
            </div>
                	

        </div>
        <p class="copyright">CryptoJet © 2021</p>
    </div>
    </footer>
</div>
<!-- This is where the footer ends-->
</body>

</html>
