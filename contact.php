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
      <td>
        <a href="https://peatmoss.online.uni-marburg.de/expression_viewer/input">
          <img src="/ppatens_db/img/PEATmoss_400.png" width="300px"/>
        </a>
      </td>

      <td>
         <div id="landing_text">
           <span id="welcome_text">Welcome to</span>
           <div style="height:0px;margin:0px;padding:0px"></div>
           <div class="peatmoss_text">
             <span id="peat">PEAT</span>moss
           </div>
           <br>
           <p style="font-size:22px;font-family: Impact">
             Please, <a id="contact_link" onclick="contt()">contact us</a> to get access to PEATmoss and the PpGML DB.
           </p>

           <br>
           <br>
         </div>
      </td>
    </tr>
    </table>

  </div>


</body>



  <style>

  body {
    background-color: #004600;
  }

  #landing {
    padding-top:100px;
    padding-left:100px;
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

  #contact_link {
    color: #fff;
    cursor: pointer;
  }

  </style>
</html>
