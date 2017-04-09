<?php
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$comment = $_GET["commentpost"];
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
						$sql = "SELECT COUNT(comment) AS num FROM comment WHERE PostID='".$_SESSION["PostID"]."'";
						$result = mysqli_query($connection, $sql);
						if($row = mysqli_fetch_assoc($result)) {
							echo "<h2>There are <span>".$row["num"]."</span> Comments</h2>";
						} else {
							echo "<h2>There are <span>0</span> Comments</h2>";
						}

						$sql2 = "SELECT * FROM comment WHERE PostID='".$_SESSION["PostID"]."'";
						$results = mysqli_query($connection, $sql2);
						while($row = mysqli_fetch_assoc($results)) {
							echo "<section class=\"comment\">";
							echo "<p>" .$row["comment"]. "</p>";
							echo "<p>Posted by <span>" .$row["username"]. "</span> on <span>".$row["date"]."</span></p>";
							echo "</section>";
						}
					}
				mysqli_close($connection);
			}
		}
		$_SESSION["commented"] = "set";
?>
