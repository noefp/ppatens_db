<?php
$seperator=';'
?>
<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#gene_section">
  <h3 class="yellow_col">Gene lookup</h3>
</div>

<div id="gene_section" class="collapse in">
  <br>
  <div class="data_table_frame">

<?php
//$current_version = "3.3";

// Retrieving versions to use before SQL query is performed.
if(isset($_GET["selGeneVersion"]))
{
	$versions=$_GET["selGeneVersion"];
}
else
{
	// Getting all versions
	$versions_res=pg_query(getVersionsQuery()) or die('Query failed: ' . pg_last_error());
	$versions=pg_fetch_all_columns($versions_res) or die("Invalid result after version-request:".pg_last_error());
}
$current_version = max($versions);
$query = getGenesForSearchAndVersion($search_input, $versions);
$res = pg_query($query) or die('Query failed: ' . pg_last_error());
if (pg_result_status($res)==PGSQL_TUPLES_OK && pg_num_rows($res)>0) {
  // Printing results in HTML
  echo "<table class=\"table annot_table\" id=\"genesTable\">\n<thead><tr>";
foreach ($versions as $versionItem)
{

echo "<th>".$versionItem."</th>";
}
echo "</tr></thead>\n<tbody>\n";


  $counter = 0;

  while ($line = pg_fetch_array($res, null, PGSQL_ASSOC)) {
	$counter++;
	// if ($counter >= $max_row) {
//		echo "<tr><td colspan=\"4\">Number of genes found exceeded the limit to display, Please refine your search.</td></tr>\n";
        // break;
    //}
	echo "<tr>";
	$contentsColumn=$line["generow"];
	$splittedRow=explode(")\",\"(",substr($contentsColumn,3,strlen($contentsColumn)-6));
	$splittedEntries=array_map(function($item) { return explode(",",$item);},$splittedRow);
	$curVersionRow=array_filter($splittedEntries,function($entry) use($current_version) { return $entry[1]==$current_version;});
	if(sizeof($curVersionRow)>0)
	{
		$curGName=$curVersionRow[array_keys($curVersionRow)[0]][2];
	}
	else
	{
		$curGName="";
	}
	foreach($versions as $versionItem)
	{
		$filteredRow=array_filter($splittedEntries, function($versionArray) use($versionItem) { return $versionArray[1]==$versionItem;});
		if(sizeof($filteredRow)==0)
			echo "<td></td>";
		else
		{
			if(sizeof($filteredRow)==1)
			{
				$currentVersionRow=$filteredRow[array_keys($filteredRow)[0]];
				echo "<td><a href=\"pp_annot.php?name={$currentVersionRow[2]}\" target=\"_blank\" name=\"openSelectAction\" gid=\"{$currentVersionRow[0]}\" gname=\"{$currentVersionRow[2]}\" curGName=\" {$curGName}\">{$currentVersionRow[2]}</a></td>";
			}
			else
			{
				$tdStr="";
				foreach($filteredRow as $versionVariant)
				{
					$tdStr="{$tdStr}<a href=\"pp_annot.php?name={$versionVariant[2]}\" target=\"_blank\" name=\"openSelectAction\" gid=\" {$versionVariant[0]}\" gname=\"{$versionVariant[2]}\" curGName=\" {$versionVariant[2]}\">{$versionVariant[2]}</a>{$seperator}";
				}
				$tdStr=substr($tdStr,0,-1);
				echo "<td> {$tdStr} </td>";

			}

		}
	}
	echo "</tr>";

  }
  echo "</tbody></table>\n\n";

}
else {
  echo "<p>No genes found.</p>\n";
}

// Free resultset
pg_free_result($res);
?>

  </div>
</div>

<script type="text/javascript">
  $("#genesTable").dataTable({
    dom:'Bfrtip',
    buttons:[{
      extend:'csv',
      text:'Download',
      title:"PpGMLDB_gene_list",
      fieldBoundary: '',
      fieldSeparator:"\t"
    },
    {
      extend:'excel',
      text:'Excel',
      title:"PpGMLDB_gene_list",
      fieldSeparator:"\t"
    },
    'copy', 'colvis'],
    bFilter:true
  });
</script>
