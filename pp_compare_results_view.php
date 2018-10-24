<?php
include_once "ppdb_header.php";
include "pp_database_data.php";
$gNamesArr=array_filter(explode("\n",$_GET["txtGenes"]),function($gName) {return ! empty($gName);});

if(sizeof($gNamesArr)==0)
{
	echo "<h1>No genes to search provided.</h1>";
}
else
{
	// Connecting to db
	$dbconn = pg_connect($connectionString)
	or die('Could not connect: ' . pg_last_error());
	
	// Getting all annotation types.
	$query="SELECT distinct annot_type from annotation order by annot_type";
	$res=pg_query($query) or die("Couldn't query database.");
	$annotTypes=pg_fetch_all_columns($res);
	$gNameValues=implode(",",array_map(function($input) {if(empty(trim($input))) return ""; else  return "'" . trim(pg_escape_string($input))."'" ;},$gNamesArr));
	 $query="SELECT g.gene_id, g.gene_name, g.genome_version, array_agg((annotation.annot_term, annotation.annot_type)) \"annot\"
	FROM 
	gene g inner join gene_gene on gene_id1=g.gene_id or gene_id2=g.gene_id
	inner join (gene g2 inner join gene_annotation on gene_annotation.gene_id=g2.gene_id) on g2.gene_id=gene_id1 or g2.gene_id=gene_id2
	inner join annotation on annotation.annotation_id=gene_annotation.annotation_id
	right join unnest(array[{$gNameValues}]) WITH ORDINALITY AS searchValues(search_name,ord) on search_name=g2.gene_name
	group by g.gene_id, g.gene_name, searchValues.ord, g.genome_version 
	order by searchValues.ord asc";
	$dbRes=pg_query($query) or die('Query failed: ' . pg_last_error());
	echo "<table class=\"table\" id=\"tblResults\"><thead><tr><th>Gene name</th><th>Version</th>";
	if(isset($_GET["chkShowAnnot"])) echo implode("",array_map(function($type) {return "<th>{$type}</th>";},$annotTypes));
	echo "</tr></thead><tbody>";
	while($row=pg_fetch_array($dbRes,null, PGSQL_ASSOC)) {
		$annotStr="";
		if(isset($_GET["chkShowAnnot"])) 
		{
			// Interpreting array returned by database - removing 3 characters in the end and at the beginning.
			$annotEntries=array_map(function($annotRow) { return explode(",",$annotRow);},explode(")\",\"(",substr($row["annot"],3,-3)));
			// Removing \" enclosing the the multi word annotation types.
			array_walk($annotEntries,function(&$entry){$entry[1]=str_replace("\\\"","",$entry[1]);});
			// Creating columns for each annotation filled with content if a matching annotation was found in the array.
			$annotStr=implode(array_map(function($type) use($annotEntries) {return "<td>" . 
					implode(
						array_map(function($currAnnot){return $currAnnot[0];},
							array_filter($annotEntries,function($item) use($type) { return $item[1] == $type;})),
					";")
							. "</td>";},$annotTypes));
			
		}
		if(empty($row["gene_id"]))
			echo "<tr><td>{$row["gene_name"]}</td><td>!</td>{$annotStr}</tr>";
		else
			echo "<tr id='${row["gene_name"]}' ><td><a href=\"pp_annot.php?name={$row["gene_name"]}\">{$row["gene_name"]}</a></td><td>{$row["genome_version"]}</td>{$annotStr}</tr>";
	}	
	echo "</tbody></table>\n";
	echo "<script type=\"text/javascript\">\n$(\"#tblResults\").dataTable({dom:'Bfrtip',
	buttons:[{text:'fasta', action:function(e,dt,node,config) 
	{ 
	window.open(\"pp_blastdbcmd.php?filename=results.fasta&\" + dt.rows({selected:true}).ids().toArray().filter(function(curId) { return curId != 'undefined';}).map(function(curId) {return \"gids[]=\"+curId;}).join('\&'));
	}},
	'selectAll', 'selectNone',
	{extend:'csv', title:\"geneList\",fieldSeparator:\"\\t\"},
	'copy'],bFilter:false,ordering:false,select:\"multi+shiftString\"});\n</script>";
	// Freeing result and closing connection.
	pg_free_result($dbRes);
	pg_close($dbconn);
}
?>
<?php include_once "ppdb_footer.php"; ?>