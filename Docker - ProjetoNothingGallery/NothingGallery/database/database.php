<?php

$dbhost = getenv("DB_HOST") ?: "localhost";
$dbuser = getenv("DB_USER") ?: "root";
$dbpass = getenv("DB_PASS") ?: "";
$dbname = getenv("DB_NAME") ?: "nothing_gallery";

try {
    $pdo = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Conectado ao MySQL\r\n";
} catch(PDOException $e) {
    die("Falha na conexão inicial: " . $e->getMessage());
}

try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
//    echo "Banco de dados verificado/criado: $dbname\r\n";
} catch(PDOException $e) {
    die("Erro ao criar banco de dados: " . $e->getMessage());
}

try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully \r\n";

} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS Migrations(
            idMigration    INT UNIQUE NOT NULL AUTO_INCREMENT,
            nome           VARCHAR(255),
            data_aplicacao DATETIME DEFAULT CURRENT_TIMESTAMP,
            CONSTRAINT     PK_Migrations PRIMARY KEY(idMigration)
        );
    ");
//    echo "Tabela de controle de migrations verificada/criada\r\n";
} catch(PDOException $e) {
    die("Erro ao criar tabela de migrations: " . $e->getMessage());
}
try {
    $stmt = $pdo->query("SELECT nome FROM Migrations");
    $aplicadas = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    die("Erro ao consultar migrations aplicadas: " . $e->getMessage());
}


$migrationDir = __DIR__ . "/migrations";
$migrationsFiles = glob($migrationDir. "/*.sql");
sort($migrationsFiles);

foreach ($migrationsFiles as $migrationFile) {
    $nomeMigration = basename($migrationFile);

    if (in_array($nomeMigration, $aplicadas)) {
//        echo "Migration já aplicada, ignorando: $nomeMigration\r\n";
        continue;
    }

//    echo "Executando migration: " . $migrationFile . "\r\n";
    $sql = file_get_contents($migrationFile);

    try {
        $pdo->exec($sql);
        $stmt = $pdo->prepare("INSERT INTO Migrations (nome) VALUES (:nome)");
        $stmt->execute([':nome' => $nomeMigration]);
//        echo "Migration executed\r\n";
    } catch(PDOException $e) {
        echo "Migration failed: " . $e->getMessage();
    }
}
return $pdo;
