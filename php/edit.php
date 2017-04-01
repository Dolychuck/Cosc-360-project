<!DOCTYPE html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>Edit</title>
      <link rel="stylesheet" href="../css/signup.css" />
      <link rel="stylesheet" href="../css/error.css" />
      <script type="text/javascript" src="../javascript/signup.js"></script>
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
         <form method="POST" onsubmit="return myFunction();" action="edituser.php" enctype="multipart/form-data">
            <fieldset>
               <legend>Edit profile</legend>
               <table>
                  <tr>
                     <td colspan="2">
                        <p>
                           <?php
                              session_start();
                              $username = $_SESSION["username"];
                              $firstname = $_SESSION["firstname"];
                              $lastname = $_SESSION["lastname"];
                              $about = $_SESSION["aboutme"];
                              ?>
                           <label>First Name*</label><br /> <input type="text"
                              id="firstname" name="firstname" size="80" value="<?php echo $firstname;?>" />
                        </p>
                        <p class="invalidfirstname"></p>
                        <p>
                           <label>Last Name*</label><br /> <input type="text"
                              id="lastname" name="lastname" size="80" value="<?php echo $lastname;?>"  />
                        </p>
                        <p class="invalidlastname"></p>
                        <p>
                           <label>password*</label><br /> <input type="password"
                              id="password" name="password" size="80" />
                        </p>
                        <p class="invalidpass"></p>
                        <p>
                           <label>Confirm password*</label><br /> <input type="password"
                              id="confpassword" size="80" />
                        </p>
                        <p class="invalidpass"></p>
                        </p> <!--name change-->
                        <p>
                           <label>About me</label><br />
                           <textarea id="aboutme" name="aboutme" rows="6" cols="73"><?php echo $about;?></textarea>
                        </p>
                        <p>
                           <label>Profile picture: </label> <input type="file" name="userImage"><br>
                        </p>
                     </td>
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
