<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$username = $_POST["username"];
		$email = $_POST["email"];
		$passwordOut = md5($_POST["password"]);
		$country = $_POST["country"];
		$city = $_POST["city"];
		$aboutme = $_POST["aboutme"];
		
		
		if(isset($firstname) && isset($lastname) && isset($username) && isset($passwordOut)) {
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
				$sql = "SELECT email, username FROM users;";
				$results = mysqli_query($connection, $sql);
				
				$duplicate = false;
				while ($row = mysqli_fetch_assoc($results)) {
					$emailRow = $row['email'];
					$usernameRow = $row['username'];
					if(strcasecmp($email,$emailRow) == 0 || strcasecmp($username,$usernameRow) == 0) {
						$duplicate = true;
						break;
					}
				}
				mysqli_free_result($results);
				$userID = -1;
				if($duplicate == false) {
					$sql2 = "INSERT INTO users (username,firstName,lastName,email,password,country,city,aboutme)VALUES (?,?,?,?,?,?,?,?);";
					if($statement = mysqli_prepare($connection, $sql2)) {
						mysqli_stmt_bind_param($statement, 'ssssssss', $username,$firstname,$lastname,$email,$passwordOut,$country,$city,$aboutme);
						mysqli_stmt_execute($statement);
						echo "<p>An account for the user ".$username." has been created</p>";
						$sql3 = "SELECT userID FROM users WHERE username = '".$username."'";
						$result = mysqli_query($connection, $sql3);
						
						while ($row = mysqli_fetch_assoc($result)) {
							$userID = $row['userID'];
						}
						mysqli_free_result($result);
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
					if ($_FILES["userImage"]["size"] > 100000) {
						echo "Sorry, your file is too large.";
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						//if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
						echo "The file ". basename( $_FILES["userImage"]["name"]). " has been uploaded.";
					} //else {
						//echo "Sorry, there was an error uploading your file.";
					//}
				
					$target_file = $target_dir.basename($_FILES["userImage"]["name"]);
					$imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
					$sql = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)";
					$stmt = mysqli_stmt_init($connection); 
					mysqli_stmt_prepare($stmt, $sql);
					$null = NULL;
					mysqli_stmt_bind_param($stmt, "isb", $userID, $imageFileType, $null);
					mysqli_stmt_send_long_data($stmt, 2, $imagedata);
					$result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
					mysqli_stmt_close($stmt);
					session_start();					
					$_SESSION["username"] = $username;
					header("Location: ../php/profile.php");
				} else {
						session_start();
					    $_SESSION["exists"] = true;
						header("Location: signup.php");
				} 
			}
				
			mysqli_close($connection);
			}
		} else {
			header("Location: main.php");
		}
?>