<!DOCTYPE html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>Article</title>
      <link rel="stylesheet" href="../css/article.css" />
      <script type="text/javascript" src="../javascript/javascrpt.js"></script>
   </head>
   <body>
      <!--main header -->
      <header>
         <nav>
            <ul>
               <?php
                  session_start();
                  echo "<li class=\"buttons\"><a href=\"main.php?a=travel\">Travel</a></li>";
                  echo "<li class=\"buttons\"><a href=\"main.php?a=news\">News</a></li>";
                  echo "<li class=\"buttons\"><a href=\"main.php?a=sports\">Sports</a></li>";
                  echo "<li class=\"buttons\"><a href=\"main.php?a=politics\">politics</a></li>";

                  if(isset($_GET['a'])) {
                  	$_SESSION["PostID"] = $_GET['a'];
                  } else if (isset($_SESSION["commented"])){
                  } else {
                  	header("Location: main.php");
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
            <!--recommended posts -->
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
               	$sql = "SELECT userpost.username,post,headline,image,contentType,userpost.PostID FROM userpost, postImages WHERE userpost.PostID='".$_SESSION["PostID"]. "' AND userpost.PostID = postImages.PostID;";
               	$results = mysqli_query($connection, $sql);
               	while ($row = mysqli_fetch_assoc($results)) {
               		echo "<section class=\"post\">";
               		echo "<h1 id=\"articleHead\"><u><i>".$row["headline"]."</i></u></h1>";
               		echo '<figure><img src="data:image/'.$row["contentType"].';base64,'.base64_encode($row["image"]).'"/></figure>';
               		echo "<p id=\"author\">Author: ".$row["username"]."</p>";
               		echo "<p>".$row["post"]."</p>";
               		echo "</section>";
               	}
               }
               mysqli_close($connection);
               ?>
            <div id="comments">
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
                  ?>
            </div>
            <?php
               if(isset($_SESSION["username"])) {
               	echo '<form method="POST" action="comment.php">';
               	echo '<fieldset><legend>Post a new comment</legend>';
               	echo '<p><textarea name="commentpost" rows="10" cols="95"></textarea>';
               	echo '</p><p><input type="submit" value="Post"></p></fieldset></form>';
               } else {
               	echo '<div class="logorsignup"><p><a href="main.php"><span class="commentsection">Log in</span></a> or <a href="signup.php"><span class="commentsection">Sign up</span></a> to leave a comment</p><div>';
               }
               ?>
         </article>
      </div>
      <!--bottom footer -->
      <footer>
         <p>
            <a href="main.html">Home</a> | <a href="#">About us</a> | <a href="#">Contact</a>
         </p>
         <p>
            <em>Copyright &copy; MyDiscussionForum</em>
         </p>
      </footer>
   </body>
</html>
