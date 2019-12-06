<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php //var_dump($full_blog);?>
<?php
// Make function that creates strings of the 'mainText' column of x length.
// If shorter than x length then no ellipses
// If longer than x length then ellipses
$most_recent= $recent_blogs[0];
?>
	<div class = "row ">
		<div class="col-md-2 col-sm-2">&nbsp;</div>
		<div class = " col-md-6 col-sm-6">
    			<!--<h1><?php print($recent_blogs[0]['blogType']);?></h1>-->
			<h2><?php print($recent_blogs[0]['name']);?></h2>
			<h3><?php print($recent_blogs[0]['dateWritten']);?></h3>
			<a href="/blog/?action=view_blog-<? print $recent_blogs[0]['BlogID']; ?>">
				<?php echo '<img class = "displayBlogImg" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[0]['image'])). '">'; ?>
			</a>
		</div>
		<div class = "col-md-2 col-sm-2">
			<div class="tiles">
			<b><? print $recent_blogs[0]['name']; ?></b>
			<p><? print $recent_blogs[0]['dateWritten']; ?></p>
			<a href="/blog/?action=view_blog-<? print $recent_blogs[0]['BlogID']; ?>">
			<?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[0]['image'])). '">'; ?>
</a>
		</div>
		<div class="tiles">
			<b><? print $recent_blogs[1]['name']; ?></b>
			<p><? print $recent_blogs[1]['dateWritten']; ?></p>
			<a href="/blog/?action=view_blog-<? print $recent_blogs[1]['BlogID']; ?>">
			<?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[1]['image'])). '">'; ?>
			</a>
		</div>
		<div class="tiles">
			<b><? print $recent_blogs[2]['name']; ?></b>
			<p><? print $recent_blogs[2]['dateWritten']; ?></p>
			<a href="/blog/?action=view_blog-<? print $recent_blogs[2]['BlogID']; ?>">
			<?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs[2]['image'])). '">'; ?>
			</a>
		</div>
		</div>
		<div class="col-md-2 col-sm-2">&nbsp;</div>
	</div>
	<?php
	//Uncomment when Proper MySQL Statement is made
	$counter=0;
	foreach($blogs_3_of_each as $blog)
	{
		if($blog['name']!=null){
			if($counter == 0){
			print"<div class='row'><div class='col-md-2 col-sm-2'>&nbsp;</div><div class='col-md-8 col-sm-8'> <h2>".$blog['blogType']."</h2></div><div class='col-md-2 col-sm-2'>&nbsp;</div></div>";
			print"<div class='row'><div class='col-md-2 col-sm-2'>&nbsp;</div>";
			}
			print '<a href="/blog/?action=view_blog-'.$blog['BlogID'].'">';
			if($counter==0 ||$counter== 2){ print"<div class = 'col-md-3 col-sm-3 blogCard'>";}else{ print "<div class='col-md-2 col-sm-2 blogCard'>";}
	        	print"      <div class ='blogCardHead'><h3>".$blog['name']."</h3></div>
	        	        <div class ='blogCardFooter'>";
	        	echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">';
               		print' </div>  </div> </a>';


			$counter++;
			if($counter>=3){$counter=0; print"<div class='col-md-2 col-sm-2'>&nbsp;</div></div>";}else{ print"";}		}
	}

	?>
<?php include '../view/footer.php'; ?>
