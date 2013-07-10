<?php session_start();?>

<html>
<head>
<title>projet de telematique
    Site universitaire de l'INSAT
</tiltle>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">

<!--
body {
	background-color: #C0C0C0;
       
}
-->
</style></head>
<body TEXT=#000000 background="Tunis_INSAT.JPG" bgcolor="#FFFFFF">
<br>
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
<table border="4" width="700" height="500" bordercolor="#000000" background="https://cp.freehostia.com/members/filemanager2/viewbigimage.php?path=L3d3dy9iaWJvbWFzdGVyLmZyZWVob3N0aWEuY29tL2luc2F0Mi8=&img_name=aW5zYXQzLmpwZw==">
<tr>
	<td bordercolor="#f9e56d">
	<h2>
		<center> <Big> <tt> Projet de telematique </tt></big>
		 	<br>      site universitaire de l'INSAT<br>
		 	
            <br><SMALL> 2009/2010 </small>
	</h2>
</center>
<center>
<table border="2" width="30%" bordercolor="gray" bgcolor="gray">
	<tr>
		<center>
        <td bordercolor="#f9e56d">
			<strong><center>       Notes des examens...         </center></strong>
		</td>
		</center>
	</tr>
</table>
<br>
<center>
<table border="2" width="30%" bordercolor="gray" bgcolor="#000000">
    <tr>
        <td bordercolor="#f9e56d">
            <center>
            <form method="get" action="note.php" >
                <FONT color="#0000CD"><strong>matiere</strong><br>
<? // liste des matiere
						require_once('fonction.php');
						connexion();
						//charger tous les matieres pour les metres dans une liste
						$query="select * from matiere";
						$result=mysql_query($query) or die("la requete a echoue");
						$i=0;
						echo "<p><FONT color=\"white\"><strong>Matiere</strong><br>";
						echo "<select name=\"matiere\">";
						echo ("<option selected value=-1>tous les matieres</option>");
						while($row=mysql_fetch_array($result))
						{
							$tab_id_mat =$row["id_mat"];
							$tab_nom_mat =$row["lib_mat"];
							echo ("<option value=\"$tab_id_mat\">$tab_nom_mat</option>");
						}
						echo "</select>";                
?>
                <p><input value="Reinitialiser" type="reset">
                <input value="consulter" type="submit">
            </form>
        </td>
    </tr>
    <!--<tr>
        <td bordercolor="#f9e56d">
            <center>
            <form method="get" action="note_bd_xml.php" >
                <FONT color="#0000CD"><strong>matiere</strong><br>
				<? /* // liste des matiere
						require_once('fonction.php');
						connexion();
						//charger tous les matieres pour les metres dans une liste
						$query="select * from matiere";
						$result=mysql_query($query) or die("la requete a echoue");
						$i=0;
						echo "<p><FONT color=\"white\"><strong>Matiere</strong><br>";
						echo "<select name=\"matiere\">";
						echo ("<option selected value=-1>tous les matieres</option>");
						while($row=mysql_fetch_array($result))
						{
							$tab_id_mat =$row["id_mat"];
							$tab_nom_mat =$row["lib_mat"];
							echo ("<option value=\"$tab_id_mat\">$tab_nom_mat</option>");
						}
						echo "</select>";  */               
				?>
                <p><input value="Reinitialiser" type="reset">
                <input value="avec bd xml" type="submit">
            </form>
        </td>
    </tr>-->
    
    <tr>
    	<td bordercolor="#f9e56d">
            <center><A HREF = "choix.php"><input value="HOME" type="submit"></A><Br>
            <A HREF = "index.php"><input value="deconnecter" type="submit"></A></center>
        </td>
   	</tr>
</table>
</center>
<? }?>
</body>
</html>