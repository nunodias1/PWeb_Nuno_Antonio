<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nuto_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na ligação à base de dados: " . $e->getMessage();
    exit();
}

try {
    $escolha = $conn->query("USE nuto_database");
} catch (PDOException $e) {
    echo "<p>Erro ao aceder à base de dados nuto_database: " . $e->getMessage() . "</p>";
    exit();
}

function verifyUser($usernameInserted, $passwordInserted)
{
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM utilizadores WHERE username = :username AND password = :password");

        $stmt->bindParam(':username', $usernameInserted);
        $stmt->bindParam(':password', $passwordInserted);

        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $_SESSION['username'] = $usernameInserted;
            header("location: index.php");
        } else {
            echo "<script>alert('Utilizador ou password incorretas');</script>";
        }
    } catch (PDOException $e) {
        echo 'Erro na consulta: ' . $e->getMessage();
    }
}

function registerNewUser($usernameInserted, $passwordInserted)
{
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO utilizadores VALUES (:username, :password)");

        $stmt->bindParam(':username', $usernameInserted);
        $stmt->bindParam(':password', $passwordInserted);

        $stmt->execute();

        echo "Utilizador criado com sucesso <br> Para fazer o login clique aqui";
        echo "<a href='login.php'> Login </a>";
    } catch (PDOException $e) {
        echo 'Erro na consulta: ' . $e->getMessage();
    }
}
// Função para obter a lista de filmes da base de dados
function getSneakers()
{
    global $conn;
    
    try {
        $sneakersQuerry = "SELECT * FROM sneakers";
        $stmt = $conn->query($sneakersQuerry);
        $sneakers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $sneakers;
    } catch (PDOException $e) {
        echo "<p>Erro ao executar a consulta: " . $e->getMessage() . "</p>";
    }

}

// Função para criar um novo comentário
function createComment($username,$comentario,$sneaker_id){
    global $conn;
    try {
        $stmt = $conn->prepare("INSERT INTO comentarios Values (null , :username, :comentario, :sneaker_id)");

            // Bind dos parâmetros
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':comentario', $comentario);
        $stmt->bindParam(':sneaker_id', $sneaker_id);
            
        // Executar a consulta
        $stmt->execute();
        
    } catch (PDOException $e) {
         echo 'Erro na consulta: ' . $e->getMessage();
     }
    
}

// Função para obter a lista de comentários da base de dados
function getcomments()
{
    global $conn;
    
    try {
        $commentsQuerry = "SELECT * FROM comentarios";
        $stmt = $conn->query($commentsQuerry);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $comments;
    } catch (PDOException $e) {
        echo "<p>Erro ao executar a consulta: " . $e->getMessage() . "</p>";
    }

}

// Função para verificar se o utilizador já comentou sobre um filme
function verifyComment($username, $sneaker_id) 
{
    global $conn; // Corrigindo para usar $conn
    try {
        $stmt = $conn->prepare("SELECT * FROM comentarios WHERE username = :username AND sneaker_id = :sneaker_id");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':sneaker_id', $sneaker_id);

        $stmt->execute();

        return ($stmt->rowCount() > 0);
    
    } catch (PDOException $e) {
        echo 'Erro na consulta: ' . $e->getMessage();
        return false; // Adicionado retorno em caso de erro
    }
}

