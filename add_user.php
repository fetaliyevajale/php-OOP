<?php

require_once 'QueryBuilder.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  
    QueryBuilder::$table = 'users';
    $data = [
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'password' => $hashedPassword
    ];

    if (QueryBuilder::insert($data)) {
        echo "İstifadəçi uğurla əlavə olundu!";
    } else {
        echo "Bir xəta baş verdi!";
    }
}
?>

<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yeni İstifadəçi Əlavə Et</title>
</head>
<body>

<h1>Yeni İstifadəçi Əlavə Et</h1>

<form method="post">
    <label for="name">Ad:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="surname">Soyad:</label>
    <input type="text" id="surname" name="surname" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Şifrə:</label>
    <input type="password" id="password" name="password" required>
    
    <input type="submit" value="Əlavə et">
</form>

<a href="index.php">Geri dön</a>

</body>
</html>
