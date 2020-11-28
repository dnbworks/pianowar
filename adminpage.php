<?php 
    require_once('authentication.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<div class="container">
    <h3>Guitar Wars - High Scores Administration</h3>
    <p>Below is a list of all guitar wars high scores. Use this page to remove scores as needed.</p>
</div>
<?php
 require_once('connectivity.php');
 require_once('variables.php');

 $dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");
 $query = "SELECT * FROM highscore ORDER BY score DESC, date ASC";
 $data = mysqli_query($dbc, $query) or die ("error");

 echo "<table>";
 while($row = mysqli_fetch_array($data)){
    echo "<tr><td><strong>Name: </strong>"  . $row['name'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['score'] . "</td>";
    echo '<td><a href="remove.php?id='. $row['id'] .'&amp;date='. $row['date']. '&amp;name=' . $row['name']. '&amp;score='. $row['score'].'&amp;screenshot='. $row['screenshot'].'">Remove</a></td>';

    if($row['approve'] == "0") {
        echo '<td><a href="approve.php?id='. $row['id'] .'&amp;date='. $row['date']. '&amp;name=' . $row['name']. '&amp;score='. $row['score'].'&amp;screenshot='. $row['screenshot'].'"> Approve</a></td></tr>';
    }
 }
 echo "</table>";
 mysqli_close($dbc);
?>

</body>
</html>