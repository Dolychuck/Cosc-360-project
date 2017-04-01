<?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $username = $_GET["a"];
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
           $sql = "SELECT status FROM users WHERE username='".$username."'";
           $result = mysqli_query($connection,$sql);
           if($row = mysqli_fetch_assoc($result)) {
               $enabled = $row["status"];
           }
           mysqli_free_result($result);
           if(isset($enabled)) {
             if(strcmp($enabled,"enabled") == 0) {
               $enabled = "disabled";
               $sql = "UPDATE users SET status='".$enabled."' WHERE username='".$username."';";
               mysqli_query($connection,$sql);
             } else if (strcmp($enabled,"disabled") == 0) {
               $enabled = "enabled";
               $sql = "UPDATE users SET status='".$enabled."' WHERE username='".$username."';";
               mysqli_query($connection,$sql);
             }
           }
        }
        mysqli_close($connection);
        header("Location: admin.php");
    } else {
      header("Location: main.php");
    }
?>
