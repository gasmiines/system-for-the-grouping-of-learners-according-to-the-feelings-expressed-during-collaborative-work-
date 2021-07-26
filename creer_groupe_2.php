<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=pfel', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
$req = $bdd->prepare("SELECT * FROM utilisateur WHERE role='etudiant'"); 

$req->execute();
  
while($row=$req->fetch()){
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
