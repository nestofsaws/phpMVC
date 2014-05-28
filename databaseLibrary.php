<?php 
function connectToDatabase() {
   global $db;
   try {
      $db = new PDO('sqlite:bookstore.sqlite'); 
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch (PDOException $e) {
      $errorMessage = $e->getMessage();
      echo "<p>SQL error: $errorMessage </p>";
      $db = null;   // "closes" a connection
      exit();
   }
}

function getListOfAllBooks() {
   global $db, $bookCount;
   try {
      $query = "SELECT * FROM BOOK"; 
      $statement = $db->prepare($query);
      $statement->execute();
      $bookCount=0;
      while($res = $statement->fetch(PDO::FETCH_ASSOC)){ 
         $bookCount++; 
      } 
      $statement->closeCursor();
      $statement->execute();
      return $statement;
   }   
   catch (PDOException $e) {
      $errorMessage = $e->getMessage();
      echo "<p>SQL error: $errorMessage </p>";
   }   
}
?>
