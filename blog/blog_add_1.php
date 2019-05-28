<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php
if(isset($_POST["insert"]))
{
	$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$_SESSION['image']=$file;
}
?>
<main>
    <div class = "rectangle">
    	<h1>Add Blog</h1>
    	<form  method="post" enctype="multipart/form-data" id="add_blog_form">
	
	        <h2>Blog Information</h2>
	        <!--<input type="hidden" name="action" value="view_add_blog_2">-->
	
	
	        <label>Image:</label>
	        <input type="file" name="image" id = "image" value="" size="30"/><span></span><br>
	
		<input type="submit" value="Create Blog" name = "insert" id = "insert" value="Insert">
		<?php if (isset($_SESSION['image'])) : ?> 
		<a href ="<?php echo $app_path.'blog?action=view_add_blog_2' ?>">Next Form</a>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($_SESSION['image'])). '">'; ?>
		<?php endif;?>

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
