<?php
    session_start();
    include_once __DIR__ . '/../init.php';

    if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
        header('Location: ../index.php'); // Redireciona para a página inicial
        exit;
    }
    if (!isset($_SERVER['HTTP_REFERER'])) {
        header('Location: NothingGallery/index.php');
        exit;
    }

    $cod = $_GET["cod"];

    $stmt = $pdo->prepare("SELECT * FROM quadros WHERE idQuadros = :cod ");
    $stmt->bindParam(':cod', $cod);
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
    <link rel="stylesheet" href="../css/finalizar.css">
    <script src="../javascript/finalizar.js"></script>
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
        background-size: 300vh;
    }

    .quantidade {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .contador {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .contador button {
        padding: 8px 16px;
        font-size: 18px;
        cursor: pointer;
        background-color: #3a3838;
        border: none;
    }

    .contador div {
        font-size: 20px;
        min-width: 20px;
        text-align: center;
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

    <br><br><br><br>

    <main>
        
        <div class="finalizar">
            <div class="titulo">
                <button onclick="pagVoltar();" class="btnVoltar" id="btnVoltar"><</button>
                <H2 id="titulo" class="titulo">Selecione a forma de pagamento</H2>
            </div>
            <div class="fim1" id="metodoPag" >
                <button onclick="pagarCartao();" class="pagar" id="metodoPag">Pagamento com Cartão</button>
            </div>
<!--            <div class="fim2" id="metodoPag2" >-->
<!--                <button onclick="pagarPix();" class="pagar" id="metodoPag2">Pagamento com Pix</button>-->
<!--            </div>-->
            <div class="preco" id="preco_total" data-preco="<?php echo $linha['preco']; ?>">
                R$ <?php echo number_format($linha['preco'], 2, ',', '.'); ?>
            </div>
            <div class="quantidade" id="quantidade">
                <div>QUANTIDADE</div>
                <div class="contador">
                    <button id="btn_minus">-</button>
                    <div class="numero" id="numero">1</div>
                    <button id="btn_plus">+</button>
                </div>
            </div>
            <!-- Cartão -->
            <form action="../php/finalizarCartao.php" method="post" class="formC" style="display: none;" id="formC" onsubmit="return Validar();">
                <label for="numCart"></label><input type="text" name="numCart" id="numCart" placeholder="Número do Cartão (Fictício)" class="inform">
                <label for="nomeCart"></label><input type="text" name="nomeCart" id="nomeCart" placeholder="Nome completo do Titular" class="inform">
                <label for="vencC"></label><input type="text" name="vencC" id="vencC" placeholder="Data de Vencimento MM/AA" oninput="formatarDataCartao(this)" class="inform">
                <label for="codsegC"></label><input type="text" name="codsegC" id="codsegC" maxlength="3" placeholder="Código de Segurança" class="inform">
                <label for="enderecoC"></label><input type="text" name="endereco" id="enderecoC" minlength="5" placeholder="Endereço" class="inform">
                <input type="hidden" name="cod" value="<?php echo $cod; ?>">
                <input type="hidden" name="quantidade" id="input_quantidade" value="1">
                <input type="hidden" name="preco_total" id="input_preco" value="<?php echo $linha['preco']; ?>">
                <div style="height: 1px;"><label id="labelC" class="errorC"></label></div>
                <br>
                <input type="submit" value="Finalizar Compra" class="finalizarCompra"><br>
            </form>
            <!-- Pix -->
            <!-- <div class="comprarPIX" id="comprarPix"> <br><br><br>
                <form action="#" class="comprarPIX" method="post" id="comprarPix" onsubmit="return finalizarPix(event);">
                    <input type="text" name="Endereco" class="informEndPIX" id="enderecoPix" placeholder="Digite seu Endereço">
                    <div style="height: 1px;"><label class="error" id="error">Endereço inválido</label></div>
                    <div style="height: 2vmin;"></div>
                    <input type="submit" class="finPix" style="cursor: pointer;">
                </form>
           </div>
            <div class="qrcode" style="display: none;" id="qrcode">
                <img src="qrcode.png" alt="" style="width: 100%; height: 100%;"><br>
                <a href="index.php" class="qrcodeTxt" onclick="popUp();">Finalizar comprar</a>
            </div> -->

        </div>

    </main>

    <br><br><br>

    <footer>
        <div class="tbfooter"><br><br>
                <div class="thfooter">Contate-nos</div>
                    <br><br>
                    <a href="https://www.instagram.com/" target="_blank" class="links"> Instagram </a> <br>
                    <a href="https://twitter.com/i/flow/login" target="_blank" class="links"> Twitter </a> <br>
                    <l style="font-size: 1.5em;">Nothing_gallery@gmail.com</l>
        </div>
    </footer>

</body>

<script>
    const btnPlus = document.getElementById('btn_plus');
    const btnMinus = document.getElementById('btn_minus');
    const numeroDiv = document.getElementById('numero');
    const precoTotalDiv = document.getElementById('preco_total');
    const inputQuantidade = document.getElementById('input_quantidade');
    const inputPrecoTotal = document.getElementById('input_preco_total');

    const precoUnitario = parseFloat(precoTotalDiv.dataset.preco); // preço unitário salvo no HTML

    let quantidade = 1;

    function atualizarPreco() {
        numeroDiv.textContent = quantidade;
        precoTotalDiv.textContent = 'R$ ' + (precoUnitario * quantidade).toLocaleString('pt-BR', { minimumFractionDigits: 2 });
        inputQuantidade.value = quantidade;
        inputPrecoTotal.value = (precoUnitario * quantidade).toFixed(2); // para enviar no formulário
    }

    btnPlus.addEventListener('click', () => {
        quantidade++;
        atualizarPreco();
    });

    btnMinus.addEventListener('click', () => {
        if (quantidade > 1) {
            quantidade--;
            atualizarPreco();
        }
    });

    function formatarDataCartao(input) {
        let valor = input.value.replace(/\D/g, ''); // remove tudo que não for número

        if (valor.length >= 3) {
            valor = valor.slice(0, 2) + '/' + valor.slice(2, 4);
        }

        input.value = valor.slice(0, 5); // máximo 5 caracteres: MM/AA
    }

</script>


</html>