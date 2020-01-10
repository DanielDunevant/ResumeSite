<?php
$uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
$StringBlog = "blog";
$onBlogPage=0;
if(strpos($_SERVER['PHP_SELF'],$StringBlog)!== false){
	$onBlogPage=1;
}else{

}
if($onBlogPage==0):
 ?>
<div id="recentSidebar" class="RecentSidebar fixedLinks">
	<h3>Recent Blogs</h3>
	  <div class="tiles">
                        <b><? print $recent_blogs_new[0]['name']; ?></b>
                        <p><? print $recent_blogs_new[0]['dateWritten']; ?></p>
                        <a href="/blog/?action=view_blog-<? print $recent_blogs_new[0]['BlogID']; ?>">
                            <?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs_new[0]['image'])). '">'; ?>
											  </a>
                </div>
                <div class="tiles">
                        <b><? print $recent_blogs_new[1]['name']; ?></b>
                        <p><? print $recent_blogs_new[1]['dateWritten']; ?></p>
                        <a href="/blog/?action=view_blog-<? print $recent_blogs_new[1]['BlogID']; ?>">
                            <?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs_new[1]['image'])). '">'; ?>
                        </a>
                </div>
                <div class="tiles">
                        <b><? print $recent_blogs_new[2]['name']; ?></b>
                        <p><? print $recent_blogs_new[2]['dateWritten']; ?></p>
                        <a href="/blog/?action=view_blog-<? print $recent_blogs_new[2]['BlogID']; ?>">
                        <?php echo '<img class="blogPicker" src="data:image/jpeg;base64, ' .base64_encode(stripslashes($recent_blogs_new[2]['image'])). '">'; ?>
                        </a>
                </div>

</div>
<?php endif; ?>

<aside id="menu" style = "display:none" >
	<?php
		$account_url = '/account';
		$about_url = '/?action=about';
		$plans_url = '/?action=plans';
		$parralax_url = '/?action=parralax';
		$resumes_url = '/resume';
		$blogs_url =  '/blog';
		$logout_url = $account_url . '?action=logout';
	?>
	<!--<section class="container">-->
	<div class="row">
	<div class="col-md-4 typingText"><p id="title_DJD" class="title_Text">DJD</p><p id="title_DotIO" class="title_Text">.io&nbsp;</p><p id="title_Cursor" class="title_Text">|</p></div>
	<div class="col-md-8">
	<h2><a class='headerLinks' href="<?php echo '/'; ?>">Home</a></h2>
	<h2><a class='headerLinks' href="<?php echo $plans_url;?>">Plans</a></h2>
	<h2><a class='headerLinks' href="<?php echo $resumes_url ;?>">Resumes</a></h2>
	<h2><a class='headerLinks' href="<?php echo $blogs_url ;?>">Blogs</a></h2>
	<!-- display links for all categories-->
		<?php
		if (isset($_SESSION['user'])){
			print"<h2 ><a class ='headerLinks' href=\"$account_url\">My Account ( ".(isset($_SESSION['rank'])?"Admin":"Regular")." user )</a></h2>";
			print"<h2 ><a class = 'headerLinks button' href=\"$logout_url\">Logout</a></h2>";
		}else{
			print"<h2 ><a class='headerLinks button' href=\"$account_url\">Login/Register</a></h2>";
		}
	/*print"<li><a href=\"<?php echo $account_url; ?>\">Login/Register</a></li>";*/

		//require_once('model/blog_db.php');
		//$blogTypes = get_BlogTypes();
		//I think  that 2 mysql functions will simplify
		// the issues I'm facing. The arrays will be
		// combined after being called into this scope.
		// In so doing they'll be available for the/////
		// foreach statement that follows. Here's a link
		// to a similar issue https://stackoverflow.com/questions/4480803/two-arrays-in-foreach-loop
		/*foreach($blogTypes as $blog):
			$blogType = $blog['blogType'];
			//$url = $app_path . 'blog/?action=view_blog_type';
			$url = '/blog/?action=view_blog_type-'.$blogType;
						print("<li><a class='headerLinks' href = '$url'>$blogType</a></li>");
			endforeach;*/
		?>
		<?php

	 ?>
 </div>
</div>
<!--</section>-->
</aside>

<i class="menuClickStatic menuClick fas fa-bars" id="menuClick1"></i>
<i class="menuClickStatic fas fa-bars" id="menuClick2"></i>
<a id = "facebook_1" target="_blank" style="display:none" href = "https://www.facebook.com/daniel.dunevan"><i  class="fixedLinks fab fa-facebook-square"></i></a>
<a id ="rss_1" style ="display:none"><i  class="fixedLinks fas fa-rss-square"></i></a>
<a id ="gitHub_1" target="_blank" href="https://github.com/DanielDunevant" style ="display:none"><i class="fixedLinks fab fa-github-square"></i></a>
<a id = "facebook_2" target="_blank" href = "https://www.facebook.com/daniel.dunevan" ><i class="fixedLinks fab fa-facebook-square"></i></a>
<a id ="rss_2" ><i  class="fixedLinks fas fa-rss-square"></i></a>
<a id ="gitHub_2" target="_blank" href="https://github.com/DanielDunevant"><i class="fixedLinks fab fa-github-square"></i></a>
	<div class="wrapper">


<!--	<div class="section sectShadow  sky">
		<header>f
    			<h1 id ="title">Daniel John Dunevant Dot Io</h1>
		</header>
	</div>-->

<main>
<script src="/js/sidebar.js">
	</script>
	<section class="section vH60 parallax bg1">
	</section>
