<?php require_once 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {



    $id = $_POST["id"];
    $datum = $_POST["datum"];
    $media_namn = $_POST["media_namn"];
    $kvalite = $_POST["kvalite"];
    $grad = $_POST["grad"];
    $säkerhet = $_POST["säkerhet"];


    $checkQuery = "SELECT COUNT(*) FROM Observation WHERE id = ?";
    $CHECK = $pdo->prepare($checkQuery);
    $CHECK->execute([$id]);
    $count = $CHECK->fetchColumn();

    if($count == 0)
    {
        $query = "INSERT INTO Observation (id, media_namn, kvalite, datum, grad, säkerhet)
        VALUES ('$id', '$media_namn', '$kvalite', '$datum', '$grad', '$säkerhet')";

        $sth = $pdo->prepare($query);

        if ($sth->execute())
        {
            echo "Observation added";
        } 
        else 
        {
            echo "Error";
        }

    }
    else{
        echo "There is already an observation with same ID";
    }


}


?>