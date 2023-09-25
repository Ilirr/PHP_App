<?php

require_once 'database.php';
session_start();
try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['username']) && isset($_POST['password'])) {

        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];
        
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $inputUsername);
        $stmt->bindParam(':password', $inputPassword);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['user_id'] = $inputUsername;
            header('Location: MyApp.php');
            
            exit();
        } else {
            echo 'Invalid login information';

        }

        if (isset($_SESSION['user_id'])) {
            // You can handle the case where the user is already logged in here
            // For example, display a different message or redirect to another page
            echo $_SESSION['user_id'] .  'Already logged in ';
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