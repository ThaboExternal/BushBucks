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
    <title>CryptoJet</title>
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
        
          $query1 ="SELECT fname, prefcoin FROM customer WHERE clientId = $id";
                
          $result1 = mysqli_query($conn1, $query1) or die("ERROR: User Name not found");

          $row = mysqli_fetch_array($result1);        

          $user = $row['fname'];
          $prefcoin = $row['prefcoin'];

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
        echo "<a class=\"nav-link\" href=\"trade-$prefcoin.php?id=" . $_REQUEST['id'] . "\">";
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
          echo "<a class=\"nav-link\" href=\"trade-btc.php\">";
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
  <p>Active Trades</p>
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
<main>
    <p>below is the code that sorts out the sell and buy limit. this stuff is long (about 300 lines)(will explain what it does later on, but now all the backend stuff is done. (all trades work)</p>
    <?php
    require_once("config.php");
    
    $conn2 = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("ERROR: unable to connect to database!");

    if(isset($_REQUEST['id'])){
      $id = $_REQUEST['id'];

$x1 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USD/BTC?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
$r1 = json_decode($x1, TRUE);
$x2 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USD/ETH?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
$r2 = json_decode($x2, TRUE);
$x3 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USD/LTC?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
$r3 = json_decode($x3, TRUE);
$x4 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USD/USDC?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
$r4 = json_decode($x4, TRUE);
$x5 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USD/XMR?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
$r5 = json_decode($x5, TRUE);
$x6 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USD/XRP?apikey=D97DE1CA-908D-4512-A65C-DF091720909B');
$r6 = json_decode($x6, TRUE);

      $query2 = "SELECT coinPrice, coinName FROM cryptocurrency";
      $result2 = mysqli_query($conn2, $query2) or die("ERROR: coin price not found");

      while ($row2 = mysqli_fetch_array($result2)){
        if($row2['coinName'] == "BTC"){
          $btc = $row2['coinPrice'];
        }else if($row2['coinName'] == "LTC"){
          $ltc = $row2['coinPrice'];
        }else if($row2['coinName'] == "ETH"){
          $eth = $row2['coinPrice'];
        }else if($row2['coinName'] == "XRP"){
          $xrp = $row2['coinPrice'];
        }else if($row2['coinName'] == "XMR"){
          $xmr = $row2['coinPrice'];
        }else if($row2['coinName'] == "USDC"){
          $usdc = $row2['coinPrice'];
        }
      }

// get awaiting transactions
      $query3 = "SELECT * FROM transaction WHERE descrip = 'BUY_ORDER' AND stat = '0'";
      $result3 = mysqli_query($conn2, $query3) or die("ERROR: transactions not found");
      $query10 = "SELECT * FROM transaction WHERE descrip = 'SELL_ORDER' AND stat = '0'";
      $result10 = mysqli_query($conn2, $query10) or die("ERROR: transactions not found");

//get balances
    $queryb = "SELECT balance FROM wallet WHERE userId = $id AND cryptoId = 1";
    $queryl = "SELECT balance FROM wallet WHERE userId = $id AND cryptoId = 2";
    $queryh = "SELECT balance FROM wallet WHERE userId = $id AND cryptoId = 3";
    $queryp = "SELECT balance FROM wallet WHERE userId = $id AND cryptoId = 4";
    $queryc = "SELECT balance FROM wallet WHERE userId = $id AND cryptoId = 5";
    $queryr = "SELECT balance FROM wallet WHERE userId = $id AND cryptoId = 6";

    $resultb = mysqli_query($conn2, $queryb) or die("ERROR: unable to check balance!");
    $resultl = mysqli_query($conn2, $queryl) or die("ERROR: unable to check balance!");
    $resulth = mysqli_query($conn2, $queryh) or die("ERROR: unable to check balance!");
    $resultp = mysqli_query($conn2, $queryp) or die("ERROR: unable to check balance!");
    $resultc = mysqli_query($conn2, $queryc) or die("ERROR: unable to check balance!");
    $resultr = mysqli_query($conn2, $queryr) or die("ERROR: unable to check balance!");    

    $rowb = mysqli_fetch_array($resultb);
    $rowl = mysqli_fetch_array($resultl);    
    $rowh = mysqli_fetch_array($resulth);
    $rowp = mysqli_fetch_array($resultp);
    $rowc = mysqli_fetch_array($resultc);
    $rowr = mysqli_fetch_array($resultr);

    $currentb = $rowb['balance'];
    $currentl = $rowl['balance'];
    $currenth = $rowh['balance'];
    $currentp = $rowp['balance'];
    $currentc = $rowc['balance'];
    $currentr = $rowr['balance'];




//handle a buy order      
      while ($row3 = mysqli_fetch_array($result3)){
        if($row3['cryptoId'] == 1 and $row3['stopL'] < $btc){
            $bal1 = ($row3['limitP'] * $r1['rate']);
            $balance1 = $currentb + $bal1;
            $hold1 = $row3['stopL'];
            $query4 = "UPDATE wallet SET balance = '$balance1'
                        WHERE userId = $id AND cryptoId = 1";
            $result4 = mysqli_query($conn2, $query4) or die("ERROR: couldnt update trans table");

            $queryf4 = "UPDATE transaction SET balance = '$bal1', stat = '1'
                        WHERE userId = $id AND cryptoId = 1 AND stopL = $hold1";
            $resultf4 = mysqli_query($conn2, $queryf4) or die("ERROR: couldnt update trans table");

        }else if($row3['cryptoId'] == 2 and $row3['stopL'] < $ltc){
            $bal2 = ($row3['limitP'] * $r3['rate']);
            $balance2 = $currentl + $bal2;
            $hold2 = $row3['stopL'];
            $query5 = "UPDATE wallet SET balance = '$balance2'
                        WHERE userId = $id AND cryptoId = 2";
            $result5 = mysqli_query($conn2, $query5) or die("ERROR: couldnt update trans table");

            $queryf5 = "UPDATE transaction SET balance = '$bal2', stat = '1'
                        WHERE userId = $id AND cryptoId = 2 AND stopL = $hold2";
            $resultf5 = mysqli_query($conn2, $queryf5) or die("ERROR: couldnt update trans table");

        }else if($row3['cryptoId'] == 3 and $row3['stopL'] < $eth){
            $bal3 = ($row3['limitP'] * $r2['rate']);
            $balance3 = $currenth + $bal3;
            $hold3 = $row3['stopL'];
            $query6 = "UPDATE wallet SET balance = '$balance3'
                        WHERE userId = $id AND cryptoId = 3";
            $result6 = mysqli_query($conn2, $query6) or die("ERROR: couldnt update trans table");

            $queryf6 = "UPDATE transaction SET balance = '$bal3', stat = '1'
                        WHERE userId = $id AND cryptoId = 3 AND stopL = $hold3";
            $resultf6 = mysqli_query($conn2, $queryf6) or die("ERROR: couldnt update trans table");

        }else if($row3['cryptoId'] == 4 and $row3['stopL'] < $xrp){
            $bal4 = ($row3['limitP'] * $r6['rate']);
            $balance4 = $currentp + $bal4;
            $hold4 = $row3['stopL'];
            $query7 = "UPDATE wallet SET balance = '$balance4'
                        WHERE userId = $id AND cryptoId = 4";
            $result7 = mysqli_query($conn2, $query7) or die("ERROR: couldnt update trans table");

            $queryf7 = "UPDATE transaction SET balance = '$bal4', stat = '1'
                        WHERE userId = $id AND cryptoId = 4 AND stopL = $hold4";
            $resultf7 = mysqli_query($conn2, $queryf7) or die("ERROR: couldnt update trans table");

        }else if($row3['cryptoId'] == 5 and $row3['stopL'] < $usdc){
            $bal5 = ($row3['limitP'] * $r4['rate']);
            $balance5 = $currentc + $bal5;
            $hold5 = $row3['stopL'];
            $query8 = "UPDATE wallet SET balance = '$balance5'
                        WHERE userId = $id AND cryptoId = 5";
            $result8 = mysqli_query($conn2, $query8) or die("ERROR: couldnt update trans table");

            $queryf8 = "UPDATE transaction SET balance = '$bal5', stat = '1'
                        WHERE userId = $id AND cryptoId = 5 AND stopL = $hold5";
            $resultf8 = mysqli_query($conn2, $queryf8) or die("ERROR: couldnt update trans table");

        }else if($row3['cryptoId'] == 6 and $row3['stopL'] < $xmr){
            $bal6 = ($row3['limitP'] * $r5['rate']);
            $balance6 = $currentr + $bal6;
            $hold6 = $row3['stopL'];
            $query9 = "UPDATE wallet SET balance = '$balance6'
                        WHERE userId = $id AND cryptoId = 6";
            $result9 = mysqli_query($conn2, $query9) or die("ERROR: couldnt update trans table");

            $queryf9 = "UPDATE transaction SET balance = '$bal6', stat = '1'
                        WHERE userId = $id AND cryptoId = 6 AND stopL = $hold6";
            $resultf9 = mysqli_query($conn2, $queryf9) or die("ERROR: couldnt update trans table");
        }
      }//while

//handle a sell order
      while ($row4 = mysqli_fetch_array($result10)){
        if($row4['cryptoId'] == 1 and $row4['stopL'] < $btc){
            if($currentb > ($row4['limitP'] * $r1['rate']) ){
                $n1 = ($row4['limitP'] * $r1['rate']);
                $new1 = $currentb - $n1;
                $hold7 = $row4['stopL'];
                $query04 = "UPDATE wallet SET balance = '$new1'
                        WHERE userId = $id AND cryptoId = 1";
                $result04 = mysqli_query($conn2, $query04) or die("ERROR: couldnt update trans table u1");

                $queryf04 = "UPDATE transaction SET balance = '$n1', stat = '1'
                        WHERE userId = $id AND cryptoId = 1 AND stopL = $hold7";
                $resultf04 = mysqli_query($conn2, $queryf04) or die("ERROR: couldnt update trans table 1");
            }
        }else if($row4['cryptoId'] == 2 and $row4['stopL'] < $ltc){
            if($currentl > ($row4['limitP'] * $r3['rate']) ){
                $n2 = ($row4['limitP'] * $r1['rate']);
                $new2 = $currentb - $n2;
                $hold8 = $row4['stopL'];
                $query05 = "UPDATE wallet SET balance = '$new2'
                        WHERE userId = $id AND cryptoId = 2";
                $result05 = mysqli_query($conn2, $query05) or die("ERROR: couldnt update trans table u2");

                $queryf05 = "UPDATE transaction SET balance = '$n2', stat = '1'
                        WHERE userId = $id AND cryptoId = 2 AND stopL = $hold8";
                $resultf05 = mysqli_query($conn2, $queryf05) or die("ERROR: couldnt update trans table 2");
            }
            

        }else if($row4['cryptoId'] == 3 and $row4['stopL'] < $eth){
            if($currenth > ($row4['limitP'] * $r2['rate']) ){
                $n3 = ($row4['limitP'] * $r1['rate']);
                $new3 = $currentb - $n3;
                $hold9 = $row4['stopL'];
                $query06 = "UPDATE wallet SET balance = '$new3'
                        WHERE userId = $id AND cryptoId = 3";
                $result06 = mysqli_query($conn2, $query06) or die("ERROR: couldnt update trans table u3");

                $queryf06 = "UPDATE transaction SET balance = '$n3', stat = '1'
                        WHERE userId = $id AND cryptoId = 3 AND stopL = $hold9";
                $resultf06 = mysqli_query($conn2, $queryf06) or die("ERROR: couldnt update trans table 3");
            }
            

        }else if($row4['cryptoId'] == 4 and $row4['stopL'] < $xrp){
            if($currentp > ($row4['limitP'] * $r6['rate']) ){
                $n4 = ($row4['limitP'] * $r1['rate']);
                $new4 = $currentb - $n4;
                $hold10 = $row4['stopL'];
                $query07 = "UPDATE wallet SET balance = '$new4'
                        WHERE userId = $id AND cryptoId = 4";
            $result07 = mysqli_query($conn2, $query07) or die("ERROR: couldnt update trans table u4");

            $queryf07 = "UPDATE transaction SET balance = '$n4', stat = '1'
                        WHERE userId = $id AND cryptoId = 4 AND stopL = $hold10";
            $resultf07 = mysqli_query($conn2, $queryf07) or die("ERROR: couldnt update trans table 4");
            }
            

        }else if($row4['cryptoId'] == 5 and $row4['stopL'] < $usdc){
            if($currentc > ($row4['limitP'] * $r4['rate']) ){
                $n5 = ($row4['limitP'] * $r1['rate']);
                $new5 = $currentb - $new5;
                $hold11 = $row4['stopL'];
                $query08 = "UPDATE wallet SET balance = '$new5'
                        WHERE userId = $id AND cryptoId = 5";
                $result08 = mysqli_query($conn2, $query08) or die("ERROR: couldnt update trans table u5");

                $queryf08 = "UPDATE transaction SET balance = '$n5', stat = '1'
                        WHERE userId = $id AND cryptoId = 5 AND stopL = $hold11";
                $resultf08 = mysqli_query($conn2, $queryf08) or die("ERROR: couldnt update trans table 5");
            }
            

        }else if($row4['cryptoId'] == 6 and $row4['stopL'] < $xmr){
            if($currentr > ($row4['limitP'] * $r5['rate']) ){
                $n6 = ($row4['limitP'] * $r1['rate']);
                $new6 = $currentb - $new6;
                $hold12 = $row4['stopL'];
                $query09 = "UPDATE wallet SET balance = '$new6'
                        WHERE userId = $id AND cryptoId = 6";
                $result09 = mysqli_query($conn2, $query09) or die("ERROR: couldnt update trans table u6");

                $queryf09 = "UPDATE transaction SET balance = '$n6', stat = '1'
                        WHERE userId = $id AND cryptoId = 6 AND stopL = $hold12";
                $resultf09 = mysqli_query($conn2, $queryf09) or die("ERROR: couldnt update trans table 6");
            }
            
        }
      }//while

    }//if



    ?>
</main>
<!-- This is where the  main ends -->

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
