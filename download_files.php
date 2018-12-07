
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

$seq_files_found = get_dir_and_files("../indexed_files/blast_plus_dbs/"); // call the function

if ($seq_files_found) {
  echo "<h3 class=\"yellow_col\">Sequences</h3><ul class=\"well pp_list\">";
}

foreach ($seq_files_found as $file) {

  $is_fasta = preg_match('/\.fasta$/', $file, $match);

  if ($is_fasta) {
    $file1 = str_replace("_"," ",$file);

      if ($file1) {
        echo "<li><a href=\"../indexed_files/blast_plus_dbs/$file\" download>$file1</a></li>";
      } else {
        echo "<li>No Sequeces Found.</li>";
      }
  }

      // echo "<div class=\"well\"><h4>Annotations</h4><ul>";
      //
      // if ($annot_found) {
      //   foreach ($annot_found as $annot_file) {
      //     echo "<li><a href=\"species/$sps/$v/annotations/$annot_file\" download>$annot_file</a></li>";
      //   }
      //
      //   echo "</ul></div>";
      // } else {
      //   echo "<li>No Annotations Found.</li></ul></div>";
      // }
    // }
}
echo "</ul>";

?>

</div>
