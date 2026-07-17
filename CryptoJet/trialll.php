<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    //load google charts
    google.charts.load('current', {
        'packages':['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
//draw chart and set chart values
function drawChart () {
    <?php
    //establish connection
    require_once("config.php");
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("Could not connect to database!");
    $query = "SELECT coinName, coinPrice
        FROM cryptocurrency";       
        $result= mysqli_query($conn, $query) or die("Could not retrieve the data!");
   echo "var data = google.visualization.arrayToDataTable([";
   echo "['coinName', ' coinPrice'],";
    while ($row = mysqli_fetch_array($result)){
        // display content 
   echo "['".$row['coinName']."',". $row['coinPrice']."],";
    }
    echo "]);";
    //close connection
    mysqli_close($conn);
    ?>
     var options= {
    title :'Todays coin prices',
     hAxis: {
        title: 'coinName', 
 } ,
 //y-axis
    vAxis: {
        title: 'coinPrice'},
        colors: ['#AB0D06', '#007329']
    };
    var chart = new google.visualization.LineChart(document.getElementById("chart_div"));
//convert classic options to material options
 chart.draw(data, options);
}
</script>
</head>
<body>
<h3>Column Chart</h3>
 <div id="columnchart" style="width:100%; max-width:600px; height:500px;"></div> 
</body>
</html>
