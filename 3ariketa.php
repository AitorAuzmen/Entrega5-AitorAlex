<!DOCTYPE html>
<html lang="eu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eskualdea eta Herria Aukeratu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    select {
      margin: 10px 0;
      padding: 5px;
    }
  </style>
</head>
<body>
  <h1>Eskualdea eta Herria Aukeratu</h1>
  <form>
    <label for="eskualdea">Eskualdea:</label>
    <select id="eskualdea">
      <option value="">-- Hautatu eskualdea --</option>
      <option value="goiherri">Goiherri</option>
      <option value="urola">Urola</option>
      <option value="donostialdea">Donostialdea</option>
      <option value="burruntzaldea">Burruntzaldea</option>
    </select>

    <label for="herria">Herria:</label>
    <select id="herria" disabled>
      <option value="">-- Lehenik eskualdea hautatu --</option>
    </select>
  </form>

  <script>
    const herriak = {
      goiherri: ["Legorreta", "Itsasondo", "Arama", "Altzaga"],
      urola: ["Zumarraga", "Urretxu", "Legazpi", "Ezkio"],
      donostialdea: ["Donostia", "Pasaia", "Errenteria", "Oiartzun"],
      burruntzaldea: ["Hernani", "Astigarraga", "Lasarte", "Usurbil"]
    };

    const eskualdeaSelect = document.getElementById('eskualdea');
    const herriaSelect = document.getElementById('herria');

    eskualdeaSelect.addEventListener('change', () => {
      const eskualdeHautatua = eskualdeaSelect.value;

      // Bigarren select-a hustu
      herriaSelect.innerHTML = '<option value="">-- Hautatu herria --</option>';

      if (eskualdeHautatua) {
        // Eskualdeari dagokion herrien zerrenda gehitu
        herriak[eskualdeHautatua].forEach(herria => {
          const option = document.createElement('option');
          option.value = herria.toLowerCase();
          option.textContent = herria;
          herriaSelect.appendChild(option);
        });
        herriaSelect.disabled = false;
      } else {
        // Eskualdea hautatu gabe badago, bigarren select-a desgaitu
        herriaSelect.disabled = true;
      }
    });
  </script>
</body>
</html>
