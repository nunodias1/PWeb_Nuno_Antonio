
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<header><h1>Login</h1></header>

<body>
    
    <div id="login-form">
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>

        <?php
        // Exibe mensagem de credenciais inválidas
        if (isset($_SESSION['login_error']) && $_SESSION['login_error']) {
            echo "<script>alert('Credenciais Inválidas');</script>";
            $_SESSION['login_error'] = false;
        }
        ?>
    </div>
</body>

</html>
<?php
include 'model/acessobd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Chama a função para verificar as credenciais do usuário
    verifyUser($username, $password);
}
?>





