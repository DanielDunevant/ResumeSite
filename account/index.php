<?php

require_once('../util/main.php');
//require_once('util/secure_connphp');
require_once('../model/user_db.php');
//require_once('model/address_db.php');
//require_once('model/order_db.php');
//require_once('model/product_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        if (isset($_SESSION['user'])) {
            $action = 'view_account';
        }
    }
}

// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();
// for the Registration page and other pages
$fields->addField('email', 'Must be valid email.');
$fields->addField('password_1');
$fields->addField('password_2');
$fields->addField('username');
$fields->addField('secret_pass');
// for the Login page
$fields->addField('password');

// for the Edit Address page

switch ($action) {
    case 'view_register':
        // Clear user data
        $email = '';
        $user_name = '';
        
	include 'account_register.php';
        break;
    case 'register':
        // Store user data in local variables
        $email = filter_input(INPUT_POST, 'email');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        $username = filter_input(INPUT_POST, 'username');
        
        // Validate user data       
        $validate->email('email', $email);
        $validate->text('password_1', $password_1, true, 6, 30);
        $validate->text('password_2', $password_2, true, 6, 30);        
        $validate->text('username', $username);

	//Other Vars
	$secret_pass = filter_input(INPUT_POST,'secret_pass');
	$adminUser = 0;

        // If validation errors, redisplay Register page and exit controller
        if ($fields->hasErrors()) {
            include 'account/account_register.php';
            break;
        }

        // If passwords don't match, redisplay Register page and exit controller
        if ($password_1 != $password_2) {
            $password_message = 'Passwords do not match.';
            include 'account/account_register.php';
            break;
        }

	if($secret_pass == "secret_pass"){
		$adminUser = 1;
	}

        // Validate the data for the user
        if (is_valid_user_email($email)) {
            display_error('The e-mail address ' . $email . ' is already in use.');
        }
        // Add the user data to the database
        $user_id = add_user($email, $username,
                                    $password_1, $adminUser);
        // Store user data in session
	$_SESSION['user'] = get_user($user_id);
	$_SESSION['rank'] = get_rank($user_id);

        redirect('..');
        break;
    case 'view_login':
        // Clear login data
        $email = '';
        $password = '';
        $password_message = '';
        
	include 'account_login_register.php';
        break;
    case 'login':
	
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        // Validate user data
        $validate->email('email', $email);
        $validate->text('password', $password, true, 6, 30);        

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account/account_login_register.php';
            break;
        }
        
        // Check email and password in database
        if (is_valid_user_login($email, $password)) {
            $_SESSION['user'] = get_user_by_email($email);
	    $_SESSION['rank'] = get_rank_by_email($email);
        } else {
            $password_message = 'Login failed. Invalid email or password.';
            include 'account/account_login_register.php';
            break;
        }
	include 'account/account_view.php';
        break;
    case 'view_account':
        $user_name = $_SESSION['user']['username'];
        $email = $_SESSION['user']['email'];        
	include 'account_view.php';
        break;
    case 'view_account_edit':
        $first_name = $_SESSION['user']['firstName'];
        $last_name = $_SESSION['user']['lastName'];
        $password_message = '';        
	include 'account_edit.php';
        break;
    case 'update_account':
        // Get the user data
        $user_id = $_SESSION['user']['customerID'];
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        $password_message = '';

        // Get the old data for the user
        $old_user = get_customer($user_id);

        // Validate user data
        $validate->email('email', $email);
        $validate->text('password_1', $password_1, false, 6, 30);
        $validate->text('password_2', $password_2, false, 6, 30);        
        $validate->text('first_name', $first_name);
        $validate->text('last_name', $last_name);        
        
        // Check email change and display message if necessary
        if ($email != $old_user['emailAddress']) {
            display_error('You can\'t change the email address for an account.');
        }

        // If validation errors, redisplay Login page and exit controller
        if ($fields->hasErrors()) {
            include 'account/account_edit.php';
            break;
        }
        
        // Only validate the passwords if they are NOT empty
        if (!empty($password_1) && !empty($password_2)) {            
            if ($password_1 !== $password_2) {
                $password_message = 'Passwords do not match.';
                include 'account/account_edit.php';
                break;
            }
        }

        // Update the user data
        update_user($user_id, $email, $first_name, $last_name,
            $password_1, $password_2);

        // Set the new user data in the session
        $_SESSION['user'] = get_user($user_id);
        $_SESSION['rank'] = get_rank($user_id);

	redirect('..');
        break;
    case 'logout':
	
        unset($_SESSION['user']);
        unset($_SESSION['rank']);
	redirect('..');
        break;
    default:
	display_error("Unknown account action: " . $action);
        break;
}
 
?>
