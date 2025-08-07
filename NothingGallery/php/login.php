<?php
    session_start();
    include_once __DIR__ . '/../init.php';

    $email = $_POST["loginEmail"];
    $senha = $_POST["loginSenha"];

    $comando = $pdo->prepare("SELECT idUsuario,senha   FROM usuario WHERE email = :email");
    $comando->bindParam(':email', $email);
    $resultado = $comando->execute();
    $user = $comando->fetch();

    if ($user && password_verify($senha, $user['senha'])) {

        $_SESSION['user'] = $user['idUsuario'];
        $_SESSION['usuario_logado'] = true;
        echo "<script>alert('Login realizado com sucesso!'); window.location.href = '../index.php';</script>";
        exit;
    } else {
        $_SESSION['loginErro'] = true;
        $_SESSION['mensagem'] = "Error ao realizar login!";
        echo "<script>alert('Error ao realizar Login!'); window.location.href = '../index.php';</script>";
        exit;
    }
?>