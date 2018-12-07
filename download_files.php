
<div class="page_container">

<?php
function get_dir_and_files($dir_name) {
    $file_array = array();

    $pattern='/^\./';
    if (is_dir($dir_name)){

      if ($dh = opendir($dir_name)){
        while (($file_name = readdir($dh)) !== false){

          $is_not_file = preg_match($pattern, $file_name, $match);
          if (!$is_not_file) {
            // echo $file_name."<br>";
            array_push($file_array,$file_name);
          }
        }
      }
    }

    return $file_array;
}

$blast_files_found = get_dir_and_files("../indexed_files/blast_plus_dbs/"); // call the function
$seqs_found = get_dir_and_files("../downloads/"); // call the function
$annot_found = get_dir_and_files("../annotations/"); // call the function

if ($seq_files_found || $seq_files_found2) {
  echo "<h3 class=\"yellow_col\">Sequences</h3><ul class=\"well pp_list\">";
}

foreach ($blast_files_found as $file) {

  $is_fasta = preg_match('/\.fasta$/', $file, $match);

  if ($is_fasta) {

      if ($file) {
        echo "<li><a href=\"../indexed_files/blast_plus_dbs/$file\" download>$file</a></li>";
      } else {
        echo "<li>No Sequeces Found.</li>";
      }
  }
}

foreach ($seqs_found as $file) {

    if ($file) {
      echo "<li><a href=\"../downloads/$file\" download>$file</a></li>";
    }
}
if ($seq_files_found || $seq_files_found2) {
  echo "</ul>";
}

if ($annot_found) {
  echo "<h4>Annotations</h4><ul class=\"well pp_list\">";
}

foreach ($annot_found as $file) {

    if ($file) {
      echo "<li><a href=\"../annotations/$file\" download>$file</a></li>";
    }
}

if ($annot_found) {
  echo "</ul>";
}

?>

</div>
