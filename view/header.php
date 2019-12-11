<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
 	<meta charset="UTF-8">
  	<meta name="keywords" content="Daniel John Dunevant, Resume Website, About, Learn more, Code, Programmer">
  	<meta name="author" content="Daniel John Dunevant">
	<?php
	$actual_link = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	if(!isset($onBlogPage)){
		include('model/blog_db_2.php');
	}
if(strpos($actual_link,'/blog/')== false){
	$recent_blogs_new=get_Recent_Blogs();
 /* $recent_blogs_new=get_Recent_New();*/
	if(strpos($actual_link,'/blog/') !== false){
		$action = filter_input(INPUT_GET, 'action');
		$action = explode("-",$action);
	}
	$blog_details=get_Blog_Detail($action[1]);
	$i=0;
	foreach($blog_details as $blog):
	if($i==0){
        print '<meta property="og:description" content="'.$blog['mainText'].'" > ';
        print '<meta property="og:title" content="'.$blog['name'].'" >';
        print '<meta property="og:url" content="'.$actual_link.'" >';
 	      print '<meta property="og:image" content="data:image/png;base64, ' .base64_encode(stripslashes($blog['image'])). '" /> ';
	}
	$i++;
	endforeach;
	}else{
  	print '<meta property="description" content="This is Daniel John Dunevant s Resume Website">';
   	print '<meta property="title" content="Test Title">';
	print '<meta property="og:image" content="https://images.pexels.com/photos/67636/rose-blue-flower-rose-blooms-67636.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" />';
	}
?>
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="600" />
<script src="/js/modernizr-custom.js"></script>
    	<title>My Resume Website</title>
    	<link rel="stylesheet" type="text/css"  href="../css/main.css?<?php echo time(); ?>">
    	<link rel="stylesheet" type="text/css"  href="../css/bootstrap.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
	      google_ad_client: "ca-pub-5377119777035709",
	      enable_page_level_ads: true
	  });
	 </script>

<!--FONTS-->
<link href="https://fonts.googleapis.com/css?family=Pacifico|Righteous&display=swap" rel="stylesheet">

</head>


<body>
