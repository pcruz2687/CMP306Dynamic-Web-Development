<?php
  include_once("../model/connection.php");
  include_once("../model/api-readings.php");

  $encoded = get_ten_readings();

  $readings_json = json_decode($encoded);
  
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