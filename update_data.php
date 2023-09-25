
<?php require_once 'database.php';

    if (isset($_GET['id'])) {
        $obsID = $_GET['id'];
    
        $sql = 'UPDATE Observation SET säkerhet = säkerhet + 10 WHERE id = :id';
        $sth = $pdo->prepare($sql);
        
        $sth->bindParam(':id', $obsID, PDO::PARAM_INT);
        
        // Utför SQL-frågan
        if ($sth->execute()) {
            echo "Trovärdigheten har ändrats för datbaasen.";
        } else {
            echo "Ett fel inträffade vid borttagning av produkten.";
        }
    }
?>
