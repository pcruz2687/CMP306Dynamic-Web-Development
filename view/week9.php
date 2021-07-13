<?php
  include("../view/session_start.php");
?>
<!DOCTYPE html>
<html>
    <head>
      <title></title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="index.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
      <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
      <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
      <script type="text/javascript" src="refresh.js"></script>
      <script>
        function showUser() {
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
          } else { // code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
              document.getElementById("table-refresh").innerHTML=this.responseText;
            }
          }
          xmlhttp.open("GET","../controller/readings.php");
          xmlhttp.send();
        }
      </script>

    </head>
    <body>
      <?php include("../model/api-readings.php"); ?>

      <div data-role="page" id="home" data-title="Home Page">
        <?php include("../view/navbar.php");?>
          <div data-role="header">
            <h1>Electric Imp Readings</h1>
          </div>
          <div class="container">
            <div data-role="content">
              <a href="#reading_latest_one" data-role="button">Latest Readings</a><br>	
              <a href="#reading_ten" data-role="button">Ten Latest Readings</a><br>
              <a href="#reading_latest_ajax" data-role="button" onclick="showUser()">Ten Latest Readings (Auto update)</a><br>
              <a href="#readings_charts" data-role="button" onclick="">Readings Charts</a>
            </div>
            <?php include("../view/footer.html");?>
          </div>
        </div>

      <div data-role="page" id="reading_latest_one" data-title="Temperature Readings">
        <?php include("../view/navbar.php");?>
        <div data-role="header">
          <h1>Electric Imp Readings</h1>
        </div>
        <div data-role="content">
          <div class="container">
            <?php 
              $readings_txt = get_recent_reading();
              $readings_json = json_decode($readings_txt);
              
                echo '<table id="rd" class="table table-bordered table-hover">
                        <tr>
                        <thead class="thead-dark">
                          <th>Reading ID</th>
                          <th>External Temperature </th>
                          <th>Internal Temperature</th>
                          <th>Voltage</th>
                          <th>Light Level</th>
                          <th>Date Recorded</th>
                        </thead>
                        </tr>';
                        for($i = 0; $i<sizeof($readings_json); $i++)
                        {
                          echo' <tr>
                                  <td>'. $readings_json[$i] -> reading_id .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state) -> external .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state) -> internal .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state) -> voltage .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state) -> lightlevel .'</td>
                                  <td>'. $readings_json[$i] -> datetime .'</td>
                                </tr>';
                        }
                echo    '</table>';
            ?>
            <a href="#home" data-role="button">Back to home</a>
            <?php include("../view/footer.html");?>
          </div>
        </div> 
      </div>

      <div data-role="page" id="reading_ten" data-title="Temperature Readings">
        <?php include("../view/navbar.php");?>
        <div data-role="header">
          <h1>Electric Imp Readings</h1>
        </div>
        <div data-role="content">
          <div class="container">
            <?php 
              $readings_txt = get_ten_readings();
              $readings_json = json_decode($readings_txt);
              
                echo '<table id="rd" class="table table-bordered table-hover">
                        <tr>
                        <thead class="thead-dark">
                          <th>Reading ID</th>
                          <th>External Temperature </th>
                          <th>Internal Temperature</th>
                          <th>Voltage</th>
                          <th>Light Level</th>
                          <th>Date Recorded</th>
                        </thead>
                        </tr>';
                        for($i = 0; $i<sizeof($readings_json); $i++)
                        {
                          echo' <tr>
                                  <td>'. $readings_json[$i] -> reading_id .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state) -> external .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state) -> internal .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state)  -> voltage .'</td>
                                  <td>'. json_decode($readings_json[$i] -> state) -> lightlevel .'</td>
                                  <td>'. $readings_json[$i] -> datetime .'</td>
                                </tr>';
                        }
                echo    '</table>';
            ?>
            <a href="#home" data-role="button">Back to home</a>
            <?php include("../view/footer.html");?>
          </div>
        </div> 
      </div>

      <div data-role="page" id="reading_latest_ajax" data-title="Temperature Readings">
        <?php include("../view/navbar.php");?>
        <div data-role="header">
          <h1>Electric Imp Readings</h1>
        </div>
        <div data-role="content">
          <div class="container">
            <div id="table-refresh">
              <script>setInterval(function()
              {
                showUser();
              }, 20000);
              </script>
            </div>
            <a href="#home" data-role="button">Back to home</a>
            <?php include("../view/footer.html");?>
          </div>
        </div> 
      </div>

      <div data-role="page" id="readings_charts" data-title="Temperature Readings">
        <?php include("../view/navbar.php");?>
        <div data-role="header">
          <h1>Electric Imp Readings</h1>
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
            var json = <?php echo $readings_txt = get_ten_readings();
                    $readings_json = json_decode($readings_txt); ?>;
            var reading_id  = [<?php echo $readings_json[0] -> reading_id?>,
                              <?php echo $readings_json[1] -> reading_id?>,
                              <?php echo $readings_json[2] -> reading_id?>,
                              <?php echo $readings_json[3] -> reading_id?>,
                              <?php echo $readings_json[4] -> reading_id?>,
                              <?php echo $readings_json[5] -> reading_id?>,
                              <?php echo $readings_json[6] -> reading_id?>,
                              <?php echo $readings_json[7] -> reading_id?>,
                              <?php echo $readings_json[8] -> reading_id?>,
                              <?php echo $readings_json[9] -> reading_id?>];
            var external = [<?php echo json_decode($readings_json[0] -> state) -> external?>,
                          <?php echo json_decode($readings_json[1] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[2] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[3] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[4] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[5] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[6] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[7] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[8] -> state) -> external ?>,
                          <?php echo json_decode($readings_json[9] -> state) -> external ?>];
            var internal = [<?php echo json_decode($readings_json[0] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[1] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[2] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[3] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[4] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[5] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[6] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[7] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[8] -> state) -> internal ?>,
                            <?php echo json_decode($readings_json[9] -> state) -> internal ?>];
            var voltage = [<?php echo json_decode($readings_json[0] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[1] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[2] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[3] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[4] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[5] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[6] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[7] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[8] -> state) -> voltage ?>,
            <?php echo json_decode($readings_json[9] -> state) -> voltage ?>];
            var lightlevel = [<?php echo json_decode($readings_json[0] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[1] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[2] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[3] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[4] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[5] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[6] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[7] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[8] -> state) -> lightlevel ?>,
            <?php echo json_decode($readings_json[9] -> state) -> lightlevel ?>];


            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Reading ID', 'Internal Temperature in Celcius', 'External Temperature in Celcius'],
                [reading_id[0], external[0], internal[0]],
                [reading_id[1], external[1], internal[1]],
                [reading_id[2], external[2], internal[2]],
                [reading_id[3], external[3], internal[3]],
                [reading_id[4], external[4], internal[4]],
                [reading_id[5], external[5], internal[5]],
                [reading_id[6], external[6], internal[6]],
                [reading_id[7], external[7], internal[7]],
                [reading_id[8], external[8], internal[8]],
                [reading_id[9], external[9], internal[9]]
              ]);

              var options = {
                chart: {
                  title: 'Electric Imp Temperature Readings',
                  subtitle: 'Internal Temperature and External Temperature',
                },
                bars: 'vertical' // Required for Material Bar Charts.
              };

              var chart = new google.charts.Bar(document.getElementById('chart_temperature'));
              chart.draw(data, google.charts.Bar.convertOptions(options));
            }
          </script>

          <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
            var json = <?php echo $readings_txt = get_ten_readings();
                    $readings_json = json_decode($readings_txt); ?>;

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Reading ID', 'Voltage'],
                [reading_id[0], voltage[0]],
                [reading_id[1], voltage[1]],
                [reading_id[2], voltage[2]],
                [reading_id[3], voltage[3]],
                [reading_id[4], voltage[4]],
                [reading_id[5], voltage[5]],
                [reading_id[6], voltage[6]],
                [reading_id[7], voltage[7]],
                [reading_id[8], voltage[8]],
                [reading_id[9], voltage[9]]
              ]);

              var options = {
                chart: {
                  title: 'Electric Imp Voltage Readings',
                  subtitle: 'Voltage',
                },
                bars: 'vertical' // Required for Material Bar Charts.
              };

              var chart = new google.charts.Bar(document.getElementById('chart_voltage'));
              chart.draw(data, google.charts.Bar.convertOptions(options));
            }
          </script>

          <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
            var json = <?php echo $readings_txt = get_ten_readings();
                    $readings_json = json_decode($readings_txt); ?>;    

            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ['Reading ID', 'Light level'],
                [reading_id[0], lightlevel[0]],
                [reading_id[1], lightlevel[1]],
                [reading_id[2], lightlevel[2]],
                [reading_id[3], lightlevel[3]],
                [reading_id[4], lightlevel[4]],
                [reading_id[5], lightlevel[5]],
                [reading_id[6], lightlevel[6]],
                [reading_id[7], lightlevel[7]],
                [reading_id[8], lightlevel[8]],
                [reading_id[9], lightlevel[9]]
              ]);

              var options = {
                chart: {
                  title: 'Electric Imp Light level Readings',
                  subtitle: 'Light level',
                },
                bars: 'vertical' // Required for Material Bar Charts.
              };

              var chart = new google.charts.Bar(document.getElementById('chart_lightlevel'));
              chart.draw(data, google.charts.Bar.convertOptions(options));
            }
          </script>
        </div>

        <div data-role="content">
          <div class="container">
            <div id="chart_temperature" style="width: 900px; height: 500px;"></div>
            <br/>
            <div id="chart_voltage" style="width: 900px; height: 500px;"></div>
            <br/>
            <div id="chart_lightlevel" style="width: 900px; height: 500px;"></div>
            <a href="#home" data-role="button">Back to home</a>
            <?php include("../view/footer.html");?>
          </div>
        </div> 
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>