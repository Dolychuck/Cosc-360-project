<html>
   <head lang="en">
      <meta charset="utf-8">
      <title>MyDiscussionForum</title>
      <link rel="stylesheet" href="../css/admin.css" />
   </head>
   <body>

      <header>
         <nav>
            <ul>
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
         <form id="input" method="POST" action="" >
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
                            <input type="text" id="adminsearch" name="adminsearch" placeholder="Search"/>
                       </p>
                       <p id="invalid" style="color:red;font-size:12px;font-style: italic;"></p>
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
            <table id="results">
                <!--List data -->
          </table>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="../javascript/adminlist.js"></script>
    </body>
  </html>
