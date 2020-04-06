<html>
  <head>
    <title>Zmogus</title>
  </head>
  <body>
    <?php
  $Zmogaus_svoris = array (
    "Linas" => "55", 
    "Tadas" => "80", 
    "Patricija" => "43", 
    "Lukrecija" => "99", 
    "Marija" => "119",
    "Marius" => "71",
    "Ramunas" => "101",
  );

  print("Lengviausias zmogus yra (kg)". "<br>"); 
  print_r(min($Zmogaus_svoris));
  print("<br>");
  print("Sunkiausias zmogus yra (kg)". "<br>"); 
  print_r(max($Zmogaus_svoris));
  print("<br>");
  print("Zmones pagal svori (kg)". "<br>");
  sort($Zmogaus_svoris);
  $length = count($Zmogaus_svoris);
  for($x = 0; $x < $length; $x++) {
    echo $Zmogaus_svoris[$x];
    echo "<br>";
}
  print("<br>");
  print("Bendras visu svoris (kg)". "<br>");
  print_r(array_sum($Zmogaus_svoris));
  print("<br>");
  if (array_sum($Zmogaus_svoris) > 500) {
    echo "NELIPKIT VISI I LIFTA! NUKRISIT";
  }
    else { echo "Lipkit i lifta ir varykit namo";
  }
    ?> 
  </body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liftas</title>
</head>

<body>
    <?php

    $zmones = ["Petras" => 78, "Jonas" => 81, "Pranas" => 72, "Matas" => 95];

    print("Į liftą įlipo šie žmonės:<br>");
    foreach ($zmones as $value) {
        print(array_search($value, $zmones) . " sveriantis " . $value . ";<br>");
    }

    print("<br>Mažiausiai sveria " . array_search(min($zmones), $zmones) . " - " . min($zmones) . "kg.<br>");
    print("Daugiausiai sveria " . array_search(max($zmones), $zmones) . " - " . max($zmones) . "kg.<br><br>");

    print("Žmonės, surikiuoti pagal svorį didėjančia tvrka:<br>");
    asort($zmones);
    foreach ($zmones as $value) {
        print(array_search($value, $zmones) . " sveriantis " . $value . ";<br>");
    }

    function arGaliKiltiLiftu($my_array)
    {
        if (array_sum($my_array) <= 500) {
            print("Bendras šių žmonių svoris neviršija 500kg. Žmonėms liftu kilti galima.<br>");
        } else {
            print("Bendras šių žmonių svoris viršija 500kg. Žmonėms liftu kilti negalima.<br>");
        }
    }
    print("<br>");
    arGaliKiltiLiftu($zmones);

    ?>


</body>

</html>