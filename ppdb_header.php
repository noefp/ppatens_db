<!DOCTYPE html>
<html lang="en">
  <head>
    <title>P. patens DB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
    <script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
            <li class="dropdown"><a id="overview_link" class="menu_click_dropdown dropdown-toggle pointer_cursor" data-toggle="dropdown">Tools</a>
              <ul class="dropdown-menu">
                <li><a href="https://peatmoss.online.uni-marburg.de/expression_viewer/input">PEATmoss</a></li>
                <li><a href="https://plantcode.online.uni-marburg.de/tapscan/index.php">TAPscan</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>


<style>
html,body {
  margin:0;
  padding:0;
  height:100%;
}

#wrapper {
	min-height:100%;
	position:relative;
  background-color: #004600;
}

.page_container {
  max-width: 900px;
  margin:auto;
  padding-left: 20px;
  padding-right: 20px;
  padding-bottom:100px;
}

.colapse_section {
  /*border-left: 3px solid red;*/
  border-bottom: 1px solid #5c5;
  background-color: #8a8;
  padding-left: 10px;
  line-height: : 10px;
}

.colapse_section>h3 {
  margin-bottom: 0px;
}

  .pointer_cursor {
    cursor: pointer;
  }

  .dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0;
    padding-bottom: 10px;
    background-color: #004600;
  }
  .dropdown-menu > li > a {
    /*line-height: 16px;*/
    font-size: 16px;
    margin-top:10px;
    padding-top:0px;
    color: #c9ebcd;
  }
  .navbar-default .navbar-nav>li>a {
    font-size: 24px;
    color: #c9ebcd;
  }



  .navbar-default .navbar-nav>li>a:hover {
      color: #fff;
  }

  .navbar {
  	background-color: #004600;
  	color: #ffcc00;
  	border-radius: 0px;
  	border-width: 1px;
  	border-color: #c9ebcd;
  	margin-bottom: 0px;
  }

  .navbar-default .navbar-brand {
      color: #c9ebcd;
  		font-size: 24px;
  		font-weight: bold;
  }
  .navbar-default .navbar-brand:hover {
      color: #ffff00;
  }
  th,td,h3,label, .yellow_col {
  	color: #ffcc00;
  }

  a {
  	color: #6ae;
  }

  a:hover {
  	color: #36b;
  }

</style>

<script>

  jQuery(document).ready(function() {
    jQuery(".menu_click_dropdown").removeClass("dropdown-toggle");
    jQuery(".menu_click_dropdown").removeAttr("data-toggle");
  });

</script>
