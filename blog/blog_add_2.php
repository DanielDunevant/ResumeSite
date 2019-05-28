<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <div class = "rectangle">
    	<h1>Add Blog</h1>
    	<form action="." method="post" id="add_blog_form">
	
       	 	<h2>Blog Information</h2>
        	<input type="hidden" name="action" value="add_blog">

        	<label>Name:</label>
        	<input type="text" name="name"
        	       value="" >
        	<?php echo $fields->getField('name')->getHTML(); ?><br>
	
	        <label>Blog:</label>
	        <input type="text" name="mainText" >
	        <?php echo $fields->getField('mainText')->getHTML(); ?>
	        <span class="error">  </span><br>
	
		<label>Blog Type:</label>
		<select name="blogType">
			<option value="Philosophy">Philosophy</option>
			<option value="Project">Project</option>
			<option value="WebDev">Web Development</option>
			<option value="CompSci">Computer Science</option>
			<option value="Writing">Writing</option>
		</select><br>
	        <?php echo $fields->getField('blogType')->getHTML(); ?>
	        <label>Image Filename:</label>
	        <input type="text" name="imageFilename" size="30"><span><span/><br>
        	<?php echo $fields->getField('imageFilename')->getHTML(); ?>
	
	
	       	<input type="submit" value="Create Blog" name = "add_blog" id = "insert" onclick='this.form.action="?action=add_blog"' /><br>

    	</form>
    </div>
</main>
<?php include '../view/footer.php'; ?>:
