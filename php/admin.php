<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>MyDiscussionForum</title>
      <link rel="stylesheet" href="../css/admin.css" />
   </head>
   <body>
      <!--main header -->
      <header>
         <nav>
            <ul><!-- RRRRRRRRRRRRRRRRRRRRRRReeeeeeeeeeeeeeeeeeeeDDDDDDDDDDDDDDDDDDirect-->
               <?php
                  session_start();
                  if(isset($_SESSION["username"])) {
                  	echo "<li id=\"profile\"><a href=\"signout.php\">sign out</a></li>";
                  	echo "<li id=\"profile\"><a href=\"profile.php\">Profile</a></li>";
                  }
                  ?>
               <li id="title">ADMIN PAGE</li>
            </ul>
         </nav>
      </header>
      <div id="main">
         <form method="POST" action="admin.php" >
            <fieldset>
               <legend>Search</legend>
               <table id="searchform">
                  <tr>
                     <td>
                       <p>
                          <label>Search user by:</label><br/>
                          <select name="searchby" id="searchby">
                            <option value="none">None</option>
                             <option value="email">Email</option>
                             <option value="username">Username</option>
                             <option value="firstname">Name</option>
                          </select>
                       </p>
                       <p>
                            <input type="text" name="adminsearch" placeholder="Search"/>
                       </p>
                        <p>
                           <label>Search post by Theme</label><br/>
                           <select name="theme" id="theme" name="theme">
                              <option value="none">None</option>
                              <option value="travel">Travel</option>
                              <option value="news">News</option>
                              <option value="sports">Sports</option>
                              <option value="politics">Politics</option>
                           </select>
                        </p>
                        <td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <div>
                           <input type="submit"> <input type="reset"
                              value="Clear Form">
                        </div>
                  </tr>
               </table>
            </fieldset>
         </form>

         <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $searchUserType = $_POST["searchby"];
                $searchValue =  $_POST["adminsearch"];
                $searchTheme = $_POST["theme"];

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
                    if(strcmp($searchUserType,"none") != 0) {
                        if(strcmp($searchUserType,"email") == 0) {
                            $sql = "SELECT * FROM users WHERE email='".$searchValue."'";
                        } else if(strcmp($searchUserType,"username") == 0) {
                              $sql = "SELECT * FROM users WHERE username='".$searchValue."'";
                        } else if(strcmp($searchUserType,"firstname") == 0) {
                              $sql = "SELECT * FROM users WHERE firstname='".$searchValue."'";
                        }
                        echo '<table id="results"><tr><th>Username</th><th>Name</th><th>Email</th><th>Status</th><th>Enable/Disable</th></tr>';
                        $result = mysqli_query($connection,$sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            if(strcmp($row["status"],"enabled") == 0) {
                               $choice = "disable";
                            } else {
                               $choice = "enable";
                            }
                            echo '<tr><td>'.$row["username"].'</td><td>'.$row["firstName"].'</td><td>'.$row["email"].'</td><td>'.$row["status"].'</td><td><a href="enable.php?a='.$row["username"].'">'.$choice.'</a></td></tr>';
                        }
                        echo '</table>';
                    } else {
                          $sql = "SELECT * FROM users,userpost WHERE users.username = userpost.username AND theme='".$searchTheme."'";
                          echo '<table id="results"><tr><th>Username</th><th>Name</th><th>Headline</th><th>Edit post</th><th>Close Post</th></tr>';
                          $result = mysqli_query($connection,$sql);
                          while($row = mysqli_fetch_assoc($result)) {
                            echo '<tr><td>'.$row["username"].'</td><td>'.$row["firstName"].'</td><td>'.$row["headline"].'</td><td><a href="editpost.php?b='.$row["PostID"].'">edit</a></td><td><a href="close.php?a='.$row["PostID"].'">close</a></td></tr>';
                          }
                          echo "</table>";
                    }
               }
               mysqli_close($connection);
             }
          ?>
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
