
<?php

 include_once('partials/header.php');
 require_once('connectivity.php');
 require_once('function/pagination_links.php');



$page = ISSET($_GET['page']) ? $_GET['page'] : null;

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$result_per_page = 5;
$skip = (($current_page - 1) * $result_per_page);



 $dbc = mysqli_connect(host, username, pwd, database) or die ("error in conncting to database");

 $query = "SELECT * FROM guitarwars WHERE approved = 1  ORDER BY score DESC, date ASC";
 $data = mysqli_query($dbc, $query) or die ("error");

$numRows = mysqli_num_rows($data);

$num_pages = ceil($numRows / $result_per_page);

$sql =  $query . " LIMIT $skip,  $result_per_page";
$data = mysqli_query($dbc, $sql) or die ("error");

 if($num_pages > 1){
    $pagination_links = generate_page_links($current_page, $num_pages);
    
} 

?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
            <table>

<?php

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
        echo "<td class='img'><img src='" . location . "unverified.jpg" . "'></td></tr>";
    }

    $i++;

 }

 mysqli_close($dbc);

?>


            </table>
            <div class="paginate">
                <?php echo $pagination_links; ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>