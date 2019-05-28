<aside id="menu" class="center">
	<?php
		$account_url = '/account';
		$about_url = '/?action=about';
		$plans_url = '/?action=plans';
		$parralax_url = '/?action=parralax';
		$resumes_url = '/resume';
		$blogs_url =  '/blog';
		$logout_url = $account_url . '?action=logout';
		if (isset($_SESSION['user'])){ 
			print"<h2 class ='headerLinks'><a href=\"$account_url\">My Account ( ".(isset($_SESSION['rank'])?"Admin":"Regular")." user )</a></h2>";
			print"<h2 class = 'headerLinks'><a href=\"$logout_url\">Logout</a></h2>";
		}else{
		print"<h2 class='headerLinks'><a href=\"$account_url\">Login/Register</a></h2>";
		}
	 ?>
	<li>
		<a class='headerLinks' href="<?php echo ''; ?>">Home</a>
	</li>
	<h2><a class='headerLinks' href="<?php echo $about_url ;?>">About</a></h2>
	<h2><a class='headerLinks' href="<?php echo $plans_url;?>">Plans</a></h2>
	1<h2><a class='headerLinks' href="<?php echo $parralax_url;?>">Parralax</a></h2>
	<h2><a class='headerLinks' href="<?php echo $resumes_url ;?>">Resumes</a></h2>
	<h2><a class='headerLinks' href="<?php echo $blogs_url ;?>">Blogs</a></h2>
	<ul>
	<!-- display links for all categories--> 
		<?php
		
	/*print"<li><a href=\"<?php echo $account_url; ?>\">Login/Register</a></li>";*/

		require_once('model/database.php');
		require_once('model/blog_db.php');
		$blogTypes = get_BlogTypes();
		//I think  that 2 mysql functions will simplify
		// the issues I'm facing. The arrays will be
		// combined after being called into this scope.
		// In so doing they'll be available for the/////
		// foreach statement that follows. Here's a link 
		// to a similar issue https://stackoverflow.com/questions/4480803/two-arrays-in-foreach-loop 
		foreach($blogTypes as $blog):
			$blogType = $blog['blogType'];
			//$url = $app_path . 'blog/?action=view_blog_type';
			$url = 'blog/?action=view_blog_type-'.$blogType;
		       	print("<a class='headerLinks' href = '$url'>$blogType</a>");
		?>
		<?php
		endforeach; ?>
</aside>

<i onclick="hideMe()" class="menuClickStatic menuClick fas fa-bars" id="menuClick1"></i>
<i onclick="hideMe()" class="menuClickStatic fas fa-bars" id="menuClick2"></i>

<script>
function hideMe() {
  var x = document.getElementById("menu");
  var y = document.getElementById("menuClick1");
  var z = document.getElementById("menuClick2");
  if (y.style.display === "none") {
   // x.setAttribute("id","menu");
    x.classList.remove("menuDown");	
    x.classList.add("menuUp");
   //x.style.display = "none";
    y.style.display = "block";
    z.style.display = "none";
  } else {
   // x.setAttribute("id","menuAni");
    x.classList.remove("menuUp");	
    x.classList.add("menuDown");
    x.style.display = "block";
    y.style.display = "none";
    z.style.display = "block";
  }
console.log("Element:Menu");
console.log(x.style.display);
console.log("Element:Click1");
console.log(y.style.display);
console.log("Element:Click2");
console.log(z.style.display);
}
</script>
