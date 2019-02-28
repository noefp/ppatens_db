<?php
include_once 'ppdb_header.php';
include "pp_compare_genes.php";
include "pp_fasta_download.php";
include "search_info_modal.php";
?>

<div class="page_container">

<br>
<br>

<p class="yellow_col" style="font-size:16px">
  The <b><i>P. patens</i> Gene Model Lookup Database</b> provide tools to convert between
  <i>P. patens</i> gene model versions,
  to extract CDS, cDNA and protein sequences from a gene or list of genes,
  and to find genes by name or keywords from their annotations.
  Genes are linked to genome browsers and annotations from multiple databases such as
  NCBI, SwissProt, Ensembl, Phytozome, CoGe, PLAZA and TAIR.
  Additionally, sequence files and annotations can be downloaded for the whole genome
  and the whole set of genes.
</p>
<br>
<br>

<form id="ppatens_search_form" action="/ppatens_db/pp_search_output.php" method="get">
  <div class="form-group">
    <label for="search_box" class="yellow_col" style="font-size:16px">Insert a gene ID or annotation keywords</label> <button type="button" class="info_icon" data-toggle="modal" data-target="#search_help">i</button>
    <input type="search_box" class="form-control" id="search_box" name="search_keywords">

  	<!-- <div class="checkbox">
      <label><input type="checkbox" id="chkExactSearch" name="exact_search"> <span class="yellow_col">Exact search</span></label>
    </div> -->
  </div>

  <button type="submit" class="btn btn-default pull-right">Search</button>
</form>




<div class="row">

  <div class="col-sm-6 col-md-6 col-lg-6">

    <!-- <input type="text" readonly id="txtCompare" placeholder="Compare genes" class="textbox textbox-modal" data-toggle="modal" data-target="#dlgEnterMultiple"/> -->
    <div class="form-group">
      <label for="search_box" class="yellow_col" style="font-size:16px">Find other gene versions for a list of genes</label>
      <input type="text" id="txtCompare" placeholder="Click here" class="form-control textbox-modal" data-toggle="modal" data-target="#dlgEnterMultiple"/>
    </div>
    
    
    <p class="yellow_col">
      <a href="img/gene_models.png" target="_blank" class="pull-right"><img class="img-thumbnail" src="img/gene_models.png" width="80px"></a>
      Multiple gene model versions has been developed over the last ten years for <em>P. patens</em>. 
      Here we provide a tool to lookup gene versions automatically for multiple genes.
      
      Click on the picture on the right to visualize <em>P. patens</em> gene model nomenclature.
      <br>
      <br>
    </p>
    
  </div>

  <div class="col-sm-6 col-md-6 col-lg-6">

    <!-- <input type="text" readonly id="txtDownload" class="textbox textbox-modal" data-toggle="modal" data-target="#dlgDownload" value="Download sequences"/> -->
    <div class="form-group">
      <label for="search_box" class="yellow_col" style="font-size:16px">Download sequences for a list of genes</label>
      <input type="text" id="txtDownload" placeholder="Click here" class="form-control textbox-modal" data-toggle="modal" data-target="#dlgDownload"/>
    </div>
  </div>


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
