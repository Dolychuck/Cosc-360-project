<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>Profile</title>
      <link rel="stylesheet" href="../css/profile.css" />
      <script type="text/javascript" src="../javascript/profile.js"></script>
   </head>
   <body>
      <!--main header -->
      <header>
         <nav>
            <ul>
               <?php
                  echo "<li class=\"buttons\"><a href=\"main.php?a=travel\">Travel</a></li>";
                  echo "<li class=\"buttons\"><a href=\"main.php?a=news\">News</a></li>";
                  echo "<li class=\"buttons\"><a href=\"main.php?a=sports\">Sports</a></li>";
                  echo "<li class=\"buttons\"><a href=\"main.php?a=politics\">politics</a></li>";
                  ?>
               <li id="title">MyDiscussionForum</li>
            </ul>
         </nav>
      </header>
      <div id="main">
         <!--profile -->
         <article id="leftside">
            <section id="profile">
               <h1>Profile</h1>
               <?php
                  session_start();
                  $username = $_SESSION["username"];
                  if(isset($username)) {
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
                  		$userID = 0;
                  		$sql3 = "SELECT userID FROM users WHERE username = '".$username."'";
                  		$result = mysqli_query($connection, $sql3);

                  		while ($row = mysqli_fetch_assoc($result)) {
                  			$userID = $row['userID'];
                  		}
                  		mysqli_free_result($result);
                  		mysqli_stmt_close($statement);
                  		$sql = "SELECT contentType, image FROM userImages where userID=?";
                  			// build the prepared statement SELECTing on the userID for the user
                  			$stmt = mysqli_stmt_init($connection);
                  			//init prepared statement object
                  			mysqli_stmt_prepare($stmt, $sql);
                  			// bind the query to the statement
                  			mysqli_stmt_bind_param($stmt, "i", $userID);
                  			// bind in the variable data (ie userID)
                  			$result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
                  			// Run the query. run spot run!
                  			mysqli_stmt_bind_result($stmt, $type, $image); //bind in results
                  			 // Binds the columns in the resultset to variables
                  			mysqli_stmt_fetch($stmt);
                  			// Fetches the blob and places it in the variable $image for use as well
                  			// as the image type (which is stored in $type)
                  			mysqli_stmt_close($stmt);
                  			// release the statement
                  			echo '<div class="aboutme"><figure><img src="data:image/'.$type.';base64,'.base64_encode($image).'" alt="image" id="profilepic"/></figure><hr>';

                  		$sql = "SELECT username, firstname, lastname, email,aboutme, userID, admin FROM users WHERE username = '".$username."';";
                  		$result = mysqli_query($connection, $sql);
                  			while($row = mysqli_fetch_assoc($result)) {
                  				$_SESSION["firstname"] = $row['firstname'];
                  				$_SESSION["lastname"] = $row['lastname'];
                  				$_SESSION["email"] = $row['email'];
                  				$_SESSION["aboutme"] = $row['aboutme'];
                          $admin = $row["admin"];
                  				echo "<p><strong>Name:</strong>".$row['firstname']."</p>";
                  				echo "<p><strong>Last Name:</strong>".$row['lastname']."</p>";
                  				echo "<p><strong>Email:</strong>".$row['email']."</p>";
                  				echo "<p><strong>aboutme:</strong>".$row['aboutme']."</p>";
                  			}
                  		mysqli_stmt_close($statement);

                  		?>
               <form method="POST" action="edit.php">
                  <input type="submit" value="edit">
               </form>
               <?php
                 if(isset($admin) && $admin == 1) {
                   echo '<form method="GET" action="admin.php"><input type="submit" value="admin"></form>';
                 }
                  echo "<p><strong>Recent posts:</strong></p>";
                  $sql = "SELECT headline,PostID FROM userpost WHERE username='".$username."' ORDER BY postID DESC LIMIT 5;";
                  $results = mysqli_query($connection, $sql);
                  	while($row = mysqli_fetch_assoc($results)) {
                  		echo "<p><a href=\"article.php?a=".$row["PostID"]."\">".$row['headline']."</a></p>";
                  	}
                  mysqli_close($connection);
                  }
                  } else {
                  header("Location: main.php");
                  }
                  ?>
      </div>
      </section>
      </article>
      <!--TO DO-->
      <!--new posts -->
      <article id="rightside">
         <section class="posts">
            <form method="POST" action="newpost.php" onsubmit="return comment();" enctype="multipart/form-data">
               <fieldset>
                  <legend>New Post</legend>
                  <table>
                     <tr>
                        <td colspan="2">
                           <p>
                              <label>Theme</label><br/>
                              <select name="theme" id="theme" name="theme">
                                 <option value="travel">Travel</option>
                                 <option value="news">News</option>
                                 <option value="sports">Sports</option>
                                 <option value="politics">Politics</option>
                              </select>
                           </p>
                           <p>
                              <label>title</label><br /> <input type="text" id="headline" name="headline" size="58" placeholder="title" />
                           </p>
                           <p class="invalidtheme"></p>
                           <p>
                              <label>Post</label><br />
                              <textarea id="userpost" name="post" rows="15" cols="53" placeholder="post"></textarea>
                           </p>
                           <p class="invaliduserpost"></p>
                           <p>
                              <label>Picture</label> <input type="file" name="userImage">
                           </p>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <div>
                              <input type="submit"> <input type="reset"
                                 value="Clear Form">
                           </div>
                        </td>
                     </tr>
                  </table>
               </fieldset>
            </form>
         </section>
      </article>
      </div>
      <!--bottom footer -->
      <footer>
         <p>
            <a href="main.php">Home</a> | <a href="#">About us</a> | <a href="#">Contact</a>
         </p>
         <p>
            <em>Copyright &copy; MyDiscussionForum</em>
         </p>
      </footer>
   </body>
</html>
