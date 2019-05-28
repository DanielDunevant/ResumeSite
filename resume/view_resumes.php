<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php 
	$programming_url = '/resume/?action=prog_resume';
	$entertainment_url = '/resume/?action=ent_resume';
?>
<main>
	<h1>Resumes</h1>
	<a class = "inviso-link" href ="<?php echo $programming_url; ?>">
		<div class = "rectangle">
			<h2>Programming Resume</h2>
			<p>This resume is  to showcase my programming abilities through the 
			usual resume type things. If you're interested in hiring me for
			a programming position click here.</p>
		</div>
	</a>
	<a class = "inviso-link" href ="<?php echo $entertainment_url; ?>">
		<div class = "rectangle">
			<h2>Entertainment Resume</h2>
			<p>This is a resume for the hobbies. Hobbies as in things I enjoy doing
			 but  don't necessarily see them as something I want to do as a career.
			 Though if I happen to get an offer that is decent then who knows.</p>
		</div>
	</a>
</main>
<?php include '../view/footer.php'; ?>
