
<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#gene_section"><h3>Genes found</h3></div>

<div id="gene_section" class="collapse in">
  <br>

<?php
print_r($_GET);
$current_version = "3.3";

// Performing SQL query
$query = "SELECT * FROM gene WHERE gene_name ILIKE '%$search_input%' ORDER BY genome_version DESC, gene_name ASC";
$res = pg_query($query) or die('Query failed: ' . pg_last_error());

if (pg_fetch_assoc($res)) {

  $res = pg_query($query) or die('Query failed: ' . pg_last_error());

  // Printing results in HTML
  echo "<table class=\"table annot_table\">\n<tr><th>Current Gene</th><th>Gene Found</th><th>Gene Version</th></tr>\n";

  $counter = 0;

  while ($line = pg_fetch_array($res, null, PGSQL_ASSOC)) {
      $found_gene_name = $line["gene_name"];
      $found_gene_id = $line["gene_id"];
      $found_gene_version = $line["genome_version"];

      if ($found_gene_version == $current_version) {

        echo "<tr><td><a href=\"pp_annot.php?name=$found_gene_name\" target=\"_blank\">$found_gene_name</a></td><td><a href=\"pp_annot.php?name=$found_gene_name\" target=\"_blank\">$found_gene_name</a></td><td>$found_gene_version</td></tr>\n";
        $counter++;

        if ($counter >= $max_row) {
          echo "<tr><td colspan=\"4\">Number of genes found exceeded the limit to display, Please refine your search.</td></tr>\n";
          break;
        }

      }
      else {
        $gene_id_query = "SELECT * FROM gene JOIN gene_gene ON(gene_id=gene_id1) WHERE gene_id2=$found_gene_id";
        $gid_res = pg_query($gene_id_query) or die('Query failed: ' . pg_last_error());


        while ($line = pg_fetch_array($gid_res, null, PGSQL_ASSOC)) {
            $new_gene_name = $line["gene_name"];
            echo "<tr><td><a href=\"pp_annot.php?name=$new_gene_name\" target=\"_blank\">$new_gene_name</a></td><td><a href=\"pp_annot.php?name=$found_gene_name\" target=\"_blank\">$found_gene_name</a></td><td>$found_gene_version</td></tr>\n";

            $counter++;

            if ($counter >= $max_row) {
              echo "<tr><td colspan=\"4\">Number of genes found exceeded the limit to display, Please refine your search.</td></tr>\n";
              break 2;
            }
        }
      }

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
