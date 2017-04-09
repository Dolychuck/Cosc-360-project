<?php
  if($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = $_GET["textsearch"];
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
    echo '<p id="results">Search results:</p>';
    $sql = "SELECT userpost.username,post,headline,image,contentType,userpost.PostID FROM userpost, postImages WHERE post LIKE '%".$search."%' AND userpost.PostID = postImages.PostID LIMIT 10;";
    $results = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($results)) {
      echo "<section class=\"posts\">";
      echo '<figure><img src="data:image/'.$row["contentType"].';base64,'.base64_encode($row["image"]).'"/></figure>';
      echo "<a href=\"article.php?a=".$row["PostID"]."\">".$row["headline"]."</a>";
      echo "<p>Author: ".$row["username"]."</p>";
      echo "<P>".$row["post"]."</p>";
      echo "</section>";
    }
    mysqli_close($connection);
  }
}
?>
