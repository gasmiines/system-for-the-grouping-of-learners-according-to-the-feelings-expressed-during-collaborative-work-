<?php 

include_once "php/config.php";
error_reporting(0);


session_start();
$bdd = new PDO('mysql:host=localhost;dbname=pfel', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));//Instructions préparées
        
$req = $bdd->prepare("SELECT * FROM utilisateur WHERE role='etudiant'"); 

$req->execute();
  ?>
 
 <html>
<head>
&nbsp;
<body>
<section>
<div class="sent">
<center>
  <font size="5" face="Geneva, Arial, Helvetica, sans-serif" color="#993366"></font> 
  <table width="70%" border="0">
    <tr>
      <td height="33" bgcolor="#000000"> 
      <div align="center" class="style1 style1"><font size="5" face="Century Gothic, Courier" style="color:#FFFFFF"> Liste des Sentiments</font></div></td>
    </tr>
  </table>
</center>
&nbsp;
<table width="348" height="28" border="3" align="center" bgcolor="#FFFFFF">
  <tr>
    <td width="338" height="22"><div align="center">
      <?php 

while($row=$req->fetch()){
//Extraire une ligne de résultat sous la forme d’un tableau associatif
  	// Trouver les sentiments positifs
  	$reqsent = $bdd->prepare("SELECT * FROM sentiment WHERE emetteur_id=?");
  
  	$reqsent->execute(array($row['unique_id']));
  	
  	$liste='';
  	
  	while($rowsent=$reqsent->fetch()){
	
  		if(($rowsent['val_pos']+$rowsent['val_neg'])>0){
  			$reqnom = $bdd->prepare("SELECT fname , lname FROM utilisateur WHERE unique_id=?");
  	
  			$reqnom->execute(array($rowsent['destinataire_id']));
  			
  			$rownom=$reqnom->fetch();
  			
  			$liste=$liste.' <br>'.$rownom['fname'] .' '.$rownom['lname'] ;
  		}
  	}
  	
  	 if($liste!='')echo $row['fname'].' '.$row['lname'].'  a un sentiment positif avec :'.$liste.'<br>';
  }
  ?>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
</section>
	 </p>



<?php 

$bdd= new PDO("mysql:host=127.0.0.1;dbname=pfel","root", "");
$requete = $bdd->query("SELECT count(*) FROM utilisateur WHERE role='etudiant'");
$nb = $requete->fetch();

if (isset($_SESSION['nomgrp'])) {
    header("Location: inserer_groupe.php");
}
if (isset($_POST['grouper'])) {
    $genre = $_POST['nomgrp'];
	$user_id = $_POST['user_id'];}
	$sql = "SELECT * FROM groupe WHERE idgroup='$idgroup'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {//S’il y a plus de zéro lignes retournées, la fonction place tous les résultats dans un tableau associatif que nous pouvons parcourir en boucle
			$sql = "INSERT INTO groupe (nomgrp, user_id)
					VALUES ('$nomgrp','$user_id')";
			$result = mysqli_query($conn, $sql);}
	
?>
<html>
<head>
<link href="stylegrp.css" rel="stylesheet" type="text/css">


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<h2 align="center" class="Style14 btn-login"><em>Creer groupe</em></h2>
</header>
<header>
<p class="Style1">    

</p>
  <form method="post" action="inserer_groupe.php?nb=<?php echo $nb[0]; ?>" >


    <label for="group_name"> 
    <div align="left"></div>
    </label>
    <div align="center">
	      <p>&nbsp;</p>
	      <section class="sent">
	  <p align="center"><strong>Groupe</strong>:
        <input type="text" id="nomgrp" name="nomgrp" required/>
        <br />
        <br />
	    <?php
	   $bdd= new PDO("mysql:host=127.0.0.1;dbname=pfel","root", "");
	   $requete =$bdd->query("SELECT user_id,fname,lname FROM utilisateur WHERE role='etudiant'");
	   $i=0;
		while($result = $requete->fetch()){
		//select table sentiment
		echo '<input type="checkbox" id="etud'.  $i  .'" name="etud'.  $i .  '" value="'.  $result['user_id'].'">';
		echo $result['fname'] . "  " . $result['lname'] .  "<br />" ;//afficher etud sentiment positif
		$i++;
		}
		
		?>
	  </p>
    </div>
	    
    
    <div align="center">
      <input type="submit" class="btn-login" name="grouper" value="grouper" >
    </div>
  </form>
    	
</div>
</center>
</center>
</body>
</html>

