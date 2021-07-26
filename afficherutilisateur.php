<?php include_once "header.php"; ?>
	
<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location:connexionadm.php");
  }
?>


<?php

include_once "php/config.php";

	    $sql="SELECT * from utilisateur";
		$result=mysqli_query($conn,$sql);	
?>


<link href="styletable.css" rel="stylesheet" type="text/css">
<p>
  <style type="text/css">
  body {
	background-image: url(../sad%20ali/ali/css/images.jpg);
}
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
	font-style: italic;
}

-->
</style>
  <body>
<div class="table_responsive">
<tr>
 <td><h1>
   <em><strong>LISTE DES UTILISATEURS:</strong></em></h1></td>
  </tr> <td width="9%" >
		 <span class="action_btn">
   <a href="deconnexion.php"> Deconnexion</a>
   </span>  </td>
   
   <p>&nbsp;</p>
   <table width="1900%">
 
 <thead>
	<tr>
	<th width="10%">user_id</span></th>
	<th width="10%">unique_id</th>
	<th width="9%">role</th>
	<th width="9%">fname</th>
	<th width="9%">lname</th>
	<th width="9%">email</th>
	<th width="8%">password</th>
	<th width="10%">img</th>
	<th width="9%">status</th>
	<th width="9%">action</th>
   </thead>
	</tr>
<?php while($ET = mysqli_fetch_assoc($result)){?> 
       <tr>	
		<td height="100" ><?php  echo ($ET['user_id']) ?></td>
		<td><?php  echo ($ET['unique_id']) ?></td>
		<td><?php  echo ($ET['role']) ?></td>
		<td><?php  echo ($ET['fname']) ?></td>
		<td><?php  echo ($ET['lname']) ?></td>
		<td><?php  echo ($ET['email']) ?></td>
		<td><?php  echo ($ET['password']) ?></td>
		<td><img src="php/images/<?php echo($ET['img'])?>"></td>
		<td><?php  echo ($ET['status']) ?></td>
		<td width="15%" >
		 <span class="action_btn">
		 <a href="supprimerutilisateur.php?user_id=<?php  echo ($ET['user_id']) ?>">Supprimer</a>
		<a href="editerutilisateur.php?user_id=<?php  echo ($ET['user_id']) ?>">Editer</a>		  </span>         </td>
       </tr>
  
	<?php
}
?>
</table>
</div>
</body>
</html>

