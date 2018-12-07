
<!-- <h3>Gene Ontology (GO)</h3> -->
<!-- <br> -->

<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#go_section"><h3 class="yellow_col">Gene Ontology (GO)</h3></div>

<div class="yellow_col" id="go_section" class="collapse in">
  <br>


<h4 class="yellow_col">Biological Process</h4>

<?php
$go_bp_query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE gene_id='$gene_id' AND annot_type='GO BP' ORDER BY annot_term";
$go_res = pg_query($go_bp_query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table class=\"table annot_table\">\n<tr><th style=\"width:150px\">GO term</th><th style=\"width:700px\">Description</th><th style=\"width:50px\">Ontology</th></tr>\n";

while ($line = pg_fetch_array($go_res, null, PGSQL_ASSOC)) {
    $go_id = $line["annot_term"];
    $go_desc = $line["annot_desc"];
    $go_ont = preg_replace('/^GO /','',$line["annot_type"]);
    $go_link = 'http://amigo.geneontology.org/amigo/term/'.$go_id;
    echo "<tr><td><a href=\"$go_link\" target=\"_blank\">$go_id</a></td><td>$go_desc</td><td>$go_ont</td></tr>\n";
}

echo "</table>\n\n";

// Free resultset
pg_free_result($go_res);
?>

<h4 class="yellow_col">Molecular Function</h4>

<?php
$go_mf_query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE gene_id='$gene_id' AND annot_type='GO MF' ORDER BY annot_term";
$go_res = pg_query($go_mf_query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table class=\"table annot_table\">\n<tr><th style=\"width:150px\">GO term</th><th style=\"width:700px\">Description</th><th style=\"width:50px\">Ontology</th></tr>\n";

while ($line = pg_fetch_array($go_res, null, PGSQL_ASSOC)) {
    $go_id = $line["annot_term"];
    $go_desc = $line["annot_desc"];
    $go_ont = preg_replace('/^GO /','',$line["annot_type"]);
    $go_link = 'http://amigo.geneontology.org/amigo/term/'.$go_id;
    echo "<tr><td><a href=\"$go_link\" target=\"_blank\">$go_id</a></td><td>$go_desc</td><td>$go_ont</td></tr>\n";
}

echo "</table>\n\n";

// Free resultset
pg_free_result($go_res);
?>

<h4 class="yellow_col">Cellular Component</h4>

<?php
$go_cc_query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE gene_id='$gene_id' AND annot_type='GO CC' ORDER BY annot_term";
$go_res = pg_query($go_cc_query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table class=\"table annot_table\">\n<tr><th style=\"width:150px\">GO term</th><th style=\"width:700px\">Description</th><th style=\"width:50px\">Ontology</th></tr>\n";

while ($line = pg_fetch_array($go_res, null, PGSQL_ASSOC)) {
    $go_id = $line["annot_term"];
    $go_desc = $line["annot_desc"];
    $go_ont = preg_replace('/^GO /','',$line["annot_type"]);
    $go_link = 'http://amigo.geneontology.org/amigo/term/'.$go_id;
    echo "<tr><td><a href=\"$go_link\" target=\"_blank\">$go_id</a></td><td>$go_desc</td><td>$go_ont</td></tr>\n";
}

echo "</table>\n\n";

// Free resultset
pg_free_result($go_res);
?>
<br>
</div>
