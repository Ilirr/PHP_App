<?php

$date = $_POST['date'];

Alla_Observationer_Innan_Datum($date);
function Alla_Observationer_Innan_Datum($date)
{
    require_once 'database.php';

    try {

        $sql = $pdo->prepare("CALL Alla_Observationer_Innan_Datum(:date)");
        $sql->bindParam(':date', $date, PDO::PARAM_STR);
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($result)) {

             echo "<h2>Listing observations before: $date:</h2>";
            echo "<table border='1'>";
            foreach ($result as $row) {
                foreach ($row as $key => $value) {
                    echo "<tr>";
                    echo "$key: $value<br>";
                    echo "<tr>";
                }
                echo "</table>";
                echo "--------------------------<br>";
            }
        } else {
            echo "No observations before this date.";
        }

    } catch (PDOException $e) {
        echo 'Database Connection Error: ' . $e->getMessage();
    }
}



?>