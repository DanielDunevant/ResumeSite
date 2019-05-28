<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php 
if (!isset($password_message)) { $password_message = ''; } 
?>
<main>
    <h1>Register</h1>
    <div class = "rectangle">
    <form action="." method="post" id="register_form">

        <h2>User Information</h2>
        <input type="hidden" name="action" value="register">

        <label>E-Mail:</label>
        <input type="text" name="email"
               value="<?php echo htmlspecialchars($email); ?>" size="30">
        <?php echo $fields->getField('email')->getHTML(); ?><br>

        <label>Password:</label>
        <input type="password" name="password_1" size="30">
        <?php echo $fields->getField('password_1')->getHTML(); ?>
        <span class="error"><?php echo htmlspecialchars($password_message); ?></span><br>

        <label>Retype Password:</label>
        <input type="password" name="password_2" size="30">
        <?php echo $fields->getField('password_2')->getHTML(); ?><br>

        <label>Username:</label>
        <input type="text" name="username"
               value="<?php echo htmlspecialchars($username); ?>" 
               size="30">
        <?php echo $fields->getField('username')->getHTML(); ?><br>

        <label>Secret Pass:</label>
        <input type="text" name="secret_pass"
               value=""
               size="30">
        <?php echo $fields->getField('secret_pass')->getHTML(); ?><br>

        <input type="submit" value="Register">
    </form>
    </div>
</main>
<?php include '../view/footer.php'; ?>
