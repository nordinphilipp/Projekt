<?php 
	$query = $_GET['query'];
	$min_length = 3;
	
	if(strlen($query) >= $min_length)
	{
		$query = htmlspecialchars($query); // Ändrar 
		$query = mysql_real_escape_string($query);
		$search_name = mysql_query("SELECT * FROM lists WHERE('name' LIKE '%".$query."%')"); // Söker efter namn på listor som innehåller sökordet
	}
	
	if(mysql_num_rows($search_name) > 0){
		while($result = mysql_fetch_array($search_name))
		{
            echo "<p>".$result['name']."</p>";
        }
             
    }else{ 
			echo "Inget hittades";
	}
?>