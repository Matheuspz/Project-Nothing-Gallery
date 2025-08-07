<?php 
    session_start();
    include_once __DIR__ . '/init.php';

    if (isset($_SESSION['mensagem'])) {
        echo "<script>alert('{$_SESSION['mensagem']}');</script>";
        unset($_SESSION['mensagem']);
    }
    if (isset($_SESSION['user'])) {
        echo '<script>
            window.addEventListener("load", function() {
                userLogin();
            });
        </script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nothing Gallery</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/carousel.css">
    <script src="javascript/carousel.js"></script>
    <script src="javascript/index.js"></script>

</head>

<style>
    @font-face {
        font-family: Voga;
        src: url(font/Voga_Medium.otf);
    }
    body {
        margin: 0;
        height: auto;
        background-image: url(images/fundo.svg);
        background-size: 300vh;
    }
    .TS_th1 {
        width: 45%;
        height: 100%;
        background-image: url(images/quadro_borrado1.svg);
        background-size: cover;
        font-size: 4em;
        color: #F8FD0C;
    }
    .userIconBtn {
        background-image: url(images/user_icon.png);
        background-size: cover;
        background-position: center;
        border-radius: 50px;
        width: 5vmin;
        height: 5vmin;
    }
</style>
<script> 
    function EntrarCadastrar() {
        window.open("php/login_singin.php", "_self")
    }

</script>

<body>

    <!-- CABEÇALHO PRESO -->

    <header> 
        <table class="tableHD">
            <tr>
                <th>
                    <div style="width: 100%; height: 100%;" class="headerh1"> 
                        <a href="index.php" style="text-decoration: none; color: #ffffff;" id="logo" > <h1> Nothing Gallery </h1> </a>
                    </div>
                </th>
                <th> <div class="searchbar"></div> </th> 
                <th> 
                    <button style="display:block" class="btnEntrar" id="btnEntrar" onclick="EntrarCadastrar();">Entrar/Cadastrar</button>
                    <button style="display:none;" class='userIconBtn' id="userIconBtn" onclick="userIconToggle();"></button>
                </th>
                
            </tr>
        </table>
    </header>
    <script>
    function userLogin() {
        document.getElementById("btnEntrar").style.display = "none";
        document.getElementById("userIconBtn").style.display = "block";
    }
    </script> 

    <main>

        <!-- UserIcon -->
        <div style="display:none" id="userInfos">
            <div class="userIconDiv" id="userIconDiv">
                <button class="userIconDivBtn" onclick="location.href='php/usuario.php'">Minhas Informações</button>
                <button class="userIconDivBtn" onclick="location.href='php/logout.php'">Sair</button>
            </div>
        </div>
        
        <!-- QUADROS EM DESTAQUE  -->

        <table class="tableSpecial">
            <tr>
                <th class="TS_th1"> Quadros em destaque <img src="images/estrela.png" alt="estrela" class="estrela"></th>
                <th class="TS_th2">

                    <!-- SLIDESHOW DOS QUADROS-->

                    <!-- Slideshow container -->
                    <div class="slideshow-container" id="quadros0">

                        <div class="mySlidesTmpSp" id="templateQdr">
                            <img src="images/quadro1.svg" style="width: 90vmin;" alt="RainEngland">
                            <div class="text"> Rain England </div>
                        </div>

                        <!-- Full-width images with number and caption text -->
                        <div class="mySlides fade">
                            <img src="images/quadro1.svg" style="width: 90vmin;" alt="RainEngland">
                            <div class="text"> Rain England </div>
                        </div>
                    
                        <div class="mySlides fade">
                            <img src="images/quadro2.svg" style="width: 90vmin;" alt="TaigaFlorest">
                            <div class="text"> Taiga Florest </div>
                        </div>
                    
                        <div class="mySlides fade">
                            <img src="images/quadro3.svg" style="width: 90vmin;" alt="CubicPenguin">
                            <div class="text"> Cubic Penguin </div>
                        </div>
                    
                        <div class="container_plusSlides">
                            <table>
                                <!-- Next and previous buttons -->
                                <td><a class="prev" onclick="plusSlides(-1)">&#10094;</a></td>
                                <td><a class="next" onclick="plusSlides(1)">&#10095;</a></td>
                            </table>
                        </div>
                    </div>
                </th>
            </tr>
        </table>

        <!-- RODAPÉ DOS QUADROS EM DESTAQUE -->

        <div class="divspecial">
            <table class="table_rodapespecial">
                <tr>
                    <th> <img src="images/parcelamento.png" alt="parcelamento" style="width: 40%; height: 40%;"> </th>
                    <th> <img src="images/entregaBr.png" alt="entrega" style="width: 35%; height: 35%;"></th>
                </tr>
            </table>
        </div>

        <br><br><br><br><br>

        <table>
            <tr>
                <th class="tbquadros">QUADROS</th>
            </tr>
        </table>
        <br><br>
  

        <!-- ANALOGIA -->

        <div style="background-color: #000000e5; height: 78vmin; width: 90vmin;" class="quadro">
            <table class="tableQuadros">
                <tr>
                    <th colspan="3">
                        <h1 class="h1grunge"><u>ANALOGIA</u></h1>
                        <br>
                    </th>
                </tr>

                <?php
                // Buscar quadros da categoria GRUNGE (exemplo: idCategoria = 1)
                $stmt = $pdo->prepare("SELECT idQuadros, nome, imagemDiretorio FROM Quadros WHERE idCategoria = 1");
                $stmt->execute();
                $quadros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;

                foreach ($quadros as $q) {
                    if ($count % 3 == 0) echo "<tr>"; // nova linha a cada 3 quadros

                    $id = $q['idQuadros'];
                    $nome = htmlspecialchars($q['nome']);
                    $img = BASE_URL . '/' . ltrim($q['imagemDiretorio'], '/');

                    echo "
                <td class='tdQuadros'>
                    <div class='mySlidesQDR fade'>
                        <button onclick='Enviar($id)' class='buttonQuadro'>
                            <img src='$img' class='quadro_slide'>
                            <div class='text_quadros'> $nome </div>
                        </button>
                    </div>
                    <br>
                </td>";

                    $count++;
                    if ($count % 3 == 0) echo "</tr>"; // fecha linha
                }

                // Fecha a linha se não completou 3 colunas
                if ($count % 3 != 0) echo "</tr>";
                ?>
            </table>
        </div>

        <br>
    
        <!-- CUBISMO -->

        <div style="background-color: #000000e5; height: 78vmin; width: 90vmin;" class="quadro">
            <table class="tableQuadros">
                <tr>
                    <th colspan="3">
                        <h1 class="h1grunge"><u>CUBISMO</u></h1>
                        <br>
                    </th>
                </tr>

                <?php
                // Buscar quadros da categoria GRUNGE (exemplo: idCategoria = 1)
                $stmt = $pdo->prepare("SELECT idQuadros, nome, imagemDiretorio FROM Quadros WHERE idCategoria = 2");
                $stmt->execute();
                $quadros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;

                foreach ($quadros as $q) {
                    if ($count % 3 == 0) echo "<tr>"; // nova linha a cada 3 quadros

                    $id = $q['idQuadros'];
                    $nome = htmlspecialchars($q['nome']);
                    $img = BASE_URL . '/' . ltrim($q['imagemDiretorio'], '/');

                    echo "
                <td class='tdQuadros'>
                    <div class='mySlidesQDR fade'>
                        <button onclick='Enviar($id);' class='buttonQuadro'>
                            <img src='$img' class='quadro_slide'>
                            <div class='text_quadros'> $nome </div>
                        </button>
                    </div>
                    <br>
                </td>";

                    $count++;
                    if ($count % 3 == 0) echo "</tr>"; // fecha linha
                }

                // Fecha a linha se não completou 3 colunas
                if ($count % 3 != 0) echo "</tr>";
                ?>
            </table>
        </div>

        <br>

        <!-- FOTORREALISMO -->

        <div style="background-color: #000000e5; height: 78vmin; width: 90vmin;" class="quadro">
            <table class="tableQuadros">
                <tr>
                    <th colspan="3">
                        <h1 class="h1grunge"><u>FOTOREALISTA</u></h1>
                        <br>
                    </th>
                </tr>

                <?php
                // Buscar quadros da categoria GRUNGE (exemplo: idCategoria = 1)
                $stmt = $pdo->prepare("SELECT idQuadros, nome, imagemDiretorio FROM Quadros WHERE idCategoria = 3");
                $stmt->execute();
                $quadros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;

                foreach ($quadros as $q) {
                    if ($count % 3 == 0) echo "<tr>"; // nova linha a cada 3 quadros

                    $id = $q['idQuadros'];
                    $nome = htmlspecialchars($q['nome']);
                    $img = BASE_URL . '/' . ltrim($q['imagemDiretorio'], '/');

                    echo "
                <td class='tdQuadros'>
                    <div class='mySlidesQDR fade'>
                        <button onclick='Enviar($id);' class='buttonQuadro'>
                            <img src='$img' class='quadro_slide'>
                            <div class='text_quadros'> $nome </div>
                        </button>
                    </div>
                    <br>
                </td>";

                    $count++;
                    if ($count % 3 == 0) echo "</tr>"; // fecha linha
                }

                // Fecha a linha se não completou 3 colunas
                if ($count % 3 != 0) echo "</tr>";
                ?>
            </table>
        </div>

        <br>

        <!-- GRUNGE -->

        <div style="background-color: #000000e5; height: 78vmin; width: 90vmin;" class="quadro">
            <table class="tableQuadros">
                <tr>
                    <th colspan="3">
                        <h1 class="h1grunge"><u>GRUNGE</u></h1>
                        <br>
                    </th>
                </tr>

                <?php
                // Buscar quadros da categoria GRUNGE (exemplo: idCategoria = 1)
                $stmt = $pdo->prepare("SELECT idQuadros, nome, imagemDiretorio FROM Quadros WHERE idCategoria = 4");
                $stmt->execute();
                $quadros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;

                foreach ($quadros as $q) {
                    if ($count % 3 == 0) echo "<tr>"; // nova linha a cada 3 quadros

                    $id = $q['idQuadros'];
                    $nome = htmlspecialchars($q['nome']);
                    $img = BASE_URL . '/' . ltrim($q['imagemDiretorio'], '/');

                    echo "
                <td class='tdQuadros'>
                    <div class='mySlidesQDR fade'>
                        <button onclick='Enviar($id);' class='buttonQuadro'>
                            <img src='$img' class='quadro_slide'>
                            <div class='text_quadros'> $nome </div>
                        </button>
                    </div>
                    <br>
                </td>";

                    $count++;
                    if ($count % 3 == 0) echo "</tr>"; // fecha linha
                }

                // Fecha a linha se não completou 3 colunas
                if ($count % 3 != 0) echo "</tr>";
                ?>
            </table>
        </div>

        <br>        

        <!-- SURREALISMO -->

        <div style="background-color: #000000e5; height: 78vmin; width: 90vmin;" class="quadro">
            <table class="tableQuadros">
                <tr>
                    <th colspan="3">
                        <h1 class="h1grunge"><u>SURREALISMO</u></h1>
                        <br>
                    </th>
                </tr>

                <?php
                // Buscar quadros da categoria GRUNGE (exemplo: idCategoria = 1)
                $stmt = $pdo->prepare("SELECT idQuadros, nome, imagemDiretorio FROM Quadros WHERE idCategoria = 5");
                $stmt->execute();
                $quadros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;

                foreach ($quadros as $q) {
                    if ($count % 3 == 0) echo "<tr>"; // nova linha a cada 3 quadros

                    $id = $q['idQuadros'];
                    $nome = htmlspecialchars($q['nome']);
                    $img = BASE_URL . '/' . ltrim($q['imagemDiretorio'], '/');

                    echo "
                <td class='tdQuadros'>
                    <div class='mySlidesQDR fade'>
                        <button onclick='Enviar($id)' class='buttonQuadro'>
                            <img src='$img' class='quadro_slide'>
                            <div class='text_quadros'> $nome </div>
                        </button>
                    </div>
                    <br>
                </td>";

                    $count++;
                    if ($count % 3 == 0) echo "</tr>"; // fecha linha
                }

                // Fecha a linha se não completou 3 colunas
                if ($count % 3 != 0) echo "</tr>";
                ?>
            </table>
        </div>

        <br>

        <!-- VARIADO -->

        <div style="background-color: #000000e5; height: 78vmin; width: 90vmin;" class="quadro">
            <table class="tableQuadros">
                <tr>
                    <th colspan="3">
                        <h1 class="h1grunge"><u>VARIADO</u></h1>
                        <br>
                    </th>
                </tr>

                <?php
                // Buscar quadros da categoria GRUNGE (exemplo: idCategoria = 1)
                $stmt = $pdo->prepare("SELECT idQuadros, nome, imagemDiretorio FROM Quadros WHERE idCategoria = 6");
                $stmt->execute();
                $quadros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count = 0;

                foreach ($quadros as $q) {
                    if ($count % 3 == 0) echo "<tr>"; // nova linha a cada 3 quadros

                    $id = $q['idQuadros'];
                    $nome = htmlspecialchars($q['nome']);
                    $img = BASE_URL . '/' . ltrim($q['imagemDiretorio'], '/');

                    echo "
                <td class='tdQuadros'>
                    <div class='mySlidesQDR fade'>
                        <button onclick='Enviar($id)' class='buttonQuadro'>
                            <img src='$img' class='quadro_slide'>
                            <div class='text_quadros'> $nome </div>
                        </button>
                    </div>
                    <br>
                </td>";

                    $count++;
                    if ($count % 3 == 0) echo "</tr>"; // fecha linha
                }

                // Fecha a linha se não completou 3 colunas
                if ($count % 3 != 0) echo "</tr>";
                ?>
            </table>
        </div>

    </main>



    <br><br>

    

    <footer>
        <div class="tbfooter"><br><br>
                <div class="thfooter">Contate-nos</div>
                    <br>
                    <a href="https://www.instagram.com/" target="_blank" class="links"> Instagram </a> <br>
                    <a href="https://twitter.com/i/flow/login" target="_blank" class="links"> Twitter </a> <br>
                    <a href="https://www.youtube.com/" target="_blank" class="links"> Youtube </a> <br>
                    <l style="font-size: 1.5em;">Nothing_gallery@gmail.com</l>
        </div>
    </footer>

</body>
<script>
    function Enviar(N)
    {
        window.open("php/comprar.php?cod="+N,"_self");
    }
</script>
</html>

