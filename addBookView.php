<?php
include('header.php');
?>
<form id="addBookForm" method="post">
<input type="submit" name="list_books" value="View all books" />
<input type="submit" name="save_new_book" value="Save book" /> 
<br><br>
<table class="bookview">
    <tr><td>ISBN </td>  <td>  <input type="text" autofocus required name="isbn" oninput="validateIsbn(this)"></td></tr>
    <tr><td>Title</td>  <td>    <input type="text" name="title"  oninput="validateTitle(this)" required></td></tr>
    <tr><td>Author </td>  <td>    <input type="text" name="author" oninput="validateAuthor(this)"  required><br></td></tr>
    <tr><td>Publisher</td>  <td>  <input type="text" name="publisher" oninput="validatePublisher(this)" required></td></tr>
    <tr><td>Format</td>  <td>  <!--<input type="text" name="format"  /> -->
    <select name="format" required>
		<option value="" selected > </option>
		<option value="Harcover">Harcover</option>
		<option value="Paperback">Paperback</option>
		<option value="eBook">eBook</option>
		<option value="Audio">Audio</option>								
	</select>
    </td></tr>
    <tr><td>Subject</td>  <td>  <!-- <input type="text" name="subject"  /> -->
    <select name="subject" required>
		<option value="" selected > </option>
		<option value="Biography">Biography</option>
		<option value="Children">Children</option>
		<option value="Fiction">Fiction</option>
		<option value="History">History</option>
		<option value="NonFiction">NonFiction</option>
		<option value="Poetry">Poetry</option>							
	</select>
    </td></tr> 
    <tr><td>Description</td><td><textarea name="description" form="addBookForm" oninput="validateLength(this)" class="bookdesc" required></textarea></td></tr> 
</table>
</form>
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
