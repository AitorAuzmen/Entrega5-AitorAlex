<?php

require_once("db.php");

if ($_GET["akzioa"] == "lortuMotoak") {

    $conn = konexioaSortu();

    $sql = "SELECT * FROM 8ataza";
    $result = $conn->query($sql);
    $ikasleak = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $ikasleak[$counter] = ["Postua" => $row["Postua"],  "Dortsala" => $row["Dortsala"],"Izena" => $row["Izena"]];
            $counter++;
        }
        
        $ikasleak["kopurua"] = $counter;
        $bueltanDatorrenInformazioa = json_encode($ikasleak);
        echo $bueltanDatorrenInformazioa;
        die;

    } else {
        $ikasleak["kopurua"] = 0;
        $bueltanDatorrenInformazioa = json_encode($ikasleak);
        echo $bueltanDatorrenInformazioa;
        die;
    }

}
