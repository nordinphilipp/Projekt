<?php 
	$query = $_GET['query'];
	$min_length = 3;
	
	if(strlen($query) >= $min_length)
	{
		$query = htmlspecialchars($query); // Ändrar 
		$query = mysql_real_escape_string($query);
		$search_name = mysql_query("SELECT * FROM lists WHERE('name' LIKE '%".$query."%')")
	}