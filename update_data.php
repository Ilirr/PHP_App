
<?php require_once 'database.php';

    if (isset($_GET['id'])) {
        $obsID = $_GET['id'];
    
        $sql = 'UPDATE Observation SET säkerhet = säkerhet + 10 WHERE id = :id';
        $sth = $pdo->prepare($sql);
        
        $sth->bindParam(':id', $obsID, PDO::PARAM_INT);
        
        try
        {
            $sth->execute();
            echo "Säkerheten har ändrats för observationen.";
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();

        }
       
    }
?>
