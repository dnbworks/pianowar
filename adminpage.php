<?php 
    require_once('authentication.php');
    include_once('partials/header.php');
    require_once('connectivity.php');
?>

<div class="container">
    <h3>Guitar Wars - High Scores Administration</h3>
    <p>Below is a list of all guitar wars high scores. Use this page to remove scores as needed.</p>

<?php
 require_once('connectivity.php');

 $dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");
 $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
 $data = mysqli_query($dbc, $query) or die ("error");

 echo "<table>";
 while($row = mysqli_fetch_array($data)){
    echo "<tr><td><strong>Name: </strong>"  . $row['name'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['score'] . "</td>";
    echo '<td><a href="remove.php?id='. $row['id'] .'&amp;date='. $row['date']. '&amp;name=' . $row['name']. '&amp;score='. $row['score'].'&amp;screenshot='. $row['screenshot'].'">Remove</a></td>';

    if($row['approved'] == "0") {
        echo '<td><a href="approve.php?id='. $row['id'] .'&amp;date='. $row['date']. '&amp;name=' . $row['name']. '&amp;score='. $row['score'].'&amp;screenshot='. $row['screenshot'].'"> Approve</a></td></tr>';
    }
 }
 echo "</table>";
 mysqli_close($dbc);
?>
</div>
</body>
</html>