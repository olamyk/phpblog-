<?php ob_start();

// THE PERFECT WAY TO CONNECT

$db["db_host"] = "localhost";
$db["db_user"] = "root";
$db["db_pass"] = "";
$db["db_name"] = "blog";

// THEN WE LOOP THROUGH IT 

foreach($db as $key => $value){
	
	define(strtoupper($key), $value);
}


$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//if($connection){
//
//echo "We are connected";
//}

?>

<!--// NOTE: we use key inside foreach because we aim to change all keys to upper, we can only use (value) if we dont wish to change anything to upper... EXAMPLE: foreach($db as $value), it would work.-->
