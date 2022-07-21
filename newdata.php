<?php
session_start();

$conn = new mysqli("localhost", "root", "", "registered_user");
if ($conn->connect_error) {
	die('Connection failed : ' . $conn->connect_error);
} else {

	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		for ($i = 0; $i < count($_POST["item"]); $i++) {
			$sql = "INSERT INTO $username(item, category, quantity, rate, total) VALUES ('" . $_POST["item"][$i] . "', '" . $_POST["category"][$i] . "', " . $_POST["quantity"][$i] . ", " . $_POST["rate"][$i] . ", " . $_POST["total"][$i] . ")";
			$conn->query($sql);
		}
		echo "Data entered successfully....!";
		echo '<h1>' . "sssssssss" . '</h1>'; 
		sleep(5);
		header('location: home.html');
	} else {
		echo "You are in logged off. First login and try again.....";
		header('location: signin.html');
	}

	$conn->close();
}

?>