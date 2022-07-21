<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'registered_user');
if ($conn->connect_error) {
	die('Connection failed : ' . $conn->connect_error);
} else {
	$username = $_SESSION['username'];
	$sql = "SELECT category,total FROM $username";
	$res = $conn->query($sql);
	// echo "Hello! " . $username . ", Your expenses distribution is here...";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Monitor</title>
    <link rel="stylesheet" href="./newdata.css">
    <!-- Material Ui -->
    <link href = "https://fonts.googleapis.com/icon?family=Material+Icons" rel = "stylesheet">
    <link rel="icon" type="image" href="./images/favicon.png">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            var data = google.visualization.arrayToDataTable([['category', 'total'],
                <?php
                while ($row = $res->fetch_assoc()) {
                    echo "['" . $row['category'] . "'," . $row['total'] . "],";
                    }
                ?>
                ]);
                var options = {
                //title: 'My Expenses!'
                is3D:true
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
    </script>
  </head>
  
  <body>

<!--      header section  start      -->

  <section class="s-header">

<div class='navbar'>
    <img src="./images/logo.png" class='logo' alt='logo' onclick="window.location.href='home.html'"></img>
    <div>
        <button type='button' onclick="window.location.href='logout.php'"><span></span>Log Out</button>
    </div>
</div>

</section>

<!--      header section  end      -->

    <div id="piechart" style="width: 900px; height: 500px; padding-top: 100px"></div>

  <!--      footer section  start      -->
  <section class="s-footer">
        <div class="footer">
           <p class="copyright"> Made with &#10084;&#65039; by Abhimanyu </p>
        </div>
  </section>
  <!--      footer section  end      -->

  </body>
  </html>
