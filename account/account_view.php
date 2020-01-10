<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <div class = "rectangle">
    	<h1>My Account</h1>
    	<p><?php echo $username . ' (' . $email . ')'; ?></p>
      <?php
        $books = '/account/?action=Book_Add';
      ?>
      <a href ="<?php echo $books ?>">Books</a>
    		<?php if(isset($_SESSION['rank'])) : ?>
		<h2>Your Blogs</h2>
	    <?php
		$blogs=array();
    include ("model/DB_Boom.php");
		$blogTypes = selectRecords(true,["*"],["blogs"],[""],[""],"","");
		foreach($blogTypes as $blogType)
		{
			if($blogType!=NULL)
			{
		     		$blogs  = array_merge($blogs,selectRecords(true,["*"],["blogs"],[""],["bookType = ".$blogType['blogType']],"",""));
			}
		}
	 	if (count($blogs) > 0) :
	      print "<ul>";
    		foreach($blogs as $blog) :
          $blog_id = $blog['BlogID'];
          $blog_written_date = $blog['dateWritten'];
          $blog_name = $blog['name'];
          $blog_mainText = $blog['mainText'];
          $blog_ImageFileName = $blog['imageFilename'];
          $blog_type = $blog['blogType'];
          $blog_view_url = 'blog' .'?action=view_blog-' . $blog_id;
          $blog_edit_url = 'blog'.'?action=view_edit_blog_1-' . $blog_id;
          $blog_add_url = 'blog'.'?action=add_blog';
          $blog_delete_url = 'blog'.'?action=delete_blog-'.$blog_id;
          print"<li>";
          print"Blog #";
          print "<a href='/".$blog_view_url."'>".$blog_id. "View Blog</a>";
          print "edited on";
          print $blog_written_date."\n";
        	print $blog_name."\n";
			    print $blog_type."\n";
				  print '<a href ="/'.$blog_edit_url.'">Edit Blog</a>';
				  print '<a href ="/'.$blog_delete_url.'">Delete Blog</a>';
          print'</li>';
        endforeach;
        print'</ul>';
   	else:
		print'<p>Looks like you need to  write some blogs!</p>';
		endif;
		print'<a href ="/blog/?action=blog_test">Add Blog</a>';
    
	endif;
  ?>
	</div>
</main>
<?php include '../view/footer.php'; ?>
