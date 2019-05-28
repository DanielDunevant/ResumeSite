<?php
//Revisit after MVC Implementation

function is_valid_user_email($email) {
    global $db;
    $query = '
        SELECT userID FROM users 
        WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function is_valid_user_login($email, $password) {
    global $db;
    $password = sha1($email . $password);
    $query = '
        SELECT * FROM users
        WHERE email = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function get_user($user_id) {
    global $db;
    $query = 'SELECT * FROM users WHERE userID = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}

function get_rank($user_id) {
    global $db;
    $query = 'SELECT userRank FROM users WHERE userID = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $rank = $statement->fetch();
    $statement->closeCursor();
    return $rank;
}

function get_rank_by_email($email) {
    global $db;
    $query = 'SELECT userRank FROM users WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $rank = $statement->fetch();
    $statement->closeCursor();
    return $rank;
}

function get_user_by_email($email) {
    global $db;
    $query = 'SELECT * FROM users WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}



function add_user($email, $username,
	$password_1, $rank) {
    global $db;
    $password = sha1($email . $password_1);
    $query = '
	INSERT INTO users (username, email, password, userRank)
	VALUES (:username, :email, :password, :rank)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':rank', $rank);
    $statement->execute();
    $user_id = $db->lastInsertId();
    $statement->closeCursor();
    return $user_id;
}

function update_user($userID,$email,$username, 
                      $password_1, $rank) {
    global $db;
    $query = '
        UPDATE users
        SET email = :email,
            username = :username,
            password = :password,
            userRank = :rank,
        WHERE userID = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':username', $first_name);
    $statement->bindValue(':password', $password_1);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $statement->closeCursor();

    if (!empty($password_1) && !empty($password_2)) {
        $password = sha1($email . $password_1);
        $query = '
            UPDATE users
            SET password = :password
            WHERE userID = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $password_1);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $statement->closeCursor();
    }
}
?>
