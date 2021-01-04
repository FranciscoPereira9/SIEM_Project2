<?php 
	include_once "../includes/opendb.php";
	
	global $conn;
	
	$query = "SELECT img FROM \"tp_php\".products WHERE sku=2";
	$result = pg_exec($conn, $query);
	$img = pg_fetch_assoc($result)['img'];
	
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $img ).'"/>'
?>