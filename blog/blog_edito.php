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
        $blogType=       $_POST['blogType'];
	$i=0;
	foreach($_FILES['img']['name'] as $image)
	{
        	$img[$i]= addslashes(file_get_contents($_FILES['img']['tmp_name'][$i]));
		$i++;
	}
	$_SESSION['BlogID']=$action[1];
	$_SESSION['chronos']=$chronos;
	$_SESSION['componentType']=$componentType;
	$_SESSION['txt']=$txt;
	$_SESSION['img']=$img;
	$_SESSION['name']=$name;
	$_SESSION['description']=$maintext;
	$_SESSION['imageFilename']=$imagefilename;
	$_SESSION['blogType']=$blogType;
}
$i=0;
foreach($edit_blog as $blog):
?>

<main>
    	<form  method="post" enctype="multipart/form-data" id="add_blog_form">
		<?php if ($_SESSION['chronos']) :?>
	        <h2>Debugging</h2>
		<h3><b>Chronos:</b><?php echo count($_SESSION['chronos']); ?></h3>
		<h3><b>Component:</b><?php echo count($_SESSION['componentType']); ?></h3>
		<h3><b>txt:</b><?php echo count($_SESSION['txt']); ?></h3>
		<h3><b>img:</b><?php echo count($_SESSION['img']); ?></h3>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($_SESSION['image'])). '">'; ?>
		<? endif; 
		if($i==0): ?>
    		<h1>Add Blog</h1>
	        <h2>Blog Information</h2>
	        <!--<input type="hidden" name="action" value="view_add_blog_2">-->
        	<input type="hidden" name="action" value="add_blog">
        	<label>Name:</label>
        	<input type="text" name="name"
        	       value="<?php echo $blog['name']; ?>" >
        	<?php  // echo $fields->getField('name')->getHTML(); ?><br>
		<label>Blog Type:</label>
		<select id="blogType" name="blogType">
			<?php 
			$blogTypes=get_BlogTypes();
			print '<option value='.$blog['blogType'].' selected>'.$blog['blogType'].'</option>';
			foreach($blogTypes as $blogType){
				var_dump($blogType);
				if($blogType['blogType'] !=$blog['blogType']){
			        print '<option value="'.$blogType['blogType'].'">'.$blogType['blogType'].'</option>';		
				}
			}
			?>
		</select><br>

	        <label>Blog Description:</label>
		<textarea name="mainText" rows="4" cols="50" value="<?php echo $blog['mainText']; ?>" ><?php echo $blog['mainText']; ?></textarea>
	        <?php  //  echo $fields->getField('mainText')->getHTML(); ?>
	        <span class="error">  </span><br>
	        <?php // echo $fields->getField('blogType')->getHTML(); ?>
	        <label>Image Filename:</label>
	        <input type="text" name="imageFilename" size="30" value="<?php echo $blog['imageFilename']?>"><br>
        	<?php // echo $fields->getField('imageFilename')->getHTML(); ?>
	        <label>Image:</label>
	        <input type="file" name="image" id = "image" value="" size="30"/><br>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">'; ?>
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
		<?php else: ?>
		<br>
		<div class ="columns medium-12" id="componentList">
		<?php 
		switch($blog['componentID']){
		case 1:
			print"<input name='chronos[]' value='".$blog['chronosID']."' style='display:none;'></input><input name='componentType[]' value='1' style='display:none;'></input>   <h2>Component(".$blog['chronosID'].") Text Left, Image Right</h2>  <div class='alignInputs medium-6 columns'><label>Text Input</label><textarea name='txt[]' rows='4' cols='50'>".$blog['mainText']."</textarea></div>        	<div class='alignInputs medium-6 columns''><label>Image Input</label><input type='file' name='img[]'></input>";
		 echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">'; 
			print"</div>";
		break;
		case 2:
			print "<input name='chronos[]' value='".$blog['chronosID']."' style='display:none;'></input><input name='componentType[]' value='2' style='display:none;'></input> <div class ='medium-6 columns'>	  <h2>Component(".$blog['chronosID'].") Text Right, Image Left</h2>     	<div class=' medium-6 columns'><label>Image Input</label><input type='file' name='img[]'></input>";
		 echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">'; 
print"</div>   <div class='medium-6 columns'><label>Text Input</label><textarea name='txt[]' rows='4' cols='50'>".$blog['mainText']."</textarea></div>     	</div>'	";
		break;
		case 3:
			print "<input name='chronos[]' value='".$blog['chronosID']."' style='display:none;'></input><input name='componentType[]' value='3' style='display:none;'></input> Component(".$blog['chronosID'].")<h2> Full Text</h2>  <div class='medium-6 columns'><label>Text Input</label><textarea name='txt[]' rows='4' cols='50'>".$blog['mainText']."</textarea></div>	";
		break;
		case 4:
			print "<input name='chronos[]' value='".$blog['chronosID']."' style='display:none;'></input><input name='componentType[]' value='4' style='display:none;'></input> <h2>Component(".$blog['chronosID'].") Full Image</h2><div class='medium-6 columns'><label>Image Input</label><input type='file' name='img[]'></input>";
		 echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($blog['image'])). '">'; 
			print"</div> 	";
		break;
		}
		?>
		</div>	
<?php 		endif;
 	$i++;
 	ENDFOREACH; ?>
		<input style="clear:both;" type="submit" value="Store Post Variables" name = "insert" id = "insert" value="Insert">
		<?php if (isset($_SESSION['image'])) : ?> 
	       	<input type="submit" value="Create Blog" name = "add_blog" id = "insert" onclick='this.form.action="?action=edit_blog"' /><br>
		<?php echo '<img src="data:image/jpeg;base64, ' .base64_encode(stripslashes($_SESSION['image'])). '">'; ?>
		<?php endif;?>
    	</form>
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
