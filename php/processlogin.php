<html>
<body>

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
				$sql = "SELECT username, password FROM users WHERE username = ? AND password = ?;";
				if($statement = mysqli_prepare($connection, $sql)) {
					mysqli_stmt_bind_param($statement, 'ss', $username,$passwordOut);
					mysqli_stmt_execute($statement);
					if(mysqli_stmt_fetch($statement)) {
						session_start();
						$_SESSION["username"] = $username;
						$_SESSION["invaliduser"] = 0;
						header("Location: profile.php");
					} else {
						session_start();
						$_SESSION["invaliduser"] = -1;
						header("Location: main.php");
					}
				}
				mysqli_close($connection);
			}
		}
	} else {
		header("Location: main.php");
	}
?>
</body>
</html>