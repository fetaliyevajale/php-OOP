<?php

class QueryBuilder
{
    public static string $table = '';
    private static string $host = 'localhost';
    private static string $user = 'root';
    private static string $password = '';
    private static string $database = 'backendproject';
    private static $connection = null;

    public static function connect()
    {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$database,
                    self::$user,
                    self::$password
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Bağlantı xətası: " . $e->getMessage();
                exit;
            }
        }
        return self::$connection;
    }

    public static function all()
    {
        $db = self::connect();
        $sql = "SELECT * FROM " . self::$table;
        $query = $db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($data)
    {
        $db = self::connect();
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO " . self::$table . " ($columns) VALUES ($placeholders)";
        $query = $db->prepare($sql);
        return $query->execute($data);
    }

    public static function update($id, $data)
    {
        $db = self::connect();
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ", ");
        $sql = "UPDATE " . self::$table . " SET $set WHERE id = :id";
        $data['id'] = $id;
        $query = $db->prepare($sql);
        return $query->execute($data);
    }

    public static function delete($id)
    {
        $db = self::connect();
        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
        $query = $db->prepare($sql);
        return $query->execute(['id' => $id]);
    }
}
?>
