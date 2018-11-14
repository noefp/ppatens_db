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

$bdb_path = getBlastdbBaseLocation();
$sps_found = get_dir_and_files($bdb_path); // call the function
// $sps_found = get_dir_and_files("species/"); // call the function

echo "<div class=\"form-group\">";
echo  "<label for=\"sel1\" class=\"yellow_col\">Select BLAST DB</label>";
echo  "<select class=\"form-control\" id=\"sel1\" name=\"blast_db\">";


foreach ($sps_found as $bdb) {
// foreach ($sps_found as $sps) {
  // echo "<p>$sps</p>";

    // $species = str_replace("_"," ",$sps);

    // $versions_found = get_dir_and_files("species/$sps");
    // foreach ($versions_found as $v) {

    // $blast_found = get_dir_and_files("species/$sps/$v/blast");
      // if ($blast_found) {
        // foreach ($blast_found as $bdb) {

          if (preg_match('/\.nhr$|\.phr$/', $bdb, $match)) {
            $bdb = str_replace(".phr","",$bdb);
            $bdb = str_replace(".nhr","",$bdb);
            $blast_db = str_replace(".fasta","",$bdb);
            $blast_db = str_replace("_"," ",$blast_db);
            echo "<option value=\"$bdb_path/$bdb\">$blast_db</option>";
          }
        // }
      // }
    // }
}

echo   "</select>";
echo   "</div>";

?>
