<?php

function get_books() {
    global $db;
    $query = 'SELECT *
	      FROM books
	      ORDER BY status DESC,
		       bookType ASC;';

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

?>
