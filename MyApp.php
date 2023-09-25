<!DOCTYPE html>
<html>

<head>
    <title>Observationsystem</title>

    <style>
        .left {
            float: left;
            width: 50%;
            /* Adjust the width as needed */
        }

        .right {
            float: right;
            width: 50%;
            /* Adjust the width as needed */
        }
    </style>
</head>

<body>
    <h1>Observationsystem</h1>
    <table border=1>
        <?php require_once 'database.php';
        session_start();
        ?>

        <?php
        $sql = 'SELECT id, säkerhet FROM Observation';
        $sth = $pdo->prepare($sql);
        $sth->execute();
        $observationer = $sth->fetchAll(PDO::FETCH_ASSOC);

        foreach ($observationer as $observation) {
            $obsID = $observation['id'];
            $obsSkh = $observation['säkerhet'];

            echo "<a href='update_data.php?id=$obsID'> Observation $obsID: Add +10 to säkerhet  Current: $obsSkh</a><br>";
        }


        // SQL query to retrieve all observations
        $sql = "SELECT * FROM Observation";

        $result = $pdo->query($sql);

        if (!empty($result)) {
            echo "<h2>All Observations:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Media Namn</th><th>Kvalite</th><th>Datum</th><th>Grad</th><th>Säkerhet</th></tr>";
            
            // Loop through the results and display each observation
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['media_namn']}</td>";
                echo "<td>{$row['kvalite']}</td>";
                echo "<td>{$row['datum']}</td>";
                echo "<td>{$row['grad']}</td>";
                echo "<td>{$row['säkerhet']}</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "No observations found.";
        }

        $sql = "SELECT * FROM Person_Observation";

        $result = $pdo->query($sql);

        if (!empty($result)) {
            echo "<h2>All Observation_Person tables:</h2>";
            echo "<table border='1'>";
            echo "</tr><th>Person ID</th><th>Observation ID<th></th>";
            
            // Loop through the results and display each observation
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['media_namn']}</td>";
                echo "<td>{$row['kvalite']}</td>";
                echo "<td>{$row['datum']}</td>";
                echo "<td>{$row['grad']}</td>";
                echo "<td>{$row['säkerhet']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No tables found.";
        }
        ?>

        <form method="post" action="execute_procedure.php">
            <label>Execute Procedure:</label>
            <select name="procedure">
                <option value="Alla_Observationer">Alla_Observationer</option>
                <option value="Alla_Observationer_Vertikal">Alla_Observationer_Vertikal</option>
            </select>
            <input type="submit" value="Execute">

        </form>


        <form method="post" action="search_data.php">
            <label>Search Observation by Media Kvalite:</label>
            <select name="kvalite">
                <option value="1">Dålig</option>
                <option value="2">God</option>
                <option value="3">Medelgod</option>
                <option value="4">Bra</option>
            </select>
            <input type="submit" value="Search">
        </form>


        <h1>Add an Observation</h1>
        <form method="post" action="add_data.php">
            <label>Observation</label><br>
            ID: <input type="number" name="id"><br>
            Media_Namn: <input type="media_namn" name="media_namn"><br>
            Kvalite (1-4): <input type="number" name="kvalite" min="1" max="4"><br>
            Datum: <input type="date" name="datum"><br>
            Grad (1-4): <input type="number" name="grad" min="1" max="4"><br>
            Säkerhet (1-114): <input type="number" name="säkerhet" min="0" max="114"><br>
            <input type="submit" value="Add Observation">
        </form>




        <h1>Current User</h1>
        <form method="post" action="logout.php">
            <?php echo $_SESSION['user_id'] . ' is logged in'; ?>
            <input type="submit" value="Logout">
        </form>
</body>

</html>