<?php
	$dbconn = pg_connect("host=localhost dbname=pp_annot3 user=web_usr password=moss33!")
	or die('Could not connect: ' . pg_last_error());
	$query='select distinct genome_version from "public"."gene";';
	$versions_res=pg_query($query) or die('Cannot access list of genome versions: ' . pg_last_error());
?>
<select name="selGeneVersion">
	<?php
		$versions=pg_fetch_all_columns($versions_res) or die("Invalid result after version-request:".pg_last_error());
		foreach($versions as $version)
		{
			echo "<option>" . $version . "</option>";
		}
	?>
	</select
	