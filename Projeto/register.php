<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register</title>
</head>

<body>
    <header>
        <h1>Register</h1>
    </header>

    <div id="register-form">
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>
    </div>
    <div id="success-message">
        <?php
        include 'model/acessobd.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Chama a função para registrar um novo utilizador
            registerNewUser($username, $password);
        }
        ?>
    </div>
</body>
</html>
