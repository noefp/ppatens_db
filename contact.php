<?php include_once 'ppdb_header_min.php';?>


<body>

  <div id="wrapper">
  <div id="landing">
    <table>
      <tr>
      <td style="vertical-align:top">
        <a href="/expression_viewer/input" target="_blank">
          <img src="/ppatens_db/img/PEATmoss_400.png" width="300px"/>
        </a>
      </td>

      <td style="vertical-align:top">
         <div id="landing_text">
           <span id="welcome_text">Welcome to</span>
           <div style="height:0px;margin:0px;padding:0px"></div>
             <a class="peatmoss_text" href="/expression_viewer/input" target="_blank"><span id="peat">PEAT</span>moss</a>

           and the <a class="peatmoss_text" href="/ppatens_db/pp_search_input.php" target="_blank"><span style="white-space: nowrap;">PpGML DB</span></a>

           <p class="font22 w450">
             PEATmoss is an expression atlas for <i>Physcomitrella patens</i> gene expression data from RNA-seq and expression microarrays.
             The <i>Physcomitrella patens</i> Gene Model Lookup Database (PpGML DB), contains tools,
             sequences and annotations to lookup between the different gene model version of <i>P. patens</i>.
             <br>
             These tools were developed by the <a href="https://www.plantco.de" target="_blank">Rensing Lab</a>
           </p>

           <p class="font22" style="font-family: Impact">
             Please, <a id="contact_link" onclick="contt()">contact us</a> if you have any question about PEATmoss or the PpGML DB.
           </p>

         </div>
      </td>
    <tr>
  </table>

  <br>

   <p class="font22" style="font-family: Impact;color:#c9ebcd;">
     Please cite PEATmoss and the PpGML DB as:
   </p>
   <p class="cite">
Fernandez-Pozo, N., Haas, F.B., Meyberg, R., Ullrich, K.K., Hiss, M., Perroud, P.F., Hanke, S., Kratz, V., Powell, A.F., Vesty, E.F., Daum, C.G., Zane, M., Lipzen, A., Sreedasyam, A., Grimwood, J., Coates, J.C., Barry, K., Schmutz, J., Mueller, L.A. and Rensing, S.A. (2020)
     <br>
     <b><a href="https://onlinelibrary.wiley.com/doi/10.1111/tpj.14607" target="_blank">PEATmoss (Physcomitrella Expression Atlas Tool): a unified gene expression atlas for the model plant <i>Physcomitrella patens</i>.</a></b>
     <br>
     <a href="https://doi.org/10.1111/tpj.14607" target="_blank">Plant J., 102:165</a>
   </p>
   <br>
   <a href="/ppatens_db/video_gallery.php" target="_blank">
     <img class="img-thumbnail" src="img/video1_min.png" width="200px" style="margin-right:20px">
     Please, check out our videos to know more about these tools
   </a>

   <?php include_once 'ppdb_footer_min.php';?>

  </div>
</div>

</body>

<script>
  function contt() {
      var addr = "moss" + '>' + "plantcode_mail.biologie.uni_marburg.de";
      addr = addr.replace(/_/g, "-");
      addr = addr.replace(">", "@");
      // alert("addr: "+addr);
      window.location.href='mailto:peat'+addr+'?subject=PEATmoss contact';
  }
</script>


  <style>

  body {
    background-color: #004600;
  }

  #landing {
    padding:60px;
  }

  #landing_text {
    font-size:32px;
    color:#c9ebcd;
    padding-left: 30px;
  }

  a.peatmoss_text {
    font-size:64px;
    font-family: Impact;
    text-decoration: none;
  }

  a {
    color:#c9ebcd;
    /* text-decoration: none; */
  }

  a:hover {
    color:#577155;
    text-decoration: none;
  }

  .font22 {
    font-size: 22px;
  }

  .w450 {
    min-width: 450px;
    max-width: 700px;
  }

  #peat {
    font-size:96px;
    line-height: 0.9;
    /* font-weight: 800; */
  }

  #contact_link {
    color: #fff;
    cursor: pointer;
  }

  .cite {
    font-size:18px;
    font-family: helvetica;
    min-width:790px;
    color:#c9ebcd;
  }

  </style>
</html>
