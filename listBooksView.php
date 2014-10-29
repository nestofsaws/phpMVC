<?php
date_default_timezone_set('America/New_York');
include('header.php');
?>
<form  method="post">
    <input type="submit" name="list_books" value="View all books" />
    <input type="submit" name="add_new_book" value="Add new book" />	
    &nbsp;&nbsp;&nbsp;Search by
    <select name = 'attribute'>
        <option value = 'ISBN'>ISBN</option>
        <option value = 'Title'>Title</option>
        <option value = 'Author'>Author</option>
        <option value = 'Publisher'>Publisher</option>
        <option value = 'Format'>Format</option>
        <option value = 'Subject'>Subject</option>
    </select>
    <input type="text" name="searchTerm" placeholder="enter a search term here"  />
    <input type="submit" name="search_books" value="Search" />
    <br><br>
</form>

<?php
if ($bookCount > 0) {
   echo "<table id='bltable' class='gridtable  tablesorter'>
         <thead> <tr>
            <th>ISBN</th>
            <th>Title</th>  
            <th>Author</th>
            <th>Publisher</th>  
            <th>Format</th>
            <th>Subject</th>
            <th>Description</th>  
         </tr> </thead>
         <tbody> ";
   while($res = $statement->fetch(PDO::FETCH_ASSOC)){
      echo "<tr>";
      echo "<td> <a href=?isbn=" .  $res['ISBN']  . ">" . $res['ISBN'] . "</a></td>"; 
      echo "<td>" . $res['Title'] . "</td>";  
      echo "<td>" . $res['Author'] .   "</td>";
      echo "<td>" . $res['Publisher'] . "</td>";  
      echo "<td>" . $res['Format'] . "</td>";
      echo "<td>" . $res['Subject'] . "</td>";
      echo "<td>" . $res['Description'] . "</td>";
      echo "</tr>";
   }
   echo "</tbody></table>";
   $statement->closeCursor();
         
}
else  {
   echo "No results found.";  }
   echo '<script src="js/jquery-1.11.1.min.js"></script>
         <script src="js/jquery.tablesorter.min.js"></script>
	 <script>
           $(document).ready(function(){
             $(function(){
               $("#bltable").tablesorter( {sortList: [[1,0]]} ); 
             });
           });
        </script> ';   
include('footer.php');
?>
