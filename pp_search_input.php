<?php
include_once 'ppdb_header.php';
include "pp_compare_genes.php";
include "pp_fasta_download.php";
?>

<div class="page_container">

<br>
<br>

<form id="ppatens_search_form" action="/ppatens_db/pp_search_output.php" method="get">
  <div class="form-group">
    <label for="search_box">Insert a gene ID or annotation keywords</label>
    <input type="search_box" class="form-control" id="search_box" name="search_keywords">
	<!-- <input type="checkbox" class="checkbox" id="chkExactSearch"name="exact_search">Exact search</input> -->
  	<div class="checkbox">
      <label><input type="checkbox" id="chkExactSearch"name="exact_search"> Exact search</label>
    </div>
  </div>

  <button type="submit" class="btn btn-default pull-right">Search</button>
</form>


<!-- <input type="text" readonly id="txtCompare" placeholder="Compare genes" class="textbox textbox-modal" data-toggle="modal" data-target="#dlgEnterMultiple"/> -->
<div class="form-group">
  <label for="search_box">Find other gene versions for a list of genes</label>
  <input type="text" id="txtCompare" placeholder="Click here" class="form-control textbox-modal" data-toggle="modal" data-target="#dlgEnterMultiple"/>
</div>

<br>
<!-- <input type="text" readonly id="txtDownload" class="textbox textbox-modal" data-toggle="modal" data-target="#dlgDownload" value="Download sequences"/> -->
<div class="form-group">
  <label for="search_box">Download sequences for a list of genes</label>
  <input type="text" id="txtDownload" placeholder="Click here" class="form-control textbox-modal" data-toggle="modal" data-target="#dlgDownload"/>
</div>

<br>
<br>
</div>

<!--  no input gene modal -->
<div class="modal fade" id="no_gene_modal" role="dialog">
  <div class="modal-dialog modal-sm">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="text-align: center;">ERROR</h4>
      </div>
      <div class="modal-body">
        <div style="text-align: center;">
          <p id="search_input_modal"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>

$(document).ready(function () {

  //check input gene before sending form
  $('#ppatens_search_form').submit(function() {
    var gene_id = $('#search_box').val();

    if (!gene_id) {
      $("#search_input_modal").html( "No input provided in the search box" );
      $('#no_gene_modal').modal();
      return false;
    }
    else if (gene_id.length < 3) {
      $("#search_input_modal").html( "Input is too short, please provide a longer term to search" );
      $('#no_gene_modal').modal();
      return false;
    }
    else {
      return true;
    }
  });

});

</script>


<?php include_once 'ppdb_footer.php';?>
