<?php

require_once 'QueryBuilder.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);


    QueryBuilder::$table = 'users';


    $db = QueryBuilder::connect();

    try {
  
        $sql = "DELETE FROM " . QueryBuilder::$table . " WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

    
        echo "İstifadəçi silindi. <a href='User.php'>Geri dön</a>";
    } catch (PDOException $e) {
        echo "Silinmə xətası: " . $e->getMessage();
    }
} else {
    echo "İstifadəçi ID-si təqdim edilməyib.";
}

?>
