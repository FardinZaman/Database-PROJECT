<?php

	$dbcon = pg_connect("host=localhost port=5432 dbname=Restaurant user=postgres password=arratul11");

	$queryString = $_GET["query"];

	$result = pg_query($dbcon,utf8_encode( $queryString));
	
	$fields = pg_num_fields($result);
	
	echo "valid";
	
	for($i = 0; $i < $fields; $i++){
		echo pg_field_name($result, $i)."||c||";
	}
	echo "||r||";
	
	while ($row = pg_fetch_row($result)) {
		for($i = 0; $i < count($row); $i++){
			echo $row[$i]."||c||";
		}
		echo "||r||";
	}
	
?>