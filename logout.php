<?php
// session_start();
// print_r($_SESSION);

if (isset($_POST['logout'])) {

	if (isset($_SESSION["username"])) {
		unset($_SESSION["username"]);
	}

	if (isset($_SESSION["password"])) {
		unset($_SESSION["password"]);
	}

	session_unset();
	if (session_status() == 2) {
		session_destroy();
	}

	echo "Logged out successfully.....";
	header('location:index.html');
} else {
	echo "You are already logged off!";
	header('location: signin.html');
}

?>