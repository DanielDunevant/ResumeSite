<?
function get_Blog_Detail($blog_id) {
    global $db;
    $query = '
        SELECT *
        FROM blogs
        WHERE BlogID = :Blog_id
	';

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
function get_Recent_Blogs() {
    global $db;
    $query = 'SELECT *
              FROM blogs
              WHERE name IS NOT NULL
              ORDER BY dateWritten
              ASC LIMIT 3';
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
