<?php 
include('connection.php');

 ?>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form action="bookDisplay.php" method="POST">
 		<fieldset>
 			<legend>Books</legend>
 			<table>
 				<?php 
            $query="SELECT * FROM book ORDER BY book_id DESC";
            $ret=mysqli_query($connect,$query);
            $count=mysqli_num_rows($ret);
            if ($count==0) 
            {
                echo "<p>No Book Found.</p>";
                exit();
            }
            else
            {
                for ($a=0; $a <$count ; $a+=3) 
                { 
                    $query1="SELECT * FROM book 
                    ORDER BY book_id DESC LIMIT $a,3";
                    $ret1=mysqli_query($connect,$query1);
                    $count1=mysqli_num_rows($ret1);

 

                    echo "<tr>";
                    for ($i=0; $i <$count1 ; $i++) 
                    { 
                        $data=mysqli_fetch_array($ret1);
                        $book_id=$data['book_id'];
                        $title=$data['title'];
                        $coverimage=$data['coverimage'];
                        $author=$data['author'];
                        $edition=$data['edition'];
                        echo "<td>
                        <img src='$coverimage' width='200px' height='200px'><br>
                        $title<br>
                        $author<br>
                        $edition<br>
                        <a href='bookDetail.php?bid=$book_id'>Detail</a>
                              </td>";
                    }
                    echo "</tr>";
                }
            }
            ?>
 			</table>
 		</fieldset>
 </body>
 </html>