<?php include 'view/header.php'; ?>
<?php include 'view/sidebar.php'; ?>
<main class="nofloat">
	<h1>Plans</h1>
	<div class = "rectangle">
 		<h2>Completed Plans</h2>
	</div>
	<div class = "rectangle">
		<h2>Current Plans</h2>
		<h3>Resume Website<h3/>
	</div>
	<div class = "rectangle">
		<h2>Future Plans</h2>
		<h3>Create Meme Meme Gaga Meme App (Android)</h3>
		<h3>Create Conspiracy Squares App (Android)</h3>
		<h3>Create C++ Game using OpenGL</h3>
		<h3>Create C++ Game Encorporating VR Technology</h3>
	</div>
	<div class = 'rectangle'>
		<h2>Books</h2>
		<table>
			<tr>
				<th>Book Name</th>
				<th>Author</th>
				<th>Book Type</th>
				<th>Status</th>
			</tr>
		<?php
		  	include ("model/book_db.php");
			$books = get_books();
			foreach($books as $book){
				$bookName=$book['bookName'];
				$author=$book['author'];
				$bookType=$book['bookType'];
				$status=$book['status'];
		  		print"<tr>
					<td>$bookName</td>
					<td>$author</td>
					<td>$bookType</td>
					<td>$status</td>
				</tr>";
			}
		?>
		</table>
	</div>
</main>
<?php include 'view/footer.php'; ?>
