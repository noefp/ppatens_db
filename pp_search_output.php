<?php include_once 'ppdb_header.php';?>

<div class="page_container">


<?php
// Connecting, selecting database
include_once 'pp_database_data.php';
$dbconn = pg_connect(getConnectionString())
    or die('Could not connect: ' . pg_last_error());

$search_input = test_input($_GET["search_keywords"]);
$max_row = 25;

echo "\n<br><h3 class=\"yellow_col\">Gene ID or keyword searched</h3>\n<div class=\"well\" style=\"background-color:#060;color:#fff\">$search_input</div><br>\n";

function test_input($data) {
  $data = preg_replace('/[\<\>]+/',' ',$data);
  $data = htmlspecialchars($data);

  if ( preg_match('/\s+/',$data) ) {
    $data_array = explode(' ',$data,99);

    foreach ($data_array as $key=>&$value) {
        if (strlen($value) < 3) {
            unset($data_array[$key]);
        }
    }

    $data = implode(' ',$data_array);
  }

  $data = stripslashes($data);

  return $data;
}
?>

<?php include_once 'ppdb_search_input_form.php';?>

<?php include_once 'pp_search_annot.php';?>

<?php include_once 'pp_search_gene.php';?>


<?php
// Closing connection
pg_close($dbconn);
?>

<br>
<br>
</div>












<script type="text/javascript">
  $(".tblAnnotations").dataTable({
    dom:'Bfrtip',
    buttons:[{
      extend:'csv',
      text:'Download',
      title:"PpGMLDB_annotations",
      fieldBoundary: '',
      fieldSeparator:"\t"},
      {
        extend:'excel',
        text:'Excel',
        title:"PpGMLDB_annotations",
        fieldSeparator:"\t"
      },
      'copy']
//      bFilter:false
    });
</script>








<?php include_once 'ppdb_footer.php';?>
