<?php
    session_start();
    use app\Person;

    require_once('connectivity.php');
    include_once('partials/header.php');


    require_once('vendor/autoload.php');


  

    // $person = new Person();

 


?>

<div class="container">
    <h3>Add your high Score</h3>
    <img src="black.png" alt="" srcset="">
<?php 

if(ISSET($_POST['submit'])){
$dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");

$fullname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
$score = mysqli_real_escape_string($dbc, trim($_POST['score']));
$screenshot = mysqli_real_escape_string($dbc, trim($_FILES['screenshot']['name']));
$pass_phrase = mysqli_real_escape_string($dbc, trim($_POST['verify']));
$form = false;

if((!empty($fullname)) && (empty($score)) && (empty($screenshot)) && (empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to fill in the score, verification and add a screenshot</p>'; 
    $form = true;
}

if((empty($fullname)) && (!empty($score)) && (empty($screenshot)) && (empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to fill in the name, verification and add a screenshot</p>'; 
    $form = true;
}

if((empty($fullname)) && (empty($score)) && (!empty($screenshot)) && (empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to fill in the name, verification and Score</p>'; 
    $form = true;
}

if((empty($fullname)) && (empty($score)) && (empty($screenshot)) && (!empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to fill in the name, screenshot and Score</p>'; 
    $form = true;
}

// two

if((empty($fullname)) && (!empty($score)) && (!empty($screenshot)) && (empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to fill in the name input and verification</p>'; 
    $form = true;
}

if((!empty($fullname)) && (empty($score)) && (!empty($screenshot)) && (empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to fill in the score input and the verification input</p>'; 
    $form = true;
}

if((!empty($fullname)) && (!empty($score)) && (empty($screenshot)) && (empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to add a screenshot and verification input </p>'; 
    $form = true;
}

if((empty($fullname)) && (empty($score)) && (empty($screenshot)) && (empty($pass_phrase))){ 
    echo '<p class="alert-danger alert">You forgot to fill in all the input fields.</p>'; 
    $form = true;
}

// if(empty($_POST['verify'])){
//     echo '<p class="alert-danger alert">You forgot to fill in the verify pass fields.</p>';
//       $form = true;
// }



if((!empty($fullname)) && is_numeric($score) && (!empty($screenshot)) && (!empty($_POST['verify']))){ 

    
    if($_SESSION['pass_phrase'] == sha1($_POST['verify'])){
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
                        $query = "INSERT INTO `guitarwars` (`date`, `name`, `score`, `screenshot`) VALUES (NOW(),'$fullname','$score','$actualimage')";
                        $result = mysqli_query($dbc, $query) or die ("error");

                        echo "Thank you for submiting the form. Your post with be approved by the admin within 1 bussiness day";
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
    } else {
        echo '<p class="alert-danger alert">Please enter the verfication pass-phrase exactly as shown</p>'; 
        $form = true;
    }


}



} else {
$form = true;
}

if($form){
?> 
<div class="container">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>" enctype="multipart/form-data">
        <label for="fullname">Full Name</label><br>
        <input type="text" name="firstname" id="fullname" value="<?php if(!empty($fullname)) echo $fullname;  ?>"><br>
        <label for="score">Score</label><br>
        <input type="text" name="score" id="score" value="<?php if(!empty($score)) echo $score;  ?>"><br>
        <label for="screenshot" id="screenshots" class="screenshot" >
            <img src="" alt="image-preview" srcset="">
            <span>Add screenshot</span>
       
        </label>
        <input type="file" name="screenshot" id="screenshot" value="<?php if(!empty($screenshot)) echo $_FILES['screenshot']['tmp_name'] . '/' . $_FILES['screenshot']['name'];  ?>"><br>
        <label for="verify">Verification:</label><br>
        <input type="text" name="verify" id="verify" placeholder="Enter the pass-phrase">
        <img src="http://localhost/GUITAR_WAR/captcha.php" alt="Verification pass-phrase"><br>
    
        <input type="submit" value="Add" name="submit">
       
    </form>
</div>


<?php   } ?>


    
</div>

<script src="asset/js/script.js"></script>
</body>
</html>