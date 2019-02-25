<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PEATmoss</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="css/PEATmoss_style.css">
  	<!-- <link rel="stylesheet" href="css/jquery-ui.min.css"> -->
    <!-- <script src="js/jquery-3.1.1.min.js"></script> -->
  	<!-- <script src="js/jquery-ui.min.js"></script> -->
    <!-- <script src="js/bootstrap.min.js"></script> -->
  </head>

<body>

  <div id="landing">

    <table>
      <tr>
      <td>
        <a href="https://peatmoss.online.uni-marburg.de/expression_viewer/input">
          <img src="img/PEATmoss_400.png" width="300px"/>
        </a>
      </td>

      <td>
         <div id="landing_text">
           <span id="welcome_text">Welcome to</span>
           <div style="height:0px;margin:0px;padding:0px"></div>
           <a class="peatmoss_text" href="https://peatmoss.online.uni-marburg.de/expression_viewer/input">
             <span id="peat">PEAT</span>moss
           </a>
           <br>
           <br>
           <span style="font-size:28px">and the</span><br>
           <a class="ppgmldb_text" href="pp_search_input.php">
             <i>P. patens</i> Gene Model lookup DB
           </a>
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

  .ppgmldb_text {
    font-size:40px;
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
</html>
