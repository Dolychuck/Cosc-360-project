<form method="Post">
	<label> 
		Email: 
		<input type="email" name="restoreemail"/>
		<input type="submit"/>
	</label>
</form>
<?php	
	session_start();
	if(isset($_POST["restoreemail"])) {
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
			$sql = "SELECT * FROM users WHERE email = ?";
			if($statement = mysqli_prepare($connection, $sql)) {
				mysqli_stmt_bind_param($statement, 's', $_POST["restoreemail"]);
				mysqli_stmt_execute($statement);
				if($row = mysqli_stmt_fetch($statement)) {
					echo '<a href="passwordReset.php">'.$_POST["restoreemail"]."</a>";
				} else {
					echo "No such email";
				}
				
			mysqli_close($connection);
		}
	}
	}
?>