<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="extra/jet.ico">
    <link rel="stylesheet" href="css/style2.css">
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

  </div>

<!-- Center elements -->
    <ul class="navbar-nav flex-row d-none d-md-flex">

      <?php
          if (isset($_REQUEST['id'])) {


          require_once("config.php");

          $id = $_REQUEST['id'];
          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("ERROR: unable to connect to database!");
        
          $query ="SELECT fname FROM customer WHERE clientId = $id";
                
          $result = mysqli_query($conn, $query) or die("ERROR: User Name not found");

          $row = mysqli_fetch_array($result);        


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
        

        $user = $row['fname'];
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

          
          // close the connection to database
          mysqli_close($conn);

          }
        ?>

  </div>
</nav>
<!-- end of navigation bar-->


<!-- This is where the design of the curve starts -->
<div class="svg-container">
  <svg viewbox="0 0 800 400" class="svg">
        <path id="curve" fill="#50c6d8" d="M 800 100 Q 400 250 0 100 L 0 0 L 800 0 L 800 300 Z">
        </path>
    </svg>
</div>
<!-- This is where the design of the curve ends -->


<!-- This is where the header starts -->
<header>
  <h1>CryptoJet</h1>
</header>
<!-- This is where the header ends -->


<!-- This is where the main starts -->
<main>
          <?php
            // check if the form has been submitted
            if (isset($_REQUEST['id'])) {
                // add the database credentials
                require_once("config.php");
                // get values from form
                $num = $_REQUEST['id'];
    
                $conn1 = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                    or die("ERROR: unable to connect to database!");
                // issue query instructions to insert customer details
                $query1 = "SELECT * FROM customer WHERE clientId = $num";
                
                $result1 = mysqli_query($conn1, $query1) or die("ERROR: unable to execute query!");
                // close the connection to database
                
                $query2 = "SELECT COUNT(*) FROM wallet WHERE userId = $num";
                $result2 = mysqli_query($conn1, $query2) or die("ERROR: unable to Get total Client query!");
                $row2 = mysqli_fetch_array($result2);
                $amountwal = $row2[0];

                echo "<h1><strong>" . "Account Details:" . "</strong></h1>";
                echo "<br>";
                echo "<table>";
                while ($row = mysqli_fetch_array($result1)) {
                        echo "<tr>";
                        $name = $row['fname'] . " " .$row['lname'];
                        echo "<td><h1 style=\"font-size:1.25em;\"><strong>" . $row['fname'] . " " .$row['lname']."</strong></h1></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Phone Number:</strong></td>";
                        echo "<td>" . $row['phoneNum'] . "<br></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Country:</strong></td>";
                        echo "<td>" . $row['country'] . "<br></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>eMail:</strong></td>";
                        echo "<td>" . $row['email'] . "<br></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Number of wallets:</strong></td>";
                        echo "<td>" . "#". $amountwal . "<br></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Preferred CryptoCurrency:</strong></td>";
                        echo "<td>" . $row['prefcoin'] . "<br></td>";
                        echo "</tr>";
                        
                        // sent to alter.php
                        echo "</tr>";
                        echo "<td><a href=\"alter.php?ua=" . $row['clientId'] . "\">Update Account</a></td>";
                        echo "<td><a href=\"alter.php?da=" . $row['clientId'] . "\" onClick=\"return confirm('Are you sure you want to delete your account : " . $name ." ') \">Delete Account</a></td>";
                        
                    }
                    echo "</table>";

                    // banking 
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        echo "<h1><strong>" . "Bank Details:" . "</strong></h1>";
                        echo "<br>";

                        echo "<table>";
                        echo "<tr>";
                        echo "<td><h1 style=\"font-size:1.25em;\"><strong>" . "Client details: " . "</strong></h1></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Account Holder:</strong></td>";
                        echo "<td>" . $name . "<br></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Account Type:</strong></td>";
                        echo "<td>" . "Savings" . "<br></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Account Number:</strong></td>";
                        echo "<td>" . rand(12,1000000000000) . "<br></td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td><strong>Bank Name:</strong></td>";
                        echo "<td>" . "New York Hedge Fund" . "<br></td>";
                        echo "</tr>";

                        // need to still create wallet.php file
                        echo "<td><a href=\"wallet.php?cx="  . $num . "\">Deposit Funds</a></td>";
                        
                        echo "</table>";

                echo "<style>
                table {
                    border-collapse: collapse;
                    width: 60%
                }
                th,
                td{
                    text-align: left;
                    padding: 20px;
                }
                tr:nth-child(even){
                    background-color: #f2f2f2;
                }
                </style>";
                

                mysqli_close($conn1);
                
                
            }
            ?>


</main>
<!-- This is where the  main ends -->

<!-- This is where the footer starts -->
<div class="footer-dark">
  <footer>
    <div class="container">
        <p class="copyright">CryptoJet © 2021</p>
    </div>
    </footer>
</div>
<!-- This is where the footer ends-->
</body>

</html>