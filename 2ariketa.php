<?php

require_once("db.php");

if (isset($_GET["akzioa"]) && $_GET["akzioa"] == "lortuMotoak") {

    $conn = konexioaSortu();

    $sql = "SELECT * FROM 8ataza";
    $result = $conn->query($sql);
    $pilotos = [];

    if ($result->num_rows > 0) {
        $counter = 0;
        while ($row = $result->fetch_assoc()) {
            $pilotos[$counter] = [
                "Postua" => $row["Postua"],  
                "Dortsala" => $row["Dortsala"],
                "Izena" => $row["Izena"]
            ];
            $counter++;
        }
        
        $response = [
            "kopurua" => $counter,
            "pilotos" => $pilotos
        ];
        
        echo json_encode($response);
        die;

    } else {
        echo json_encode(["kopurua" => 0]);
        die;
    }

}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $(".taulaReload").on("click", function () {
            taulaBirkargatu();
        });

        setInterval(taulaBirkargatu, 1000);
    });

    function taulaBirkargatu() {
        $.ajax({
            url: "moto.php",
            type: "GET",
            data: { akzioa: "lortuMotoak" }
        })
        .done(function (bueltanDatorrenInformazioa) {
            var info = JSON.parse(bueltanDatorrenInformazioa);
            if (info.kopurua > 0) {
                $(".zerrenda").html("<tr><th>Postua</th><th>Dortsala</th><th>Izena</th></tr>");
                
                info.pilotos.forEach(function (piloto, index) {
                    var colorFila = "white";

                    if (piloto.Postua < info.pilotos[index].Postua) {
                        colorFila = "green";
                    } else if (piloto.Postua > info.pilotos[index].Postua) {
                        colorFila = "red";
                    }

                    $(".zerrenda").append(
                        "<tr style='background-color:" + colorFila + "'>" +
                        "<td>" + piloto.Postua + "</td>" +
                        "<td>" + piloto.Dortsala + "</td>" +
                        "<td>" + piloto.Izena + "</td>" +
                        "</tr>"
                    );
                });
            } else {
                alert("Ez da elementurik kargatu");
            }
        })
        .fail(function () {
            alert("Errore bat gertatu da");
        });
    }

</script>

