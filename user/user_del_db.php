<?php
//1. เชื่อมต่อ database: 
include('server.php');
include('h.php');

  $ID = $_GET["ID"];


  
  $sql = "DELETE FROM tbl_user  WHERE id='$ID' ";
$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
mysqli_close($conn); 
  
  if($result){
  echo "<script type='text/javascript'>";
  echo "alert('Delected');";
  echo "window.location = 'user_show.php'; ";
  echo "</script>";
  }
  else{
  echo "<script type='text/javascript'>";
  echo "alert('Error back to Update again');";
  echo "</script>";
}
?>

