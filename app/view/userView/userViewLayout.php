<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/favicon.ico">

    <title>Oblicze</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="assets/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="assets/js/ie-emulation-modes-warning.js"></script>-->
    <!--<script src="dist/js/popover.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
    <body>
 <!-- Begin page content -->
    <div class="container">
        <div class="page-header">          
        <h1>Witaj, <?php echo $userData[0]['fname'];?></h1>
        </div>
        <div class="row">
                <p>Cześć, jestem ankietą konferencji θβℓιcℤε!</p> 
                <p>Poniżej spośród wszystkich 
                   plakatów i referatów możesz wybrać po trzy ulubione i 
                   przyporządkować im trzy, dwa lub jeden punkt, wedle uznania. </p>
                <p>Gdyby coś poszło źle, kliknij ten duży czerwony przycisk 
                    po prawej.</p>
        </div>
        <form method="POST" action="./<?php echo $userCode; ?>/poll">
        <div class="row">
        <?php 
        $udao = new userViewDAO($database);
        $lecData = $udao->getLectures();
        $lectureList = new lecturesList($lecData);
        $lectureList->show();
        ?>
        </div>
        
        <div class="row">
        <?php
        $posData = $udao->getPosters();
        $posterList = new posterList($posData);
        $posterList->show();
        ?>
        </div>
        <div class ="row">
            <button type="submit" class="btn btn-block btn-lg btn-success">Wyślij</button>
        </div>
        </form>
    </div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted">θβℓιcℤε 2017</p>
      </div>
    </footer>
 
<script>     
function hideLecture(chosen) {
    chosen = parseInt(chosen);
    if ((chosen % 3) == 0) {
        $("#r" + (chosen + 1)).addClass('hidden');
        $('#r' + (chosen + 1)).attr('disabled', true);
        $("#r" + (chosen + 2)).addClass('hidden');
        $('#r' + (chosen + 2)).attr('disabled', true);
        
    } else if ((chosen % 3) == 1) {
        $("#r" + (chosen - 1)).addClass('hidden');
        $('#r' + (chosen - 1)).attr('disabled', true);
        $("#r" + (chosen + 1)).addClass('hidden');
        $('#r' + (chosen + 1)).attr('disabled', true);
    } else if ((chosen % 3) == 2) {
        $("#r" + (chosen - 1)).addClass('hidden');
        $('#r' + (chosen - 1)).attr('disabled', true);
        $("#r" + (chosen - 2)).addClass('hidden');
        $('#r' + (chosen - 2)).attr('disabled', true);
    }
    for (i = 1; i <= <?php echo count($lecData)*3+2; ?>; i++) { 
        if (i != chosen && (i % 3 == chosen % 3)) {
            $("#r" + i).addClass('hidden');
            $('#r' + i).attr('disabled', true);
        }
    }
}

function hidePoster(chosen) {
    chosen = parseInt(chosen);
    if ((chosen % 3) == 0) {
        $("#p" + (chosen + 1)).addClass('hidden');
        $('#p' + (chosen + 1)).attr('disabled', true);
        $("#p" + (chosen + 2)).addClass('hidden');
        $('#p' + (chosen + 2)).attr('disabled', true);
    } else if ((chosen % 3) == 1) {
        $("#p" + (chosen - 1)).addClass('hidden');
        $('#p' + (chosen - 1)).attr('disabled', true);
        $("#p" + (chosen + 1)).addClass('hidden');
        $('#p' + (chosen + 1)).attr('disabled', true);
    } else if ((chosen % 3) == 2) {
        $("#p" + (chosen - 1)).addClass('hidden');
        $('#p' + (chosen - 1)).attr('disabled', true);
        $("#p" + (chosen - 2)).addClass('hidden');
        $('#p' + (chosen - 2)).attr('disabled', true);
    }
    for (i = 1; i <= <?php echo count($posData)*3+2; ?>; i++) { 
        if (i != chosen && (i % 3 == chosen % 3)) {
            $("#p" + i).addClass('hidden');            
            $('#p' + i).attr('disabled', true);
        }
    }
}

function resetLectures() {
    for (i = 1; i <= <?php echo count($lecData)*3+2; ?>; i++) {
        $('#r' + i).prop('checked', false);
        if ($("#r" + i).hasClass('hidden')){
            $('#r' + i).attr('disabled', false);
            $("#r" + i).removeClass('hidden');
        }
    }
}

function resetPosters() {
    for (i = 1; i <= <?php echo count($posData)*3+2; ?>; i++) {
        $('#p' + i).prop('checked', false);
        if ($("#p" + i).hasClass('hidden')){
            $("#p" + i).removeClass('hidden');
            $('#p' + i).attr('disabled', false);
        }
    }
}
</script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="assets/js/ie10-viewport-bug-workaround.js"></script>-->
    <script src="dist/js/jquery-3.2.1.min"></script>    
    <script src="dist/js/button.js"></script>    
  </body>
</html>
