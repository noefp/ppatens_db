<div id="dlgDownload" class="modal fade" role="dialog" tabIndex=-1 aria-labelledby="Enter gene identifiers to download":" >
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" id="exampleModalLabel">Sequence downloading</h4>
		</div>
		<div class="modal-body" style="height:355px">
		<div class="form">
		<form action="pp_blastdbcmd.php" method="post">
      <label for="txtDownloadGenes">Paste a list of gene IDs</label>
				<textarea class="form-control" id="txtDownloadGenes" rows="8" name="gids">
Pp3c1_10000V3.1
Pp3c2_3600V3.1
Pp3c1_21730V3.1
        </textarea>
		<br>
        <div class="form-group">
          <label for="dbPath">Select Dataset:</label>

				<?php
				include "pp_blastdbcmd.php";
				$dbs=getPossibleDbs();
	echo "<select id=\"dbPath\" class=\"form-control\"name="dbPath">";
		echo implode('\n',array_map(function($path){$path=substr($path,0,-10);return "<option value=\"{$path}\">" .
		str_replace("_", " ",$path)
		."</option>";},$dbs));
		echo "</select>";
		?>

      </div>

				<input class="button btn btn-success pull-right" id="btnSend" type="submit">Download</button>
				</form>
				</div>
				
		</div>
	</div>
</div>
</div>

