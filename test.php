$cmd='ipconfig';

echo $cmd;

$WshShell = new COM("WScript.Shell");
$output = $WshShell->Run($cmd,7,false);
