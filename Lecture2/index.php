<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>KMI</title>

</head>

<body>
    <header class="header">
        <h1 class="h1">KMI Skaičiuoklė</h1>
    </header>

    <main class="main">
        <form action="index.php" method="POST">
            <label for="kg">Iveskite savo svorį (kg)</label>
            <input type="number" name="kg">
            <label for="ugis">Iveskite savo ugį (pvz: 1.75)</label>
            <input type="number" step="0.01" name="ugis">
            <input type="submit" value="Įveskite duomenis">
        </form>
        <div>
            <p class="isvada">
                <?php
                $svoris = $_POST["kg"];
                $ugis = $_POST["ugis"];

                $kmi;
                $isvada;
                $picture;

                if ($ugis <= 0 || $svoris <= 0) {
                    echo "";
                } else {
                    $kmi = $svoris / pow($ugis, 2);
                    if ($kmi < 18.5) {
                        $isvada = "Suvalgyk kebabą!";
                        $picture = "dziusna";
                    } else if ($kmi < 25) {
                        $isvada = "Tu esi tiesiog nuostabus.";
                        $picture = "ripped";
                    } else if ($kmi < 30) {
                        $isvada = "Gal tau laikas nevalgyti po 6 h?";
                        $picture = "over";
                    } else {
                        $isvada = "Storas kiaulė.";
                        $picture = "fat";
                    }
                    echo "$isvada Tavo KMI: $kmi";
                    echo "<br><br><img src=" . $picture . ".jpg height=\"300\">";
                }
                ?>
            </p>
        </div>


    </main>
</body>

</html>