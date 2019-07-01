<?php   
session_start();

session_destroy(); // Removes the current sesion.
header("Refresh:0; url=index.php");

?>