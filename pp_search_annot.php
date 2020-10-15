
<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#annot_section"><h3 class="yellow_col">Results found</h3></div>

<div id="annot_section" class="collapse in">
  <br>
  <div class="data_table_frame">

<?php
// Performing SQL query
$desc_input = strtolower($search_input);
if ( preg_match('/\s+/',$desc_input) ) {
  $desc_input = preg_replace('/\s+/','%|%',$desc_input);
}
$query = "SELECT * FROM gene FULL OUTER JOIN gene_annotation USING(gene_id) FULL OUTER JOIN annotation USING(annotation_id) WHERE lower(gene_name) SIMILAR TO '%".pg_escape_string($desc_input)."%' OR lower(annot_desc) SIMILAR TO '%".pg_escape_string($desc_input)."%' OR lower(annot_term) ILIKE '%".pg_escape_string($search_input)."%'";
$res = pg_query($query) or die('Query failed: ' . pg_last_error());

if ($res) {
  // Printing results in HTML
  echo "<table class=\"table annot_table tblAnnotations\">\n<thead><tr><th>Gene</th><th>Term</th><th>Description</th><th>Source</th></tr></thead>\n<tbody>\n";
  // $counter = 0;
  while ($line = pg_fetch_array($res, null, PGSQL_ASSOC)) {
      $found_gene = $line["gene_name"];
      $found_term = $line["annot_term"];
      $found_desc = $line["annot_desc"];
      $found_type = $line["annot_type"];
      echo "<tr><td><a href=\"pp_annot.php?name=$found_gene\" target=\"_blank\">$found_gene</a></td><td>$found_term</td><td>$found_desc</td><td style=\"white-space: nowrap;\">$found_type</td></tr>\n";

  }
  echo "</tbody>\n</table>\n";
}
else {
  echo "<p>No results found.</p>\n";
}
// Free resultset
pg_free_result($res);
?>
  </div>
</div>







<?php
// Performing SQL query
// $desc_input = pg_escape_string($search_input);
//
// if ( preg_match('/\s+/',$desc_input) ) {
//   $desc_input = preg_replace('/\s+/','%|%',$desc_input);
// }
//
// // if(isset($_GET["exact_search"]) and $_GET["exact_search"]=="on")
// // {
// //  $query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE annot_desc SIMILAR TO '%$desc_input%' OR annot_term ILIKE '%$search_input%'";
// // }
// // else
// // {
//  $query="SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE " . getGinWhere("annot_desc", pg_escape_string($desc_input)) . " OR annot_term ILIKE '%" . pg_escape_string($search_input) . "%'";
//  // $query="SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE annot_desc %> '%$desc_input%' OR annot_term ILIKE '%$search_input%'";
// // }
//
// // $query = "SELECT * FROM annotation WHERE annot_desc ILIKE '%$search_input%' OR annot_term ILIKE '%$search_input%'";
// $res = pg_query($query) or die('Query failed: ' . pg_last_error());
// if (pg_result_status($res) == PGSQL_TUPLES_OK && pg_num_rows($res)>0) {
//   // Printing results in HTML
//   echo "<table class=\"table annot_table\" id=\"tblAnnotations\">\n<thead><tr><th>Gene</th><th>Term</th><th>Description</th><th>Source</th></tr></thead>\n";
//   echo "<tbody>\n";
//
//
//   while ($line = pg_fetch_array($res, null, PGSQL_ASSOC)) {
//       $found_gene = $line["gene_name"];
//       $found_term = $line["annot_term"];
//       $found_desc = $line["annot_desc"];
//       $found_type = $line["annot_type"];
//
//       echo "<tr><td><a href=\"pp_annot.php?name=$found_gene\" target=\"_blank\">$found_gene</a></td><td>$found_term</td><td>$found_desc</td><td style=\"white-space: nowrap;\">$found_type</td></tr>\n";
//
//   }
//
//   echo "</tbody></table>\n\n";
// }
// else {
//   echo "<p class=\"yellow_col\">No annotations found.</p>\n";
// }

// Free resultset
//pg_free_result($res);
?>

  <!-- </div>
</div> -->

<!-- <script type="text/javascript">
  $("#tblAnnotations").dataTable({
    dom:'Bfrtip',
    buttons:[{
      extend:'csv',
      text:'Download',
      title:"PpGMLDB_annotations",
      fieldBoundary: '',
      fieldSeparator:"\t"},
      {
        extend:'excel',
        text:'Excel',
        title:"PpGMLDB_annotations",
        fieldSeparator:"\t"
      },
      'copy'],
      bFilter:false
    });
</script> -->
