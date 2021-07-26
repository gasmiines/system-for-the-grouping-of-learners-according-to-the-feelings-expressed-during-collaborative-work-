<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){


            $sql = mysqli_query($conn, "INSERT INTO messages (emetteur_id, destinataire_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')")or die();
										
    //mysqli_query($conn,"insert into sentiment (emetteur_id,destinataire_id,val_pos,val_neg) values ('$emetteur_id','$destinataire_id','$val_pos','$val_neg') ")or die(mysqli_error());	
        }
    }else{
        header("location: ../loginens.php");
    }


    
?>