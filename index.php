<?php
require('includes/db.config.php');

$mysqli->real_query("SELECT * FROM hardware ORDER BY name ASC");
$res = $mysqli->use_result();

$hardwareArray = array();

if ($res) {
  while ($row = $res->fetch_assoc()) {
      $hardwareArray[$row['id']] = $row['name'];
  }
}else{
  die('There has been a database error');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Equipment booking - SPU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="assets/css/calendar.css" rel="stylesheet">
   <link href="assets/css/datepicker.css" rel="stylesheet">    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Equipment booking - SPU</a>
        </div>
      </div>
    </div>

    <div class="container">


      <!-- Example row of columns -->
      <div class="row">
        <div class="span9">
          <h2>Current bookings</h2>

			<div id="render-calendar"><p style="text-align:center;"><img src="assets/img/loading.gif"></p></div>
          	<p><small><strong>Once a booking has been finalised, you will need to contact Jim, Keith or John to amend an entry.</strong></small></p>
        </div>

        <div class="span3">
          <h2>Equipment</h2>


        <form id="equipment-booking-form">
          <fieldset>

            <label>From:</label>
            <input type="text" name="from" id="from" placeholder="" class="text input-datepicker">
            <label>To:</label>
            <input type="text" name="to" id="to" placeholder="" class="text input-datepicker">
            <label>Booked by:</label>
            <input class="input-xlarge" type="text" name="who" id="who" placeholder="Booked by:">
          <label>Reason:</label>
            <input class="input-xlarge" type="text" name="reason" id="reason" placeholder="Reason for booking">
            <span class="help-block">Select the equipment you require.</span>
            <?php

            $rowCounter = 0;
            foreach ($hardwareArray as $key => $value) {

              echo '<label class="checkbox">';
              echo '<input class="hardware" type="checkbox" name="hardware" id="hardware-'.$key.'" value="'.$key.'"> '.$value;
              echo '</label>';

            }

            ?>
            <ul id="error-list"></ul>
            <button type="submit" id="submit-button" class="btn btn-primary">Confirm booking</button>
          </fieldset>
        </form>


        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; SPU 2013</p>
      </footer>

    </div> <!-- /container -->




<!-- MODAL -->

<div id="event-modal" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Modal header</h3>
  </div>
  <div class="modal-body">
    <p>Modal Body</p>
  </div>
  <div class="modal-footer">
    <a href="#" data-dismiss="modal" class="btn">Close</a>
  </div>
</div>


<!-- /MODAL -->






    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/global.js"></script>


  </body>
</html>