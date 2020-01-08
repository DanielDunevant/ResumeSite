<?php
    include 'blog_class.php';
    $blog = new blog();
function get_BlogTypes() {
    global $db;
    $query = 'SELECT DISTINCT blogType FROM blogs
              ORDER BY blogType';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_Blog($blog_id) {
    global $db;
    $query = '
        SELECT *
        FROM blogs
        WHERE BlogID = :Blog_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Blog_id', $blog_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_Blogs() {
    global $db;
    $query = 'SELECT *
	      FROM blogs
	      ORDER BY BlogID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_Recent_Blogs_Of_Type($blogType) {
    global $db;
    $query = 'SELECT * FROM blogs
	            ORDER BY dateWritten
	            WHERE blogType = :Blog_Type
              ASC LIMIT 3';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Blog_Type', $blogType);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_Blog_Types() {
    global $db;
    $query = 'SELECT blogType
              FROM blogs
	      GROUP BY blogType
              ORDER BY BlogID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function get_Blogs_Of_Type($blogType) {
    global $db;
    $query = 'SELECT *
              FROM blogs
              WHERE blogType = :Blog_Type
              ORDER BY BlogID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Blog_Type', $blogType);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_Blogs_New() {
    global $db;
    $query = 'SELECT *
                FROM blogs
                ORDER by dateWritten DESC LIMIT 3';;
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}



function get_3_Blogs_Of_All_Types() {
	global $db;
	$types = $db
		->query('SELECT DISTINCT blogType from blogs ORDER BY blogType')
		->fetchAll(PDO::FETCH_COLUMN);
	$subqueries = array_map(function($type){
		return '(SELECT * FROM blogs WHERE blogType = ? ORDER by dateWritten DESC LIMIT 3)';
	}, $types);
	$query = implode(' UNION ALL ', $subqueries) . ' ORDER BY blogType, dateWritten DESC';
	       try {
	        $statement = $db->prepare($query);
	        $statement->execute($types);
	        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	        $statement->closeCursor();
	        return $result;
	       } catch (PDOException $e) {
	        $error_message = $e->getMessage();
	        display_db_error($error_message);
	       }
}
function get_Blogs_Info() {
    global $db;
    $query = 'SELECT *
	      FROM blogs
	      ORDER BY BlogID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function add_Image($image){
	global $db;
	$query= "INSERT INTO blogs
			(image)
		 VALUES
			(:Blog_Image)";
	try{
		$statement = $db->prepare($query);
		$statement->bindValue(':Blog_Image',$image);
        	$statement->execute();
        	$statement->closeCursor();
        	// Get the last product ID that was automatically generated
        	$blog_id = $db->lastInsertId();
        	return $blog_id;
   	} catch (PDOException $e) {
        	$error_message = $e->getMessage();
        	display_db_error($error_message);
    	}
}
//This system would put the image in the database then keep a session
// of the id of the image. This is used to select the proper  record and
// input the remaining data.
//    $query = 'INSERT INTO blogs
//                 (name, mainText, dateWritten, imageFilename, blogType )
//              VALUES
//                 (:Blog_Name, :Blog_MainText, :Blog_DateWritten, :Blog_ImageFilename,  :Blog_Type)
//       	      WHERE BlogID = :Blog_id';
//function add_Blog($name, $mainText ,$blog_ID, $imageFilename, $type) {
function add_Blog($name, $mainText ,$image, $imageFilename, $type) {
    global $db;
    global $blog;
    //include '../model/blog_class.php';
    //$blog= new blog();
    $BlogID= $blog->getBlogID();
    $date = date("Y-m-d");
    $query = 'INSERT INTO blogs
                 (BlogID, name, mainText, dateWritten,image, imageFilename, blogType )
              VALUES
                 (:Blog_ID,:Blog_Name, :Blog_MainText, :Blog_DateWritten,:Blog_Image, :Blog_ImageFilename,  :Blog_Type)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Blog_ID', $BlogID);
        $statement->bindValue(':Blog_Name', $name);
        $statement->bindValue(':Blog_MainText', $mainText);
        $statement->bindValue(':Blog_DateWritten', $date);
        $statement->bindValue(':Blog_ImageFilename', $imageFilename);
        $statement->bindValue(':Blog_Image', $_SESSION['image']);
        $statement->bindValue(':Blog_Type', $type);
        $statement->execute();
        $statement->closeCursor();
        // Get the last product ID that was automatically generated
 // Get the last product ID that was automaticallyp generated
	unset($blog);
        return $BlogID;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_Blog_Components($blogID, $chronos, $compType, $compTexts, $compImages) {
    global $db;
    global $blog;
    //include '../model/blog_class.php';
    //$blog2= new blog();
    $query = 'INSERT INTO blogs
                 (BlogID, chronosID, componentID, mainText, image)
              VALUES
                 (:Blog_ID, :Blog_ChronosID, :Blog_ComponentID, :Blog_CompTexts, :Blog_CompImages)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Blog_ID', $blogID);
        $statement->bindValue(':Blog_ChronosID', $chronos);
        $statement->bindValue(':Blog_ComponentID', $compType);
        $statement->bindValue(':Blog_CompTexts', $compTexts);
        $statement->bindValue(':Blog_CompImages', $compImages);
        $statement->execute();
        $statement->closeCursor();
        // Get the last product ID that was automatically generated
	unset($blog);
        return $blog_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function update_Blog($Blog_ID, $name, $imageFilename, $mainText, $image, $type) {
	global $db;
	//1. If $image variable is empty then use $currentImage Var else use new $image Var
	if($image != 1){
		$query = 'UPDATE blogs
			  SET name = :Blog_Name , imageFilename = :Blog_ImageFilename ,
			  mainText = :Blog_MainText, image = :Blog_Image , blogType = :Blog_Type
			  WHERE BlogID = :Blog_ID';
    		try {
    		    $statement = $db->prepare($query);
    		    $statement->bindValue(':Blog_Name', $name);
    		    $statement->bindValue(':Blog_ImageFilename', $imageFilename);
    		    $statement->bindValue(':Blog_MainText', $mainText);
    		    $statement->bindValue(':Blog_Image', $image);
    		    $statement->bindValue(':Blog_Type', $type);
    		    $statement->bindValue(':Blog_ID', $Blog_ID);
    		    $statement->execute();
    		    $statement->closeCursor();
    		} catch (PDOException $e) {
    		    $error_message = $e->getMessage();
    		    display_db_error($error_message);
    		}
	}
}
function delete_Blog($blog_id) {
    global $db;
    $query = 'DELETE FROM blogs WHERE BlogID = :Blog_ID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':Blog_ID', $blog_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>
