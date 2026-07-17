<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="extra/jet.ico">
    <link rel="stylesheet" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/8f7b167549.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <title>CryptoJet</title>
</head>

<!-- only global nav is included, as this is the login page -->

<!-- Add other type of navigation if deemed needed-->


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

<body>

<!-- This is where the  form part starts -->
<h2>Sign in to continue</h2>

<button onclick="document.getElementById('login').style.display='block'" style="width:auto;">Login</button>

<div id="login" class="background">
  
  <form class="background-content animate" action="login.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" id="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
        
      <button name="submit" type="submit">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="forget"><a href="forgot.php">Forgot password?</a></span>
      <span class="create"><a href="create.php">Create new account?</a></span>
    </div>
  </form>
</div>

<script>

// Get the hold
var hold = document.getElementById('login');

// When the user clicks anywhere outside of the hold, close it
window.onclick = function(event) {
    if (event.target == hold) {
        hold.style.display = "none";
    }
}
</script>
</main>
<!-- This is where the  main ends -->

<!-- This is username and password is checked against DB -->
<?php
      if (isset($_REQUEST['submit'])) {

          require_once("config.php");

          $suname = $_REQUEST['uname'];
          $spsw = $_REQUEST['psw'];


          $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                    or die("ERROR: unable to connect to database!");
                
          $query ="SELECT clientId FROM customer WHERE username = '$suname' AND pass = '$spsw'";
                
          $result = mysqli_query($conn, $query) or die("ERROR: User is not in the system! <a href=\"login.php\">Go Back To Login Page</a>");

          $row = mysqli_fetch_array($result);        

          $clientid = $row['clientId'];

          if (isset($clientid)){
              echo "<script> window.location.href =\"index.php?id=" . $clientid . "\"</script>";
          }
      
          // close the connection to database
          mysqli_close($conn);

      }

?>






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