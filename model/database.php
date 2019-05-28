<?php
// Set up the database connection
//Revisit upon later implementation
/*UNUSED VARIABLES*/
$dsn = 'mysql:host=az1-ss20.a2hosting.com;dbname=danieljo_ResumeSiteDB';
$username = 'danieljo_root';
$password = "EgoIsUnlearned1!";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
//bold-origin-211113:us-central1:resume-site-db
try {
	$db = new PDO($dsn, $username, $password, $options);	
} catch (PDOException $e) {
    	$error_message = $e->getMessage();
    	include('errors/db_error_connect.php');
    	exit();
}
?>
