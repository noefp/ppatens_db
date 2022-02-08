<?php
// \ini_set('session.name', 'PEATmossession');
\ini_set('session.cookie_domain', '*');
  require __DIR__.'/user_db/vendor/autoload.php';
  \Delight\Cookie\Session::start(null);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>PpGML DB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/ppatens_db/favicon.ico">
    <link rel="stylesheet" href="/ppatens_db/css/bootstrap.min.css">
	<link rel="stylesheet" href="/ppatens_db/css/PEATmoss_style.css">
	<link rel="stylesheet" type="text/css" href="/ppatens_db/css/datatables.css">
	<link rel="stylesheet" href="/ppatens_db/css/jquery-ui.min.css">
	<link rel="stylesheet" href="/ppatens_db/js/DataTables/Select-1.2.6/css/select.dataTables.min.css">
  <script src="/ppatens_db/js/jquery-3.1.1.min.js"></script>
	<script src="/ppatens_db/js/jquery-ui.min.js"></script>
  <script src="/ppatens_db/js/bootstrap.min.js"></script>
  <script src="/ppatens_db/js/download2.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/datatables.min.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/Buttons-1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/Buttons-1.5.2/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/Buttons-1.5.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/Buttons-1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/Buttons-1.5.2/js/buttons.jqueryui.min.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/Buttons-1.5.2/js/buttons.print.min.js"></script>
	<script type="text/javascript" charset="utf8" src="/ppatens_db/js/DataTables/Select-1.2.6/js/dataTables.select.min.js"></script>
	  </head>

    <body>
      <?php include_once 'login_modal.php'; ?>

      <div class="container-fluid imoss-top">
        <p class="pull-left cover-title">
          <i>P. patens</i> Gene Model Lookup DB
        </p>

        <div style="background: url(/ppatens_db/img/cover.jpg) center center; background-size:cover;">
         <img class="cover-img" src="/ppatens_db/img/cover.jpg" style="visibility: hidden;" />
        </div>
        <!-- <img class="pull-left cover-img" src="img/cover.jpg"> -->
      </div>

      <div id="wrapper">
      <div id="navigation_block">

      <nav class="navbar navbar-default" data-spy="affix" data-offset-top="277">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/ppatens_db/pp_search_input.php"><span class="glyphicon glyphicon-home" style="line-height: 0;"></span></a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li><a href="/ppatens_db/blast_input.php">BLAST</a></li>
              <li><a href="/ppatens_db/downloads.php">Downloads</a></li>
              <li><a href="/ppatens_db/links.php">Links</a></li>
              <li><a href="/ppatens_db/contact.php">About Us</a></li>
              <li><a href="/expression_viewer/input" target="_blank">PEATmoss</a></li>
              <li><a class="pmoss_menu_tab" href="https://www.plantco.de/" target="_blank"><span class="plant">plant</span><span class="plantco">co</span><span class="plantco-dot">.</span><span class="plantco">de</span></a></li>
              <li id="login_li">
                <a id="login_link" style="font-size:16px; cursor:pointer" data-toggle="modal" data-target="#loginModal">
                  Log In <span class="glyphicon glyphicon-log-in" style="line-height: 1.2;"></span>
                </a>
                <a id="logout_link" style="font-size:16px; cursor:pointer; display:none">
                  Log Out <span class="glyphicon glyphicon-log-out" style="line-height: 1.2;"></span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    </div>


  <style>

    .affix {
      top: 0;
      width: 100%;
      z-index:100;
    }

    #navigation_block {
      min-height:50px;
    }

    .cover-img {
      height: 277px;
      overflow: hidden;
    }

    .cover-title {
      position: absolute;
      padding:10px;
      margin-top:200px;
      font-size: 24px;
      color:#fff;
      width: 50%;
      background: black; /* For browsers that do not support gradients */
      background-color: rgba(0, 0, 0, 0.5);
      background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.8) , rgba(0, 0, 0, 0)); /* For Safari 5.1 to 6.0 */
      background: -o-linear-gradient(right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0)); /* For Opera 11.1 to 12.0 */
      background: -moz-linear-gradient(right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0)); /* For Firefox 3.6 to 15 */
      background: linear-gradient(to right, rgba(0, 0, 0, 0.8) , rgba(0, 0, 0, 0)); /* Standard syntax */
    }

    .imoss-top {
      background-color: #a7d0e5;
      width: 100%;
      height: 277px;
      padding:0px
    }

    .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
      color: #fff;
      background-color: transparent;
    }

  </style>
