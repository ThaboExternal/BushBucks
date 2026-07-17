<!DOCTYPE html> 
<html> 
    <head> 
      
        <!-- CSS style to put div side by side -->
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
        </style> 
    </head> 
      
    <body>
    <?php
    require_once("config.php");
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("Sorry, could not conect");
    $query = "SELECT * from cryptocurrency ORDER BY coinName";
    $result=mysqli_query($conn, $query) or die("Error executing query");
    echo "<div class=\"column\">";
    echo "<div class=\"card\">";
    echo "<table>
    <tr bgcolor= \"#f69104\">
    <th> coinName </th>
    <th> coinPrice </th>
    </tr>";
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['coinName'] . "</td>";
        echo "<td>" . $row['coinPrice'] . "</td>";
    }
    echo "</table>";
       mysqli_close($conn);
echo "</div>";
echo "</div>";

?>
        
              
            <div class="column">
            <div class="card">
            <h2> Do you want to become a crypto professional?</h2>
<p> With Cryptojet, trading cryptocurrency <br>
becomes simple, easy and reliable <br>
<a href="https://www.cryptojet.com">Read more....</a>
            </div>
            </div>
              
            <div class="column">
            <div class="card">
            <h3> Let's get you started ... </h3>
<img src="images\bank card.jpg" alt="bank card" style="width:50px;height:50px;">
<p> Link your bank account <p>
<img src="images\cryptocurrencies.png" alt="bank card" style="width:50px;height:50px;">
<p> Start buying and selling <p>
<a href="login.php" target="_blank">Sign up</a>
            </div>
        </div>
      
     
    </body>
</html>  