<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php
if(isset($_POST["insert"]))
{
	if(file_get_contents($_FILES['image']['tmp_name'])){
		$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$_SESSION['image']=$file;
	}else{
		$_SESSION['image']=1;
	}
}
?>
<main>
    <div class = "rectangle">
    	<h1>Edit Blog</h1>
    	<form  method="post" enctype="multipart/form-data" id="add_blog_form">
	
	        <input type="hidden" name="action" value="view_edit_blog_2">
	        <h2>Blog Information</h2>
	
	
	        <label>Image:</label>
		<input type="file" name="image" id = "image" value="" size="30"/><span></span><br>
		<p>Image in database</p>
		<?php if (!isset($_SESSION['image'])) : ?>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($edit_blog['image'])). '">'; ?>
		<a href ="<?php echo $app_path.'blog?action=view_edit_blog_2-'.$action[1]; ?>">Next Form</a>
		<?php else: 
		
		echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($_SESSION['image'])). '">'; ?>
		<a href ="<?php echo $app_path.'blog?action=view_edit_blog_2-'.$action[1]; ?>">Next Form</a>
		
		<?php endif;?>
		<input type="submit" value="Create Blog" name = "insert" id = "insert" value="Insert">

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
