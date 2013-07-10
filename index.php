<?php 
	// recuperation de session ouvert
	session_start();
	// annulation de session
	$_SESSION = array();
	session_destroy();
?>
<html>
<head>
	<title> Projet de Technoligie Internet,
		Site de gestion de location de film
	</title>
</head>
<body TEXT=#000000 bgcolor="gray">
	<center>
	
	<table border="5" width="700" height="486" bordercolor="#000000" background="insat11.gif">
	<tr>
	<br>
	<td bordercolor="#f9e56d">
	<h2>
		<center> <Big> <tt> Projet de Technoligie Internet</big>
		 	<br>      site gestion de location de film<br>
		 	
	    	 	<br><SMALL> 2010/2011 </small>
	</h2>
	<br>
	<br>
	<br><br>
	<br>
	<br><br>
	<br>
	<br>
	</table>
	<br>
	<br>
	<br>
	<center>
	<table border="4" width="50%" bordercolor="red" bgcolor="#000000">
		<tr>
			<td bordercolor="#f9e56d">
				<center>
				<form method="post" action="authentification_session.php" >
					<FONT color="#0099FF"><big>Connection</big>		
					<p><FONT color="white"><strong>Pseudo</strong><br>
					<input name="pseudo" size="26" type="text">
					<br><strong>Mot de passe</strong><br>
					<input name="password" size="26" type="password">			
					<p><input value="Reinitialiser" type="reset">
					<input value="Connection" type="submit">
				</form>
			</td>
		</tr>
	</table>
	<br>
	</td>
	</tr>

</body>
</html>