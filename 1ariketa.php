<?php

require_once("db.php");

$conn = konexioaSortu();




?>



<button class="taulaReload">Taula birkargatu</button>
<br>


<?php


$kontsulta = "SELECT Postua, Dortsala, Izena FROM motoclassification ";
$result = $conn->query($kontsulta);
if ($result->num_rows > 0) {
    echo "<table border='1' class= zerrenda >";
    echo "<tr><th>Postua</th><th>Dortsala</th><th>Izena</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Postua"] . "</td><td>" . $row["Dortsala"] . "</td><td>" . $row["Izena"] . "</td></tr>";
    }
    echo "</table>";


} else {
    echo "Ez dago informaziorik";
}
$conn->close();

?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $(document).ready(function () {

        $(".taulaReload").on("click", function () {
             taulaBirkargatu();
        });

         setInterval(taulaBirkargatu(), 1000);

    });

    function taulaBirkargatu() {

        $.ajax({
            url : "moto.php",
            type: "GET",
            data: {akzioa : "lortuMotoak"}
        })
            .done(function (bueltanDatorrenInformazioa) {

                var info = JSON.parse(bueltanDatorrenInformazioa);
                if (info.kopurua > 0) {
                    $(".zerrenda").html("");
                    $(".zerrenda").append("<tr>");
                    $(".zerrenda").append("<th> Postua </th>");
                    $(".zerrenda").append("<th> Dortsala </th>");
                    $(".zerrenda").append("<th> Izena </th>");
                    $(".zerrenda").append("</tr>");


                    for (var i = 0; i < info.kopurua; i++) {
                    $(".zerrenda").html("");
                    $(".zerrenda").append("<tr>");
                    $(".zerrenda").append("<th> Postua" + info[i].Postua , "</th>");
                    $(".zerrenda").append("<th> Izena" + info[i].Dortsala , "</th>");
                    $(".zerrenda").append("<th> Dortsala" + info[i].Izena , "</th>");
                    $(".zerrenda").append("</tr>");
                    }
                } else {
                    alert("Ez da elementurik kargatu");
                }

            })
            .fail(function () {
                alert("gaizki joan da");
            })
          
    }

    
</script>