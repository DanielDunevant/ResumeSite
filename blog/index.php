<?php
require_once('../util/main.php');
//require_once('util/secure_connphp');
require_once('model/blog_db.php');
//require_once('model/address_db.php');
//require_once('model/order_db.php')ohsd;
//require_once('model/product_db.php');
require_once('model/fields.php');
require_once('model/validate.php');
$action = filter_input(INPUT_GET, 'action');
$action = explode("-",$action);
if ($action[0] == NULL) {
    $action[0] = filter_input(INPUT_GET, 'action');
    if ($action[0] == NULL) {        
        $action[0] = 'rss_blog';
        }
}
// Set up all possible fields to validate
$validate = new Validate();
$fields = $validate->getFields();
// for the Registration page and other pages
$fields->addField('name', 'Must be valid email.');
$fields->addField('mainText');
$fields->addField('imageFilename');
$fields->addField('blogType');
// for the Login page
// for the Edit Address page
switch ($action[0]) {
    	case 'rss_blog':

		$recent_blogs = get_Recent_Blogs();
		$blogs_3_of_each = get_3_Blogs_Of_All_Types();
		//Use this template when adding more blog types
		//$_blogs = get_Blogs_Of_Type("");
            	include 'blog/blog_rss.php';
	    	break;
    	case 'view_add_blog':
	    	include 'blog/blog_add_1.php';
	   	break;	
    case 'view_add_blog_2':
            include 'blog/blog_add_2.php';
	    break;	
    case 'add_blog':
        // Store user data in local variables
        $name = filter_input(INPUT_POST, 'name');
        $mainText = filter_input(INPUT_POST, 'mainText');
        $imageFilename = filter_input(INPUT_POST, 'imageFilename');
        $blogType = filter_input(INPUT_POST, 'blogType');
        // Validate user data       
        $validate->text('name', $name,true,3,50);
        $validate->text('mainText', $mainText,true,3, 10000);
        $validate->text('imageFilename', $imageFilename, true, 6, 30);        
        // If validation errors, redisplay Register page and exit controller
        if ($fields->hasErrors()) {
            include 'blog/blog_add.php';
            break;
        }
        // Add the user data to the database
	$user_id = add_blog($name, $mainText, $_SESSION['image'], $imageFilename, $blogType);
	unset($_SESSION['image']);
        redirect('..');
        break;
    case 'view_blog':
	$full_blog= get_Blog($action[1]);
	include 'blog_view.php';
        break;
    case 'view_blog_type':
        unset($_SESSION['user']);
	include('blog_view_type.php');
	//To get here we simply set the action for the blog to Philosophy. 
	//From there it will call the philosophy.php. That will just call a 
	//list of the  blogs that are in that category. The user will click 
	//on one of those items listed. In doing so they set the action to view_blog 
	//and send the specific blog ID of the  link with it. At that  point 
	//the get_BLog Function can be called in the model in blog_db.php. 
	//This serves the required  information for blog_view.php.
        break;
    case 'view_edit_blog_1':
	$edit_blog=get_Blog($action[1]);
	include 'blog_edit_1.php';
        break;
    case 'view_edit_blog_2':
	$edit_blog=get_Blog($action[1]);
	include 'blog_edit_2.php';
        break;
    case 'edit_blog':
        // Store user data in local variables
	$edit_blog=get_Blog($action[1]);
        $name = filter_input(INPUT_POST, 'name');
        $mainText = filter_input(INPUT_POST, 'mainText');
        $imageFilename = filter_input(INPUT_POST, 'imageFilename');
        $blogType = filter_input(INPUT_POST, 'blogType');

	// Validate user data     
        $validate->text('name', $name,true,3,50);
        $validate->text('mainText', $mainText,true,3, 10000);
        $validate->text('imageFilename', $imageFilename, true, 6, 30);        
        // If validation errors, redisplay Register page and exit controller
        if ($fields->hasErrors()) {
            include 'blog/blog_edit_1.php';
            break;
        }
        // Add the user data to the database
        update_Blog($action[1],$name,$imageFilename, $mainText, $_SESSION['image'], $blogType);
	unset($_SESSION['image']);
	redirect('..');
        break;
    case 'delete_blog':
	delete_Blog($action[1]);
	redirect('..');
        break;
    default:
	display_error("Unknown blog action: " . $action[0]);
        break;
}
?>
