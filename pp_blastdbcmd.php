<?php
include_once "pp_paths.php";
// File is ignored by .gitignore - should contain:
// getBlastdbcmdPath and getBlastdbBaseLocation.
// These functions are returning corresponding paths and taking no arguments. Path of directory ends with /

function getPossibleDbs()
{
	exec("find " . getBlastdbBaseLocation() ."*.fasta.*in -maxdepth 0 -readable -type f -printf '%f\\n'",$ret);
	return $ret;
}

function getFastaFile($gids,$dbPath)
{
	$blastdbcmdPath=getBlastdbcmdPath();
	$blastDbLocation=getBlastdbBaseLocation()  . $dbPath .".fasta";
	exec("{$blastdbcmdPath} -db {$blastDbLocation} -entry " . escapeshellarg(implode(",",$gids)) ."| sed 's/lcl|//'" ,$ret);
	// exec("{$blastdbcmdPath} -db {$blastDbLocation} -entry " . escapeshellarg(implode(",",$gids)),$ret);
	return implode("\n",$ret);

}
if(isset($_POST["gids"]))
	if(isset($_POST["dbPath"]))
	{
		header('Content-Type: application/octet-stream');
		$filename="Pp_GMLDB_{$_POST["dbPath"]}_" . date("Y-m-d.His") . ".fasta";
		header("Content-Disposition: attachment;filename={$filename}");
		$gids=array_map(function($row)
		{
			return trim($row);
		}
		,explode("\n",$_POST["gids"]));
		
		echo getFastaFile($gids,$_POST["dbPath"]);
	}
	else
	{
		echo "<html><head><title>Download fasta file</title></head><body><h1>Select database to use</h1>";
		$dbs=getPossibleDbs();
	echo "<form action=\"pp_blastdbcmd.php\" method=\"post\">";
	echo "<input type=\"hidden\" value=\"{$_POST["gids"]}\" name=\"gids\"></input>";
	echo "<input type=\"hidden\" name=\"filename\" value=\"{$_POST["filename"]}\"></input>";
	echo "<select name=\"dbPath\">";
		echo implode('\n',array_map(function($path){$path=substr($path,0,-10);return "<option value=\"{$path}\">" .
		str_replace("_", " ",$path)
		."</option>";},$dbs));
		echo "</select>";
		echo "<input type=\"submit\"></input>";
		echo "</form></body></html>";
	}

?>
