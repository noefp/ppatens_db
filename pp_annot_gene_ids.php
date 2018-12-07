
<!-- <h3>Other Gene Versions</h3> -->

<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#gene_ver_section" aria-expanded="true"><h3 class="yellow_col">Other Gene Versions</h3></div>

<div id="gene_ver_section" class="collapse in yellow_col">
  <br>

<?php
// echo "\n\n<br><br><h1>GENE ID: $gene_id</h1><br><br>\n\n";

$gene_id_query = "SELECT * FROM gene JOIN gene_gene ON(gene_id=gene_id2) WHERE gene_id1='$gene_id' ORDER BY genome_version DESC, gene_name ASC";
$gid_res = pg_query($gene_id_query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table class=\"table annot_table\">\n<tr><th>Gene Name</th><th>Version</th></tr>\n";

while ($line = pg_fetch_array($gid_res, null, PGSQL_ASSOC)) {
    $old_gene_name = $line["gene_name"];
    $gene_version = $line["genome_version"];
    echo "<tr><td><a href=\"pp_annot.php?name=$old_gene_name\" target=\"_blank\">$old_gene_name</a></td><td>V$gene_version</td></tr>\n";
}

echo "</table>\n\n";

// Free resultset
pg_free_result($gid_res);
?>

<br>
</div>
