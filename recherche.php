<?php session_start();?>
<html>
<head>
</head>
<body TEXT=#FF0000 background="insat1.jpg" bgcolor="#000000">
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
        <table border="4" width="500" bordercolor="#000000" background="Book.jpg">
        <tr>
        <br>
        <td bordercolor="#f9e56d">
        <h2>
            <center> <Big> <tt>RECHERCHE DES LIVRES</big>
               <br>
               <br>
        </h2>
        <center>
        <table border="2" width="30%" bordercolor="gray" bgcolor="#000000">
			<?php
				require_once('fonction.php');
				
				if(connexion())
				{}
				else
				{
					echo "";
					exit;
				}
				echo "<tr>";
				echo "<td bordercolor=\"#f9e56d\">";
				if($_GET['mot_cle']!="" and $_GET['cat']!= "-1")
				{ //si les deux champs sont remplies
					$mot_cle = $_GET['mot_cle'];
					$cat = $_GET['cat'];
					$req="select nom_liv from livre where livre.nom_liv LIKE '%$mot_cle%' and livre.id_cat = $cat";
					$resultat=mysql_query($req) or die("verifier la requete");
					$num_row=mysql_num_rows($resultat);
					$req1="select nom_cat from categorie where categorie.id_cat = $cat";
					$resultat1=mysql_query($req1) or die("verifier la requete");
					$row1=mysql_fetch_array($resultat1);
					echo "<strong >Recherche de '$mot_cle' dans '";
					echo $row1["nom_cat"];
					echo "'</strong>";
					echo "<BR>";
					if( $num_row >0 && !mysql_error()){
						$f = $mot_cle." dans ".$row1["nom_cat"].".xml";
						$file=fopen($f,'w');
						fwrite($file,"<?xml version=\"1.0\" encoding=\"utf-8\" ?><?xml-stylesheet type=\"text/xsl\" href=\"cat_mot.xsl\"?><projet>");
						echo "<center>";
						while($row=mysql_fetch_array($resultat)){
							echo $row["nom_liv"];
							$nom_liv = $row["nom_liv"];
							echo "<BR>";
							fwrite($file,"<livre>");
							fwrite($file,"<nom_livre>");
							fwrite($file,"$nom_liv");
							fwrite($file,"</nom_livre>");
							fwrite($file,"</livre>");
						}
						fwrite($file,"</projet>");
						fclose($file);
						echo "</center>";
					}
					else
					{
						echo "<BR>";
						print "aucun resultat1";
					}
					
				}
				else 
				{
					if($_GET['cat']=="-1" and $_GET['mot_cle']=="") 
					{//si seulement le champs categorie est remplie
						$req="select nom_liv from livre";
						$resultat=mysql_query($req) or die("verifier la requet");
						$num_row=mysql_num_rows($resultat);
						echo "<strong >Recherche dans tous les categories</strong><BR>";
						echo "<center>";
						
						if( $num_row >0 && !mysql_error()){
							$f = "tous les livres".".xml";
							$file=fopen($f,'w');
							fwrite($file,"<?xml version=\"1.0\" encoding=\"utf-8\" ?><?xml-stylesheet type=\"text/xsl\" href=\"cat_mot.xsl\"?><projet>");
							while($row=mysql_fetch_array($resultat)){
								$nom_liv=$row["nom_liv"];
								fwrite($file,"<livre>");
								fwrite($file,"<nom_livre>");
								fwrite($file,"$nom_liv");
								fwrite($file,"</nom_livre>");
								fwrite($file,"</livre>");
								echo $row["nom_liv"];
								echo "<BR>";
							}
							fwrite($file,"</projet>");
							fclose($file);
							echo "<center>";
						}
						else{
							echo "<BR>";
							print "aucun resultat";
						}
					}
					else
					{ 	
						if($_GET['cat']=="-1" and $_GET['mot_cle']!="")
						{
							$mot_cle = $_GET['mot_cle'];
							$req="select nom_liv from livre where livre.nom_liv LIKE '%$mot_cle%'";
							$resultat=mysql_query($req) or die("verifier la reque");
							$num_row=mysql_num_rows($resultat);
							if( $num_row >0 && !mysql_error()){
								$f = $mot_cle." dans tous".".xml";
								$file=fopen($f,'w');
								fwrite($file,"<?xml version=\"1.0\" encoding=\"utf-8\" ?><?xml-stylesheet type=\"text/xsl\" href=\"cat_mot.xsl\"?><projet>");
								echo "<strong>Recherche de '$mot_cle'</strong>";
								echo "<center>";
								while($row=mysql_fetch_array($resultat)){
									$nom_liv=$row["nom_liv"];
									fwrite($file,"<livre>");
									fwrite($file,"<nom_livre>");
									fwrite($file,"$nom_liv");
									fwrite($file,"</nom_livre>");
									fwrite($file,"</livre>");
									echo $row["nom_liv"];
									echo "<BR>";
								}
								echo "</center>";
								fwrite($file,"</projet>");
								fclose($file);
							}
							else{
								echo "<BR>";
								print "aucun resultat3";
							}
						}
						else
						{
							$cat = $_GET['cat'];
							$req="select nom_liv from livre where livre.id_cat = '$cat'";
							$resultat=mysql_query($req) or die("verifier la reque");
							$num_row=mysql_num_rows($resultat);
							$req1="select nom_cat from categorie where categorie.id_cat = $cat";
							$resultat1=mysql_query($req1) or die("verifier la requete");
							$row1=mysql_fetch_array($resultat1);
							echo "<strong >Recherche dans '";
							echo $row1["nom_cat"];
							echo "'</strong>";
							echo "<BR>";
							$f = "tous dans ".$row1["nom_cat"].".xml";
								$file=fopen($f,'w');
								fwrite($file,"<?xml version=\"1.0\" encoding=\"utf-8\" ?><?xml-stylesheet type=\"text/xsl\" href=\"cat_mot.xsl\"?><projet>");
							if( $num_row >0 && !mysql_error()){
								while($row=mysql_fetch_array($resultat)){
									$nom_liv=$row["nom_liv"];
									fwrite($file,"<livre>");
									fwrite($file,"<nom_livre>");
									fwrite($file,"$nom_liv");
									fwrite($file,"</nom_livre>");
									fwrite($file,"</livre>");
									echo $row["nom_liv"];
									echo "<BR>";
								}
								echo "</center>";
								fwrite($file,"</projet>");
								fclose($file);
							}
							else{
								echo "<BR>";
								print "aucun resultat3";
							}
						}
					}
				}
				echo "</td>";
				echo "</tr><br>";
				?>
                </center>
				<tr>
                    <td bordercolor="#f9e56d">
                        <p><A HREF = "rech.php"><input value="recherche" type="submit"> </A>
                        <p><A HREF = "choix.php"><input value="HOME" type="submit"></A>
                        <p><A HREF = "index.php"><input value="deconnecter" type="submit"></A>
                    </td>
            	</tr>
        </table>
        <br>
        </td>
        </tr>
    </table>
    <? } ?>
    </center>
</Body>
</html>
