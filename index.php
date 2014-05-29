<?php 
date_default_timezone_set('America/New_York');
require_once('databaseLibrary.php');
$db = null;
$bookCount = 0;

connectToDatabase();

if ( empty($_POST) || isset($_POST['list_books']) ) { 
   $statement = getListOfAllBooks();
   if ($bookCount > 0) 
      include('listBooksView.php');
   else
      echo "No results found.";
}

else if ( isset($_POST['search_books'])) {
	$sa = $_POST['attribute'];
	$st = $_POST['searchTerm'];
	$statement = searchBooks($sa, $st);
	include('listBooksView.php');

}

else if ( isset($_POST['add_book'])) {
	include('addBookView.php');

}

else if ( isset($_POST['save_book'])) {
	print_r($_POST);
	addBook();
	$statement = getListOfAllBooks();
	include('listBooksView.php');

}

?>
