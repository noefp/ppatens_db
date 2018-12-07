<!DOCTYPE html>
<html lang="en">
  <head>
    <title>P. patens DB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/PEATmoss_style.css">
	<link rel="stylesheet" type="text/css" href="css/datatables.css">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<link rel="stylesheet" href="js/DataTables/Select-1.2.6/css/select.dataTables.min.css">
    <script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/Buttons-1.5.2/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/Buttons-1.5.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/Buttons-1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/Buttons-1.5.2/js/buttons.jqueryui.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/Buttons-1.5.2/js/buttons.print.min.js"></script>
	<script type="text/javascript" charset="utf8" src="js/DataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
	  </head>

  <body>

    <!-- <div class="container-fluid imoss-top">
      <p class="pull-left cover-title">
        <i>P. patens</i> DB
      </p>

      <div style="background: url(img/cover.jpg) left center;">
       <img class="cover-img" src="img/cover.jpg" style="visibility: hidden;" />
      </div>
    </div> -->
<div id="wrapper">
    <nav class="navbar navbar-default" style="border-radius: 0px;">
      <div id="moss_toolbar" class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="pp_search_input.php"><i>P. patens</i> gene model lookup</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="blast_input.php">BLAST</a></li>
            <li><a href="downloads.php">Downloads</a></li>
            <li><a href="links.php">Links</a></li>
            <!-- <li class="dropdown"><a id="overview_link" class="menu_click_dropdown dropdown-toggle pointer_cursor" data-toggle="dropdown">Tools</a>
              <ul class="dropdown-menu">
                <li><a href="https://peatmoss.online.uni-marburg.de/expression_viewer/input">PEATmoss</a></li>
                <li><a href="https://plantcode.online.uni-marburg.de/tapscan/index.php">TAPscan</a></li>
              </ul>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>

<script>

  jQuery(document).ready(function() {
    jQuery(".menu_click_dropdown").removeClass("dropdown-toggle");
    jQuery(".menu_click_dropdown").removeAttr("data-toggle");
  });

</script>
