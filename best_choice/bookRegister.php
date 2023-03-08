<?php 
	include("connection.php");

	if(isset($_POST['btnSave'])){
		$txtTitle = $_POST['txtTitle'];
		$txtAuthor = $_POST['txtAuthor'];
		$txtPublisher = $_POST['txtPublisher'];
		$txtEdition = $_POST['txtEdition'];
		$cboBookTypeID = $_POST['cboBookTypeID'];
		$txtNumberOfCopy = $_POST['txtNumberOfCopy'];
		$rdoAvailibility = $_POST['rdoAvailibility'];

		//---Upload Img---
		$fileImage=$_FILES['fileImage']['name'];//Assign var to ui element
		$Destination="bookCover/";//file destination to copy
		$fileName=$Destination . $txtTitle ."_". $fileImage;//set file name before copy/dot is plus operator
		$copied = copy($_FILES['fileImage']['tmp_name'], $fileName);//copy(from,to)/so a(temp name) copy to (b)
		if(!$copied){
			echo"<p>Error Uploading Photo</p>";
			exit();
		}
		//----------------

		//------check email already exists
		$checkTitle = "SELECT * FROM book WHERE title=?, author=?, edition=?";
		$stmt = mysqli_prepare($connect, $checkTitle);
		mysqli_stmt_bind_param($stmt, 'ssi', $txtTitle, $txtAuthor, $txtEdition);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if($res === false){
			echo"Error: ".mysqli_error($connect);
		}
		elseif (mysqli_num_rows($res) > 0){
			echo"<script>window.alert('Book Already Exist')</script>";
			echo"<script>window.location='bookRegister.php'</script>";
		}

			else{
				$insertQuery = "INSERT INTO book (title, coverimage, author, publisher, edition, numberofcopy, availibility, booktype_id)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				$insertStmt = mysqli_prepare($connect, $insertQuery);
				mysqli_stmt_bind_param($insertStmt, 'ssssiisi', $txtTitle, $fileName, $txtAuthor, $txtPublisher, $txtEdition, $txtNumberOfCopy,$rdoAvailibility, $cboBookTypeID);
				$res1 = mysqli_stmt_execute($insertStmt);
				if(!$res1){
					echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
				}
				else{
					echo"<script>window.alert('New Book Successfully Added')</script>";
					echo"<script>window.location='bookList.php'</script>";
				}
			}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="bookRegister.php" method = "POST" enctype="multipart/form-data">
		<fieldset>
		<legend>Add New Book</legend>
		<table>
			<tr>
				<td>Title</td>
				<td>
					<input type="text" name="txtTitle" required placeholder="Harry Potter">
				</td>
			</tr>
			<tr>
				<td>author</td>
				<td>
					<input type="text" name="txtAuthor" required placeholder="JK Rowling">
				</td>
			</tr>
			<tr>
				<td>Upload Image</td>
				<td>
					<input type="file" name="fileImage" required>
				</td>
			</tr>
			<tr>
				<td>Publisher</td>
				<td>
					<input type="text" name="txtPublisher" required placeholder="bloomsbury">
				</td>
			</tr>
			<tr>
				<td>Edition</td>
				<td>
					<input type="number" name="txtEdition" min="0" max="100" required placeholder="1">
				</td>
			</tr>
			<tr>
				<td>Book Type</td>
				<td>
					<select name="cboBookTypeID">
						<?php 
							$select="SELECT * FROM booktype";
							$query=mysqli_query($connect,$select);
							$count=mysqli_num_rows($query);
							for($i=0;$i<$count;$i++)
						{
							$data=mysqli_fetch_array($query);
							$booktype_id=$data['booktype_id'];
							$booktype_name=$data['booktype_name'];
							echo "<option value='$booktype_id'>
								$booktype_name
							</option>";
						}
						 ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Number of Copy</td>
				<td>
					<input type="number" name="txtNumberOfCopy" min="0" max="1000" required placeholder="25">
				</td>
			</tr>
			<tr>
				<td>Availibility</td>
					<td>
						<input type="radio" name="rdoAvailibility" value="Yes" checked />Yes
						<input type="radio" name="rdoAvailibility" value="No" />No
					</td>
				</tr>
			<tr>
				<td>
					<input type="submit" name="btnSave" value="Save" />
					<input type="reset" value="Cancel" />
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</body>
</html>