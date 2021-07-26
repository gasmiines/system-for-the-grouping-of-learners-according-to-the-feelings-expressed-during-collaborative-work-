	<?php 
  session_start();
  try
{
	$bdd = new PDO('mysql:host=localhost;dbname=pfel;charset=utf8', 'root', ''
	, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // Ajouter ces paramètres pour que php affiche les erreurs liées à la BDD
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

	  $chaine = 'vrai vrai';//$_REQUEST['message'];
	
	// remplacer la ponctuation par "espace"
	
	$ponctuation = array('.', ',', '!', "'"); // COMPLETER
	
	$new_chaine = str_replace($ponctuation, ' ', $chaine);
	
    $mots = explode(' ', $new_chaine);
    
    $nb_pos = 0;
    $nb_neg = 0;
	
	for($i = 0; $i < sizeof($mots); $i++){
        $req = $bdd->prepare("SELECT sentiment 
					        FROM afinn
                            WHERE mot = ?");
        try
        {
            $req -> execute(array(strtolower($mots[$i])));

            if($req->rowCount()>0) { // MOT TROUVE DANS AFINN
                $sent = $req->fetch();

                if($sent[0] > 0) $nb_pos = $nb_pos + $sent[0]; //positif
                else  $nb_neg = $nb_neg + $sent[0]; //negatif
            }    
            //else echo strtolower($mots[$i]).' NON<br/>'; 
    
        }
        catch (Exception $e)
        {
            die("Erreur recherche mot : " . $e->getMessage());
        }

    }
	$req = $bdd->prepare("SELECT * FROM sentiment WHERE emetteur_id=? AND destinataire_id =?");

$req->execute(array($incoming_id, $outgoing_id));
  
if($row=$req->fetch()){
// echo 'modifier';
 
 $idsent = $row['emetteur_id'];
 
 $reqmod = $bdd->prepare("UPDATE sentiment SET val_pos=?, val_neg=? WHERE emetteur_id=?");
 
 $reqmod->execute(array($row['val_pos']+$nb_pos, $row['val_neg']+$nb_neg, $row['emetteur_id']));
 
}else{
	//echo 'inserer';
	
	$reqins = $bdd->prepare("INSERT INTO sentiment (emetteur_id, destinataire_id, val_pos, val_neg) VALUES (?, ?, ?, ?)");
 
	$reqins->execute(array($incoming_id, $outgoing_id, $nb_pos, $nb_neg));
}
?>
