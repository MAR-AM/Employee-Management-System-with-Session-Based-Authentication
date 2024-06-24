<?php
        require_once 'conxDB.php';
        include 'menu.php';

        

        $depar = $conx->query("SELECT DISTINCT villeD FROM descvoyage");
        $optionsD = $depar->fetchAll(PDO::FETCH_ASSOC);

        if (isset($_POST['villD'])) {
            $villD = $_POST['villD'];

            $arrive = $conx->prepare("SELECT DISTINCT villeA FROM descvoyage WHERE villeD = ?");
            $arrive->execute([$villD]);
            $optionsA = $arrive->fetchAll(PDO::FETCH_ASSOC);
        }

        if (isset($_POST['click'])) {

            $dateV = $_POST['dateV'];
            $nbrP = $_POST['nbrP'];
            $villD = $_POST['villD'];
            $villA = $_POST['villA'];


            $fetchCodeD = $conx->prepare("SELECT codeDesc FROM descvoyage WHERE villeD = ? AND villeA = ?");
            $fetchCodeD->execute([$villD, $villA]);
            $codeDescResult = $fetchCodeD->fetch(PDO::FETCH_ASSOC);
            $codeDesc = $codeDescResult['codeDesc'];

            $fetchCodeT = $conx->prepare("SELECT codeTrans FROM voyage WHERE codeDesc = ?");
            $fetchCodeT->execute([$codeDesc]);
            $codeTransResult = $fetchCodeT->fetch(PDO::FETCH_ASSOC);
            $codeTrans = $codeTransResult['codeTrans'];

            $fetchCodeV = $conx->prepare("SELECT codeVoyage FROM voyage WHERE codeDesc = ? AND codeTrans = ?");
            $fetchCodeV->execute([$codeDesc , $codeTrans ]);
            $codeVResult = $fetchCodeV->fetch(PDO::FETCH_ASSOC);
            $codeVoyage = $codeVResult['codeVoyage'];


            $ajout = $conx->prepare("INSERT INTO inscription  VALUES (NULL, ?, ?, ?, ?)");
            $ajout->execute([$user, $codeVoyage, $nbrP, $dateV]);

            if ( $ajout) {
                echo '<script> alert("Inscription réussie!")</script>';
            } 
            else {
                echo "Erreur lors de l'inscription.";
                }
            }

            
        
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Document</title>
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
    <div class="container" align="center">
        <form method="post">
            <div class="form-group">
                <label for="villD">Ville Départ :</label>
                <select class="form-select form-select-lg w-50" name="villD" onchange="form.submit()">
                    <option value="">Sélectionner la ville de départ</option>
                    <?php foreach ($optionsD as $option): ?>
                        <option value="<?php echo $option['villeD']; ?>" <?php echo (isset($villD) && $villD == $option['villeD']) ? 'selected' : ''; ?>>
                            <?php echo $option['villeD']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="villA">Ville d'Arrivée :</label>
                <select class="form-select form-select-lg w-50" name="villA">
                    <option value="">Sélectionner la ville d'arrivée</option>
                    <?php foreach ($optionsA as $option): ?>
                        <option value="<?php echo $option['villeA']; ?>" <?php echo (isset($villA) && $villA == $option['villeA']) ? 'selected' : ''; ?>>
                            <?php echo $option['villeA']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="dateV">Date de voyage :</label>
                <input type="date" class="form-control w-50" id="dateV" name="dateV" placeholder="Entrer la date de voyage" required>
            </div>

            <div class="form-group">
                <label for="nbrP">Nombre de personnes :</label>
                <input type="number" class="form-control w-50" id="nbrP" name="nbrP" placeholder="Entrer le nombre de personnes" required>
            </div><br>

            <button type="submit" class="btn btn-primary w-50" name="click">S'inscrire</button>
        </form>
    </div>
</body>
</html>
