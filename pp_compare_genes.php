<div id="dlgEnterMultiple" class="modal fade" role="dialog" tabIndex=-1 aria-labelledby="Enter gene identifiers to search">
  <!-- <div class="modal-dialog" role="document"> -->
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" id="exampleModalLabel">Gene version lookup</h4>
		</div>
		<div class="modal-body" style="height:355px">

			<form id="gene_version_lookup">
        <label for="txtGenes">Paste a list of gene IDs</label>
				<textarea name="txtGenes" id="txtGenes" class="form-control" rows="10">
Pp3c1_10000V3.1
Pp3c2_3600V3.1
Pp3c1_21730V3.1
        </textarea>

				<input type="checkbox" name="chkShowAnnot"> Show annotations
				<?php
				include_once "pp_search_gene_version_input.php";
				getCheckboxes("chkVersionName",True);
				?>
				<button type="submit" class="btn btn-success pull-right" form="gene_version_lookup" formaction="pp_compare_results_view.php" formmethod="post">search</button>

			</form>

		</div>
	</div>
</div>
</div>

<script>
  $(document).ready(function () {

    $('#gene_version_lookup').submit(function () {
      var gene_lookup_input = $('#txtGenes').val();
      var gene_count = (gene_lookup_input.match(/\n/g)||[]).length

      // alert("gene_lookup_input: "+gene_lookup_input+", gene_count: "+gene_count);

      //check input genes from gene lookup before sending form
      if (gene_count > 100) {
          alert("A maximum of 100 sequences can be provided as input, your input has: "+gene_count);
          return false;
      }

      return true;
    });

  });
</script>
