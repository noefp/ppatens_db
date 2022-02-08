<?php include_once 'ppdb_header_min.php';?>

<body>

  <div id="wrapper">
    <a id="contact_link" class="ppgmldb_text" onclick="contt()">Contact Us</a>
    <a id="about_link" class="pull-right ppgmldb_text" href="/ppatens_db/contact.php">About Us</a>

  <div id="landing">

    <table>
      <tr>
      <td>
        <a href="/expression_viewer/input">
          <img src="/ppatens_db/img/PEATmoss_400.png" width="300px"/>
        </a>
      </td>

      <td>
         <div id="landing_text">
           <span id="welcome_text">Welcome to</span>
           <div style="height:0px;margin:0px;padding:0px"></div>
           <a class="peatmoss_text" href="/expression_viewer/input">
             <span id="peat">PEAT</span>moss
           </a>
           <br>
           <br>
           <span style="font-size:28px">and the</span><br>
           <a class="ppgmldb_text fs40" href="/ppatens_db/pp_search_input.php">
             <i>P. patens</i> Gene Model lookup DB
           </a>
           <br>
           <br>
         </div>
      </td>
    </tr>
    </table>

    <?php include_once 'ppdb_footer_min.php';?>

    </div>
  </div>


</body>
  <style>

  body {
    background-color: #004600;
  }

  #contact_link {
    position:absolute;
    font-size:18px;
    /* padding-top:80px; */
    text-decoration: none;
    margin:10px;
    cursor: pointer;
  }

  #about_link {
    font-size:18px;
    /* padding-top:80px; */
    text-decoration: none;
    margin:10px;
    cursor: pointer;
  }

  #landing {
    padding-top:80px;
    padding-left:100px;
    padding-bottom:60px;
  }

  #landing_text {
    font-size:32px;
    color:#c9ebcd;
    padding-left: 30px;
  }

  .peatmoss_text {
    font-size:72px;
    font-family: Impact;
    color:#c9ebcd;
  }

  a.peatmoss_text:hover {
    color:#577155;
    text-decoration: none;
  }

  #peat {
    font-size:124px;
    line-height: 0.9;
    /* font-weight: 800; */
  }

  .fs40 {
    font-size:40px;
  }

  .ppgmldb_text {
    color:#c9ebcd;
    font-family: Impact;
  }

  a.ppgmldb_text:hover {
    color:#577155;
    text-decoration: none;
  }

  .landing_links {
    color:#c9ebcd;
  }

  </style>

  <script>
      function contt() {
          var addr = "moss" + '>' + "plantcode_mail.biologie.uni_marburg.de";
          addr = addr.replace(/_/g, "-");
          addr = addr.replace(">", "@");
          // alert("addr: "+addr);
          window.location.href='mailto:peat'+addr+'?subject=PEATmoss contact';
      }
  </script>

</html>
