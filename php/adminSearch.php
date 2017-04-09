<?php
   if($_SERVER["REQUEST_METHOD"] == "GET") {
       $searchUserType = $_GET["searchby"];
       $searchValue =  $_GET["adminsearch"];
       $searchTheme = $_GET["theme"];

       session_start();
       $_SESSION["theme"] = $searchTheme;
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
               echo '<tr><th>Username</th><th>Name</th><th>Email</th><th>Status</th><th>Enable/Disable</th></tr>';
               $result = mysqli_query($connection,$sql);
               while($row = mysqli_fetch_assoc($result)) {
                   if(strcmp($row["status"],"enabled") == 0) {
                      $choice = "disable";
                   } else {
                      $choice = "enable";
                   }
                   echo '<tr><td>'.$row["username"].'</td><td>'.$row["firstName"].'</td><td>'.$row["email"].'</td><td>'.$row["status"].'</td><td><button onclick="enable(this.value)" value="'.$row["username"].'">'.$choice.'</button></td></tr>';
               }
           } else {
                 $sql = "SELECT * FROM users,userpost WHERE users.username = userpost.username AND theme='".$searchTheme."'";
                 echo '<tr><th>Username</th><th>Name</th><th>Headline</th><th>Edit post</th><th>Close Post</th></tr>';
                 $result = mysqli_query($connection,$sql);
                 while($row = mysqli_fetch_assoc($result)) {
                   echo '<tr><td>'.$row["username"].'</td><td>'.$row["firstName"].'</td><td>'.$row["headline"].'</td><td><a href="editpost.php?b='.$row["PostID"].'">edit</a></td><td><button onclick="deletePost(this.value)" value="'.$row["PostID"].'">close</a></td></tr>';
                 }
           }
      }
      mysqli_close($connection);
    }
 ?>
