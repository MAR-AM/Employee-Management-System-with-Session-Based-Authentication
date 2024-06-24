<?php
    require_once 'conxDB.php';
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user = $_POST['user'];
        $pwd = $_POST['pwd'];

        $stmt = $conx->prepare("SELECT * FROM employe WHERE user = ? AND pwd = ?");
        $stmt->execute([$user, $pwd]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            session_start(); 
            $_SESSION['info'] = $employee['codeEmp'];
            header("Location: menu.php");
        } else {
            echo '<div class="alert alert-danger"> User name or password incorrect </div>';
        }
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Login</title>
    <style>
        .container {
            border: 1px solid #ccc;
            padding: 20px; 
            border-radius: 10px; 
            margin-top: 70px; 
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container w-50" align="center">
        <h1 align="center">Employee Login</h1>
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">User name:</label>
                <input type="email" class="form-control w-50" id="exampleInputEmail1" name="user" placeholder="Enter user name" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password:</label>
                <input type="password" class="form-control w-50" id="exampleInputPassword1" name="pwd" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-25">Submit</button>
        </form>
    </div>
</body>
</html>
