<?php

include('include/process/connect_process.php');

$listid = $_GET['list'];
$movieid = $_GET['movie'];
mysqli_query($connection, "delete from movie_list where movieID = '$movieid' and listID = '$listid'");

?>
