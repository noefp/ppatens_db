<?php
include_once "ppdb_header.php";
include "pp_database_data.php";
?>

<div class="page_container" style="margin-top:40px">
<div class="data_table_frame">

<?php
$gNamesArr=array_filter(explode("\n",trim($_GET["txtGenes"])),function($gName) {return ! empty($gName);});

if(sizeof($gNamesArr)==0)
{
	echo "<h1>No genes to search provided.</h1>";
}
else
{
	// Connecting to db
	$dbconn = pg_connect(getConnectionString());
	$versionWhere="";
	if(isset($_GET["chkVersionName"]) and  sizeof($_GET["chkVersionName"])>0)
	{
		$versions=array_map(function($versionItem) {return trim($versionItem); },$_GET["chkVersionName"]);
	$versionWhere="where g.genome_version in(" . implode(",",
	array_map( function($versionItem)
		{return "'" . pg_escape_string($versionItem) . "'"; },$_GET["chkVersionName"])
	) . ") or g.gene_name=searchValues.search_name";
	}
	else
	{
		$res=pg_query(getVersionsQuery()) or die("Couldn't query database.");
		$versions=pg_fetch_all_columns($res);
	}

	// Getting all annotation types.
	$query="SELECT distinct annot_type from annotation where annot_type not like 'GO %' order by annot_type desc";
	$res=pg_query($query) or die("Couldn't query database.");
	$annotTypes=pg_fetch_all_columns($res);
	$gNameValues=implode(",",array_map(function($input) {if(empty(trim($input))) return ""; else  return "'" . trim(pg_escape_string($input))."'" ;},$gNamesArr));
	 $query="SELECT searchValues.search_name as \"input\", array_agg( distinct (g.gene_name, g.genome_version)) as \"genes\", array_agg(distinct (annotation.annot_desc, annotation.annot_type)) \"annot\"
	FROM
	gene g inner join gene_gene on gene_id1=g.gene_id or gene_id2=g.gene_id
	inner join (gene g2 inner join gene_annotation on gene_annotation.gene_id=g2.gene_id) on g2.gene_id=gene_id1 or g2.gene_id=gene_id2
	inner join annotation on annotation.annotation_id=gene_annotation.annotation_id
	right join unnest(array[{$gNameValues}]) WITH ORDINALITY AS searchValues(search_name,ord) on search_name=g2.gene_name
		{$versionWhere}
	group by searchValues.search_name, searchValues.ord
	order by searchValues.ord desc";
	$dbRes=pg_query($query) or die('Query failed: ' . pg_last_error());
	//echo $query;
	echo "<table class=\"table\" id=\"tblResults\"><thead><tr><th>input</th>";
foreach($versions as $versionItem)
{
	echo "<th>{$versionItem}</th>";
}

	if(isset($_GET["chkShowAnnot"])) echo implode("",array_map(function($type) {return "<th style=\"min-width:200px\">{$type}</th>";},$annotTypes));
	echo "</tr></thead><tbody>";
	while($row=pg_fetch_array($dbRes,null, PGSQL_ASSOC)) {

		// Creating Gene columns:

		// Interpreting array returned by database - removing 3 characters in the end and at the beginning.
		$geneEntries=array_map(function($geneCol) { return explode(",",$geneCol);},explode(")\",\"(",substr($row["genes"],3,-3)));
		// Removing \" enclosing the the multi word gene names.
		array_walk($geneEntries,function(&$entry) {$entry[1]=str_replace("\\\"","",$entry[1]);});
		// Creating columns for each version filled with content if a matching gene was found in the array.
		$geneStr=implode(array_map(function($geneVersion) use($geneEntries) {return "<td>" .
		implode(
		array_map(function($currGene){return $currGene[0];},
		array_filter($geneEntries,function($item) use($geneVersion) { return $item[1] == $geneVersion;})),
		";")
		. "</td>";},$versions));

		// Get all anotations for this row and creating the columns.
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
						array_map(function($currAnnot){return str_replace("\\\"","",$currAnnot[0]);},
							array_filter($annotEntries,function($item) use($type) { return $item[1] == $type;})),

					";")
							. "</td>";},$annotTypes));

		}
		echo "<tr><td><a href=\"/ppatens_db/pp_annot.php?name={$row["input"]}\" target=\"_blank\">{$row["input"]}</a></td>{$geneStr}{$annotStr}</tr>";
	}
	echo "</tbody></table>\n";
	// Freeing result and closing connection.
	pg_free_result($dbRes);
	pg_close($dbconn);
}
?>

</div>
</div>

<script type="text/javascript">
$("#tblResults").dataTable({
	dom:'Bfrtip',
	buttons:[{
		extend:'csv',
		text:'Download',
		title:"PpGMLDB_geneList",
		fieldBoundary: '',
		fieldSeparator:"\t"
	},
	{
		extend:'excel',
		text:'Excel',
		title:"PpGMLDB_geneList",
		fieldSeparator:"\t"
	},
'copy'],
bFilter:false,
ordering:false,
select:"multi+shiftString"
});

</script>


<?php include_once "ppdb_footer.php"; ?>
