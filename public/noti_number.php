<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "softtech";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM users WHERE approved='0'";
	$result = $conn->query($sql);
	echo $result->num_rows;
	$conn->close();
?>