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
?>
