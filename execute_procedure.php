<?php require_once 'database.php';
    
try {

    $procedure = $_POST['procedure'];
    $sql = $pdo->prepare("CALL $procedure()");

    $sql->execute();


    $results = $sql->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($results)) {
        foreach ($results as $row) {
            foreach ($row as $key => $value) {
                echo "$key: $value<br>";
            }
            echo "--------------------------<br>";
        }
    } else {
        echo "No observations found.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>


