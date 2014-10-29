<?php
include('header.php');
?>

<form method="post">
<input type="submit" name="update_book" value="Update book" />
<input type="submit" name="delete_book" value="Delete book" />
<input type="submit" name="add_review" value="Add Review" />
<input type="submit" name="return" value="Return" />
<input type="hidden" name="isbn" value="<?php echo $res['ISBN'] ?>" />  
<br><br>

<img name=imgName onMouseOver='handleOver();return true;' onMouseOut='handleOut();return true;' class='bookimg' src='../bookstore1/images/<?php echo $res['ISBN'] ?>.png'>
<br />

<table class="bookview">
    <tr><td><strong>ISBN</strong></td>  <td>  <?php echo $res['ISBN'] ?></td></tr>
    <tr><td><strong>Title</strong></td>  <td>   <?php echo $res['Title'] ?></td></tr>
    <tr><td><strong>Author</strong></td>  <td>   <?php echo $res['Author'] ?></td></tr>
    <tr><td><strong>Publisher</strong></td>  <td>  <?php echo $res['Publisher'] ?></td></tr>
    <tr><td><strong>Format</strong></td>  <td>   <?php echo $res['Format'] ?></td></tr>
    <tr><td><strong>Subject</strong></td>  <td>   <?php echo $res['Subject'] ?></td></tr>
    <tr><td id="desclabel" onclick="toggleVisibility('updown', 'desc')"><strong>Description</strong>
            <img id="updown" src="images/up3.png" alt=""/></td>  <td id="desc"><?php echo $res['Description'] ?></td></tr>
</table>
</form>
<br />
 <?php
        $reviewCount = getReviewCount($isbn); //jpb
        	if ($reviewCount <1 ) {	
		echo "Be the first to review <strong>" . $res['Title'] . "!</strong> <br />Click the 'Add Review' button above!";
	}
	else {
		echo "<p id='desclabel' onclick='toggleVisibility(\"\", \"rev\")' display='none'><strong>Show Reviews</strong></p>";
	}
	$query = "SELECT  * FROM REVIEWS WHERE ISBN='" . $isbn . "' ORDER BY Date DESC";
	$statement = $db->prepare($query);
	$statement->execute();
	//jpb $reviewCount = 0;
       
        
	echo "<table id='rev' class='gridtable' style=\"display: none;\"><tbody>";
	while($res2 = $statement->fetch(PDO::FETCH_ASSOC)){
		echo "<tr>";
		echo "<td><strong>" . $res2['Reviewer'] . "</strong></td>";
		echo "<td>" . $res2['Date'] . "</td>";
		echo "<td>" . $res2['Review'] . "</td>";
		echo "</tr>";
		$reviewCount++;
	}
	echo "</tbody></table>";
/*		
	if ($reviewCount <1 ) {	
		echo "Be the first to review <strong>" . $res['Title'] . "!</strong> <br />Click the 'Add Review' button above!";
	}
	else {
		echo "<p id='desclabel' onclick='toggleVisibility(\"\", \"rev\")' display='none'><strong>Show Reviews</strong></p>";
	}
*/        
	$statement->closeCursor();
?>
<br />
<script>
  function toggleVisibility(image, element){
    var image   = document.getElementById(image); 
    var element = document.getElementById(element); //Find element to show/hide

    if (element.style.display == "none"){  //Is the element hidden?
      element.style.display = "block";      //If yes, then show it
      image.src = "images/up3.png";
    }
    else {  //The element is not hidden, so hide it
      element.style.display = "none";
      image.src = "images/down3.png";
    }
  }
  function changeImage(imageName, newImageFile) {
    var image = document.getElementById(imageName); //find the image
    image.src = newImageFile; //change the image
  }  
  
  
  
</script>
<script>
// PRELOADING IMAGES
if (document.images) {
 img_on =new Image();  img_on.src ="../bookstore1/images/<?php echo  $res['ISBN'] ?>author.png"; 
 img_off=new Image();  img_off.src ="../bookstore1/images/<?php echo  $res['ISBN'] ?>.png"; 
}

function handleOver() { 
 if (document.images) document.imgName.src=img_on.src;
}

function handleOut() {
 if (document.images) document.imgName.src=img_off.src;
}

</script>
<p><?php echo $errorMessage ?> </p>
<?php
include('footer.php');
?>



