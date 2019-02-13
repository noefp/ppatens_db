
<?php
include_once 'ppdb_header.php';
include_once "pp_paths.php";
?>

<h3 class="text-center yellow_col">BLAST</h3>

<div class="margin-20">

  <form id="blast_form" action="run_blast.php" method="post">

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
          <option value='blastn'>BLASTn</option>
          <option value='blastp'>BLASTp</option>
          <option value='blastx' selected>BLASTx</option>
          <!-- <option value='tblastn'>tBLASTn</option> -->
          <!-- <option value='tblastx'>tBLASTx</option> -->
        </select>
      </div>

    </div>

    <hr>
    <a data-toggle="collapse" data-target="#adv_opt" class="btn btn-default">BLAST options</a>
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
    <div class="text-center">
      <button type="submit" id="blast_button" class="btn btn-primary">BLAST</button>
    </div>
  </form>
</div>

<div style="height:100px"></div>

<?php include_once 'ppdb_footer.php';?>

<style>
  .margin-20 {
    margin: 20px;
  }
</style>

<script>
  $(document).ready(function () {

    // $('#blast_program').change(function () {
    //   blast_program = $('#blast_program').val();
    //   alert("blast_program: "+blast_program);
    // });

    $('#blast_button').click(function () {
      var seq_type = "nt";
      var input_seq = $('#blast_sequence').val();
      var blast_db = $('#sel1').val();
      var blast_program = $('#blast_program').val();

      input_seq = input_seq.trim();

      var trimmed_seq = input_seq.trim();
      trimmed_seq = trimmed_seq.replace(/^>.+\n/,"");
      trimmed_seq = trimmed_seq.replace(/\n/g,"");
      var seq_length = trimmed_seq.length;

      var nt_count = (trimmed_seq.match(/[ACGNTacgnt]/g)||[]).length

      if (nt_count < seq_length*0.9) {
        seq_type = "prot";
      }

      // alert("nt_count: "+nt_count+" seq_length: "+seq_length+" seq_type: "+seq_type);
      // alert("blast_program: "+blast_program+" blast_db: "+blast_db);

      //check input genes from BLAST output before sending form
      seqnum = input_seq.match(/>/g).length
      if (seqnum > 10) {
          alert("A maximum of 10 sequences can be provided as input, your input has: "+seqnum);
          return false;
      }
      if (!input_seq || seq_length < 5) {
          alert("Please provide a valid input sequence");
          return false;
      }
      if (seq_type == "nt" && blast_program == "blastp") {
          alert("BLASTp can not be used for an input nucleotide sequence");
          return false;
      }
      if (seq_type == "prot" && blast_program != "blastp") {
          alert("Input protein sequences can only be used with BLASTp");
          return false;
      }
      if (blast_program == "blastn" && blast_db.match("proteins")) {
          alert("BLASTn can not be used for a protein database");
          return false;
      }
      if ((blast_program == "blastp" || blast_program == "blastx") && !blast_db.match("proteins")) {
        // $('#blast_form').submit(function() {
          alert("BLASTp and BLASTx can only be used for a protein database");
          return false;
        // });
      }

      return true;
    });

  });
</script>
