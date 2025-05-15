<?php 
session_start();

require 'dbcon.php';

// Valdasi input data
function validate($inputData){  
  global $conn;
  $validatedData = mysqli_real_escape_string($conn, $inputData);
  return trim($validatedData);
}

// Ridirect Halaman
function redirect($url, $status){
  $_SESSION['status'] = $status;
  header("Location: $url");
  exit(0);
}

?>