<?php include_once 'ppdb_header_min.php';?>

  <h3 class="video_title">Video Gallery</h3>

  <div id="wrapper">
  <div id="video_div">
    <br>
    <video controls width="850" height="478" style="background-color:#000;border: 2px solid #000;" id="video_tv">
      <source id="video_screen" src="/ppatens_db/img/PEATmoss_welcome2.mp4" type="video/mp4">
    Your browser does not support the video tag.
    </video>
    <br>
    <br>
    <table>
      <tr>
        <td><a class="video_min pointer_cursor" name="PEATmoss_welcome2" style="margin-right:12px" ><img class="img-thumbnail" src="img/video1_min.png" width="200px"></a></td>
        <td><a class="video_min pointer_cursor" name="PEATmoss_features" style="margin-right:12px"><img class="img-thumbnail" src="img/video2_min.png" width="200px"></a></td>
        <td><a class="video_min pointer_cursor" name="PpGMLDB_features" style="margin-right:12px" ><img class="img-thumbnail" src="img/video3_min.png" width="200px"></a></td>
        <td><a class="video_min pointer_cursor" name="PEATmoss_lookup" style="margin-right:12px"><img class="img-thumbnail" src="img/video4_min.png" width="200px"></a></td>
      </tr>
      <tr>
        <td class="video_td_text">Introduction</td>
        <td class="video_td_text">PEATmoss</td>
        <td class="video_td_text">The PpGML DB</td>
        <td class="video_td_text">Lookup integration in PEATmoss</td>
      </tr>
    </table>
    <br>
    <p class="yellow_col">
      Acknowledgements: These videos are narrated by Tarryn Miller.
    </p>

    <?php include_once 'ppdb_footer_min.php';?>

  </div>
  </div>


</body>
</html>

<script>
  $(document).ready(function () {

    //check input gene before sending form
    $('.video_min').click(function() {
      var video_name = $(this).attr("name");

      // alert("video name: "+video_name);

      $('#video_screen').attr("src", "/ppatens_db/img/"+video_name+".mp4");

      $('#video_tv').trigger('load');
    });

  });
</script>

<style>

#video_div {
  margin:auto;
  width: 850px;
  padding-bottom:50px;

}

.video_title {
  color: #fff;
  text-align:center;
}

.video_td_text {
  color: #fff;
  text-align:center;
}

*:focus {
    outline: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}

</style>
