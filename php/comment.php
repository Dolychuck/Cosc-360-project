<?php
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$comment = $_POST["commentpost"];
			if(isset($comment)) {
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
						session_start();
						$post = $_SESSION["PostID"];
						$username = $_SESSION["username"];

						$sql2 = "INSERT INTO comment VALUES (?,?,?,now());";
						if($statement = mysqli_prepare($connection, $sql2)) {
							mysqli_stmt_bind_param($statement, 'sss', $post,$username,$comment);
							mysqli_stmt_execute($statement);
						}

				}
				mysqli_close($connection);
			}
		}
		$_SESSION["commented"] = "set";
		header("Location: article.php");
?>
