<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$post = $_POST["post"];
		$theme = $_POST["theme"];
		$headline = $_POST["headline"];
		if(isset($post) && isset($theme)) {
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
					$username = $_SESSION["username"];
					$sql2 = "INSERT INTO userpost (theme,post,username,headline) VALUES (?,?,?,?);";
					if($statement = mysqli_prepare($connection, $sql2)) {
						mysqli_stmt_bind_param($statement, 'ssss', $theme,$post,$username,$headline);
						mysqli_stmt_execute($statement);
						$sql3 = "SELECT postID FROM userpost WHERE username = '".$username."'";
						$result = mysqli_query($connection, $sql3);

						while ($row = mysqli_fetch_assoc($result)) {
							$postID = $row['postID'];
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
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						//if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
						mysqli_close($connection);
						header("Location: main.php");
					} //else {
						//echo "Sorry, there was an error uploading your file.";
					//}

					$target_file = $target_dir.basename($_FILES["userImage"]["name"]);
					$imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
					$sql = "INSERT INTO postImages (postID,username, contentType,image) VALUES(?,?,?,?)";
					$stmt = mysqli_stmt_init($connection);
					mysqli_stmt_prepare($stmt, $sql);
					$null = NULL;
					mysqli_stmt_bind_param($stmt, "issb", $postID, $username, $imageFileType, $null);
					mysqli_stmt_send_long_data($stmt, 3, $imagedata);
					$result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
					mysqli_stmt_close($stmt);
				}
				mysqli_close($connection);
				header("Location: main.php");
			}
		} else {
			header("Location: main.php");
		}
?>
