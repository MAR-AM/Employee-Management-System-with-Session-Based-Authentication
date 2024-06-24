<?php 

    require 'conxDB.php';
    include 'menu.php';

    $list = $conx->prepare  ('SELECT descvoyage.codeDesc, descvoyage.villeD, descvoyage.villeA,
                                    inscription.dateVoy, Voyage.codeVoyage, Voyage.heureDepart, Voyage.duree,
                                    ADDTIME(Voyage.heureDepart, Voyage.duree) AS heureArrive
                                FROM
                                    inscription
                                JOIN
                                    Voyage ON inscription.codeVoyage = Voyage.codeVoyage
                                JOIN
                                    descvoyage ON Voyage.codeDesc = descvoyage.codeDesc
                                JOIN
                                    employe ON inscription.codeEmp = employe.codeEmp
                                WHERE 
                                    inscription .codeEmp = ?
                                GROUP BY
                                    descvoyage.codeDesc, inscription.dateVoy, Voyage.codeVoyage, 
                                    descvoyage.villeD, descvoyage.villeA, Voyage.heureDepart, Voyage.duree
                            ');
    $list->execute([$user]);
    $result = $list->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <table class="table">
                
                <tr>
                    <th scope="col">Date de voyage</th>
                    <th scope="col">Ville de depart </th>
                    <th scope="col">Ville d'arrive </th>
                    <th scope="col">Heure de depart</th>
                    <th scope="col">Heure d'arrive </th>
                </tr>

            <tbody>
            
                <?php foreach($result as $val) : ?>

                    <tr>
                        <td><?php echo $val['dateVoy']; ?></td>
                        <td><?php echo $val['villeD']; ?></td>
                        <td><?php echo $val['villeA']; ?></td>
                        <td><?php echo $val['heureDepart']; ?> </td>
                        <td><?php echo $val['heureArrive']; ?> </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</body>
</html>
