<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php
	$programming_url = '/resume/?action=prog_resume';
	$entertainment_url = '/resume/?action=ent_resume';
?>
<div class="section sectShadowUpper angleDiv_left sky">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<h1>Resumes</h1>
			<div class="rectangleContainer">
				<div class="row">
					<div class="col-md-6">
						<a class = "inviso-link" href ="<?php echo $programming_url; ?>">
							<h2>Programming Resume</h2>
							<p>This resume is  to showcase my programming abilities through the
								usual resume type things. If you're interested in hiring me for
								a programming position click here.</p>
						</a>
				</div>
				<div class = "col-md-6">
					<a class = "inviso-link" href ="<?php echo $entertainment_url; ?>">
						<h2>Entertainment Resume</h2>
						<p>This is a resume for the hobbies. Hobbies as in things I enjoy doing
					 but  don't necessarily see them as something I want to do as a career.
					 Though if I happen to get an offer that is decent then who knows.</p>
				 	</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php include '../view/footer.php'; ?>
