<?php
require_once('util/main.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
	$action = filter_input(INPUT_GET, 'action');
	if ($action == NULL) {
	      $action = 'home';
	}
}
switch ($action) {
	case 'home':
         	include 'home_view.php';
         	break;
    	case 'about':
        	include 'about.php';
        	break;
    	case 'plans':
        	include 'plans.php';
        	break;
    	case 'parralax':
        	include 'parralax.php';
        	break;
        default:
   		display_error("Unknown homepage action: " . $action);
   		break;
}
?>
