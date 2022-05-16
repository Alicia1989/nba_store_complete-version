<?php
//Database credentials. Assuming you are running MySQL
//server with default setting (user 'root' with no password)
define('DB_SERVER', 'sql201.epizy.com');
define('DB_USERNAME', 'epiz_31340535');
define('DB_PASSWORD', 'cGRcQ445yACXy'); // enter your database password if it is set to use password
define('DB_NAME', 'epiz_31340535_nba_database');

/*
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root'); 
define('DB_NAME', 'nba');
define('DB_PORT', 3306);
*/

/* Attempt to connect to MySQL database */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
 
// Check connection
if($connection === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>