<?php
// Get the document root
$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);
// Get the application path
$uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
$dirs = explode('/', $uri);
//$app_path = $_SERVER['DOCUMENT_ROOT'];
// Set the include path
set_include_path($_SERVER['DOCUMENT_ROOT']);
// Get common code
include('util/tags.php');
require_once('model/database.php');
// Define some common functions
function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_error.php';
    exit;
}
function display_error($error_message) {
    global $app_path;
    include 'errors/error.php';
    exit;
}
function redirect($url) {
session_write_close();
header("Location: " . $url);
exit;
}

// Start session to store user and cart data
session_start();
?>
