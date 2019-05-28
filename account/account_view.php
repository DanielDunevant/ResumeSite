<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <div class = "rectangle">
    	<h1>My Account</h1>
    	<p><?php echo $username . ' (' . $email . ')'; ?></p>
    		<?php if(isset($_SESSION['rank'])) : ?>
		<h2>Your Blogs</h2>
	    <?php 
		$blogs = get_Blogs();
	 	if (count($blogs) > 0) : ?>
	        <ul>
	<?php
		foreach($blogs as $blog) :
	                $blog_id = $blog['BlogID'];
	                $blog_written_date = $blog['dateWritten'];
			$blog_name = $blog['name'];
			$blog_mainText = $blog['mainText'];
			$blog_ImageFileName = $blog['imageFilename'];
			$blog_type = $blog['blogType'];
	                $blog_view_url = $app_path . 'blog' .
	                       '?action=view_blog-' . $blog_id;
			$blog_edit_url = $app_path.'blog'.
				'?action=view_edit_blog_1-' . $blog_id;
			$blog_add_url = $app_path.'blog'.
				'?action=add_blog';
			$blog_delete_url = $app_path.'blog'.
				'?action=delete_blog-'.$blog_id;
       	         ?>
       	         <li>
			    Blog #
				<?php echo "<a href=\"<?php echo $blog_view_url; ?>\"><?php echo $blog_id; ?> View Blog</a>"; ?> 
				edited on
        	        	<?php echo $blog_written_date."\n"; ?>
        	            	<?php echo $blog_name."\n"; ?>
			    	<?php echo $blog_type."\n"; ?>
				<a href ="<?php echo $blog_edit_url ?>">Edit Blog</a>
				<a href ="<?php echo $blog_delete_url ?>">Delete Blog</a>
               	 </li>
            	<?php endforeach; ?>
        	</ul>
   		<?php else: ?>
		<p>Looks like you need to  write some blogs!</p>
		<?php endif;?>
		<a href ="<?php echo $app_path.'blog?action=view_add_blog' ?>">Add Blog</a>
		<?php endif;?>
	</div>
</main>
<?php include '../view/footer.php'; ?>
