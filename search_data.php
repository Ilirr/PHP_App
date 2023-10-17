<?php require_once 'database.php';
    

    $selectedKvalite = $_POST["kvalite"];
    
    $sql = $pdo->prepare("SELECT * FROM Observation WHERE kvalite = :kvalite");
    $sql->bindParam(":kvalite", $selectedKvalite, PDO::PARAM_STR);
    $sql->execute();
    
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($results)) 
    {
        echo "<h2>Search Results for Media Kvalite: $selectedKvalite</h2>";
        echo "<ul>";
        foreach ($results as $row) {
            foreach ($row as $key => $value) 
            {
                echo "$key: $value<br>";
            }
            echo "--------------------------<br>";
        }
    } else {
        echo "<p>No results found for Media Kvalite: $selectedKvalite</p>";
    }

?>