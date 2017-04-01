<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		session_start();
		$username = $_SESSION["username"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$passwordOut = md5($_POST["password"]);
		$aboutme = $_POST["aboutme"];

		if(!isset($passwordOut)) {
			 
		}

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
			$userID = -1;
				$sql2 = "UPDATE users SET firstName= '".$firstname."', lastName= '".$lastname."', password= '".$password."', aboutme= '".$aboutme."' WHERE username='".$username."';";
				mysqli_query($connection, $sql2);
				echo "<p>An account for the user ".$username." has been created</p>";
				$sql3 = "SELECT userID FROM users WHERE username = '".$username."'";
				$result = mysqli_query($connection, $sql3);

				while ($row = mysqli_fetch_assoc($result)) {
					$userID = $row['userID'];
				}




				$target_dir = "uploads/";
				$target_file = $target_dir.basename($_FILES["userImage"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["userImage"]["tmp_name"]);
					if($check !== false) {
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}
					// Check if file already exists
					if (file_exists($target_file)) {
						echo "Sorry, file already exists.";
						$uploadOk = 0;
					}
					// Check file size
					if ($_FILES["userImage"]["size"] > 400000) {
						echo "Sorry, your file is too large.";
						$uploadOk = 0;
					}
					if($_FILES["userImage"]["size"] != 0 && $_FILES["userImage"]["name"] != "") {
					// Allow certain file formats
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
							echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
							$uploadOk = 0;
						}
						if ($uploadOk == 0) {
							echo "Sorry, your file was not uploaded.";
						} else {
							echo "The file ". basename( $_FILES["userImage"]["name"]). " has been uploaded.";
						}

						$target_file = $target_dir.basename($_FILES["userImage"]["name"]);
						$imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
						$sql = "UPDATE userImages SET contentType= ?, image= ? WHERE userID= ?;";
						$stmt = mysqli_stmt_init($connection);
						mysqli_stmt_prepare($stmt, $sql);
						$null = NULL;
						mysqli_stmt_bind_param($stmt, "sbi", $imageFileType, $null, $userID);
						mysqli_stmt_send_long_data($stmt, 1, $imagedata);
						$result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
						mysqli_stmt_close($stmt);
						$_SESSION["username"] = $username;
					}
					header("Location: profile.php");
			}

		mysqli_close($connection);
	}
?>
