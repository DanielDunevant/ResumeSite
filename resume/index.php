<?php

require_once('../util/main.php');
require_once('../model/user_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_resumes';
    }
}

switch ($action) {
    case 'view_resumes':
	include 'view_resumes.php';
        break;
    case 'prog_resume':
	include 'programming_resume.php';
        break;
    case 'ent_resume':
	include 'entertainment_resume.php';
        break;
    default:
	display_error("Unknown account action: " . $action);
        break;
}
 
?>
