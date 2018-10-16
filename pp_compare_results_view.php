<?php
include_once "ppdb_header.php";
include "pp_database_data.php";
$gNamesArr=explode("\n",$_GET["txtGenes"]);
$gNameValues=implode(",",array_map(function($input) { return trim(pg_escape_string($input)) ;},$gNamesArr));
$query="SELECT gene_id, searchValues.gene_name, genome_version FROM gene right join unnest('{{$gNameValues}}'::text[]) WITH ORDINALITY AS searchValues(gene_name,ord) using(gene_name) order by searchValues.ord asc";
$dbconn = pg_connect($connectionString)
	or die('Could not connect: ' . pg_last_error());
$dbRes=pg_query($query);

// Freeing result and closing connection.
pg_free_result($dbRes);
pg_close($dbconn);
	
?>
<?php include_once "ppdb_footer.php"; ?>