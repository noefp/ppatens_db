
<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#gene_section"><h3>Genes found</h3></div>

<div id="gene_section" class="collapse in">
  <br>

<?php
$current_version = "3.3";

// Performing SQL query
if(isset($_GET["version_search"]) and $_GET["version_search"]=="on")
{
	if(isset($_GET["selGeneVersion"]))
	{
		$versions=$_GET["selGeneVersion"];
	}
		else
		{
			$versions=[];
		}
}
else
{
	// Getting all versions
	$versions_res=pg_query(getVersionsQuery()) or die('Query failed: ' . pg_last_error());
	$versions=pg_fetch_all_columns($versions_res) or die("Invalid result after version-request:".pg_last_error());
}
	
$query = getGenesForSearchAndVersion($search_input, $versions);
$res = pg_query($query) or die('Query failed: ' . pg_last_error());

if (pg_fetch_assoc($res)) {

  $res = pg_query($query) or die('Query failed: ' . pg_last_error());

  // Printing results in HTML
  echo "<table class=\"table annot_table\">\n<tr>";
foreach ($versions as $versionItem)
{
echo "<th>".$versionItem."</th>";
}
echo "</tr>\n";


  $counter = 0;

  while ($line = pg_fetch_array($res, null, PGSQL_ASSOC)) {
	$counter++;
	if ($counter >= $max_row) {
		echo "<tr><td colspan=\"4\">Number of genes found exceeded the limit to display, Please refine your search.</td></tr>\n";
        break;
    }
	echo "<tr>";
	$contentsColumn=$line["generow"];
	$splittedRow=explode(")\",\"(",substr($contentsColumn,3,strlen($contentsColumn)-6));
	$splittedEntries=array_map(function($item) { return explode(",",$item);},$splittedRow);
	foreach($versions as $versionItem)
	{
		$filteredRow=array_filter($splittedEntries, function($versionArray) use($versionItem) { return $versionArray[1]==$versionItem;});
		if(sizeof($filteredRow)==0)
			echo "<td></td>";
		else
			echo "<td>".array_pop($filteredRow)[2]."</td>";
	}
	echo "</tr>";
	
  }
  echo "</table>\n\n";
}
else {
  echo "<p class=\"yellow_col\">No genes found.</p>\n";
}

// Free resultset
pg_free_result($res);
?>

</div>