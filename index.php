<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Web Slinger Comic Reader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,600,300" rel="stylesheet" type="text/css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/jquery.hotkeys.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/deflate.js"></script>
    <script src="./js/main.js"></script>

    <?php include('./php/libs.php'); ?>

    <link href="./css/main.css" rel="stylesheet">
  </head>

  <body onload="init()">
    <div class="navbar navbar-inverse navbar-static-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <a class="brand" href="/">Web Slinger Comic Reader</a>
          <a class="brand" href="info">info</a>

          <div class="nav-collapse collapse">
          <ul class="nav">
            <li style="display: none;"><a href="#" title="Left arrow or k" id="prevPanel"><i class="icon-chevron-left icon-white"></i> Previous</a></li>
            <li style="display: none;"><a href="#" title="Right arrow or j" id="nextPanel"><i class="icon-chevron-right icon-white"></i> Next</a></li>
            <li style="display: none;"><a href="#" title="v key" id="fitVertical"><i class="icon-resize-vertical icon-white"></i> Fit Vertical</a></li>
            <li style="display: none;"><a href="#" title="h key" id="fitHorizontal"><i class="icon-resize-horizontal icon-white"></i> Fit Horizontal</a></li>
            <li style="display: none;"><a href="#" title="b key" id="fitBoth"><i class="icon-move icon-white"></i> Fit Both</a></li>
            <li style="display: none;"><a href="#" title="f key" id="fullSpread"><i class="icon-pause icon-white"></i> Full Spread View</a></li>
            <li style="display: none;"><a href="#" title="s key" id="singlePage"><i class="icon-stop icon-white"></i> Single Page View</a></li>
          </ul>
          </div>
        </div>
      </div>
    </div>

    <div id="file-container" class="file-container">
      <h1 class="file-direc">
      </h1>
      <ul class="file-list">
      </ul>
    </div>

    <div class="modal hide" id="statusModal">
      <div class="modal-header">
        <h3>Uploading your comic.</h3>
      </div>
      <div class="modal-body">
        <p id="statusModalText"></p>
      </div>
    </div>

    <div id="comicImages">
    </div>
  </body>
</html>
