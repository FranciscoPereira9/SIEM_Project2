<?PHP
	
	$conn = pg_connect("host=db dbname=jfaria user=jfaria password=jfaria");
	if (!$conn)
			{
		print "Nao foi possivel estabelecer a ligacao";
		exit;
		}
	$query = "set schema 'demosAulas';";	
	pg_exec($conn, $query);

?>