<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=pfel', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
$req = $bdd->prepare("SELECT * FROM utilisateur WHERE role='etudiant'"); 

$req->execute();
  
while($row=$req->fetch()){
  	// Trouver les sentiments positifs
  	$reqsent = $bdd->prepare("SELECT * FROM sentiment WHERE emetteur_id='$id_emet'");
  	
  	$reqsent->execute(array($row['emetteur_id']));
  	
  	$liste='';
  	
  	while($rowsent=$reqsent->fetch()){
  		if(($rowsent['val_pos']+$rowsent['val_neg'])>0){
  			$reqnom = $bdd->prepare("SELECT fname FROM utilisateur WHERE user_id='$user_id");
  	
  			$reqnom->execute(array($rowsent['destinataire_id']));
  			
  			$rownom=$reqnom->fetch();
  			
  			$liste=$liste.' '.$rownom['fname'];
  		}
  	}
  	
  	echo $row['fname'].' a un sentiment positif avec : '.$liste.'<br>';
  }
?>