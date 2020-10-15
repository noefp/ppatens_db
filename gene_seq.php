<div class="colapse_section pointer_cursor" data-toggle="collapse" data-target="#seq_section" aria-expanded="true"><h3 class="yellow_col">Sequences</h3></div>

<div id="seq_section" class="collapse in">
  <br>


<?php
include_once "pp_paths.php";
// File is ignored by .gitignore - should contain:
// getBlastdbcmdPath and getBlastdbBaseLocation.
// These functions are returning corresponding paths and taking no arguments. Path of directory ends with /


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

    rsort($file_array);
    return $file_array;
}

$bdb_path = getBlastdbBaseLocation();
$sps_found = get_dir_and_files($bdb_path); // call the function
$blastdbcmdPath=getBlastdbcmdPath();


foreach ($sps_found as $bdb) {

  if ( preg_match('/\.nhr$|\.phr$/', $bdb, $match) ) {
    $bdb = str_replace(".phr","",$bdb);
    $bdb = str_replace(".nhr","",$bdb);
    $full_path_db = $bdb_path."/".$bdb;

    exec("{$blastdbcmdPath} -db {$full_path_db} -entry " . escapeshellarg($gene_name) ."| sed 's/lcl|//'" ,$ret);

    $blast_db = str_replace(".fasta","",$bdb);
    $blast_db = str_replace("_"," ",$blast_db);

    if ($ret) {
      echo "<h5 class=\"yellow_col\">$blast_db</h5>";
      echo "<div class=\"well\" style=\"font-family:courier\">".implode("<br>",$ret)."</div>";
    }
    $ret=null;
  }

}


?>
<br>
</div>
