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
				<button class="button" id="btnSend">Download</button>
				<script type="text/javascript">
				$("#btnSend").click(function(){
					var paramStr=$("#txtDownloadGenes").val().split("\n").map(function(row)
					{
						return "gids[]=" + row.trim();
					}).join("&");
					window.open("pp_blastdbcmd.php?filename=results.fasta&" + paramStr);
					
				})
				</script>
		</div>
		<div class="modal-footer">
		</div>
	</div>
</div>
</div>