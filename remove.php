<?php 
    require_once('authentication.php');
    include_once('partials/header.php');
    require_once('connectivity.php');
?>

<div class="container">
    <h2>Guitar Wars- Remove a High Score</h2>

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
        @unlink(location . $actualimage );
        $dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");
        $query = "DELETE FROM guitarwars WHERE id = $id LIMIT 1";
        mysqli_query($dbc, $query) or die ("error");
        mysqli_close($dbc);

        echo '<p>The High Score of ' . $score . ' for ' . $fullname . ' was successfully removed';
        header('Location:' . 'http://localhost/GUITAR_WAR/adminpage.php');

    } else {
        echo '<p>the high score was not  removed</p>';
    }
} elseif (ISSET($id) && ISSET($fullname) && ISSET($score) && ISSET($screenshot)) {
    echo '<p>Are you sure you want to delete the following high score</p>';
    echo '<span><strong>Name: </strong>' .  $fullname . '</span><br>';
    echo '<span><strong>Score: </strong>' .  $score . '</span><br>';
    echo '<span><strong>Date: </strong>' .  $date . '</span><br>';

    echo '<form method="POST" action="remove.php">';
    echo '<input type="radio" name="confirm" value="yes">Yes';
    echo '<input type="radio" name="confirm" value="no" checked="checked">No <br>';
    echo '<input type="submit" name="submit" value="Delete">';

    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo '<input type="hidden" name="name" value="' . $fullname . '">';
    echo '<input type="hidden" name="score" value="' . $score . '">';

    echo '</form>';

} 

?>
</div>
</body>
</html>