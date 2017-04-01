<!DOCTYPE html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>MyDiscussionForum</title>
      <link rel="stylesheet" href="../css/mainStyle.css" />
      <script type="text/javascript" src="../javascript/userpass.js"></script>
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

                  session_start();
                  if(isset($_GET['a'])) {
                  	$_SESSION["category"] = $_GET['a'];
                  }
                  if(isset($_SESSION["username"])) {
                  	echo "<li id=\"profile\"><a href=\"signout.php\">sign out</a></li>";
                  	echo "<li id=\"profile\"><a href=\"profile.php\">Profile</a></li>";
                  }
                  ?>
               <li id="title">MyDiscussionForum</li>
            </ul>
         </nav>
      </header>
      <div id="main">
         <article id="rightside">
           <div id="searchbar">
             <form method="POST" action="main.php">
               <input type="text" name="search" placeholder="Search"/>
               <input type="submit" value="Search"/>
             </form>
           </div>
            <!--user login -->
            <section id="userLogin">
               <form method="POST" action="processlogin.php" onsubmit="return userpass();">
                  <fieldset>
                     <legend> Login </legend>
                     <p>
                        <label>Username:</label> <input type="text" name="username" id="user"
                           placeholder="username" />
                     </p>
                     <p class="invaliduser"></p>
                     <p>
                        <label>Password: </label> <input type="password" name="password" id="pass"
                           placeholder="password" />
                     </p>
                     <?php
                        if(isset($_SESSION["disabled"])) {
                            echo "<p class=\"invalidpass\">Account disabled</p>";
                            unset($_SESSION["disabled"]);
                        }
                        else if(isset($_SESSION["invaliduser"]) && $_SESSION["invaliduser"]  == -1) {
                        	echo "<p class=\"invalidpass\">Invalid username or password</p>";
                        	echo '<p><a href="restore.php" class="create">Forgot your password?</a></p>';
                        	unset($_SESSION["invaliduser"]);
                        }
                        ?>
                     <p class="invalidpass"></p>
                     <p>
                        No account?<a href="signup.php" class="create">&nbsp Create one!</a> <input
                           type="submit" value="Login" class="loginbutton" />
                     </p>
                  </fieldset>
               </form>
            </section>
            <section id="recommended">
               <h1>Recommended</h1>
               <?php
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
                  		$sql = "SELECT userpost.username,post,headline,image,contentType,userpost.PostID FROM userpost, postImages WHERE userpost.PostID = postImages.PostID ORDER BY POSTID DESC LIMIT 5;";
                  		$results = mysqli_query($connection, $sql);
                  		while ($row = mysqli_fetch_assoc($results)) {
                  			echo '<figure id= "recimage"><img id="im" src="data:image/'.$row["contentType"].';base64,'.base64_encode($row["image"]).'"/></figure>';
                  			echo '<div class="recposts">';
                  			echo "<a href=\"article.php?a=".$row["PostID"]."\">Read Article</a>";
                  			echo "<p>".$row["headline"]."</p>";
                  			echo "<h3>Author: ".$row["username"]."</h3></div>";
                  		}
                  	}
                  	mysqli_close($connection);

                  ?>
            </section>
         </article>
         <!--main posts -->
         <article id="leftside">
            <?php
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
                 if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $search = $_POST["search"];
                 }

                 if(isset($search)) {
                   echo '<p id="results">Search results:</p>';
                   $sql = "SELECT userpost.username,post,headline,image,contentType,userpost.PostID FROM userpost, postImages WHERE post LIKE '%".$search."%' AND userpost.PostID = postImages.PostID LIMIT 10;";
                   $results = mysqli_query($connection, $sql);
                   while ($row = mysqli_fetch_assoc($results)) {
                     echo "<section class=\"posts\">";
                     echo '<figure><img src="data:image/'.$row["contentType"].';base64,'.base64_encode($row["image"]).'"/></figure>';
                     echo "<a href=\"article.php?a=".$row["PostID"]."\">".$row["headline"]."</a>";
                     echo "<p>Author: ".$row["username"]."</p>";
                     echo "<P>".$row["post"]."</p>";
                     echo "</section>";
                   }
                 } else {
                   if(!isset($_SESSION["category"])) {
                   	//travel is default
                   	$_SESSION["category"] = "travel";
                   }
                    //shows which articles to display
                    $category = $_SESSION["category"];

                    $sql = "SELECT userpost.username,post,headline,image,contentType,userpost.PostID FROM userpost, postImages WHERE theme='".$category. "' AND userpost.PostID = postImages.PostID;";
                   	$results = mysqli_query($connection, $sql);
                   	while ($row = mysqli_fetch_assoc($results)) {
                   		echo "<section class=\"posts\">";
                   		echo '<figure><img src="data:image/'.$row["contentType"].';base64,'.base64_encode($row["image"]).'"/></figure>';
                   		echo "<a href=\"article.php?a=".$row["PostID"]."\">".$row["headline"]."</a>";
                   		echo "<p>Author: ".$row["username"]."</p>";
                   		echo "<P>".$row["post"]."</p>";
                   		echo "</section>";
                   	}
                   }
               }
               mysqli_close($connection);
               ?>
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
