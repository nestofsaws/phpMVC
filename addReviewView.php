<?php
include('header.php');
?>
<form id="addReviewForm" method="post">
<input type="hidden" name="isbn" value="<?php echo $res['ISBN'] ?>" />
<br><br>
<table>
    <tr><td><strong>ISBN: </strong></td>  <td>  <?php echo $res['ISBN'] ?></td></tr>
    <tr><td><strong>Title: </strong></td>  <td>  <?php echo $res['Title'] ?></td></tr>
    <tr><td><strong>Author: </strong></td>  <td> <?php echo $res['Author'] ?></td></tr>
	<tr><td><strong>Reviewer: </strong></td>  <td>  <input type="text" name="reviewer" required></td></tr> 
    <tr><td><strong>Review Comments: </strong></td>  <td><textarea class="bookdesc" form="addReviewForm"  name="review" required></textarea></td></tr> 
	<tr><td><td><input type="submit" name="save_review" value="Save Review" /> </td>
</table>   
</form>
<p><?php echo $errorMessage ?> </p>
<?php
include('footer.php');
?>
