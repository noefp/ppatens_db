
<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#annot_section"><h3>Annotations found</h3></div>

<div id="annot_section" class="collapse in">
  <br>


<?php
// Performing SQL query
$desc_input = $search_input;

if ( preg_match('/\s+/',$desc_input) ) {
  $desc_input = preg_replace('/\s+/','%|%',$desc_input);
}
if(isset($_GET["exact_search"]) and $_GET["exact_search"]=="on")
{
 $query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE annot_desc SIMILAR TO '%$desc_input%' OR annot_term ILIKE '%$search_input%'";
}
else
{
 $query="SELECT an.*, gene_name FROM (SELECT getPhoneticCode('$search_input') AS phoneticSearchString) as pho,  (annotation an inner join annotation_phonetic aph on an.annotation_id=aph.annotation_id) JOIN gene_annotation gan on gan.annotation_id=an.annotation_id JOIN gene gen on gen.gene_id=gan.gene_id WHERE aph.phoneticDesc SIMILAR TO '%' || pho.phoneticSearchString || '%' OR aph.phoneticTerm ILIKE '%' || pho.phoneticSearchString || '%'";
}

// $query = "SELECT * FROM annotation WHERE annot_desc ILIKE '%$search_input%' OR annot_term ILIKE '%$search_input%'";
$res = pg_query($query) or die('Query failed: ' . pg_last_error());

if (pg_fetch_assoc($res)) {
  // Printing results in HTML
  echo "<table class=\"table annot_table\">\n<tr><th>Gene</th><th>Term</th><th>Description</th><th>Source</th></tr>\n";

  $counter = 0;

  while ($line = pg_fetch_array($res, null, PGSQL_ASSOC)) {
      $found_gene = $line["gene_name"];
      $found_term = $line["annot_term"];
      $found_desc = $line["annot_desc"];
      $found_type = $line["annot_type"];

      echo "<tr><td><a href=\"pp_annot.php?name=$found_gene\" target=\"_blank\">$found_gene</a></td><td>$found_term</td><td>$found_desc</td><td style=\"white-space: nowrap;\">$found_type</td></tr>\n";
      $counter++;

      if ($counter >= $max_row) {
        echo "<tr><td colspan=\"4\">Number of annotations found exceeded the limit to display, Please refine your search.</td></tr>\n";
        break;
      }
  }

  echo "</table>\n\n";
}
else {
  echo "<p class=\"yellow_col\">No annotations found.</p>\n";
}

// Free resultset
pg_free_result($res);
?>
</div>
