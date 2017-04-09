<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $theme = $_POST["theme"];
    $post = $_POST["post"];
    $headline = $_POST["headline"];

    session_start();
    $postID =  $_SESSION["postID"];
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
      $sql = "UPDATE userpost set theme='".$theme."' , post='".$post."' , headline='".$headline."'  WHERE postID=".$postID."";
      mysqli_query($connection, $sql);
      mysqli_close($connection);
    }
}
header("Location: admin.php");
?>
