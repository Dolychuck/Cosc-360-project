<?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $postid = $_GET["a"];
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
           $sql = "DELETE FROM postImages WHERE PostID=".$postid."";
           mysqli_query($connection,$sql);

           $sql = "DELETE FROM userpost WHERE PostID=".$postid."";
           mysqli_query($connection,$sql);
           session_start();
           $sql = "SELECT * FROM users,userpost WHERE users.username = userpost.username AND theme='".$_SESSION["theme"]."'";
           echo '<tr><th>Username</th><th>Name</th><th>Headline</th><th>Edit post</th><th>Close Post</th></tr>';
           $result = mysqli_query($connection,$sql);
           while($row = mysqli_fetch_assoc($result)) {
             echo '<tr><td>'.$row["username"].'</td><td>'.$row["firstName"].'</td><td>'.$row["headline"].'</td><td><a href="editpost.php?b='.$row["PostID"].'">edit</a></td><td><button onclick="deletePost(this.value)" value="'.$row["PostID"].'">close</a></td></tr>';
           }
           mysqli_close($connection);
      }
    } else {
        header("Location: main.php");
    }
?>
