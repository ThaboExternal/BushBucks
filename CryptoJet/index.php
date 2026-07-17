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
          <input type="submit" name="custName" style="margin-left: 10px;" value=" Go "><!-- fix this on all other scripts -->
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

<!-- check if user is logged in, and if yes add custom detail -->
<!-- else just do base version -->

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
<main style="padding : 10vh  0 10vh;">
    <style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Float four columns side by side */
.column {
  float: left;
  width: 30%;
  padding: 50px;
  margin: auto;
}

table, td, th {
  border: 1px solid black;
}

table {
  width: 100%;
  border-collapse: collapse;
}
/* Remove extra left and right margins, due to padding */
.row {margin: auto;
  padding: 40px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }
}

/* Style the counter cards */
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 60px;
  text-align: center;
  background-color: #f1f1f1;
}
</style>
    <?php
/*
$x1 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/BTC/USD?apikey=D4864B54-0B07-4EA1-AD3C-1745B9F23F59');
$d1 = json_decode($x1, TRUE);

$x2 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/LTC/USD?apikey=D4864B54-0B07-4EA1-AD3C-1745B9F23F59');
$d2 = json_decode($x2, TRUE);

$x3 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/ETH/USD?apikey=D4864B54-0B07-4EA1-AD3C-1745B9F23F59');
$d3 = json_decode($x3, TRUE);

$x4 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/XRP/USD?apikey=D4864B54-0B07-4EA1-AD3C-1745B9F23F59');
$d4 = json_decode($x4, TRUE);

$x5 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/USDC/USD?apikey=D4864B54-0B07-4EA1-AD3C-1745B9F23F59');
$d5 = json_decode($x5, TRUE);

$x6 = file_get_contents('https://rest.coinapi.io/v1/exchangerate/XMR/USD?apikey=D4864B54-0B07-4EA1-AD3C-1745B9F23F59');
$d6 = json_decode($x6, TRUE);
//for whole list check listAsset.txt (extra folder 11/09/2021 test)
$btc = $d1['rate'];//BTC
$ltc = $d2['rate'];//LTC
$eth = $d3['rate'];//ETH
$xrp = $d4['rate'];//XRP
$usdc = $d5['rate'];//USDC
$xmr =  $d6['rate'];//XMR
$findH=strtotime("-1 day");
$foundH = date("Y-m-d", $findH) . "T" . date("h:i:s", $findH);//echo $foundH;


//btc
$urlh = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_BTC_USD/history?period_id=4HRS&time_start=$foundH&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urlh;
$gh = file_get_contents($urlh);
$h = json_decode($gh, TRUE);
$h1Close = $h['3']['price_close']; //-24h
$h6Close = $h['8']['price_close']; //-4h
$changeb = (($h6Close - $h1Close)/$h1Close)*100;

//eth
$urlh = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_ETH_USD/history?period_id=4HRS&time_start=$foundH&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urlh;
$gh = file_get_contents($urlh);
$h = json_decode($gh, TRUE);
$h1Close = $h['3']['price_close'];
$h6Close = $h['8']['price_close'];
$changeh = (($h6Close - $h1Close)/$h1Close)*100;

//ltc
$urlh = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_LTC_USD/history?period_id=4HRS&time_start=$foundH&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urlh;
$gh = file_get_contents($urlh);
$h = json_decode($gh, TRUE);
$h1Close = $h['3']['price_close'];
$h6Close = $h['8']['price_close'];
$changel = (($h6Close - $h1Close)/$h1Close)*100;

//xrp
$urlh = "https://rest.coinapi.io/v1/ohlcv/BITSTAMP_SPOT_XRP_USD/history?period_id=4HRS&time_start=$foundH&apikey=8E08E111-7899-4FDF-B473-31F639928280";
//echo $urlh;
$gh = file_get_contents($urlh);
$h = json_decode($gh, TRUE);
$h1Close = $h['3']['price_close'];//old
$h6Close = $h['8']['price_close'];//newest
$changep = (($h6Close - $h1Close)/$h1Close)*100;
    
*/    
    
   
    
    

    require_once("config.php");
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("Sorry, could not conect");
    $linkaddress= "https://www.cryptojet.com";
    $email = "email@address.com";
    $bankcard= "CryptoJet\images\bankcard.jpg";
    $cryptocurrencies="CryptoJet\images\cryptocurrencies.png";

