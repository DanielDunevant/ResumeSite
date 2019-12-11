<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<section class="section vH100 parallax bg1">
	<div class ="ContentBox">
                <h1 class="center"></h1>
    		<h1>Login</h1>

				<div id="errorText"></div>

    		<form action="/account/?action=login" method="post" id="login_form" novalidate ="novalidate">
       	 		<input type="hidden" name="action" value="login">

        		<label>E-Mail:</label>
        		<input id ="email" type="text" name="email"
        		       value="<?php echo htmlspecialchars($email); ?>" ><br>
            <div id="errorEmail"></div>
        		<label>Password:</label>
        		<input id="password" type="password" name="password" size="30"><br>
						<div id="errorPass"></div>
						<input type="hidden" name="action" value="login">
       			<input type="submit" class="button" value="Login">
        		<?php if (!empty($password_message)) : ?>
        		<span class="error"><?php echo htmlspecialchars($password_message); ?></span>
        		<?php endif; ?>
    		</form>
    		<h1>Register</h1>
    		<form action="." method="post">
    		    <input type="hidden" name="action" value="view_register">
    		    <input type="submit" class="button" value="Register">
    		</form>
	</div>
</section>
<script src ="/js/login.js">
</script>
<?php include '../view/footer.php'; ?>
