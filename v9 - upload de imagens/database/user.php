<?php


function loadByUsernameAndPassword($username, $pass){
  global $conn;

  $query = "select * from users where username = '" . $username . "' AND password = '" . $pass. "';" ;
  $result = pg_exec($conn, $query);

  //Obtenção do número de registos
  $num_registos = pg_numrows($result);

  $user = pg_fetch_row($result, 0);
  
    //Se o número de registos não for maior que 0, o para username e password não existe
  if ($num_registos > 0)
    return $user[1];
  else
    return NULL;
}

?>
