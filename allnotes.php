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
 <center>
  <font size="5" face="Geneva, Arial, Helvetica, sans-serif" color="#993366"></font> 
  <table width="70%" border="0">
    <tr>
      <td bgcolor="#000000"> 
      <div align="center" class="style1 style1"> <a href="users.php" ><font size="5" face="Century Gothic, Courier">Note </font></a></div></td>
    </tr>
  </table>
</center>

							<div align="center">
					<?php 
								$comment_query = mysqli_query($conn,"SELECT * FROM note LEFT JOIN utilisateur on utilisateur.unique_id = note.user_id ") or die (mysqli_error());
								while ($comment_row=mysqli_fetch_array($comment_query)){
								$idnote = $comment_row['idnote'];
								$comment_by = $comment_row['fname']." ".  $comment_row['lname'];
							?>
					<br>
					<a href="#"><?php echo $comment_by; ?></a>  <?php echo $comment_row['valNote']; ?>
					
					        <br>
					        <br>
					        <hr
					&nbsp;
					

					        </p>
						
					        <form method="post">
					&nbsp;
					<?php 
					if ($u_id = $idnote){
					?>
					
				
					
					<?php }else{ ?>
						
					<?php
					} } ?>
					
				

                            </div>
</body>

  

</html>