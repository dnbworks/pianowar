<?php 

if(ISSET($_POST['submit'])){
    $files = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileLocation = $_FILES['file']['tmp_name'];
    $fileError = $_FILES['file']['error'];
    $fileSize = $_FILES['file']['size'];
    
    $fileActualType = explode(".", $fileName );
    $fileActualFormat = strtolower(end($fileActualType));

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($fileActualFormat, $allowed )){
        if($fileError === 0){
            if($fileSize < 384797){
                $filenewname = uniqid("", true) . "." . $fileActualFormat;
                $filedest = 'uploads/' . $filenewname;
                move_uploaded_file($fileLocation, $filedest);
                echo "success";
            } else {
                echo "too big file";
            }
        } else {
            echo "error in uploading";
        }
    } else {
        echo "Wrong format";
    }


    

}
    

?>