<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php //var_dump($full_blog);?>
<main>
	<div class = "rectangle">
    		<h1><?php print($full_blog['blogType']);?></h1>
		<h2><?php print($full_blog['name']);?></h2>
		<h3><?php print($full_blog['dateWritten']);?></h3>
		<p><?php print($full_blog['mainText']);?> </p>
		<h3><?php print($full_blog['imageFilename']);?></h3>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($full_blog['image'])). '">'; ?>
	</div>
</main>
<?php include '../view/footer.php'; ?>
