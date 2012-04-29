<?php

	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "at_db";
	
		mysql_connect($host,$username,$password)
		or die ("Unable to connect to database.");
		
		mysql_select_db($db)
		or die ("Unable to select database.");
		
		$fname=$_GET["fname"];
		$platformname=$_GET["platformname"];
		$quality=$_GET["quality"];
		$fpath=$_GET["filepath"];
		
		$rs = mysql_query("select file_id from audio_inputdata_master where file_name='".$fname."';")
		or die ("Unable to complete query2");
		$info=mysql_fetch_array($rs);
		$fid=$info['file_id'];
		
		$rs = mysql_query("select platform_id from audio_platform_lookup where platform_name = '".$platformname."';")
		or die ("Unable to complete platform query");
		$info=mysql_fetch_array($rs);
		$platformid=$info['platform_id'];
		
		$rs = mysql_query("select quality_id from audio_quality_lookup where quality_name = '".$quality."';")
		or die ("Unable to complete quality query");
		$info=mysql_fetch_array($rs);
		$qualityid=$info['quality_id'];
		
		$rs = mysql_query("select formaudio_id from audio_formaudio_lookup where platform_id = '".$platformid."' AND quality_id = '".$qualityid."';")
		or die ("Unable to complete formatoutput query");
		$info=mysql_fetch_array($rs);
		$formatid=$info['formaudio_id'];
		
		$rs = mysql_query("insert into audio_process_master values(null,'".$fid."','".$formatid."',0,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);")
		or die ("Unable to complete audio process input query");
		

	
	
?>