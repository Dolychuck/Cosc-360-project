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
           $sql = "SELECT * FROM users WHERE firstname='".$username."'";
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
        }
        mysqli_close($connection);
    } else {
      header("Location: main.php");
    }
?>
