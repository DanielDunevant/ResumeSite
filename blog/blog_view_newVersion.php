<?php include 'view/header.php'; ?>
<?php include 'view/sidebar.php'; ?>
<?php $blogLink="http://www.danieljohndunevant.io/blog/?action=view_blog-".$action[1];
      $blogLinkSharer="http%3A%2F%2Fwww.danieljohndunevant.io%2Fblog%2F%3Faction%3Dview_blog-".$action[1]."&amp;src=sdkpreparse"; ?>
	<div class="row">
	<div class="col-md-2">&nbsp;</div>
	<div class="col-md-8">
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3"></script>
	<?php
	$i=0;
	//New blog outputter based on the char #
	// Once char limit is reached the image is inserted
	// The image will be loaded first into a div on first iteration
        // not waiting for any char length to be reached.
	$blogText="";
/*	foreach($full_blog as $blog):
		echo $blog['mainText']; 
		if($i>0){
			$blogText=$blogText.$blog['mainText'];
		}
		$i++;
	endforeach;
	$btLength= strlen($blogText);
	$btArray = array();
	for ($i=0; $i<$btLength; $i++) {
    		$btArray[$i] = $blogText[$i];
	}*/
	print "<div class='blogPost'>";
	$i=0;
	foreach($full_blog as $blog):
		if($i==0){
		echo "<h1>".$blog["blogType"]."</h1>";
		print "<h2>".$blog['name']."</h2>";
		print "<h3>Date Written:". $blog['dateWritten']."</h3>";
		print "<p>". $blog['mainText']." </p>";
	//	print "<h3>".$blog['imageFilename']."</h3>";
		echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">'; 
		}
		else{
			/*foreach($btArray as $blogChar)
			{echo $blogChar;}*/
			switch($blog['componentID'])
			{
				case 1:
 				print"<div class='row' ><p class='blogTxt'>";
				print' <img class="blogImg" style="width:50%;float:left;" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">';
				print $blog['mainText']."  </p></div>";
				/*print"<div class='row'><div class = 'blogTxt col-md-6'>".$blog['mainText']." hgguossd goiffh  ihsdoh ff jgsoudg fo ugapidg fi sh doufgy ou sg df gsdg f sh hdlfg lsdgh fljhh sljdh flsh dljhf hljshdh f lj hsldjfh  lshd dfl hsldh flsh dfkh slkdh f lkshdlkjf hlskjdh </div>";
				print'<div class = "col-md-5">
				<img class="blogImg" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '"></div></div> ';*/
				break;
				break;
				case 2:
 				print"<div class='row' ><p class='blogTxt'>";
				print' <img class="blogImg" style="width:50%;float:right;" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">';
				print $blog['mainText']." </p></div>";
				break;
				case 3:
				print"<div class='row'><div class = 'blogTxt col-md-12'>".$blog['mainText']."</div></div>";
				break;
				case 4:
				print'<div class="row"><div class="col-md-12">
				<img class="blogImg" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '"></div></div>';
				break;
			}
		}
	$i++;
endforeach;
		?> 
	<div class="fb-share-button" data-href="<?php echo $blogLink; ?>https://developers.facebook.com/docs/plugins/" data-layout="button" data-size="small">
		<a class="fb-share-button" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
 		class="fb-xfbml-parse-ignore">Share</a></div>
	
	</div> <!--END BLOG COLUMN-->
	<div class="col-md-2">&nbsp;</div>
	</div><!--END BLOG ROW-->
	</div>
<?php include 'view/footer.php'; ?>
