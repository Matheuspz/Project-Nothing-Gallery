<?php
    session_start();
    include_once __DIR__ . '/../init.php';

    $nome       = $_POST["cadastroNome"];
    $sobrenome  = $_POST["cadastroSobrenome"];
    $email      = $_POST["cadastroEmail"];
    $senha      = $_POST["cadastroSenha"];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $check = $pdo->prepare("SELECT COUNT(*) FROM usuario WHERE email = :email");
    $check->execute([":email" => $email]);
    if ($check->fetchColumn() > 0){
        $_SESSION['mensagem'] = "Email já cadastrado!";
        header("Location: ../php/login_singin.php");
        exit;
    }

    $comando = $pdo->prepare("INSERT INTO usuario(idTipoUsuario, nome, sobrenome, email, senha) 
                                    VALUES(:idTipoUsuario,:nome,:sobrenome,:email,:senha_hash)" );
    $resultado = $comando->execute([
        ':idTipoUsuario' => 2,
        ':nome' => $nome,
        ':sobrenome' => $sobrenome,
        ':email' => $email,
        ':senha_hash' => $senha_hash
    ]);

    if($resultado){
        echo "<script>alert('Cadastro Realizado!'); window.location.href = '../php/login_singin.php';</script>";
        exit;
    } else {
        $_SESSION['mensagem'] = "Error ao cadastrar!";
        echo "<script>alert('Error ao Cadastrar!'); window.location.href = '../php/login_singin.php';</script>";
        exit;
    }
?>