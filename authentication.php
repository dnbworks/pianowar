<?php

$username = "dooyong";
$pwd = "nsaako";

if(!ISSET($_SERVER['PHP_AUTH_USER']) || !ISSET($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $pwd)){
    header("http/1.1 401 Unauthorized");
    header("www-authenticate: Basic realm='Guitar Wars'");
    exit('<h2>Guitars Wars</h2><p>Sorry, you must enter a valid username and password to access this page.');
}


?>


