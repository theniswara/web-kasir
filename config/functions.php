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

// Pesan proses
function alertMessage(){
  if(isset($_SESSION['status'])){
    echo '<div class="alert alert-warning alert-dismissible" role="alert">
      <h6>'.$_SESSION['status'].'</h6>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    unset($_SESSION['status']);
  }
}

// Insert Record
function insert ($tableName, $data)
{
  global $conn;

  $table = validate($tableName);

  $columns = array_keys($data);
  $values = array_values($data);

  $finalColumn = implode(',', $columns);
  $finalValues = "'".implode("','", $values)."'";

  $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
  $result = mysqli_query($conn,$query);
  return $result;
}

?>