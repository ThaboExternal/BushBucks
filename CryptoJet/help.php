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
        echo "<a class=\"nav-link\" href=\"trade.php?id=" . $_REQUEST['id'] . "\">";
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
          echo "<a class=\"nav-link\" href=\"trade.php\">";
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
  <p>Help</p>
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
    <p>Add some things (help page)</p>
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
