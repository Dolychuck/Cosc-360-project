<!DOCTYPE html>
<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>Sign up</title>
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
         <form method="POST" onsubmit="return myFunction();" action="../php/newuser.php" enctype="multipart/form-data">
            <fieldset>
               <legend>Sign Up</legend>
               <table>
                  <tr>
                     <td colspan="2">
                        <?php
                           session_start();
                           if(isset($_SESSION["exists"]) && $_SESSION["exists"] == true) {
                           	echo "<p class=\"invalidfirstname\">Username/email already exists</p>";
                            unset($_SESSION["exists"] );
                           }

                           ?>
                        <p>
                           <label>First Name*</label><br /> <input type="text"
                              id="firstname" name="firstname" size="80" />
                        </p>
                        <p class="invalidfirstname"></p>
                        <p>
                           <label>Last Name*</label><br /> <input type="text"
                              id="lastname" name="lastname" size="80" />
                        </p>
                        <p class="invalidlastname"></p>
                        <p>
                           <label>username*</label><br /> <input type="text" id="username"
                              name="username" size="80" />
                        </p>
                        <p class="invalidusername"></p>
                        <label>email*</label><br /> <input
                           type="email" id="email" name="email" size="80" />
                        <p class="invalidemail"></p>
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
                           <textarea id="aboutme" name="aboutme" rows="6" cols="73"></textarea>
                        </p>
                        <p>
                           <label>Profile picture: </label> <input type="file" name="userImage" id="userImage"><br>
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
