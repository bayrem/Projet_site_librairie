<?php session_start();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style1 {color: #993300}
-->
</style>
</head>

<body TEXT=#000000 background="insat1.jpg" bgcolor="#000000">
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
	
	$matiere= $_GET['matiere'];

	require_once('fonction.php');
	connexion();
	if($matiere!=-1)
	{
		$req="select * from matiere where (lib_mat='$matiere')";
		$f = "date des devoirs de ".$matiere."2.xml";
	}
	else
	{
		$req="select * from matiere";
		$f = "date tous matiers.xml";
	}
	$resultat=mysql_query($req) or die("connexion impossible");
    $num_row=mysql_num_rows($resultat);
	if( $num_row >= 1 && !mysql_error())
	{
		$file=fopen($f,'w');
		fwrite($file,"<?xml version=\"1.0\" encoding=\"utf-8\" ?><?xml-stylesheet type=\"text/xsl\" href=\"date_devoir2.xsl\"?><projet>");
		//HTML
			print "<BR>";      
			print"<center>";
			print"<img src=\"INSAT.png\"></center>";      
			print"<br><center>";        
			print "<table border=\"4\" width=\"600\" height=\"300\"  bordercolor=\"black\"  >";
			echo "<body bgcolor=' 	lightgrey'>";
			print"<tr>";
			print"<td>";
			print"<font size=\"4\" face=\"Georgia, Times New Roman, Times, serif\" color=\"red\"><i>";
				print"<center>";
        while($row=mysql_fetch_array($resultat))
		{
			$a=$row["id_mat"];
			$nom_mat=$row["lib_mat"];
			$req2="select date,id_dev from dev_mat where (id_mat='$a')";
			
			$resultat2=mysql_query($req2) or die("connexion impossible");
			$num_row2=mysql_num_rows($resultat2);
			if( $num_row2 == 0)//si la date de matière n'est pas encore saisie
			{
				echo"<br>";echo"<br>";
				print"<strong>";
				echo "<u><span class=\"style1\">nous sommes desole mais nous n'avons pas Les dates des examens pour la matiere  $nom_mat  :</span></u>";
				echo"<br>";
			}
			else //traitement des donnee 
			{
				//HTML
				echo "Bonjour .. ";
				echo"<br>";
				echo "Voici le resultat de votre consultation :</i></font>";
				print"<br><br><strong>";
				echo" <u><span class=\"style1\">Les dates des examens pour la matire $nom_mat :</span></u> ";
				print"<br><br>";
				fwrite($file,"<M>");
				while($row2=mysql_fetch_array($resultat2))
				{
					if($row2["id_dev"]=='1')
						$b="examen";
					if($row2["id_dev"]=='0')
						$b="devoir surveillee";
					if($row2["id_dev"]=='2')
						$b="TP";
					echo $b;
					echo"  : ";
					echo $row2["date"];
					print"<br>";
					$date = $row2["date"];
					//fichier xml
					fwrite($file,"<date_matiere>");
					fwrite($file,"<matiere>");
					fwrite($file,"$nom_mat");
					fwrite($file,"</matiere>");
					fwrite($file,"<exam>");
					fwrite($file,"$b");
					fwrite($file,"</exam>");
					fwrite($file,"<date>");
					fwrite($file,"$date");
					fwrite($file,"</date>");
					fwrite($file,"</date_matiere>");
				}
				fwrite($file,"</M>");
			}
		}
		fwrite($file,"</projet>");
		fclose($file);
	}
	else //pour les req erronés 
	{
		echo "<body bgcolor=' 	lightgrey'>";
		print "<center>";
		print "<table border=\"2\" width=\"535\" height=\"307\" bordercolor=\"gray\" background=\"stop.jpg\">";
		print "<tr>";
		print "<td bordercolor=\"#f9e56d\">";
		print "<center>";
		print "<center><h1><tt><br><br><br> Verifier votre requete";
		print "<br><br><br></h1>";
		print "</form>";
		print "</td>";
		print "</tr>";
		print "</table>";
		print "<table><tr><td>";
	}
	//pour les boutons
	echo "<center>";
	print"<p><A HREF=\"index.php\"><input value=\"deconnecter\" type=\"submit\"></A>"; 
	print"<A HREF=\"date_pre.php\"><input value=\"date devoir\" type=\"submit\"></A>"; 
	print"<A HREF=\"choix.php\"><input value=\"HOME\" type=\"submit\"></A>"; 
	echo "</center>";
	print"</strong></td></tr></center></table>";
}
?>
</body>
</html>
