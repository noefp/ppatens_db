<?php

function getFastaFile($gids,$seqType)
{
	include_once "pp_paths.php"; 
	// File is ignored by .gitignore - should contain: 
	// getBlastdbcmdPath, getBlastdbNucLocation, getBlastdbProtLocation 
	// These functions are returning corresponding paths and taking no arguments.
	
	$blastdbcmdPath=getBlastdbcmdPath();
	if($seqType=="n")
		$blastdbLocation=getBlastdbNucLocation();
	else
		$blastdbLocation=getBlastdbProtLocation();
	else
		return "Invalid sequence type";
	
	exec("{$blastdbcmdPath} -db {$blastdbLocation} -entry " . escapeshellarg(implode(",",$gids)),$ret);
	return implode("\n",$ret);

}
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment;filename={$_GET["filename"]}");
echo getFastaFile($_GET["gids"],$_GET["seqType"]);


?>