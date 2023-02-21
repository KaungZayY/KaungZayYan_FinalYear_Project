<?php  
session_start();
include('connection.php');

$memberTypeID=$_GET['did'];

$delete="DELETE FROM membertype WHERE membertype_id='$memberTypeID' ";
$res=mysqli_query($connect,$delete);

if($res) 
{
	echo "<script>window.alert('Member Type Deleted!')</script>";
	echo "<script>window.location='memberTypeRegister.php'</script>";
}
else
{
	echo "<p>Something went wrong" . mysqli_error($connect) . "</p>";
}
?>