
<?php
include_once 'ppdb_header.php';
include_once "pp_paths.php";
?>

<h3 class="text-center yellow_col">BLAST</h3>

<div class="margin-10">

  <form action="run_blast.php" method="post">

    <div class="form-group">
      <label for="blast_sequence" class="yellow_col">Paste a sequence</label>
      <textarea id="blast_sequence" name="query" class="form-control" rows="12" style="font-family:Monospace">
>protein or DNA
GGAGGTGACTAGGGAGGGCGATGTAATAGAACTGGAGCAATGTATTGTGCATGATCGGAA
GCGAATCCGAGTCTTGCAACAGCTGGGAGCTCGGAGACGTGTCATGATATATCGTGAAAC
CTGGGAAGGTCCATTCCGCAATGGCGAGTCACTCTGTGGTTGTGCGACTGGTAATTCAGC
TTTTGCCACACAAAAGCCTTTGCAGGGCGATTCTCTTGCAGGATCCTGGCATGCCGAGCT
TTACACCGCGCAGAACCTGGAGAATCAGCTCCCTTGCTTACTAAGGTTCTTGCCGGACAG
CTGGTGCCTGTAGACGCGGTGGGATTGG
      </textarea>
    </div>

    <div class="row">

      <div class="col-sm-6 col-md-6 col-lg-">
        <?php include_once 'blast_dbs_select.php';?>
      </div>

      <div class="col-sm-6 col-md-6 col-lg-">
        <label for="blast_program" class="yellow_col">BLAST program</label>
        <select class="form-control" id="blast_program" name="blast_prog">
          <option value='blastn' selected>BLASTn</option>
          <option value='blastp'>BLASTp</option>
          <option value='blastx'>BLASTx</option>
          <option value='tblastn'>tBLASTn</option>
          <option value='tblastx'>tBLASTx</option>
        </select>
      </div>

    </div>

    <hr>
    <a data-toggle="collapse" data-target="#adv_opt" class="btn btn-default">BLAST options</a>
    <br>
    <br>
    <div id="adv_opt" class="collapse">

      <div class="row text-left">

        <div class="col-sm-6 col-md-6 col-lg-">
          <label for="blast_hits" class="yellow_col">Max hit number</label>
          <select class="form-control" id="blast_hits" name="max_hits">
            <option value='10' selected>10</option>
            <option value='20'>20</option>
            <option value='40'>40</option>
            <option value='60'>60</option>
          </select>
        </div>

        <div class="col-sm-6 col-md-6 col-lg-">
            <label for="blast_eval" class="yellow_col">Max <i>e</i> value</label>
            <select class="form-control" id="blast_eval" name="evalue">
            <option value='10'>10</option>
            <option value='1e-3' selected>1e-3</option>
            <option value='1e-6'>1e-6</option>
            <option value='1e-9'>1e-9</option>
            <option value='1e-12'>1e-12</option>
          </select>
        </div>

      </div>

      <div class="row text-left">

        <div class="col-sm-6 col-md-6 col-lg-">
          <label for="blast_matrix" class="yellow_col">Matrix</label>
          <select class="form-control" id="blast_matrix" name="blast_matrix">
            <option value='BLOSUM45'>BLOSUM45</option>
            <option value='BLOSUM52'>BLOSUM55</option>
            <option value='BLOSUM62' selected>BLOSUM62</option>
            <option value='BLOSUM80'>BLOSUM80</option>
            <option value='BLOSUM90'>BLOSUM90</option>
          </select>
        </div>
        <br>
        <br>
        <div class="col-sm-6 col-md-6 col-lg-6">
          <div class="checkbox" style="margin:0px">
            <label class="yellow_col"><input type="checkbox" id="blast_filter" name="blast_filter"> Filter low complexity</label>
          </div>
        </div>

      </div>

    </div>
    <hr>
    <br>
    <br>
    <div class="text-center">
      <button typ="submit" id="blast_button" class="btn btn-primary">BLAST</button>
    </div>
  </form>
  <br>
  <br>
</div>

<style>
  .margin-10 {
    margin: 10px;
  }
</style>