/*
    $queryb = "UPDATE cryptocurrency SET coinPrice = '$btc', rateCh = '$changeb'
                      WHERE cryptoId = 1";

    $queryl = "UPDATE cryptocurrency SET coinPrice = '$ltc', rateCh = '$changel'
                      WHERE cryptoId = 2";

    $queryh = "UPDATE cryptocurrency SET coinPrice = '$eth', rateCh = '$changeh'
                      WHERE cryptoId = 3";

    $queryp = "UPDATE cryptocurrency SET coinPrice = '$xrp', rateCh = '$changep'
                      WHERE cryptoId = 4";

    $queryc = "UPDATE cryptocurrency SET coinPrice = '$usdc'
                      WHERE cryptoId = 5";

    $queryr = "UPDATE cryptocurrency SET coinPrice = '$xmr'
                      WHERE cryptoId = 6";

    $resultb = mysqli_query($conn, $queryb) or die("ERROR: unable to Update records (crypto table bit)!");
    $resultl = mysqli_query($conn, $queryl) or die("ERROR: unable to Update records (crypto table lit)!");
    $resulth = mysqli_query($conn, $queryh) or die("ERROR: unable to Update records (crypto table eth)!");
    $resultp = mysqli_query($conn, $queryp) or die("ERROR: unable to Update records (crypto table rip)!");
    $resultc = mysqli_query($conn, $queryc) or die("ERROR: unable to Update records (crypto table usa)!");
    $resultr = mysqli_query($conn, $queryr) or die("ERROR: unable to Update records (crypto table mon)!");
*/


    $query = "SELECT * from cryptocurrency ORDER BY coinName";
    $result=mysqli_query($conn, $query) or die("Error executing query");

    echo "<table>
    <tr bgcolor= \"#00CDCD\"> 
    <th> # </th>
    <th> Name </th>
    <th> Price </th>
    <th> Change </th>
    </tr>";
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        if($row['cryptoId'] == 1){
          echo "<td>" . "1 " . "</td>";
          echo "<td>" . "Bitcoin    (BTC)" . "</td>";
        }elseif ($row['cryptoId'] == 2) {
          echo "<td>" . "4" . "</td>";
          echo "<td>" . "Litecoin     (LTC)" . "</td>";
        }elseif ($row['cryptoId'] == 3) {
          echo "<td>" . "2" . "</td>";
          echo "<td>" . "Ethereum   (ETH)" . "</td>";
        }elseif ($row['cryptoId'] == 4) {
          echo "<td>" . "5" . "</td>";
          echo "<td>" . "Ripple   (XRP)" . "</td>";
        }elseif ($row['cryptoId'] == 5) {
          echo "<td>" . "6" . "</td>";
          echo "<td>" . "USD Coin   (USDC)" . "</td>";
        }elseif ($row['cryptoId'] == 6) {
          echo "<td>" . "3" . "</td>";
          echo "<td>" . "Monero   (XMR)" . "</td>";
        }
        echo "<td>" . "$ " . $row['coinPrice'] . "</td>";
        if($row['rateCh'] >= 0){
          echo "<td>" . "+" . $row['rateCh'] . "%" . "</td>";
        }elseif ($row['rateCh'] < 0) {
          echo "<td>" .  $row['rateCh'] . "%" . "</td>";
        }
    }
    echo "</table>";

       mysqli_close($conn);




echo "<div class=\"row\">";
echo "<div class=\"column\">";
echo "<div class=\"card\">";
echo "<h2>Do you want to become a crypto professional?</h2>";
echo "<p> With Cryptojet, trading cryptocurrency becomes simple, easy and reliable <br> </p>";
echo "<a href=' ".$linkaddress." '>Read more....</a>";
echo "</div>";
echo "</div>";

echo "<div class=\"column\">";
echo "<div class=\"card\">";
echo "<h3>Let's get you started</h3>";
echo "<p> ... <p>";
echo "<img src=\"images/cards.png\" height=\"50\" width=\"50\"alt=\"\"  />";
echo "<p> Link your bank account <p>";
echo "<img src=\"images/cryptocurrencies.png\" height=\"50\" alt=\"\"  />";
echo "<p>  Start buying and selling <p>";
echo "</div>";
echo "</div>";

echo "<div class=\"column\">";
echo "<div class=\"card\">";
echo "<h3>Be the first to know about crypto news every day</h3>";
echo "<p>Get crypto analysis, news and updates right to your inbox! Sign up here so you don't miss a single newsletter!</p>";
echo "<form> 
<input type=”text” email=”” placeholder=' ".$email." '> </form> ";
echo "</div>";
echo "</div>";
echo "</div>";

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