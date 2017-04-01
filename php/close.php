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
           mysqli_close($connection);
           header("Location: admin.php");
      }
    } else {
        header("Location: main.php");
    }
?>
