<?php

	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "at_db";
	//$fname=$_GET["fname"];
	//$fpath=$_GET["fpath"];
	//$src=$_GET["src"];
	//$opid=$_GET["opid"];
	
		mysql_connect($host,$username,$password)
		or die ("Unable to connect to database.");
		
		mysql_select_db($db)
		or die ("Unable to select database.");
	$fname=$_GET["fname"];
	$fpath=$_GET["fpath"];
	$src=$_GET["src"];
		
		
		$rs = mysql_query("call p_i_insertaudiodata('".$fname."','".$fpath."','".$src."');")
		or die ("Unable to complete query1");
		

	
	
?>