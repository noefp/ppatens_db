
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
    sort($file_array);
    return $file_array;
}

$files_found = get_dir_and_files("../downloads/"); // call the function


foreach ($files_found as $file) {

    if ($file) {
      if (is_dir("../downloads/$file")){
        echo "<h3 class=\"yellow_col\">$file/</h3><ul class=\"well download_list\" >";

        $files_found2 = get_dir_and_files("../downloads/$file");

        foreach ($files_found2 as $file2) {

          if (is_dir("../downloads/$file/$file2")){
            echo "<h4 class=\"folder2 font550\">$file2/</h4>";
            $files_found3 = get_dir_and_files("../downloads/$file/$file2");


            foreach ($files_found3 as $file3) {
              if ($file3) {
                echo "<li class=\"indent_li\"><a href=\"../downloads/$file/$file2/$file3\" download> $file3</a></li>";
              }
            }

          }
          else {
            echo "<li class=\"indent_li\"><a href=\"../downloads/$file/$file2\" download> $file2</a></li>";
          }
        }
        echo "</ul>";
      }
      else {
        echo "<h3 class=\"yellow_col\">Other files</h3><ul class=\"well download_list\">";
        echo "<li class=\"indent_li\"><a href=\"../downloads/$file\" download>$file</a></li>";
        echo "</ul>";
      }
    }
}

?>

</div>

<style>

.download_list {
  padding-left:0px;
  padding-top:20px;
  font-size: 18px;
}

.folder2 {
  margin-left:10px;
  font-size: 20px;
  color:#666;
}
.font550 {
  font-weight: 550;
}

.indent_li {
  margin-left:50px;
}
</style>
