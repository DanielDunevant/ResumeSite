<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<div class = "section sectShadowUpper angleDiv_right sky">
	<div class ="ContentBox">
                <h1 class="center"></h1>
    		<h1>Login</h1>

				<div id="errorText"></div>

				<form action="/account/?action=save_books" method="post" id="book_form" novalidate ="novalidate">
						<input type="hidden" name="action" value="save_books">
						<label>Book Name: </label>
        		<input id ="bookName" type="text">
            <div id="error_BookName"></div><br>
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
							<td><p>$bookName</p><input value ='$bookName' style = 'display:none' name='tableData[]'></td>
							<td><p>$author</p><input value ='$author' style = 'display:none' name='tableData[]'></td>
							<td><p>$bookType</p><input value ='$bookType' style = 'display:none' name='tableData[]'></td>
							<td><p>$status</p><input value ='$status' style = 'display:none' name='tableData[]'></td>
							</tr>";
						}
							?>
							</table>
						<input type="hidden" name="action" value="save_books">
					 <input type="submit" class="button" value="save_books">
	      		<?php if (!empty($password_message)) : ?>
	      		<span class="error"><?php echo htmlspecialchars($password_message); ?></span>
	      		<?php endif; ?>
    		</form>
	</div>
</div>
<script src ="/js/account_Book_Add.js">
</script>
<?php include '../view/footer.php'; ?>
