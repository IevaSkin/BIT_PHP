<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>

    <?php
    // 1. Masyvo sukūrimas

    $vienmatis = [2, 6, 1, 9];
    $asociatyvus = ["Jonas" => "Jonaitis", "Petras" => "Petraitis", "Vardenis" => "Pavardenis"];
    $daugiamatis = [[12, 4, 7], [34, 78, 9]];
    print("<h3>1. Sukurti masyvai:</h3>");
    print("<b>Vienmatis masyvas:</b><br>");
    print_r($vienmatis);
    print("<br><b>Asociatyvus masyvas:</b><br>");
    print_r($asociatyvus);
    print("<br><b>Daugiamatis masyvas:</b><br>");
    print_r($daugiamatis);

    // 2. Reikšmės nuskaitymas

    print("<h3>2. Nuskaitytos tam tikros masyvo elementų reikšmės:</h3>");
    print($vienmatis[1] . "<br>");
    print($asociatyvus["Petras"] . "<br>");
    print_r($daugiamatis[1][2] . "<br>");

    // 3. Elemento reikšmės pakeitimas

    $vienmatis[0] = 13;
    $asociatyvus["Jonas"] = "Jonaz";
    $daugiamatis[0][0] = 13;
    print("<h3>3. Masyvai po reikšmių pakeitimo:</h3>");
    print("<b>Vienmatis masyvas:</b><br>");
    print_r($vienmatis);
    print("<br><b>Asociatyvus masyvas:</b><br>");
    print_r($asociatyvus);
    print("<br><b>Daugiamatis masyvas:</b><br>");
    print_r($daugiamatis);

    // 4. Naujų elementų pridėjimas

    array_push($vienmatis, 88);
    $asociatyvus["Mauras"] = "Maurauskas";
    array_push($daugiamatis, [16, 5, 99]);
    print("<br><br><h3>4. Masyvai po naujų reikšmių įdėjimo:</h3>");
    print("<b>Vienmatis masyvas:</b><br>");
    print_r($vienmatis);
    print("<br><b>Asociatyvus masyvas:</b><br>");
    print_r($asociatyvus);
    print("<br><b>Daugiamatis masyvas:</b><br>");
    print_r($daugiamatis);

    // 5. Elementų reikšmių išvardinimas

    print("<h3>5. Masyvo reikšmių išvardinimas naudojant for():</h3>");
    print("<b>Vienmačio masyvo reikšmės:</b><br>");
    for ($i = 0; $i < sizeof($vienmatis); $i++) {
        print($vienmatis[$i] . "<br>");
    }
    print("<br><b>Asociatyvaus masyvo:</b><br>");
    foreach ($asociatyvus as $value) {
        print($value . "<br>");
    }
    print("<br><b>Daugiamačio masyvo:</b><br>");
    for ($i = 0; $i < sizeof($daugiamatis); $i++) {
        print("<br>" . ($i + 1) . ". masyvo reikšmės: <br>");
        for ($j = 0; $j < sizeof($daugiamatis[$i]); $j++) {
            print($daugiamatis[$i][$j] . "<br>");
        }
    }

    // 6. Elementų pašalinimas iš masyvų

    print("<h3>6. Masyvai po tam tikrų elementų pašalinimo:</h3>");
    array_splice($vienmatis, 4, 1);
    array_splice($asociatyvus, 2);
    array_splice($daugiamatis, 2, 1);
    print("<b>Vienmatis masyvas:</b><br>");
    print_r($vienmatis);
    print("<br><b>Asociatyvus masyvas:</b><br>");
    print_r($asociatyvus);
    print("<br><b>Daugiamatis masyvas:</b><br>");
    print_r($daugiamatis);

    // 7. Paieška

    print("<h3>7. Surastos tam tikros masyvo elementų reikšmės su array_search:</h3>");
    print((array_search('6', $vienmatis)) . "<br>");
    print((array_search("Jonaz", $asociatyvus)) . "<br>");

    function multidimesional_array_search($value_to_find, $my_array)
    {
        $values = null;
        for ($i = 0; $i < sizeof($my_array); $i++) {
            if (array_search($value_to_find, $my_array[$i]) != null) {
                $values = $values . ($i . " " . array_search($value_to_find, $my_array[$i]) . ";");
            }
        }
        return $values;
    }

    print(multidimesional_array_search(78, $daugiamatis) . "<br>");

    // 8. Rikiavimas

    print("<h3>8. Masyvai po rikiavimo:</h3>");
    print("<b>Vienmatis masyvas:</b><br>");
    sort($vienmatis);
    print_r($vienmatis);
    print("<br><b>Asociatyvus masyvas:</b><br>");
    arsort($asociatyvus);
    print_r($asociatyvus);
    print("<br><b>Daugiamatis masyvas:</b><br>");

    function multi_dimensional_array_sort($my_array)
    {
        $my_sorted_array = [];
        for ($i = 0; $i < sizeof($my_array); $i++) {
            sort($my_array[$i]);
            array_push($my_sorted_array, $my_array[$i]);
        }
        return $my_sorted_array;
    }

    $daugiamatis = multi_dimensional_array_sort($daugiamatis);
    print_r($daugiamatis);

    // 9. Filtravimas

    print("<h3>9. Masyvai po filtravimo:</h3>");

    function filter_values($value)
    {
        if ($value >= 10) {
            return false;
        } else {
            return true;
        }
    }

    function dropValueOut($value)
    {
        return $value == "Jonaz";
    }

    print("<b>Vienmatis masyvas:</b><br>");
    print_r(array_filter($vienmatis, "filter_values"));
    print("<br><b>Asociatyvus masyvas:</b><br>");
    print_r(array_filter($asociatyvus, "dropValueOut", ARRAY_FILTER_USE_BOTH));
    print("<br><b>Daugiamatis masyvas:</b><br>");

    function multi_dimensional_array_filter($my_array, $my_function)
    {
        $my_filtered_array = [];
        for ($i = 0; $i < sizeof($my_array); $i++) {
            $filtered = array_filter($my_array[$i], $my_function);
            array_push($my_filtered_array, $filtered);
        }
        return $my_filtered_array;
    }

    print_r(multi_dimensional_array_filter($daugiamatis, "filter_values"));

    // 10. Reikšmės įdėjimas į vidurį arba pradžią, ištrynus seną reikšmę

    array_splice($vienmatis, 0, 0, 55);
    print("<br><br><h3>10. Masyvai po naujų reikšmių įdėjimo su splice:</h3>");
    print("<b>Vienmatis masyvas:</b><br>");
    print_r($vienmatis);
    print("<br><b>Asociatyvus masyvas:</b><br>");

    function array_splice_associative($my_array, $index, $key, $value)
    {
        $array_start = array_splice($my_array, $index);
        $array_end = array_splice($my_array, 0, $index);
        $my_array = array_merge($array_start, array($key => $value), $array_end);
        return $my_array;
    }
    $asociatyvus = array_splice_associative($asociatyvus, 1, "Grybas", "Grybauskas");
    print_r($asociatyvus);
    print("<br><b>Daugiamatis masyvas:</b><br>");

    function array_splice_multidimensional($my_array, $indexOfArray, $index, $value)
    {
        for ($i = 0; $i < sizeof($my_array); $i++) {
            if ($i == $indexOfArray) {
                array_splice($my_array[$i], $index, 0, $value);
            }
        }

        return $my_array;
    }

    $daugiamatis = array_splice_multidimensional($daugiamatis, 1, 1, 55);
    print_r($daugiamatis);

    // 11. Reikšmių sumavimas

    print("<h3>11. Masyvų reikšmių sumos naudojant array_sum:</h3>");
    

    print("<b>Vienmatis masyvas:</b><br>");
    print(array_sum($vienmatis));
    print("<br><b>Asociatyvus masyvas:</b><br>");
    print("Nėra ką sumuoti.");
    print("<br><b>Daugiamatis masyvas:</b><br>");

    function array_sum_multidimesional($my_array) {
        $sum = 0;
        for ($i = 0; $i < sizeof($my_array); $i++) {
            $sum += array_sum($my_array[$i]);
        }
        return $sum;
    }
    print(array_sum_multidimesional($daugiamatis));

    // 11. Didžiausių ir mažiausių reikšmių radimas

    print("<h3>11. Masyvų didžiausios ir mažiausios reikšmės:</h3>");
    
    print("<b>Vienmatis masyvas:</b><br>");
    print(min($vienmatis) . "<br>");
    print(max($vienmatis));
    print("<br><b>Asociatyvus masyvas:</b><br>");
    print(min($asociatyvus) . "<br>");
    print(max($asociatyvus));
    print("<br><b>Daugiamatis masyvas:</b><br>");

    function min_multidimensional($my_array) {
        $values = [];
        for ($i = 0; $i < sizeof($my_array); $i++) {
           array_push($values, min($my_array[$i]));
        }

        return min($values);
    }

    function max_multidimensional($my_array) {
        $values = [];
        for ($i = 0; $i < sizeof($my_array); $i++) {
           array_push($values, max($my_array[$i]));
        }
        return max($values);
    }

    print(min_multidimensional($daugiamatis) . "<br>");
    print(max_multidimensional($daugiamatis));

    ?>
</body>

</html>