<?php
	function getCheckboxes($chkName,$disableLatest)
	{
		// Connecting to database and retrival of all Versions.
		include_once 'pp_database_data.php';

		$dbconn = pg_connect(getConnectionString())
		or die('Could not connect: ' . pg_last_error());
		$query=getVersionsQuery();
		$versions_res=pg_query($query) or die('Cannot access list of genome versions: ' . pg_last_error());
?>
	<div class="form-group">
	<div class="form-check-inline">
		<?php
			$versions=pg_fetch_all_columns($versions_res) or die("Invalid result after version-request:".pg_last_error());
			$latest=getMaxVersion();
			foreach($versions as $version)
			{
				if($disableLatest==True && $version==$latest)
				{
					echo "<label class='checkbox-inline'><input type='checkbox' checked disabled name='{$chkName}[]' value='{$version}' class='form-check-input checkbox'>" . $version . " </label> ";
					echo "<input type='checkbox' checked name='{$chkName}[]' value='{$version}' class='form-check-input checkbox' style='display:none; margin-left: 10px;'> ";
				}
				else
				{
					echo "<label class='checkbox-inline'><input type='checkbox' checked name='{$chkName}[]' value='{$version}' class='form-check-input checkbox'> " . $version . "</label>";
				}
				// echo "<input type='checkbox' checked name='{$chkName}[]' value='{$version}' class='form-check-input checkbox'>" . $version . "</input>";
			}
		?>
	</div>
</div>
	<?php
	// Closing connection
	pg_close($dbconn);
	}
?>
