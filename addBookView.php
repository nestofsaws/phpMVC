<?php
include('header.php');
?>
<form  method="post">
    <input type="submit" name="list_books" value="View all books" />
    <input type="submit" name="save_book" value="Save Book" />
    <br><br>

<label>ISBN:</label>
<label>&nbsp;</label>
<input type="text" name="addISBN" align="right"/><br/>
<label>Title:</label>
<label>&nbsp;</label>
<input type="text" name="addTitle"/><br/>
<label>Author:</label>
<label>&nbsp;</label>
<input type="text" name="addAuthor"/><br/>
<label>Publisher:</label>
<label>&nbsp;</label>
<input type="text" name="addPublisher" align="right"/><br/>
<label>Format:</label>
<label>&nbsp;</label>
<input type="text" name="addFormat"/><br/>
<label>Subject:</label>
<label>&nbsp;</label>
<input type="text" name="addSubject"/><br/>
	
</form>
<br />

<?php


	
include('footer.php');
?>
