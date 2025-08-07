<?php
    session_start();
    include_once __DIR__ . '/../init.php';

    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ../index.php');
        exit;
    }
    $cod = $_GET["cod"];

    $stmt = $pdo->prepare('SELECT * FROM quadros WHERE idQuadros = :cod');
    $stmt->bindParam(':cod', $cod, PDO::PARAM_INT);
    $stmt->execute();
    $linha = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nothing Gallery</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../css/carousel.css">
    <link rel="stylesheet" href="../css/comprar.css">
</head>
<style>
    @font-face {
        font-family: Voga;
        src: url(../font/Voga_Medium.otf);
    }

    body {
        margin: 0;
        height: auto;
        background-image: url(../images/fundo.svg);
        background-size: cover;
    }
</style>

<body>

    <!-- CABEÇALHO PRESO -->

    <header> 
        <table class="tableHD">
            <tr> 
                <th> <a href="../index.php" style="text-decoration: none; color: #ffffff;"> <h1> Nothing Gallery </h1> </a> </th>
                <th> <div class="searchbar"></div> </th> 

            </tr>
        </table>
    </header>

    <br><br><br><br><br>

    <main>

        <div class="comprar">
            <div class="imgQDR"> <img src="<?php echo BASE_URL . '/' . ltrim($linha['imagemDiretorio'], '/');?>"
                                      style="height: 90%; border: 2px solid #ffffff; id='imgQDR'" alt="imagemQuadro"> </div>
            <div class="infoQDR">
                <div class="nomeQDR" id="nomeQDR"> <?php echo htmlspecialchars($linha['nome']);?> </div>
                <div class="precoQDR" id="precoQDR"> R$ <?php echo ($linha['preco']) ?> </div>
                <div class="freteQDR">
                    Em 6x de R$ <?php echo number_format($linha['preco'],2,',','.');?> sem juros
                </div>

                <br><br>

                <div class="desc"><div class="desc_txt"> <?php echo nl2br(htmlspecialchars($linha['descricao'])); ?></div> </div>

                <div class="finalizarQDR">
                    <div style="width:35%">

                    </div>
                    <div class="fimQDR">
                        <input type="button" class="finalizar" onclick="concluir();" value="Finalizar compra">
                    </div>
                </div>
            </div>
        </div>

    </main>

    <br><br><br><br><br><br>

    <footer>
        <div class="tbfooter"><br><br><br>
                <div class="thfooter">Contate-nos</div>
                    <br><br>
                    <a href="https://www.instagram.com/" target="_blank" class="links"> Instagram </a> <br>
                    <a href="https://twitter.com/i/flow/login" target="_blank" class="links"> Twitter </a> <br>
                    <a style="font-size: 1.5em;">Nothing_gallery@gmail.com</a>
                </div>
        </div>
    </footer>

</body>
<script>
    function concluir()
    {
        window.open("finalizar.php?cod=<?php echo $cod; ?>", "_self")
    }

    let quantidade = 1;
    const quantidadeMin = 1;
    const quantidadeMax = 99;

    function atualizarQuantidade() {
        document.getElementById("quantidade").textContent = quantidade;
    }

    function aumentarQuantidade() {
        if (quantidade < quantidadeMax) {
            quantidade++;
            atualizarQuantidade();
        }
    }

    function diminuirQuantidade() {
        if (quantidade > quantidadeMin) {
            quantidade--;
            atualizarQuantidade();
        }
    }
    document.addEventListener("DOMContentLoaded", atualizarQuantidade);
</script>



</script>
</html>