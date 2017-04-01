<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = $_POST["username"];
		$passwordOut = md5($_POST["password"]);
		if(isset($username) && isset($passwordOut)) {
			$host = "localhost";
			$database = "db_42686155";
			$user = "42686155";
			$password = "42686155";

			$connection = mysqli_connect($host, $user, $password, $database);
			$error = mysqli_connect_error();

			if($error != null) {
				$output = "<p>Unable to connect to database!</p>";
				exit($output);
			} else {
				$sql = "SELECT username, password, status FROM users WHERE username = '".$username."' AND password = '".$passwordOut."';";
					$result = mysqli_query($connection,$sql);
					if($row = mysqli_fetch_assoc($result)) {
						session_start();
						$_SESSION["username"] = $username;
						if(strcmp($row["status"],"disabled") == 0) {
							$_SESSION["invaliduser"] = -1;
							$_SESSION["disabled"] = 1;
							mysqli_close($connection);
							header("Location: main.php");
						} else {
							$_SESSION["invaliduser"] = 0;
							mysqli_close($connection);
							header("Location: profile.php");
						}
					} else {
						session_start();
						$_SESSION["invaliduser"] = -1;
						mysqli_close($connection);
						header("Location: main.php");
					}
				mysqli_close($connection);
			}
		}
	} else {
		header("Location: main.php");
	}
?>
