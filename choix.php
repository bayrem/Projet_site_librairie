<?php session_start();?>
<html>
<head>
	<title> projet telematique
       Site universitaire (INSAT)
	</tiltle>
</head>


<body TEXT=#000000 background="insat1.jpg" bgcolor="#FFFFFF">
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
<table border="4" width="700" height="500" bordercolor="#000000" background="traits.jpg" TEXT=#000000>

	<tr>
        <td bordercolor="#f9e56d" >
            <h2>
                <center> 
                    <Big> <tt> Projet de telematique </tt></big>
                    <br>      site universitaire de l'INSAT<br>
                    <img src ="50px-Smiley_head_happy.png">
                    <br><SMALL> 2009/2010 </small>
                </center>
            </h2>
            <center>
                <table border="2" width="30%" bordercolor="gray" bgcolor="gray">
                    <tr>
                        <center>
                            <td bordercolor="#f9e56d">
                                <center>       BIENVENUE...</center>
                            </td>
                        </center>
                    </tr>
                </table>
        	</center>
            <center>
                <p><A HREF="rech.php"><input value="chercher un livre" type="submit"></A><br>
                <p><A HREF="date_pre.php"><input value="dates des examens" type="submit"></A><br>
                <p><A HREF="note_pre.php"><input value="notes des examens" type="submit"></A>
                <p><A HREF = "index.php"><input value="deconnecter" type="submit"></A>
		</td>
	</tr>
</table>
<? }?>
</body>
</html>