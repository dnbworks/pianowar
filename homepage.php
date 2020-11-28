<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/homepage.css">
    <style>
        nav {
        width: 500px;
        margin-left: 50px;
        margin-top: 20px;
        }

        nav ul {
        list-style-type: none;
        display: flex;
        justify-content: space-around;
        }

        nav ul li a {
        text-decoration: none;
        font-size: 1.2rem;
        }

        table {
        width: 700px;
        margin: 50px auto;
        border-top: 1px solid red;
        border-left: 1px solid #111;
        border-right: 1px solid #111;
        border-bottom:none;
        }
        
    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="homepage.php">Home</a></li>
        <li><a href="index.php">Add High Score</a></li>
        <li><a href="adminpage.php">Admin Page</a></li>
    </ul>
</nav>
<?php
 require_once('connectivity.php');
 require_once('variables.php');

 $dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");
 $query = "SELECT * FROM highscore WHERE approve = 1  ORDER BY score DESC, date ASC";
 $data = mysqli_query($dbc, $query) or die ("error");

 echo "<table>";
 $i = 0;
 while($row = mysqli_fetch_array($data)){
    if($i == 0) {
        echo "<tr><td colspan='2' class='topScore'>Top Score: " . $row['score'] . "</td></tr>";
    }

    echo "<td>" ;
    echo "<span>" . $row['score'] . "</span>";
    echo "<span><strong>Name: </strong>" . $row['name'] . "</span>";
    echo "<span>" . $row['date'] . "</span>";
    echo "</td>" ;

    if(is_file(location . $row['screenshot']) && filesize(location . $row['screenshot']) > 0) {
        echo '<td class="img"><img src="' . location . $row['screenshot'] . '" /></td></tr>';
    } else {
        echo "<td class='img'><img src='" . location . "unverified.png" . "'></td></tr>";
    }

    $i++;

 }

 echo "</table>";
 mysqli_close($dbc);

?>

</body>
</html>