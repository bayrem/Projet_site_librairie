<?php session_start();?>
<html>
<head>
	
	<title> Recherche
	</title>

</head>

<body TEXT=#000000 background="insat3.jpg">
 <?php if ( !isset($_SESSION) || (empty($_SESSION['nom'])) || (empty($_SESSION['pre'])) )
{?>
	<br><br><br><br><center>
	<table border="2" width="535" bordercolor="gray" background="stop-1.jpg">
	<tr>
	<td bordercolor="#f9e56d" >
	<center>
	<h1><tt><br><br><br><br> Vous n'etes pas connecter<br><br><br><br></h1></center>
	</td>
    </tr>
	</table>
    <meta http-equiv="refresh" content="3; URL=index.php"><?
}
else 
{
	echo "<center> ";
        echo "<strong> ";
	echo "bonjour ";
	echo $_SESSION['pre'];
	echo " ";
	echo $_SESSION['nom'];print " nous sommes le :";
	echo date ("d/m/Y");
	print "<BR>";
	print "il est :";
	echo date ("H:i:s");
	print "<P>" ;
	echo "</strong>";	
?> 
	<center>
	<table border="4" width="700" bordercolor="#000000" background="traits.jpg">
   
	<tr>
	<br>
	<td bordercolor="#f9e56d">
	<h2>
		<center> <Big> <tt> RECHERCHE DES LIVRES</big>
		 	<br>      site universitaire de l'INSAT<br>
		 	<br>
	</h2>
	</table>
        <br>
        <br>
        <br>
	<center>
	<table border="2" width="30%" bordercolor="gray" bgcolor="#4B4B4B">
		<tr>
			<td bordercolor="#f9e56d">
				<center>
				<form method="GET" action="recherche.php" >
					<FONT color="#0099FF">
                    <big>RECHERCHE</big>
					<p><FONT color="white"><strong>Mot Cle</strong><br>
					<input name="mot_cle" size="26" type="text">
                    <?php 
						require_once('fonction.php');
						if(connexion())
						{
							//charger tous les categories pour les mettres dans une liste
							$query="select * from categorie";
							$result=mysql_query($query) or die("la requete a echoue");
							$i=0;
							echo "<p><FONT color=\"white\"><strong>Categorie</strong><br>";
							echo "<select name=\"cat\">";
							echo ("<option selected value=-1>tous les categories</option>");
							while($row=mysql_fetch_array($result))
							{
								$tab_id_cat =$row["id_Cat"];
								$tab_nom_cat =$row["nom_Cat"];
								echo ("<option value=\"$tab_id_cat\">$tab_nom_cat</option>");
							}
							echo "</select>";
						}else
						{
							echo "<BR>";
							echo "base de donnee indisponible";
						}
					?>
					<p><input value="Reinitialiser" type="reset">
					<input value="Rechercher" type="submit">
				</form>
			</td>
		</tr>
        <tr>
                    <td bordercolor="#f9e56d">
                        <p><A HREF = "choix.php"><input value="HOME" type="submit"></A>
                        <center><A HREF = "index.php"><input value="deconnecter" type="submit"></A>
                    </td>
       	</tr>
	</table>	
	
<? } ?>
</body>

</html>