<!DOCTYPE html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>Edit Post</title>
      <link rel="stylesheet" href="../css/signup.css" />
      <link rel="stylesheet" href="../css/error.css" />
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
      <?php
      if($_SERVER["REQUEST_METHOD"] == "GET") {
          $id = $_GET["b"];
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
              $sql = "SELECT * FROM userpost WHERE PostID=".$postid.";";
              $result = mysqli_query($connection,$sql);
              if($row = mysqli_fetch_assoc($result)) {
                $theme = $row["headline"];
                $post = $row["post"];
              }
          }
          mysqli_close($connection);
        }
      ?>
      <div id="main">
        <form method="POST" action="newpost.php" onsubmit="return comment();">
           <fieldset>
              <legend>Edit Post</legend>
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
                            <label>title</label><br /> <input type="text" id="headline" name="headline" size="58" value="<?php echo $headline;?>" />
                       </p>
                       <p class="invalidtheme"></p>
                       <p>
                          <label>Post</label><br />
                          <textarea id="userpost" name="post" rows="15" cols="53" placeholder="<?php echo $headline;?>"></textarea>
                       </p>
                       <p class="invaliduserpost"></p>
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
      </div>
      <!--bottom footer -->
      <footer>
         <p>
            <a href="#">Home</a> | <a href="#">About us</a> | <a href="#">Contact</a>
         </p>
         <p>
            <em>Copyright &copy; MyDiscussionForum</em>
         </p>
      </footer>
   </body>
</html>
