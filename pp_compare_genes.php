<div id="dlgEnterMultiple" class="modal fade" role="dialog" tabIndex=-1 aria-labelledby="Enter gene identifiers to search":" >
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Enter gene identifiers to search:</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			
			<form method="get" action="pp_compare_results_view.php">
				<textarea name="txtGenes" id="txtGenes"></textarea>
				<input type="checkbox" name="chkShowAnnot">Show annotations</input>
				<input type="submit" class="btn btn-search">search</input>
			</form>
							<button id="btnDownload">Download as fasta</button>

			<script type="text/javascript">
				$("#btnDownload").click(function()
				{
					
					window.open("pp_blastdbcmd.php?filename=results.fasta&" + $("#txtGenes").prop("value").split("\n").map(function(row){return "gids[]=" + row;}).join("&"));
				});
			</script>
		</div>
		<div class="modal-footer">
		</div>
	</div>
</div>
</div>
