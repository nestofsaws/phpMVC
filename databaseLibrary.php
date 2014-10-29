<?php 

function connectToDatabase() {
   global $db;
   try {
      $db = new PDO('sqlite:bookstoreWithDesc.sqlite'); 
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

function searchBooks($attr, $term) {
   global $db, $bookCount;
   try {
      $query = "SELECT * FROM BOOK WHERE " . $attr . " LIKE '%" . $term . "%'";
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

function getBook($isbn) {
   global $db, $errorMessage;
   $query = "SELECT  * FROM BOOK WHERE BOOK.ISBN='" . $isbn . "'";
   try {
      $statement = $db->prepare($query);
      $statement->execute();
      $res = $statement->fetch(PDO::FETCH_ASSOC);
      return $res;
   }   
   catch (PDOException $e) {
      $errorMessage = $e->getMessage();
      echo "<p>SQL error: $errorMessage </p>";
   }   
}

function addBook() {
   global $db, $errorMessage;
   $query = "INSERT INTO BOOK VALUES ('" . $_POST['isbn'] . "','" . $_POST['title'] . "','" . $_POST['author'] . "','" . $_POST['publisher'] . "','" . $_POST['format'] . "','" . $_POST['subject'] . "','" . $_POST['description'] . "')" ;
   try {
      $statement = $db->prepare($query);
      $statement->execute();   // true if successful, otherwise false
      $statement->closeCursor();
	  return TRUE;
   }
   catch (PDOException $e) { 
      //$errorMessage = $e->getMessage();
      $errorMessage = "Error: a book with ISBN '" . $_POST['isbn'] . "' already exists.";
      return FALSE;
   }
}

function deleteBook($isbn) {
   global $db, $errorMessage;
   $query = "DELETE FROM BOOK WHERE ISBN='$isbn'";
   try {
      $statement = $db->prepare($query);
      $statement->execute();   // true if successful, otherwise false
      $statement->closeCursor();
      return TRUE;
   }
   catch (PDOException $e) {     
      $errorMessage = $e->getMessage();
      echo "<p>SQL error: Delete book failed, $errorMessage </p>";
      return FALSE;
   }
}

function updateBook($isbn) {
  global $db, $errorMessage;
  $query = "UPDATE BOOK SET Title='" . $_POST['title'] . "', Author='" . $_POST['author'] . "', Publisher='" . $_POST['publisher'] . "', Format='" . $_POST['format'] . "', Subject='" . $_POST['subject'] . "' , Description='" . $_POST['description'] . "' WHERE ISBN='" . $isbn . "'" ;
  try {
      $statement = $db->prepare($query);
      $statement->execute();   // true if successful, otherwise false
      $statement->closeCursor();
      return TRUE;
   }
   catch (PDOException $e) {     
      $errorMessage = $e->getMessage();
      echo "<p>SQL error: Update book failed, $errorMessage </p>";
      return FALSE;
   }
}
//jpb
function getReviewCount($isbn) {
   global $db, $errorMessage, $reviewCount;
   $reviewCount = 0;
   try {
      $query = "SELECT  * FROM REVIEWS WHERE ISBN='" . $isbn . "' ORDER BY Date DESC";
      $statement = $db->prepare($query);
      $statement->execute();
	  $reviewCount=0;
      while($res = $statement->fetch(PDO::FETCH_ASSOC)){ 
         $reviewCount++; 
      } 
      $statement->closeCursor();
      $statement->execute();
      return $reviewCount;
   }   
   catch (PDOException $e) {
      $errorMessage = $e->getMessage();
      echo "<p>SQL error: $errorMessage </p>";
   }   
}
//jpb


function getReviews($isbn) {
   global $db, $errorMessage, $reviewCount;
   try {
      $query = "SELECT  * FROM REVIEWS WHERE ISBN='" . $isbn . "' ORDER BY Date DESC";
      $statement = $db->prepare($query);
      $statement->execute();
	  $reviewCount=0;
      while($res = $statement->fetch(PDO::FETCH_ASSOC)){ 
         $reviewCount++; 
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

function saveReview($isbn) {
  global $db, $errorMessage;
  //$query = "UPDATE BOOK SET Title='" . $_POST['title'] . "', Author='" . $_POST['author'] . "', Publisher='" . $_POST['publisher'] . "', Format='" . $_POST['format'] . "', Subject='" . $_POST['subject'] . "' , Description='" . $_POST['description'] . "' WHERE ISBN='" . $isbn . "'" ;
  $query = "INSERT INTO REVIEWS VALUES ('" . $isbn . "','" . $_POST['reviewer'] . "','" . date("Y-m-d") . "','" . $_POST['review'] . "')" ;
   
  try {
      $statement = $db->prepare($query);
      $statement->execute();   // true if successful, otherwise false
      $statement->closeCursor();
      return TRUE;
   }
   catch (PDOException $e) {     
      $errorMessage = $e->getMessage();
      echo "<p>SQL error: Update book failed, $errorMessage </p>";
      return FALSE;
   }
}


//$query = "SELECT  REVIEWS.Reviewer, REVIEWS.Date, REVIEWS.Review FROM REVIEWS INNER JOIN BOOK ON REVIEWS.ISBN=BOOK.ISBN WHERE BOOK ISBN='" . $isbn . "'";

?>
