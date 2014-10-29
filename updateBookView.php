<?php
include('header.php');
?>
<form id="updateBookForm" method="post">
<input type="submit" name="save_book_updates" value="Save updates" />
<input type="submit" name="return" value="Return" />
<input type="hidden" name="isbn" value="<?php echo $res['ISBN'] ?>" />
<br><br>
<table class="bookview">
<tr><td><strong>ISBN: </strong></td><td><?php echo $_GET['isbn']; ?></td></tr>
<tr><td><strong>Title: </strong></td><td><input type='text' name="title" oninput='validateTitle(this)' value='<?php echo $res['Title']; ?>' required></td></tr>
<tr><td><strong>Author: </strong></td><td><input type='text' name="author" oninput='validateAuthor(this)' value='<?php echo $res['Author']; ?>' required></td></tr>
<tr><td><strong>Publisher: </strong></td><td><input type='text' name="publisher" oninput='validatePublisher(this)' value='<?php echo $res['Publisher']; ?>' required></td></tr>
<tr><td><strong>Format: </strong></td>  <td>  <!--<input type="text" name="format"  /> -->
    <select name="format" required>
		<option value="<?php echo $res['Format']; ?>" selected ><?php echo $res['Format']; ?> </option>
		<option value="Hardcover">Hardcover</option>
		<option value="Paperback">Paperback</option>
		<option value="eBook">eBook</option>
		<option value="Audio">Audio</option>								
	</select>
    </td></tr>
    <tr><td><strong>Subject: </strong></td>  <td>  <!-- <input type="text" name="subject"  /> -->
    <select name="subject" required>
		<option value="<?php echo $res['Subject']; ?>" selected ><?php echo $res['Subject']; ?> </option>
		<option value="Biography">Biography</option>
		<option value="Children">Children</option>
		<option value="Fiction">Fiction</option>
		<option value="History">History</option>
		<option value="NonFiction">NonFiction</option>
		<option value="Poetry">Poetry</option>							
	</select>
    </td></tr> 
    <tr><td><strong>Description: </strong></td><td><textarea name="description" form="updateBookForm" oninput="validateLength(this)" class="bookdesc" required><?php echo $res['Description']; ?></textarea></td></tr> 
</table>	
</form>
<br />
<p><?php echo $errorMessage ?> </p>
<script>
function validateIsbn(input) {
   var isbn = input.value
   var isbnLength = input.value.length;
   var isIsbn = isbn.match(/\d{3}-\d{9}/);
   if ((isbnLength == 13) && (isIsbn)) {
      input.setCustomValidity("");    }
   else {
      input.setCustomValidity("ISBN must be in this format: XXX-XXXXXXXXX");  }
}
function validateTitle(input) {
   var title = input.value
   var titleLength = input.value.length;
   var isAlphaNum = title.match(/[a-zA-Z0-9]/);
   if ((titleLength >= 1) && (isAlphaNum)) {
      input.setCustomValidity("");    }
   else {
      input.setCustomValidity("Title must include at least one alphanumeric character.");  }
}
function validateAuthor(input) {
   var author = input.value
   var authorLength = input.value.length;
   var isAlpha = author.match(/[a-zA-Z]/);
   if ((authorLength > 4) && (isAlpha)) {
      input.setCustomValidity("");    }
   else {
      input.setCustomValidity("Author must include at least five alphabetic characters.");  }
}
function validatePublisher(input) {
   var publisher = input.value
   var publisherLength = input.value.length;
   var isAlpha = publisher.match(/[a-zA-Z]/);
   if ((publisherLength > 9) && (isAlpha)) {
      input.setCustomValidity("");    }
   else {
      input.setCustomValidity("Publisher must include at least ten alphabetic characters.");  }
}
function validateLength(input) {
   var description = input.value
   var descriptionLength = input.value.length;
   var isAlphaNum = description.match(/[a-zA-Z0-9]/);
   if ((descriptionLength > 24) && (isAlphaNum)) {
      input.setCustomValidity("");    }
   else {
      input.setCustomValidity("Description must include at least 25 alphanumeric characters.");  }
}

</script>
<?php
include('footer.php');
?>
