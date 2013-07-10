<?php //session_start();?>
<?php 
	function Connexion()
	{
		$host="mysql4.freehostia.com";
		$bd="bayjri10_db";
		$user="bayjri10_db";
		$pwd="2461988";
		
		$link=mysql_connect($host,$user,$pwd);
		if(!$link)
		{
			echo ("connexion impossible");
			return false;
		}
		$select=mysql_select_db($bd);
		if(!$select)
		{
			echo ("Base de donnée introuvable");
			return false;
		}
		return true;
	}
	
	/* function generateur_XSL($nom_fich,$nbr_colone,$nom_colone,$donne)
	{
		$f = $nom_fich.".xsl";
		$file=fopen($f,'w');
		fwrite($file,"<?xml version='1.0'?><xsl:stylesheet version=\"1.0\" xmlns:xsl=\"http://www.w3.org/1999/XSL/Transform\"><xsl:template match=\"/\"><html><body><table border=\"1\"><tr bgcolor=\"#FFFF00\">");
		for($i=0;i<$nbr_colone;i++)
		{
			fwrite($file,"<td>");
			fwrite($file,"$nom_col[$i]");
			fwrite($file,"</td>");
		}
		fwrite($file,"</tr>");
		
		
		fclose($file);
	} */
?>