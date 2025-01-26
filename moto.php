<?php

require_once("db.php");


if ($_GET["akzioa"] == "lortuMotoak") {

    $conn = konexioaSortu();

    $sql = "SELECT * FROM 8ataza";
    $result = $conn->query($sql);
    $motoa = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            // taulan bilatzen du postua, izena eta dortsala
            $motoa[$counter] = ["Postua" => $row["Postua"],  "Dortsala" => $row["Dortsala"],"Izena" => $row["Izena"]];
            $counter++;
        }
        // Informazioa bueltatzen dio json bidez 0 baina handiagoa denean
        $motoa["kopurua"] = $counter;
        $bueltanDatorrenInformazioa = json_encode($motoa);
        echo $bueltanDatorrenInformazioa;
        die;

    } else {
        // Tabla ez badago informaziorik 0 bueltatzen du
        $motoa["kopurua"] = 0;
        $bueltanDatorrenInformazioa = json_encode($motoa);
        echo $bueltanDatorrenInformazioa;
        die;
    }

}
