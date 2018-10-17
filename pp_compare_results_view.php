<?php
include_once "ppdb_header.php";
include "pp_database_data.php";
$gNamesArr=explode("\n",$_GET["txtGenes"]);
$gNameValues=implode(",",array_map(function($input) { return trim(pg_escape_string($input)) ;},$gNamesArr));
$query="SELECT gene_id, searchValues.gene_name, genome_version FROM gene right join unnest('{{$gNameValues}}'::text[]) WITH ORDINALITY AS searchValues(gene_name,ord) using(gene_name) order by searchValues.ord asc";
$dbconn = pg_connect($connectionString)
	or die('Could not connect: ' . pg_last_error());
$dbRes=pg_query($query) or die('Query failed: ' . pg_last_error());
echo "<table class=\"table\" id=\"tblResults\"><thead><tr><th>Gene name</th><th>Version</th></tr></thead><tbody>";
while($row=pg_fetch_array($dbRes,null, PGSQL_ASSOC)) {
	if(empty($row["gene_id"]))
		echo "<tr><td>{$row["gene_name"]}</td><td>!</td></tr>";
	else
		echo "<tr><td><a href=\"pp_annot.php?name={$row["gene_name"]}\">{$row["gene_name"]}</a></td><td>{$row["genome_version"]}</td></tr>";
}	
echo "</tbody></table>\n";
echo "<script type=\"text/javascript\">\n$(\"#tblResults\").dataTable({dom:'Bfrtip',buttons:[{extend:'csv', title:\"{$search_input}\",fieldSeparator:\"\\t\"},'copy'],bFilter:false});\n</script>";
// Freeing result and closing connection.
pg_free_result($dbRes);
pg_close($dbconn);
	
?>
<?php include_once "ppdb_footer.php"; ?>