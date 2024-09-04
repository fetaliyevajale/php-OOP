<?php
require_once 'QueryBuilder.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('İstifadəçi ID-si təmin edilməmişdir.');
}


QueryBuilder::$table = 'users';
$users = QueryBuilder::all();
$user = array_filter($users, fn($u) => $u['id'] == $id);
$user = reset($user);

if (!$user) {
    die('İstifadəçi tapılmadı.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $email = $_POST['email'] ?? '';
    

    $query = "UPDATE users SET name = :name, surname = :surname, email = :email WHERE id = :id";
    $params = [
        ':name' => $name,
        ':surname' => $surname,
        ':email' => $email,
        ':id' => $id
    ];

    $db = QueryBuilder::connect();
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    
    header('Location: index.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İstifadəçi Düzəlişi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        
        h1 {
            color: #444;
            text-align: center;
            
        }

        form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 500px;
            margin: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 15px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        a {
            color: #007bff;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>



<form method="post">
    <label for="name">Ad:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required>
    
    <label for="surname">Soyad:</label>
    <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($user['surname'] ?? ''); ?>" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
    
    <input type="submit" value="Yenilə">

    <a href="index.php">Geri dön</a>
</form>



</body>
</html>


