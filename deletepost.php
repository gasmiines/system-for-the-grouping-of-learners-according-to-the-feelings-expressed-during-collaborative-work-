<?php 
include ('php/config.php');
$id=$_GET['id'];

mysqli_query($conn,"delete from travail where idtravail='$id'") or die (mysqli_error());
header ('location:home.php');

?>