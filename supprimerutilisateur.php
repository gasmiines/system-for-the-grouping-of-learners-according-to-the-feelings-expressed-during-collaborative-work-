<?php

include_once "php/config.php";
$user_id=$_GET['user_id'];

	    $sql="DELETE from utilisateur where (user_id=$user_id)";
		$result=mysqli_query($conn,$sql);
		header("location:afficherutilisateur.php");	
?>