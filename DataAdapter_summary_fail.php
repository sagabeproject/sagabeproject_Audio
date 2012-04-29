<?php
 //SQL Connection Info - update with your database, username & password
 $connection = mysql_connect('localhost', 'root', '') or die ('cannot reach database');
 $db = mysql_select_db("at_db") or die ("this is not a valid database");

 //Change this query as you wish for single or multiple records
 $rs = mysql_query("select * from audio_process_master where status_id = 4;");
 $result = mysql_query("select file_name,file_path,dte_update from audio_inputdata_master where file_id = ".mysql_result($rs,$i,"queued_file_id").";")//For processed videos
					or die ("Unable to complete in body of processed videos 1".mysql_error() );

							

 //Get the number of rows
 $num_row = mysql_num_rows($result);

 //Start the output of XML
 echo '<?xml version="1.0" encoding="iso-8859-1"?>';
 echo "<data>";
 echo '<num>' .$num_row. '</num>';
 if (!$result) {
    die('Query failed: ' . mysql_error());
 }    
 /* get column metadata - column name -------------------------------------------------*/
         $i = 0;
         while ($i < mysql_num_fields($result)) {
               $meta = mysql_fetch_field($result, $i);
             $ColumnNames[] = $meta->name;                      //place col name into array
             $i++;
         }
 $specialchar = array("&",">","<");                                         //special characters
 $specialcharReplace = array("&amp;","&gt;","&lt;");            //replacement
 /* query & convert table data and column names to xml ---------------------------*/

 $w = 0;    
 while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "<row>";
     foreach ($line as $col_value){
         echo '<'.$ColumnNames[$w].'>';
         $col_value_strip = str_replace($specialchar, $specialcharReplace, $col_value);        
         echo $col_value_strip;
         echo '</'.$ColumnNames[$w].'>';
         if($w == ($i - 1)) { $w = 0; }
         else { $w++; }
        }
     echo "</row>";
 }
if($num_row  == "1"){
     echo '<row></row>';
 }
 echo "</data>";
 mysql_free_result($result);
 ?>