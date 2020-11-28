<?php
    require_once('connectivity.php');
    require_once('variables.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitar Wars</title>
    <link rel="stylesheet" href="css/style.css">
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

        form input[type="file"] {
            display:none;
        }

        label#screenshots {
        padding: 10px 15px;
        display:inline-block;
        outline: none;
        border-color: #c4c4c4;
        border-style: solid;
        border-radius: 1em;
        margin:10px 0;
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
    <h3>Add your high Score</h3>
<?php 

if(ISSET($_POST['submit'])){
$dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");

$fullname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
$score = mysqli_real_escape_string($dbc, trim($_POST['score']));
$screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
$form = false;

if((!empty($fullname)) && (empty($score)) && (empty($screenshot))){ 
    echo '<p>You forgot to fill in the score and add a screenshot</p>'; 
    $form = true;
}

if((empty($fullname)) && (!empty($score)) && (empty($screenshot))){ 
    echo '<p>You forgot to fill in the name and add a screenshot</p>'; 
    $form = true;
}

if((empty($fullname)) && (empty($score)) && (!empty($screenshot))){ 
    echo '<p>You forgot to fill in the name and Score</p>'; 
    $form = true;
}

if((empty($fullname)) && (!empty($score)) && (!empty($screenshot))){ 
    echo '<p>You forgot to fill in the name input</p>'; 
    $form = true;
}

if((!empty($fullname)) && (empty($score)) && (!empty($screenshot))){ 
    echo '<p>You forgot to fill in the score input</p>'; 
    $form = true;
}

if((!empty($fullname)) && (!empty($score)) && (empty($screenshot))){ 
    echo '<p>You forgot to add a screenshot </p>'; 
    $form = true;
}

if((empty($fullname)) && (empty($score)) && (empty($screenshot))){ 
    echo '<p>You forgot to fill in all the input fields.</p>'; 
    $form = true;
}


if((!empty($fullname)) && is_numeric($score) && (!empty($screenshot))){ 
$screenshotname = $_FILES['screenshot']['name'];
$screenshottype = $_FILES['screenshot']['type'];
$screenshotsize = $_FILES['screenshot']['size'];
$screenshotlocation = $_FILES['screenshot']['tmp_name'];
$screenshoterror = $_FILES['screenshot']['error'];

$allowed = array("jpeg", "jpg", "png");
$Actual = explode("/", $screenshottype);
$ActualFormat = strtolower(end($Actual));

if(in_array($ActualFormat, $allowed)){
    if($screenshotsize < 1000000){
        if($screenshoterror === 0){
            $actualimage = time() . $screenshotname;
            $actualLocation  = location . $actualimage;
            if(move_uploaded_file($screenshotlocation, $actualLocation)){
                $query = "INSERT INTO `highscore` (`date`, `name`, `score`, `screenshot`) VALUES (NOW(),'$fullname','$score','$actualimage')";
                $result = mysqli_query($dbc, $query) or die ("error");

                echo "Thank you for submiting the form";
                $fullname = "";
                $score = "";
                $screenshot = "";

                mysqli_close($dbc);
            } else {
                echo '<p>An error occured in moving the image from a temporary folder</p>';
            }
        } else {
            echo '<p>An error occured in uploading the image</p>';
        }
        
    } else {
        echo '<p>image is too large</p>';
    }

    @unlink($_FILES['screenshot']['tmp_name']);

} else {
     echo '<p>We only accept image formats such as jpeg, jpg and png</p>';
}

}



} else {
$form = true;
}

if($form){
?> 
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>" enctype="multipart/form-data">
    <label for="fullname">Full Name</label><br>
    <input type="text" name="firstname" id="fullname" value="<?php if(!empty($fullname)) echo $fullname;  ?>"><br>
    <label for="score">Score</label><br>
    <input type="text" name="score" id="score" value="<?php if(!empty($score)) echo $score;  ?>"><br>
    <label for="screenshot" id="screenshots" >Add ScreenShot</label><br>
    <input type="file" name="screenshot" id="screenshot" value="<?php if(!empty($screenshot)) echo $screenshot;  ?>"><br>
    <input type="submit" value="Add" name="submit">
</form>

<?php   } ?>


    
</div>
</body>
</html>




