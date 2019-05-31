<?php include 'view/header.php'; ?>
<?php include 'view/sidebar.php'; ?>
<main>
<div class ="rectangle">
<h1><?php print($action[1])?></h1>
    <h2><?php print($action[1]);?></h2>
    <?php 
	$blogs = get_Blogs_Of_Type($action[1]);
 	if (count($blogs) > 0) : ?>
	<ul>
		<div class = "rectangle">
<?php
	foreach($blogs as $blog) :
                $blog_id = $blog['BlogID'];
                $blog_written_date = $blog['dateWritten'];
		$blog_name = $blog['name'];
		$blog_mainText = $blog['mainText'];
		$blog_ImageFileName = $blog['imageFilename'];
		$blog_type = $blog['blogType'];
                $blog_view_url = '/blog' .
                       '?action=view_blog-' . $blog_id;
                ?>
                <li>
		    Blog #
			<a href="<?php echo $blog_view_url; ?>"><?php echo $blog_id; ?> View Blog</a> 
			edited on
                	<?php echo $blog_written_date."\n"; ?>
                    	<?php echo $blog_name."\n"; ?>
		    	<?php echo $blog_type."\n"; ?>
                </li>
            <?php endforeach; ?>
		</div>
        </ul>
   	<?php else: ?>
	<p>Looks like you need to  write some blogs!</p>
	<?php endif;?>
</div>
</main>
<?php include 'view/footer.php'; ?>
