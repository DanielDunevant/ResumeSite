<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php //var_dump($full_blog);?>
<?php
// Make function that creates strings of the 'mainText' column of x length. 
// If shorter than x length then no ellipses
// If longer than x length then ellipses
?>
<main>
	<h1>Blog Home Page! Sup ;)</h1>
	<div class = "row recentBlogsBox">
		<div class = "displayBlogStub col-md-6 rectangle center">
    			<h1><?php print($recent_blogs[0]['blogType']);?></h1>
			<h2><?php print($recent_blogs[0]['name']);?></h2>
			<h3><?php print($recent_blogs[0]['dateWritten']);?></h3>
			<div class="div">
				<?php echo '<img class = "displayBlogImg" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[0]['image'])). '">'; ?>
			</div>
		</div>
		<div class = "displayBlogList col-md-3 center">
			<?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[0]['image'])). '">'; ?>
			<?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[1]['image'])). '">'; ?>
			<?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[2]['image'])). '">'; ?>
		</div>
	</div>
	<?php
	//Uncomment when Proper MySQL Statement is made
	$counter=0;
	foreach($blogs_3_of_each as $blog)
	{
		if($blog['name']==null){
			if($counter == 0){
				print"<h2>".$blog['blogType']."</h2>";
			}
			print"<div class = 'col-sm-4 blogCard'>
	        	      <div class ='blogCardHead'><h3>".$blog[$counter]['name']."</h3></div>
	        	        <div class ='blogCardFooter'>";
	        	echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog[$counter]['image'])). '">'; 
               		print' </div>
        </div>';	
	
			$counter++;
			//THIS TERNARY STATEMENT MAY HAVE AN ERROR;
			($counter>=2?$counter=0: print"");
		}
	}
	
	?>
</main>
<?php include '../view/footer.php'; ?>
