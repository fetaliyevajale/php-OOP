<?php

require_once 'QueryBuilder.php';

QueryBuilder::$table = 'users';
$users = QueryBuilder::all();

if (!is_array($users)) {
    echo "Məlumatlar düzgün alınmadı!";
    var_dump($users); 
    exit; 
}
?>

<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İstifadəçilər</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>İstifadəçi Siyahısı</h1>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ad</th>
            <th>Soyad</th>
            <th>Email</th>
            <th>Əməliyyatlar</th>
        </tr>
    </thead>
    <tbody>
        <?php if (is_array($users) && !empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <?php 
    
                $id = $user['id'] ?? 'Mövcud deyil'; 
                $name = $user['name'] ?? 'Mövcud deyil'; 
                $surname = $user['surname'] ?? 'Mövcud deyil'; 
                $email = $user['email'] ?? 'Mövcud deyil'; 
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($id); ?></td>
                    <td><?php echo htmlspecialchars($name); ?></td>
                    <td><?php echo htmlspecialchars($surname); ?></td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlspecialchars($id); ?>">Düzəliş et</a>
                        <a href="delete.php?id=<?php echo htmlspecialchars($id); ?>" onclick="return confirm('Silmek istediyinize eminsiniz?');">Sil</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Məlumat tapılmadı!</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
