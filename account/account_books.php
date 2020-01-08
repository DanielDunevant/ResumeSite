<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<style>
.edited, .editedAndChanged{
		color:rgb(200,200,150);
		background:rgb(255,255,233);
		content-align:center;
		text-align: center;
	}
.edited input{
	text-align: center;
}
.deleteRecord{
	color:rgb(200,150,150);
	background:rgb(255,233,233);
	content-align:center;
	text-align: center;
}
.addRecord{
	color:rgb(150,200,150);
	background:rgb(233,255,233);
	content-align:center;
	text-align: center;
}
table{
	width:100%;
}
/*table td,table th{
	width:16.666%;
}*/
</style>
<div class = "section sectShadowUpper angleDiv_right sky">
	<div class ="ContentBox">
                <h1 class="center"></h1>
    		<h1>Book Editing</h1>

				<div id="errorText"></div>

    		<form action="/account/?action=save_books" method="post" id="book_form" novalidate ="novalidate">
       	 		<input type="hidden" name="action" value="save_books">
				<!--<form action="/account/?action=login" method="post" id="login_form" novalidate ="novalidate">
       	 		<input type="hidden" name="action" value="login">-->
        		<label>Book Name: </label>
        		<input id ="bookName" type="text">
            <div id="error_bookName"></div><br>
            <label>Author: </label>
        		<input id ="author" type="text">
            <div id="error_author"></div><br>
						<?php
							include ("model/DB_Boom.php");
							$bookTypeArray = selectRecords(true,["bookType"],["books"],[""],[""],"","");
							$bookStatusArray = selectRecords(true,["status"],["books"],[""],[""],"","");
					  ?>
            <label>Book Type: </label>
						<select id ="bookType">
							<?php
								foreach($bookTypeArray as $bookType){
									$BoookType =  $bookType['bookType'];
									print "<option value='$BoookType'>$BoookType</option>";
								}
							?>
						</select>
						<div id="error_bookType"></div><br>
						<label>Status: </label>
						<select id ="status">
							<?php
								foreach($bookStatusArray as $bookStatus){
									$BoookStatus =  $bookStatus['status'];
									print "<option value='$BoookStatus'>$BoookStatus</option>";
								}
							?>
						</select>
            <div id="error_status"></div><br>
					<div id="error_BookAdd"></div><br>
        	  <a class="button" id="addBookBtn" value="Add Book">Add Book</a>
						<table>
							<tr id="none">
								<th>Delete</th>
								<th>Edit</th>
								<th>Book Name</th>
								<th>Author</th>
								<th>Book Type</th>
								<th>Status</th>
							</tr>
						</table>
						<table>
						<?php
						include ("model/book_db.php");
						$books = get_books();
						foreach($books as $book){
						$bookID=$book['bookID'];
						$bookName=$book['bookName'];
						$author=$book['author'];
						$bookType=$book['bookType'];
						$status=$book['status'];
						print"<tr id = 'book_$bookID' onclick='editToggle($bookID)'>
						<td><a class='delete' class='button'>Delete</a></td>
						<td><a class='edit' class='button'>Edit</a></td>
						<td><p>$bookName</p><input value ='$bookName' style = 'display:none' name='tableData'></td>
						<td><p>$author</p><input value ='$author' style = 'display:none' name='tableData'></td>
						<td><p>$bookType</p><input value ='$bookType' style = 'display:none' name='tableData'></td>
						<td><p>$status</p><input value ='$status' style = 'display:none' name='tableData'></td>
						</tr>";
					}
						?>
						</table>
						<input type="hidden" name="action" value="save_books">
       			<input type="submit" class="button" value="Save Books">
						<!--
						<input type="hidden" name="action" value="login">
						<input type="submit" class="button" value="Login">
					-->
    		</form>
	</div>
</div>
<section class="section vH100 parallax bg1">
</section>
<script src ="/js/account_Book_Add.js">
</script>
<?php include '../view/footer.php'; ?>
