<?php
include('header.php');
?>
<form  method="post">
    <input type="submit" name="list_books" value="View all books" />
    <br><br>
</form>

<form method="post">
<label>Search by: </label>
		<select name="attribute">
				<option value='ISBN'>ISBN</option>
				<option value='Title'>Title</option>
				<option value='Author'>Author</option>
				<option value='Publisher'>Publisher</option>
				<option value='Format'>Format</option>
				<option value='Subject'>Subject</option>
		</select>
        <input type="text" name="searchTerm"/>
	<input type="submit" name="search_books" value="Search" />
</form>
<br />

<?php
if ($bookCount > 0) {
   echo "<table class='gridtable'>
         <tr><th>ISBN</th>
         <th>Title</th>  
         <th>Author</th>
         <th>Publisher</th>  
         <th>Format</th>
         <th>Subject</th>  
         </tr> ";
   while($res = $statement->fetch(PDO::FETCH_ASSOC)){
      echo "<tr>";
      //echo "<td> <a href=?action=view_book&isbn=" .  $res['ISBN']  . ">" . $res['ISBN'] . "</a></td>"; 
      echo "<td>" . $res['ISBN']  . "</td>"; 
      echo "<td>" . $res['Title'] . "</td>";  
      echo "<td>" . $res['Author'] .   "</td>";
      echo "<td>" . $res['Publisher'] . "</td>";  
      echo "<td>" . $res['Format'] . "</td>";
      echo "<td>" . $res['Subject'] . "</td>";
      echo "</tr>";
   }
   echo "</table>";
   $statement->closeCursor();
}
include('footer.php');
?>
