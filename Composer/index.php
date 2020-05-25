

<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="">
                <ul id="" class="nav">
                    <li><a href="?path=projektai">Projektai</a></li>
                    <li><a href="?path=darbuotojai">Darbuotojai</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main style="padding: 20px" class="">

 <?php

 include_once "bootstrap.php"; 

        $table = 'darbuotojai';
        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        $dbname = "mydb";

        if (isset($_GET['path']) and $_GET['path'] !== $table) {
            if ($_GET['path'] == 'darbuotojai' or $_GET['path'] == 'projektai')
                $table = $_GET['path'];
        }
        // Connection 
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn)
            die("Connection failed: " . mysqli_connect_error());

        // Delete
        if (isset($_GET['delete'])) {
            $sql_delete = "DELETE FROM " . $table . " WHERE id = " . $_GET['delete'];
            $stmt = $conn->prepare($sql_delete);
            $stmt->execute();
        }
        
        // Update 
        if (isset($_POST['update'])) {
            $sql_update = "UPDATE " . $table
                . " SET id=" . $_POST['id']
                . ", name='" . $_POST['name']
                . (isset($_POST['proj_id']) ? "', proj_id='" . $_POST['proj_id'] : "")
                . "' WHERE id=" . $_GET['update'];
            $stmt = $conn->prepare($sql_update);
            $stmt->execute();
        }
        // Add
        if (isset($_POST['Prideti'])) {
            print($_POST['name']);
            $sql_add = "INSERT INTO " . $table . " (`name`) VALUES (?)";
            $stmt = $conn->prepare($sql_add);
            $stmt->bind_param("s", $_POST['name']);
            $stmt->execute();
        }

        $sql = "SELECT "
            . $table . ".id, "
            . $table . ".name, GROUP_CONCAT(" . ($table === 'projektai' ? 'darbuotojai' : 'projektai') . ".name SEPARATOR \", \")" .
            " FROM " . $table .
            " LEFT JOIN " . ($table === 'projektai' ? 'darbuotojai' : 'projektai') .
            " ON " . ($table === 'projektai' ? 'darbuotojai.proj_id = projektai.id' : 'darbuotojai.proj_id = projektai.id') .
            " GROUP BY " . $table . ".id;";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($id, $Name, $AnotherName);


        echo '<table><th>Id</th><th>Vardas</th><th>' . ($table === 'projektai_sql' ? 'Darbuotojai' : 'Projektai') . '</th><th>Veiksmai</th>';
        while ($stmt->fetch()) {
            echo "<tr>
                            <td>" . $id . "</td>
                            <td>" . $Name . "</td>
                            <td>" . $AnotherName . "</td>
                            <td>
                                <button><a href=\"?path=" . $table . "&update=$id\">Redaguoti</a></button>
                                <button><a href=\"?path=" . $table . "&delete=$id\">Istrinti</a></button>
                            </td>
                        </tr>";
        }
        echo '</table>';

        if (isset($_GET['update'])) {
            $projektai_sql = mysqli_query($conn, "SELECT id, name FROM Projektai");
            $projektai = [];
            if (mysqli_num_rows($projektai_sql) > 0)
                while ($projektas = mysqli_fetch_assoc($projektai_sql))
                    $projektai[$projektas['id']] = $projektas['name'];

            $sql_update = "SELECT id, name FROM " . $table . " WHERE id = " . $_GET['update'];
            $stmt = $conn->prepare($sql_update);
            $stmt->execute();
            $stmt->bind_result($id, $Name);

            while ($stmt->fetch()) {
                echo "<br><br><form style=\"max-width: 150px\" action=\"\" method=\"POST\">
                            <input type=\"text\" name=\"id\" value=\"" . $id . "\">
                            <input type=\"text\" name=\"name\" text value=\"" . $Name . "\">";
                if ($_GET['path'] === 'darbuotojai') {
                    echo "<select name=\"proj_id\">
                                <option value=\"\" disabled selected>Projektas:</option>";
                    foreach ($projektai as $p_id => $p_name)
                        echo "<option value=\"$p_id\">$p_name</option>";
                    echo "</select>";
                }
                echo "<input type=\"submit\" value=\"UPDATE\" name=\"update\">
                        </form>";
            }
        } else
            echo "<br><br><form class=\"button1\" action=\"\" method=\"POST\">
                            <input type=\"text\" name=\"name\" value=\"\" placeholder=\""
                . ($_GET['path'] === 'projektai' ? 'Projekto pavadinimas' : 'Darbuotojo vardas')  . "\"> <br>
                            <input class=\"button1\" type=\"submit\" value=\"Prideti "
                . ($_GET['path'] === 'projektai' ? 'Projektas' : 'Darbuotojas') . "\" name=\"Prideti\"> <br>
                <br><br></form>";

        $stmt->close();
        mysqli_close($conn);

    ?>

    </main>
</body>
</html>