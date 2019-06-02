<?php

$list = $_GET['list'];
$title = $_GET['name'];

$sql = "UPDATE movie_list name = '$title' where listID = '$list'";
$ch = $connect->query($sql);

?>