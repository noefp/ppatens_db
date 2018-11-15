<?php
function getConnectionString(){return "host=localhost dbname=pp_annot3 user=web_usr password=moss33!";};
function getGenesForSearchAndVersion($searchString, $versions)
{
	$searchString=pg_escape_string($searchString); 
	$versions=implode(",",array_map(function ($versionString) { return "'" . pg_escape_string($versionString) ."'"; },$versions));
	 	return "select array_agg((gene_id, genome_version, gene_name)) as geneRow
		from gene inner join 
		(SELECT array_agg(distinct gene_id1) || array_agg(distinct gene_id2) 
	 as gene_ids
	 FROM gene ge1
	 right join gene_gene 
	 on ge1.gene_id=gene_id1 or ge1.gene_id=gene_id2
WHERE ge1.gene_name ILIKE '%" . $searchString . "%' 
	 group by gene_id1) as geneArrays
 on gene_id = any(gene_ids)
 where genome_version in(" . $versions . ")
 group by gene_ids;";

}
function getVersionsQuery()
{
	return 'select distinct genome_version from "public"."gene" order by genome_version desc;';
}
// Use this for postgres 10 and above
function getGinWhere($field, $searchString)
{
	$postgres_version=10;
	if($postgres_version<10) return "{$field} ilike '%{$searchString}%'";
	else return "'{$searchString}' <% {$field}";
}
?>