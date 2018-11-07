<div id="dlgDownload" class="modal fade" role="dialog" tabIndex=-1 aria-labelledby="Enter gene identifiers to download":" >
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Enter gene identifiers to download:</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
				<textarea class="form-control" id="txtDownloadGenes"></textarea>
				<?php
				include "pp_blastdbcmd.php";
				$dbs=getPossibleDbs();
	echo "<select id=\"dbPath\">";
		echo implode('\n',array_map(function($path){$path=substr($path,0,-10);return "<option value=\"{$path}\">" . 
		str_replace("_", " ",$path) 
		."</option>";},$dbs));
		echo "</select>";
		?>
				<button class="button" id="btnSend">Download</button>
				<script type="text/javascript">
				$("#btnSend").click(function(){
					var paramStr=$("#txtDownloadGenes").val().split("\n").map(function(row)
					{
						return "gids[]=" + row.trim();
					}).join("&");
paramStr+="&dbPath="+$("#dbPath").val();
paramStr+="&filename=pp_GmlDB_"+$("#dbPath").val() +"_"+ new Date().toLocaleDateString()+".fasta";
					window.open("pp_blastdbcmd.php?" + paramStr);
					
				})
				</script>
		</div>
		<div class="modal-footer">
		</div>
	</div>
</div>
</div>