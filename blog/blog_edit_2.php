<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
	<div class ="rectangle">
    		<form action="." method="post" id="edit_blog_form">
    			<h1>Edit Blog</h1>
        		<h2>Blog Information</h2>
        		<input type="hidden" name="action" value="edit_blog"/>
        		<label>Name:</label>
        		<input type="text" name="name" value=" <?php echo $edit_blog['name']; ?> " /><br>
        		<label>Blog:</label>
			<input type="text" name="mainText" value="<?php echo $edit_blog['mainText']; ?>" /><br>
			<label>Blog Type:</label>
			<select name="blogType">
				<?php $blog_types=array("Philosophy","Project","Web Development","Computer Science","Writing");
				foreach($blog_types as $blog_type) {
					if($blog_type == $edit_blog['blogType']) { 
						print("<option name=\"blogType\" label=".$blog_type." selected=\"selected\">".$blog_type."</option>");
				 	} else {	
						print("<option name=\"blogType\" label=".$blog_type.">".$blog_type."</option>");
				       } 
				} ?>
			</select><br>
        		<?php echo $fields->getField('blogType')->getHTML(); ?>
			<label>Blog Image Name:</label>
			<input type="text" name="imageFilename" size="30" value=" <?php echo $edit_blog['imageFilename']; ?> " /><br>
        		<?php echo $fields->getField('imageFilename')->getHTML(); ?>
        		<input type="submit" value="Edit Blog" name = "edit_blog" id = "insert" onclick='this.form.action="?action=edit_blog-<?php echo $action[1]; ?>"' /><br>
    		</form>	
	</div>
</main>
<?php include '../view/footer.php'; ?>
