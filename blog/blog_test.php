<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<?php
if(isset($_POST["insert"]))
{
	$file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$_SESSION['image']=$file;
	$file2 = addslashes(file_get_contents($_FILES['img']['tmp_name']));
	print count($_FILES['img']);
	$_SESSION['img']=$file2;
	// SET ALL FIELDS TO SESSIONS THAT EXPIRE AT END OF AD_BLOG CONTROLLER'S CONTROL
	
        $chronos=        $_POST['chronos'];
        $componentType=  $_POST['componentType'];
        $txt=            $_POST['txt'];
        $name=           $_POST['name'];
        $maintext=       $_POST['mainText'];
        $imagefilename=  $_POST['imageFilename'];
	$i=0;
	foreach($_FILES['img']['name'] as $image)
	{
        	$img[$i]= addslashes(file_get_contents($_FILES['img']['tmp_name'][$i]));
		$i++;
	}
	$_SESSION['chronos']=$chronos;
	$_SESSION['componentType']=$componentType;
	$_SESSION['txt']=$txt;
	$_SESSION['img']=$img;
	$_SESSION['name']=$name;
	$_SESSION['description']=$maintext;
	$_SESSION['imageFilename']=$imagefilename;
}
?>
<main>
    <div class = "rectangle">
    	<h1>Add Blog</h1>
    	<form  method="post" enctype="multipart/form-data" id="add_blog_form">
		<?php if ($_SESSION['chronos']) :?>
	        <h2>Debugging</h2>
		<h3><b>Chronos:</b><?php echo count($_SESSION['chronos']); ?></h3>
		<h3><b>Component:</b><?php echo count($_SESSION['componentType']); ?></h3>
		<h3><b>txt:</b><?php echo count($_SESSION['txt']); ?></h3>
		<h3><b>img:</b><?php echo count($_SESSION['img']); ?></h3>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($_SESSION['image'])). '">'; ?>
		<? endif; ?>
	        <h2>Blog Information</h2>
	        <!--<input type="hidden" name="action" value="view_add_blog_2">-->
        	<input type="hidden" name="action" value="add_blog">
        	<label>Name:</label>
        	<input type="text" name="name"
        	       value="" >
        	<?php  // echo $fields->getField('name')->getHTML(); ?><br>
		<label>Blog Type:</label>
		<select id="blogType" name="blogType">
			<option value="Philosophy">Philosophy</option>
			<option value="Project">Project</option>
			<option value="WebDev">Web Development</option>
			<option value="CompSci">Computer Science</option>
			<option value="Writing">Writing</option>
		</select><br>

	        <label>Blog Description:</label>
		<textarea name="mainText" rows="4" cols="50"></textarea>
	        <?php  //  echo $fields->getField('mainText')->getHTML(); ?>
	        <span class="error">  </span><br>
	        <?php // echo $fields->getField('blogType')->getHTML(); ?>
	        <label>Image Filename:</label>
	        <input type="text" name="imageFilename" size="30"><br>
        	<?php // echo $fields->getField('imageFilename')->getHTML(); ?>
	        <label>Image:</label>
	        <input type="file" name="image" id = "image" value="" size="30"/><br>

		<!--BEGINING OF COMPONENTS-->
		<br>
		<div class="columns medium-12" >
	        	<label>Add Component</label>
			<div class="components" id="txtL_imgR" onclick="addComponent(1)" >
				<img src="../images/components/txtL_imgR.svg" >	
			</div>
			<div class="components" id="txtR_imgL" onclick= "addComponent(2)" >
				<img  src="../images/components/txtR_imgL.svg" >	
			</div>
			<div class="components" id="fullTxt" onclick= "addComponent(3)" >
				<img  src="../images/components/fullTxt.svg" >
			</div>
			<div class="components" id="fullImg" onclick= "addComponent(4)" >
				<img  src="../images/components/fullImg.svg" >	
			</div>
		</div>
		<br>
		<div class ="columns medium-12" id="componentList"></div>	
		<input style="clear:both;" type="submit" value="Store Post Variables" name = "insert" id = "insert" value="Insert">
		<?php if (isset($_SESSION['image'])) : ?> 
	       	<input type="submit" value="Create Blog" name = "add_blog" id = "insert" onclick='this.form.action="?action=add_blog"' /><br>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($_SESSION['image'])). '">'; ?>
		<?php endif;?>
    	</form>
    </div>
</main>
<script>
var chronos=0;
function addComponent(componentID) {
	var createAfter = document.getElementById('componentList');
	var container = document.createElement("div");
	container.className="container columns medium-6";
	switch(componentID){
		case 1:
			container.innerHTML="<input name='chronos[]' value='"+chronos+"' style='display:none;'></input><input name='componentType[]' value='1' style='display:none;'></input>   <h2>Component("+chronos+") Text Left, Image Right</h2>  <div class='alignInputs medium-6 columns'><label>Text Input</label><textarea name='txt[]' rows='4' cols='50'></textarea></div>        	<div class='alignInputs medium-6 columns''><label>Image Input</label><input type='file' name='img[]'></input></div>";
			document.getElementById("componentList").appendChild(container);
		break;
		case 2:
			container.innerHTML="<input name='chronos[]' value='"+chronos+"' style='display:none;'></input><input name='componentType[]' value='2' style='display:none;'></input> <div class ='medium-6 columns'>	  <h2>Component("+chronos+") Text Right, Image Left</h2>     	<div class=' medium-6 columns'><label>Image Input</label><input type='file' name='img[]'></input></div>   <div class='medium-6 columns'><label>Text Input</label><textarea name='txt[]' rows='4' cols='50'></textarea></div>           	</div>'	";
			document.getElementById("componentList").appendChild(container);
		break;
		case 3:
			container.innerHTML="<input name='chronos[]' value='"+chronos+"' style='display:none;'></input><input name='componentType[]' value='3' style='display:none;'></input> Component("+chronos+")<h2> Full Text</h2>  <div class='medium-6 columns'><label>Text Input</label><textarea name='txt[]' rows='4' cols='50'></textarea></div>	";
			document.getElementById("componentList").appendChild(container);
		break;
		case 4:
			container.innerHTML="<input name='chronos[]' value='"+chronos+"' style='display:none;'></input><input name='componentType[]' value='4' style='display:none;'></input> <h2>Component("+chronos+") Full Image</h2><div class='medium-6 columns'><label>Image Input</label><input type='file' name='img[]'></input></div> 	";
			document.getElementById("componentList").appendChild(container);
		break;
		default:
	}
	chronos++;
}
</script>
<script>
$(document).ready(function(){
	$('#insert').click(function(){
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
	
	})});
</script>
<?php include '../view/footer.php'; ?>:
