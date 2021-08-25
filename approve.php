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
    

    </style>
</head>
<body>
<h2>Guitar Wars- Approve a High Score</h2>
<?php

require_once('connectivity.php');


if(ISSET($_GET['id']) && ISSET($_GET['name']) && ISSET($_GET['date']) && ISSET($_GET['score']) && ISSET($_GET['screenshot'])) {
    $id = $_GET['id'];
    $fullname = $_GET['name'];
    $date = $_GET['date'];
    $score = $_GET['score'];
    $screenshot = $_GET['screenshot'];
    
 } elseif (ISSET($_POST['name']) && ISSET($_POST['score']) && ISSET($_POST['id'])) {
    $fullname = $_POST['name'];
    $id = $_POST['id'];
    $score = $_POST['score'];
 } else {
    echo "<p class='error'>Sorry, no high score was specified for removal</p>";
}

if(ISSET($_POST['submit'])){
    if($_POST['confirm'] == "yes"){
        $dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");
        $query = "UPDATE `guitarwars` SET `approved`= 1 WHERE `id` = $id";
        
        mysqli_query($dbc, $query) or die ("error");
        mysqli_close($dbc);

        echo '<p>The High Score of ' . $score . ' for ' . $fullname . ' was successfully approved';
        header('Location:' . 'http://localhost/GUITAR_WAR/adminpage.php');

    } else {
        echo '<p>Sorry, there was a problem approving the high score.</p>';
    }
} elseif (ISSET($id) && ISSET($fullname) && ISSET($score) && ISSET($screenshot)) {
    echo '<p>Are you sure you want to Approve the following high score</p>';
    echo '<span><strong>Id: </strong>' .  $id . '</span><br>';
    echo '<span><strong>Name: </strong>' .  $fullname . '</span><br>';
    echo '<span><strong>Score: </strong>' .  $score . '</span><br>';
    echo '<span><strong>Date: </strong>' .  $date . '</span><br>';
    echo '<img src='. location . $screenshot .' alt="approved pic" style="width:250px"><br>';

    echo '<form method="POST" action="approve.php">';
    echo '<input type="radio" name="confirm" value="yes">Yes';
    echo '<input type="radio" name="confirm" value="no" checked="checked">No <br>';
    echo '<input type="submit" name="submit" value="Approve">';

    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo '<input type="hidden" name="name" value="' . $fullname . '">';
    echo '<input type="hidden" name="score" value="' . $score . '">';

    echo '</form>';

} 



?> 
</body>
</html>



