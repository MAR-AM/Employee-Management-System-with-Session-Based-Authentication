<?php
    require_once 'conxDB.php';
    session_start();
    $user = $_SESSION['info'];

    $stmt = $conx->prepare("SELECT * FROM employe WHERE codeEmp = ?");
    $stmt->execute([$user]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Menu</title>
    <style>
        .container {
            border: 1px solid #ccc;
            padding: 20px; 
            border-radius: 10px; 
            margin-top: 20px; 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="S'inscrire.php">S'inscrire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="listIns.php">Liste de Voyages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="deconx.php" onclick="return confirm('voules vous vraiment deconnecter ? ')">Se deconnecter</a>
                </li>
            </ul>
        </div>

    </nav>

    <div class="container">

        <?php

            if ($result) {
                echo "<p>Nom: " .$result['nom']. "</p>";
                echo "<p>Fonction: " .$result['fonction']. "</p>";
            } 

        ?>
    </div>
</body>
</html>
