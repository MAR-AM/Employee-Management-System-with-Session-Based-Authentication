<?php 

        require_once 'conxDB.php';
        include 'menu.php';
        

        $list = $conx->prepare('SELECT descvoyage .codeDesc, inscription .dateVoy, inscription .nbrPers,
                                COUNT(inscription .nbrPers) AS Nombre_Personnes_inscri,
                                SUM(Voyage .prixTocket) * inscription .nbrPers  AS Total_A_Payer
                                FROM
                                    inscription
                                JOIN
                                    Voyage ON inscription .codeVoyage = Voyage .codeVoyage
                                JOIN
                                    descvoyage ON Voyage .codeDesc = descvoyage .codeDesc
                                JOIN
                                    employe ON inscription .codeEmp = employe .codeEmp
                                WHERE
                                    employe .codeEmp = ?
                                GROUP BY
                                    descvoyage .codeDesc, inscription .dateVoy, inscription .nbrPers ;
                                ');
        $list -> execute([$user]);
        $result = $list->fetchAll(PDO::FETCH_ASSOC);
        
        // var_dump($result);
        

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    
    
    <div class="container">
        <table class="table">
                
                <tr>
                    <th scope="col">Date de voyage</th>
                    <th scope="col">Nombre Personne </th>
                    <th scope="col">Nombre Personne inscri</th>
                    <th scope="col">Total A payer</th>
                    <th scope="col"> Details </th>

                </tr>

            <tbody>
            
            <?php foreach($result as $i) : ?>
                <tr>
                    <td><?php echo $i['dateVoy']; ?></td>
                    <td><?php echo $i['nbrPers']; ?></td>
                    <td><?php echo $i['Nombre_Personnes_inscri']; ?></td>
                    <td><?php echo $i['Total_A_Payer']; ?>  MAD</td>
                    <td> <a href="details.php?codeDesc <?php echo $i['codeDesc'] ; ?>" class="btn btn-info btn-md w-100">Afficher</a> </td>
                </tr>
                
            </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    

</body>
</html>