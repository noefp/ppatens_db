<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PEATmoss</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="ppatens_db/favicon.ico">

    <script>
        function contt() {
            var addr = "moss" + '>' + "plantcode_mail.biologie.uni_marburg.de";
            addr = addr.replace(/_/g, "-");
            addr = addr.replace(">", "@");
            // alert("addr: "+addr);
            window.location.href='mailto:peat'+addr+'?subject=PEATmoss contact';
        }
    </script>

  </head>

<body>

  <div id="landing">

    <table>
      <tr>
      <td style="vertical-align:top">
        <a href="https://peatmoss.online.uni-marburg.de/expression_viewer/input" target="_blank">
          <img src="/ppatens_db/img/PEATmoss_400.png" width="300px"/>
        </a>
      </td>

      <td style="vertical-align:top">
         <div id="landing_text">
           <span id="welcome_text">Welcome to</span>
           <div style="height:0px;margin:0px;padding:0px"></div>
             <a class="peatmoss_text" href="https://peatmoss.online.uni-marburg.de/expression_viewer/input" target="_blank"><span id="peat">PEAT</span>moss</a>

           and the <a class="peatmoss_text" href="https://peatmoss.online.uni-marburg.de/ppatens_db/pp_search_input.php" target="_blank">PpGML DB</a>

           <p class="font22 w700">
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

   <p class="font22" style="font-family: Impact;color:#c9ebcd;">
     Please cite PEATmoss and the PpGML DB as:
   </p>
   <p class="cite">
     Fernandez-Pozo N, Haas FB, Meyberg R, Ullrich KK, Hiss M, Perroud P, Hanke S, Kratz V, Powell A, Vesty EF, Coates JC, Mueller LA, Rensing, SA.
     <br>
     <b>PEATmoss (Physcomitrella Expression Atlas Tool): a unified gene expression atlas for the model plant <i>Physcomitrella patens</i>.</b>
     <br>
     In preparation.
   </p>
   <br>

  </div>


</body>



  <style>

  body {
    background-color: #004600;
  }

  #landing {
    padding-top:100px;
    padding-left:60px;
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

  .w700 {
    width: 700px;
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
    width:1200px;
    color:#c9ebcd;
  }

  </style>
</html>
