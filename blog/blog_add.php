<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php 
if (!isset($password_message)) { $password_message = '';} 
if(isset($_POST["insert"]))
{
	$file = addslashes(file_get_contents($_FILE['image']['tmp_name']));
	$_SESSION['image']=$file;
	redirect('..');
}
?>
<main>
    <div class = "rectangle">
    	<h1>Add Blog</h1>
    	<form action="." method="post" id="add_blog_form">
	
       	 	<h2>Blog Information</h2>
        	<input type="hidden" name="action" value="add_blog">

        	<label>Name:</label>
        	<input type="text" name="name"
        	       value="" >
        	<?php echo $fields->getField('name')->getHTML(); ?><br>
	
	        <label>Blog:</label>
	        <input type="text" name="mainText" >
       	 	<?php echo $fields->getField('mainText')->getHTML(); ?>
       	 	<span class="error">  </span><br>

		<label>Blog Type:</label>
		<select name="blogType">
			<option value="Philosophy">Philosophy</option>
			<option value="Project">Project</option>
			<option value="WebDev">Web Development</option>
			<option value="CompSci">Computer Science</option>
			<option value="Writing">Writing</option>
		</select><br>
        	<?php echo $fields->getField('blogType')->getHTML(); ?>
        	<label>Image Name:</label>
        	<input type="text" name="imageFilename" size="30"><span><span/><br>
        	<?php echo $fields->getField('imageFilename')->getHTML(); ?>
	
	        <label>Image:</label>
	        <input type="file" name="image" id = "image" value="" size="30"/><span></span><br>
	        <input type="submit" value="Create Blog" name = "add_blog" id = "insert">

	</form>
    </div>
</main>
<script>
$(document).ready(function(){
	$('#insert').click(function(){}
		var image_name = $('#image').val();
		if(image_name==''){
			alert("Please Select Image");
			return false;
		}else{
			var extension = $('#image').val().split('.').pop().toLowerCase();
			if(jQuerey.inArray(extension,['gif','png','jpg','jpeg'])=-1){
				alert('Invalid Image File');
				$('#image').val('');
				return false;
			}
		}
	)});
</script>
<?php include '../view/footer.php'; ?>:
