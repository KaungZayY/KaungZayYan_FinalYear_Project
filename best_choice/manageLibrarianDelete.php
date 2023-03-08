<?php 
	include('connection.php');
	if (isset($_REQUEST['did'])) {
		$librarianID=$_REQUEST['did'];
		$Select="DELETE FROM librarian WHERE librarian_id='$librarianID'";
		$query=mysqli_query($connect, $Select);
		if(!$query){
			echo "<script>alert(' Cannot Remove Current User')
			window.location='librarianList.php'
			</script>";
		}
		else{
			echo "<script>alert('User was removed')
			window.location='librarianList.php'
			</script>";
		}
	}
 ?>