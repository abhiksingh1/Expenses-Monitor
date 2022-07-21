<?php

$username = $_POST['username'];
$password = $_POST['password'];
$conn = new mysqli("localhost", "root", "", "registered_user");
if ($conn->connect_error) {
	die('Connection failed : ' . $conn->connect_error);
} else {

	$check_user = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $check_user);
	if (mysqli_num_rows($result) == 0) {
		echo "You don't have an account! Please Signup first.....";
	} else {
		$check_password = "SELECT * FROM users WHERE username = '$username' && password ='$password'";
		$getresult = mysqli_query($conn, $check_password);
		if (mysqli_num_rows($getresult) == 0) {
			echo "Password donot matched.....";
		} else {
			echo "Logged In successfully!";
			session_start();
			$_SESSION["username"] = $username;
			//$_SESSION["password"] = $password;
			header('location: home.html');
		}
	}
	$conn->close();
}