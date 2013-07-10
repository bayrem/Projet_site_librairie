<?php session_start();
$loginOK=false;?>
<html>
<head>

</head>
<body TEXT=#F00000 bgcolor="#000000">
<?php
	require_once('fonction.php');
	if ( isset($_POST) && (!empty($_POST['pseudo'])) && (!empty($_POST['password'])) )
	{
	
		extract($_POST);  // je vous renvoie a la doc de cette fonction
		$pseudo = $_POST['pseudo'];
		$password = $_POST['password'];
		
		if(connexion())
		{
                        
			$req="select * from etudient where login='$pseudo'";
			$resultat=mysql_query($req) or die("connexion impossible!!!!!!!!!!!!!");
			$num_row=mysql_num_rows($resultat);
			if( $num_row == 1 && !mysql_error())
			{
				$data = mysql_fetch_assoc($resultat);
				if ($password == $data["pass"])
				{
				  	$loginOK = true;
					print "<br><br><br><br><center>";
					print "<table border=\"2\" width=\"600\" bordercolor=\"gray\" background=\"OK.png\">";
						print "<tr>";
							print "<td bordercolor=\"#f9e56d\">";
								print "<center>";
									print "<center><h1><tt> <br><br><br>Vous etes bien identifie";
									print "<BR>";
									echo "bonjour monsieur ";
									echo $data["pre_etu"] ;
									print " ";
									echo $data["nom_etu"];
									print "<BR>";
									echo "Redirection vers page d'acceuil dans 2 seconde.";
									print "<BR>";
									echo "appuye <A HREF = \"choix.php\"> ici </A> pour continuer...";
									print "<br><br><br><br><br> </h1>";
								print "</form>";
							print "</td>";
						print "</tr>";
					print "</table>";?>
					<meta http-equiv="refresh" content="3; URL=choix.php">
                    <?
				}
			}
		}
else {
			echo "Authentification impossible";
		}
	}
	if ($loginOK)
	{
	  $_SESSION['login'] = $data["login"];
	  $_SESSION['nom'] = $data["nom_etu"];
	  $_SESSION['pre'] = $data["pre_etu"];
	  $_SESSION['id'] = $data["id_etu"];
	}
	else
	{
	  echo 'Une erreur est survenue, veuillez reessayer !';
	  print "<br><br><br><br><center>";
			print "<table border=\"2\" width=\"535\" bordercolor=\"gray\" background=\"9if.jpg\">";
				print "<tr>";
					print "<td bordercolor=\"#f9e56d\">";
						print "<center>";
							print "<center><h1><tt><br><br><br><br> Verifier votre demande";
							print "<br><br><br><br> </h1>";
						print "</form>";
					print "</td>";
				print "</tr>";
			print "</table>";
			?>
            </center><meta http-equiv="refresh" content="3; URL=index.php"><?
	}
?>
</Body>
</html>