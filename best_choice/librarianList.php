<?php 
	include('connection.php');
 ?>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action="librarianList.php" method="POST">
 		<fieldset>
 			<legend>Librarians</legend>
 			<table>
 				<tr>
 					<th>ID</th>
 					<th>Image</th>
 					<th>Name</th>
 					<th>Email</th>
 					<th>Password</th>
 					<th>Address</th>
 					<th>Phone No</th>
 					<th>Action</th>
 				</tr>
 				<tr>
 					<?php 
 					$select="SELECT * FROM librarian";
 					$query=mysqli_query($connect, $select);
 					$count=mysqli_num_rows($query);
 					for($i=0;$i<$count;$i++)
 					{
 						$data=mysqli_fetch_array($query);
 						$librarianID=$data['librarian_id'];
 						$librarianImage=$data['librarian_image'];
 						$librarianName=$data['librarian_name'];
 						$librarianEmail=$data['librarian_email'];
 						$librarianPassword=$data['librarian_password'];
 						$librarianAddress=$data['librarian_address'];
 						$librarianPhoneNumber=$data['librarian_phonenumber'];
 						echo "<tr>
 							<td>$librarianID</td>
 							<td>$librarianImage</td>
 							<td>$librarianName</td>
 							<td>$librarianEmail</td>
 							<td>$librarianPassword</td>
 							<td>$librarianAddress</td>
 							<td>$librarianPhoneNumber</td>
 							<td>
 							<a href='manageLibrarianUpdate.php?uit=$librarianID'>Update</a> | 
 							<a href='manageLibrarianDelete.php?did=$librarianID'>Delete</a>
 							</td>
 							</tr>";
 					}
 					 ?>
 				</tr>
 			</table>
 		</fieldset>
 </body>
 </html>
