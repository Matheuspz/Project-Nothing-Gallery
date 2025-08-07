<?php
session_start();
include_once __DIR__ . '/../init.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

$idUsuario = $_SESSION['user'];

// Dados recebidos do formulário
$nome       = trim($_POST['nome']);
$sobrenome  = trim($_POST['sobrenome']);
$email      = trim($_POST['email']);
$senha_atual     = $_POST['senha_atual'];
$nova_senha      = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

// Buscar a senha atual do banco
$comando = $pdo->prepare("SELECT senha FROM Usuario WHERE idUsuario = :id");
$comando->execute([':id' => $idUsuario]);
$senha_hash = $comando->fetchColumn();

// Verifica se a senha atual está correta
if (!password_verify($senha_atual, $senha_hash)) {
    echo "<script>alert('Senha atual incorreta!'); window.history.back();</script>";
    exit;
}

// Início da construção dinâmica da query de atualização
$campos = [];
$valores = [':id' => $idUsuario];

// Só atualiza nome se não estiver vazio
if ($nome !== "") {
    $campos[] = "nome = :nome";
    $valores[':nome'] = $nome;
}

// Só atualiza sobrenome se não estiver vazio
if ($sobrenome !== "") {
    $campos[] = "sobrenome = :sobrenome";
    $valores[':sobrenome'] = $sobrenome;
}

// Só atualiza email se não estiver vazio
if ($email !== "") {
    $campos[] = "email = :email";
    $valores[':email'] = $email;
}

// Só atualiza senha se nova senha for válida e igual à confirmação
if (!empty($nova_senha) && $nova_senha === $confirmar_senha) {
    $nova_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    $campos[] = "senha = :senha";
    $valores[':senha'] = $nova_hash;
} elseif (!empty($nova_senha) && $nova_senha !== $confirmar_senha) {
    echo "<script>alert('As novas senhas não coincidem!'); window.history.back();</script>";
    exit;
}

// Verifica se há algo para atualizar
if (count($campos) > 0) {
    $sql = "UPDATE Usuario SET " . implode(', ', $campos) . " WHERE idUsuario = :id";
    $comando = $pdo->prepare($sql);
    $resultado = $comando->execute($valores);

    if ($resultado) {
        echo "<script>alert('Dados atualizados com sucesso!'); window.location.href = '../index.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar os dados!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Nenhuma alteração feita.'); window.history.back();</script>";
}
?>
