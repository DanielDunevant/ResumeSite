<?php include 'view/header.php'; ?>
<?php include 'view/sidebar.php'; ?>
<?php $blogLink="http://www.danieljohndunevant.io/blog/?action=view_blog-".$action[1];
      $blogLinkSharer="http%3A%2F%2Fwww.danieljohndunevant.io%2Fblog%2F%3Faction%3Dview_blog-".$action[1]."&amp;src=sdkpreparse"; ?>
<main>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3"></script>
	<div class = "rectangle">
    		<h1><?php print($full_blog['blogType']);?></h1>
		<h2><?php print($full_blog['name']);?></h2>
		<h3><?php print($full_blog['dateWritten']);?></h3>
		<p><?php print($full_blog['mainText']);?> </p>
		<h3><?php print($full_blog['imageFilename']);?></h3>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($full_blog['image'])). '">'; ?>
	</div>

	<div class="fb-share-button" data-href="<?php echo $blogLink; ?>https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small">
		<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
 		class="fb-xfbml-parse-ignore">Share</a>
	</div>
	
</main>
<?php include 'view/footer.php'; ?>
