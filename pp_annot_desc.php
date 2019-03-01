
<!-- <h3>Annotations</h3> -->

<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#annot_section" aria-expanded="true">
  <h3 class="yellow_col">Annotations</h3>
</div>

<div id="annot_section" class="collapse in yellow_col">
  <br>

<?php

$sp_query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE gene_id='$gene_id' AND annot_type='SwissProt'";
$sp_res = pg_query($sp_query) or die('Query failed: ' . pg_last_error());

$at_query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE gene_id='$gene_id' AND annot_type='TAIR'";
$at_res = pg_query($at_query) or die('Query failed: ' . pg_last_error());

$nr_query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE gene_id='$gene_id' AND annot_type='NCBI Nr'";
$nr_res = pg_query($nr_query) or die('Query failed: ' . pg_last_error());

$pz_query = "SELECT * FROM annotation JOIN gene_annotation USING(annotation_id) JOIN gene USING(gene_id) WHERE gene_id='$gene_id' AND annot_type='Phytozome'";
$pz_res = pg_query($pz_query) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
echo "<table class=\"table annot_table\">\n<tr><th>Gene ID</th><th>Description</th><th>Source</th></tr>\n";

while ($line = pg_fetch_array($sp_res, null, PGSQL_ASSOC)) {
    $sp_id = $line["annot_term"];
    $sp_desc = $line["annot_desc"];
    $sp_link = 'http://www.uniprot.org/uniprot/'.preg_replace('/sp\|(.+)\|.+/','$1',$sp_id);
    echo "<tr><td><a href=\"$sp_link\" target=\"_blank\">$sp_id</a></td><td>$sp_desc</td><td>SwissProt</td></tr>\n";
}
while ($line = pg_fetch_array($at_res, null, PGSQL_ASSOC)) {
    $tair_id = $line["annot_term"];
    $tair_desc = $line["annot_desc"];
    $tair_link = 'http://www.arabidopsis.org/servlets/TairObject?type=locus&name='.preg_replace('/\.\d$/','',$tair_id);

    echo "<tr><td><a href=\"$tair_link\" target=\"_blank\">$tair_id</a></td><td>$tair_desc</td><td>TAIR</td></tr>\n";
}
while ($line = pg_fetch_array($nr_res, null, PGSQL_ASSOC)) {
    $nr_id = $line["annot_term"];
    $nr_desc = $line["annot_desc"];
    $nr_link = 'https://www.ncbi.nlm.nih.gov/protein/'.preg_replace('/.+\|(.+)\|$/','$1',$nr_id);

    echo "<tr><td><a href=\"$nr_link\" target=\"_blank\">$nr_id</a></td><td>$nr_desc</td><td>NCBI</td></tr>\n";
}
while ($line = pg_fetch_array($pz_res, null, PGSQL_ASSOC)) {
    $pz_id = $line["annot_term"];
    $pz_desc = $line["annot_desc"];
    $pz_link = 'https://phytozome.jgi.doe.gov/pz/portal.html#!gene?search=1&detail=1&method=5013&searchText=transcriptid:'.$pz_id;

    echo "<tr><td><a href=\"$pz_link\" target=\"_blank\">$gene_name_displayed</a></td><td>$pz_desc</td><td>Phytozome</td></tr>\n";
}
echo "<tr><td><a href=\"https://phytozome.jgi.doe.gov/jbrowse/index.html?data=genomes%2FPpatens&tracks=DNA%2CTranscripts%2CRNAExpression&highlight=&loc=$gene_name_displayed\" target=\"_blank\">$gene_name_displayed</a></td><td>Phytozome Genome browser</td><td>Phytozome</td></tr>\n";
echo "<tr><td><a href=\"https://genomevolution.org/coge/FeatView.pl?accn=$gene_name_displayed\" target=\"_blank\">$gene_name_displayed</a></td><td>CoGe gene view</td><td>CoGe</td></tr>\n";

$plaza_gene = preg_replace('/V3\.1/','',$gene_name_displayed);
echo "<tr><td><a href=\"https://bioinformatics.psb.ugent.be/plaza/genes/redirect_gene/3218/$plaza_gene\" target=\"_blank\">$gene_name_displayed</a></td><td>PLAZA gene view</td><td>PLAZA</td></tr>\n";
echo "<tr><td><a href=\"https://plants.ensembl.org/Physcomitrella_patens/Gene/Summary?g=$gene_name_displayed\" target=\"_blank\">$gene_name_displayed</a></td><td>Ensembl gene view</td><td>Ensembl</td></tr>\n";
echo "<tr><td><a href=\"http://plants.ensembl.org/Physcomitrella_patens/Location/View?db=core;g=$gene_name_displayed\" target=\"_blank\">$gene_name_displayed</a></td><td>Ensembl Genome browser</td><td>Ensembl</td></tr>\n";
echo "<tr><td><a href=\"https://peatmoss.online.uni-marburg.de/expression_viewer/input?input_gene=$gene_name_displayed\" target=\"_blank\">$gene_name_displayed</a></td><td>Expression data</td><td>PEATmoss</td></tr>\n";
echo "</table>\n\n";

// Free resultset
pg_free_result($sp_res);
pg_free_result($at_res);
pg_free_result($nr_res);
?>

<br>
</div>
