<?php session_start();?>
<html>
<head>
</head>
<body TEXT=#000000 background="insat1.jpg" bgcolor="gray">
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
	//$id_etu = $_SESSION['id'];
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
	print "<P>" ;
	echo "</strong>";	
	$mon_id=$_SESSION['id'];
	$mon_nom=$_SESSION['nom'];
	$mon_pre=$_SESSION['pre'];
?> 
    <center>
        <table border="4" width="700" bordercolor="#000000" >
        <tr>
        <br>
        <td bordercolor="#f9e56d">
        <h2>
            <center> <Big> <tt>Consultation des notes</big>
                <br>      site universitaire de l'INSAT<br>
                
                    <br>
        </h2>
        <center>
        <table border="2" width="30%" bordercolor="gray" bgcolor="white" >
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
				$id_mat=$_GET['matiere'];
				if($id_mat!=-1)
				{
					$req="select note,id_dev from note where id_etu = '$mon_id' and id_mat = $id_mat";
					$req2="select * from matiere where id_mat = $id_mat";
					$resultat=mysql_query($req) or die("verifier la requete");
					$num_row=mysql_num_rows($resultat);
					$resultat2=mysql_query($req2) or die("verifier la requete");
					$row2=mysql_fetch_array($resultat2);
					$mat=$row2["lib_mat"];
					$f = "notes de l'etudient ".$mon_pre." ".$mon_nom." dans la matiere ".$mat.".xml";
					echo "<br>";
//					echo $req;
/* 					echo $req2; */
					if($num_row>=1 &&  !mysql_error())
					{
						$file=fopen($f,'w');
						fwrite($file,"<?xml version=\"1.0\" encoding=\"utf-8\" ?><?xml-stylesheet type=\"text/xsl\" href=\"note_devoir.xsl\"?><projet>");
						fwrite($file,"<M>");
						echo "<u><strong><br>Vos notes de la matiere ";
						echo $row2["lib_mat"];
						echo "</strong></u>";
						while($row=mysql_fetch_array($resultat))
						{
							if($row["id_dev"]=='1')
								$b="examen";
							if($row["id_dev"]=='0')
								$b="devoir surveille";
							if($row["id_dev"]=='2')
								$b="TP";
							echo "<center><br>";
							echo $b;
							echo "<strong> ";echo $row["note"]; echo "</strong></center>";
							$note = $row["note"];
							fwrite($file,"<note_matiere>");
							fwrite($file,"<matiere>");
							fwrite($file,"$mat");
							fwrite($file,"</matiere>");
							fwrite($file,"<exam>");
							fwrite($file,"$b");
							fwrite($file,"</exam>");
							fwrite($file,"<note>");
							fwrite($file,"$note");
							fwrite($file,"</note>");
							fwrite($file,"</note_matiere>");
							
						}
						fwrite($file,"</M>");
						fwrite($file,"</projet>");
						fclose($file);
					}
					else
					{
						echo "<BR>";
						print "les devoirs de cette matiere ne sont pas corrigees";
					}
				}
				else
				{
					$req2="select * from matiere";
					$resultat2=mysql_query($req2) or die("verifier la requete");
					$f = "notes de l'etudient ".$mon_pre." ".$mon_nom." dans tous matieres.xml";
					$file=fopen($f,'w');
					fwrite($file,"<?xml version=\"1.0\" encoding=\"utf-8\" ?><?xml-stylesheet type=\"text/xsl\" href=\"note_devoir.xsl\"?><projet>");
					while($row2=mysql_fetch_array($resultat2))
					{
						$mat=$row2["lib_mat"];
						$id_matiere=$row2["id_mat"];
						$req="select note,id_dev from note where id_etu = '$mon_id' and id_mat = $id_matiere";
						$resultat=mysql_query($req) or die("verifier la requete");
						$num_row=mysql_num_rows($resultat);
						echo "<br>";
						//echo $req;
						//echo $req2;
						if($num_row>=1 &&  !mysql_error())
						{
							echo "<u><strong><br>Vos notes de la matiere ";
							echo $row2["lib_mat"];
							echo "</strong></u>";
							fwrite($file,"<M>");
							while($row=mysql_fetch_array($resultat))
							{
								if($row["id_dev"]=='1')
									$b="examen";
								if($row["id_dev"]=='0')
									$b="devoir surveille";
								if($row["id_dev"]=='2')
									$b="TP";
								echo "<center><br>";
								echo $b;
								echo "<strong> ";echo $row["note"]; echo "</strong></center>";
								$note = $row["note"];
								fwrite($file,"<note_matiere>");
								fwrite($file,"<matiere>");
								fwrite($file,"$mat");
								fwrite($file,"</matiere>");
								fwrite($file,"<exam>");
								fwrite($file,"$b");
								fwrite($file,"</exam>");
								fwrite($file,"<note>");
								fwrite($file,"$note");
								fwrite($file,"</note>");
								fwrite($file,"</note_matiere>");
							}
							fwrite($file,"</M>");
						}
						else
						{
							echo "<BR>";
							print "les devoirs de <u><strong>";
							echo $mat;
							echo "</u></strong> ne sont pas corrigees";
						}
					}
					fwrite($file,"</projet>");
					fclose($file);
				}
				
				echo "</td>";
				echo "</tr><br>";
				?>
                </center>
				<tr>
                    <td bordercolor="#f9e56d">
                    	<center><p><A HREF = "note_pre.php"><input value="notes" type="submit"></A></p>
                        <p><A HREF = "choix.php"><input value="HOME" type="submit"></A></p>
                        <p><A HREF = "index.php"><input value="deconnecter" type="submit"></A></p></center>
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


