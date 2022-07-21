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
    

    <link href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" rel="stylesheet" />

    <script src="//code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

    <style>
        .s-dowloadtable{
            padding: 100px 20px;
        }
    </style>

    <title></title>

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

 <section class="s-dowloadtable" style="width:100% padding-top: 100px">

    <table id="example" class="display" style="width:100%">
       <thead>
        <tr>
            <th>Sr. No.</th>
            <th>Item</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Total</th>
        </tr>
       </thead>
       <tbody>
         <?php
            session_start();
            $conn = new mysqli("localhost", "root", "", "registered_user");
            if ($conn->connect_error) {
                die('Connection failed : ' . $conn->connect_error);
            } else {

                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    // for($i = 0; $i < count($_POST["item"]); $i++){
                    // $sql = "INSERT INTO $username(item, category, quantity, rate, total) VALUES ('".$_POST["item"][$i]."', '".$_POST["category"][$i]."', ".$_POST["quantity"][$i].", ".$_POST["rate"][$i].", ".$_POST["total"][$i].")";
                    // $conn -> query($sql);

                    $sql = "SELECT id, item, category, quantity, rate, total FROM $username";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["item"] . "</td><td>" . $row["category"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["rate"] . "</td><td>" . $row["total"] . "</td></tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No data found!";
                    }
                } else {
                    echo "You are in logged off. First login and try again.....";
                }
                $conn->close();
            }
          ?>
        </tbody>
    </table>
        </section>

      <!--      footer section  start      -->
  <section class="s-footer">
        <div class="footer">
           <p class="copyright"> Made with &#10084;&#65039; by Abhimanyu </p>
        </div>
  </section>
  <!--      footer section  end      -->

    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

</body>
</html>