<!DOCTYPE html>
<html>
<head>
	<?php 
	session_start();
  include_once "php/config.php";
  ?>
	

    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
    </style>
</head>
<body>
<link rel="stylesheet" href="stylegrp.css">


							<div align="center">
							<center>
  <font size="5" face="Geneva, Arial, Helvetica, sans-serif" color="#993366"></font> 
  <table width="70%" border="0">
    <tr>
      <td bgcolor="#000000"> 
      <div align="center" class="style1 style1 style1"><font size="5" face="Century Gothic, Courier"> Reponses</font></div></td>
    </tr>
  </table>
</center>
					<?php 
								$comment_query = mysqli_query($conn,"SELECT * ,UNIX_TIMESTAMP() - date_posted AS TimeSpent FROM reponse LEFT JOIN utilisateur on utilisateur.unique_id = reponse.user_id ") or die (mysqli_error());
								while ($comment_row=mysqli_fetch_array($comment_query)){
								$idreponse = $comment_row['idreponse'];
								$comment_by = $comment_row['fname']." ".  $comment_row['lname'];
							?>
					<br>
					<?php echo $comment_by; ?></a> - <?php echo $comment_row['content']; ?>
					<br>
							<?php				
								$days = floor($comment_row['TimeSpent'] / (60 * 60 * 24));
								$remainder = $comment_row['TimeSpent'] % (60 * 60 * 24);
								$hours = floor($remainder / (60 * 60));
								$remainder = $remainder % (60 * 60);
								$minutes = floor($remainder / 60);
								$seconds = $remainder % 60;
								if($days > 0)
								echo date('F d, Y - H:i:sa', $comment_row['date_posted']);
								elseif($days == 0 && $hours == 0 && $minutes == 0)
								echo "A few seconds ago";		
								elseif($days == 0 && $hours == 0)
								echo $minutes.' minutes ago';
							?>
					        <br>
					        <br>
					        <hr
					&nbsp;
					

					        </p>
						
					        <form method="post">
					&nbsp;
					<?php 
					if ($u_id = $idreponse){
					?>
					
				
					
					<?php }else{ ?>
						
					<?php
					} } ?>
					
				

                            </div>
							 <p align="right"><a href="note.php" class="swagbutton"> Noter Travail </a></p>
</body>

  

</html>