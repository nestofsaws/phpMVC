<?php 
date_default_timezone_set('America/New_York');
require_once('databaseLibrary.php');
$db = null;
$bookCount = 0;
$errorMessage = "";
$reviewCount =0;

connectToDatabase();


if (isset($_POST['return'])) { 
   header('Location: .');  }

if (((empty($_POST)) && (empty($_GET))) || isset($_POST['list_books'])) { 
   $statement = getListOfAllBooks();
   if ($bookCount > 0) 
      include('listBooksView.php');
}

else if (isset($_POST['search_books'])) {  
   $searchAttribute = $_POST['attribute'];
   $searchTerm = $_POST['searchTerm'];
   $statement = searchBooks($searchAttribute, $searchTerm);
   include('listBooksView.php');
}

else if (isset($_POST['add_new_book'])) { 
   include('addBookView.php');   
}
else if (isset($_POST['save_new_book'])) { 
   if (addBook() ) {
      $isbn = $_POST['isbn'];
      $res = getBook($isbn);
      if ($res)
         include('viewBookView.php');  
      else
         echo "Could not find book for ISBN " . $isbn;  
   }
   else
      include('addBookView.php');   //refresh page with $errorMessage 
}
else if (isset($_POST['delete_book'])) { 
   $isbn = $_POST['isbn'];
   if (deleteBook($isbn) ) {
      header('Location: .');   // redirect request
   }
   else
      include('viewBookView.php');   //refresh page with $errorMessage 
}
else if (isset($_POST['update_book'])) { 
   $isbn = $_POST['isbn'];
   $res = getBook($isbn);
   if ($res)
      include('updateBookView.php');
   else
      echo "Could not find book for ISBN " . $isbn;      
}
else if (isset($_POST['save_book_updates'])) {
   $isbn = $_POST['isbn'];
   updateBook($isbn);
   $res = getBook($isbn);
   if ($res)
      include('viewBookView.php');  
   else
      echo "Could not find book for ISBN " . $isbn;  
}
else if (isset($_POST['add_review'])) { 
   $isbn = $_POST['isbn'];
   $res = getBook($isbn);
   if ($res)
      include('addReviewView.php');
   else
      echo "Could not find book for ISBN " . $isbn;      
}
else if (isset($_POST['save_review'])) {
   $isbn = $_POST['isbn'];
   saveReview($isbn);
   $res = getBook($isbn);
   if ($res)
      include('viewBookView.php');  
   else
      echo "Could not find book for ISBN " . $isbn;  
}

else if(isset($_GET['isbn'])) {
   $isbn = $_GET['isbn'];
   $res = getBook($isbn);
   
   if ($res)
      include('viewBookView.php');  
   else
      echo "Could not find book for ISBN $isbn";
}

?>
