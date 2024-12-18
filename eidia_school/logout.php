<?php 
session_start();

session_unset(); //sup data stockrd in the currect session 
session_destroy(); //destroy the currect session 
 
header("Location: login.php"); // after le logout on reviebt à al page de loggin 
exit;