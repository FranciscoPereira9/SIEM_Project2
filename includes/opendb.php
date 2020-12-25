<?php
	
	$conn = pg_connect("host=db.fe.up.pt dbname=siem2053 user=siem2053 password=EIscKFUh");
	if (!$conn)
			{
		print "Nao foi possivel estabelecer a ligacao";
		exit;
		}
	$query = "set schema 'tp_php';";	
	pg_exec($conn, $query);

?>

	