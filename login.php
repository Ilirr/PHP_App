<?php
require_once 'database.php';
session_start();
try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['username']) && isset($_POST['password'])) {

        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];
        
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $sql = $pdo->prepare($query);
        $sql->bindParam(':username', $inputUsername);
        $sql->bindParam(':password', $inputPassword);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['user_id'] = $inputUsername;
            header('Location: MyApp.php');
            
            exit();
        } else {
            echo 'Invalid login information';

        }
    }
} catch (PDOException $e) {
    echo 'Database Connection Error: ' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>

<body>
    <?php if (!isset($_SESSION['user_id'])) { ?>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    <?php } else { ?>
        <form method="post" action="logout.php">
        <?php echo $_SESSION['user_id'] . ' is logged in'; ?>
            <input type="submit" value="Logout">
        </form>
    <?php } ?>
</body>

</html>