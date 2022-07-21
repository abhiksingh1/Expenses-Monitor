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
		$sql = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
		$datatable = "CREATE TABLE $username(id int NOT NULL AUTO_INCREMENT, item varchar(255), category varchar(255), quantity int, rate int, total int, PRIMARY KEY (id))";
		if (($conn->query($sql) === TRUE) && ($conn->query($datatable) == TRUE)) {
			echo "Signed up successfully....!";
			header('location:signin.html');
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	} else {
		echo "This username is already taken! Please try another....";
	}

	$conn->close();
}

?>