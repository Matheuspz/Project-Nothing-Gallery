<?php
    session_start();
    include_once __DIR__ . '/../init.php';

    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ../index.php');
        exit;
    }
    $idUsuario = $_SESSION['user'];
    $idQuadro = $_POST["cod"];
    $precoUnitario = $_POST["preco_total"];
    $quantidade = $_POST["quantidade"];
    $precoTotal = $precoUnitario * $quantidade;

    $comando = $pdo->prepare("INSERT INTO Vendas(idUsuario, data, precoTotal) 
                                    VALUES(:idUsuario, NOW(), :precoTotal);");
    $comando->execute([
        ':idUsuario' => $idUsuario,
        ':precoTotal' => $precoTotal
    ]);
    $idVendas = $pdo->lastInsertId();
    $comando = $pdo->prepare("INSERT INTO Vendas_Quadros (idVendas, idQuadro, quantidade, precoUnitario) 
                                    VALUES (:idVendas, :idQuadro, :quantidade, :precoUnitario)");
    $comando->execute([
        ':idVendas' => $idVendas,
        ':idQuadro' => $idQuadro,
        ':quantidade' => $quantidade,
        ':precoUnitario' => $precoUnitario
    ]);

    echo "<script>alert('Obrigado pela compra.'); window.location.href = '../index.php';</script>";
?>