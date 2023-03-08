<?php 
	include('connection.php');
 ?>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action="bookList.php" method="POST">
 		<fieldset>
 			<legend>Books</legend>
 			<table>
 				<tr>
 					<th>ID</th>
 					<th>Title</th>
 					<th>Image</th>
 					<th>Author</th>
 					<th>Publisher</th>
 					<th>Edition</th>
 					<th>Number of Copy</th>
 					<th>Availibility</th>
 					<th>Book Type</th>
 					<th>Action</th>
 				</tr>
 				<tr>
 					<?php 
 					$select="SELECT * FROM book";
 					$query=mysqli_query($connect, $select);
 					$count=mysqli_num_rows($query);
 					for($i=0;$i<$count;$i++)
 					{
 						$data=mysqli_fetch_array($query);
 						$bookID=$data['book_id'];
 						$title=$data['title'];
 						$coverImage=$data['coverimage'];
 						$author=$data['author'];
 						$publisher=$data['publisher'];
 						$edition=$data['edition'];
 						$numberOfCopy=$data['numberofcopy'];
 						$availibility=$data['availibility'];
 						$bookTypeID = $data['booktype_id'];
 						$select1 = "SELECT booktype_name FROM booktype WHERE booktype_id='$bookTypeID'";
 						$query1 = mysqli_query($connect,$select1);
 						$data1 = mysqli_fetch_array($query1);
 						$bookType = $data1['booktype_name'];
 						echo "<tr>
 							<td>$bookID</td>
 							<td>$title</td>
 							<td>$coverImage</td>
 							<td>$author</td>
 							<td>$publisher</td>
 							<td>$edition</td>
 							<td>$numberOfCopy</td>
 							<td>$availibility</td>
 							<td>$bookType</td>
 							<td>
 							<a href='bookUpdate.php?uit=$bookID'>Update</a> | 
 							<a href='bookDelete.php?did=$bookID'>Remove</a> |
 							<a href='bookGenre.php?gid=$bookID'>Add Genre</a>
 							</td>
 							</tr>";
 					}
 					 ?>
 				</tr>
 			</table>
 		</fieldset>
 </body>
 </html>
